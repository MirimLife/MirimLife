<?php
    include ('db_conn.php');
    $uploads_dir = './notice_file';
    $title = $_POST["title"];
    $fileName = "file";
    $contents = $_POST["contents"];
    $DBFile = "0";

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

    if(is_uploaded_file($_FILES[$fileName]['tmp_name'])){

        if(!is_dir($uploads_dir)){
            if(!mkdir($uploads_dir, 0777))
                die("업로드 디렉토리 생성에 실패 했습니다.");
        }
        $error = $_FILES[$fileName]['error'];
        $name = $_FILES[$fileName]['name'];
        // 오류 확인
        if( $error != UPLOAD_ERR_OK ) {
            switch( $error ) {
                case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                    echo "<script> alert('파일 용량이 너무 큽니다.'); location.replace('Write.php'); </script>";
                break;
                case UPLOAD_ERR_PARTIAL:
                    echo "<script> alert('파일이 부분적으로 첨부되었습니다.'); location.replace('Write.php'); </script>";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo "<script> alert('임시파일을 저장할 디렉토리가 없습니다.'); location.replace('Write.php'); </script>";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo "<script> alert('임시파일을 생성할 수 없습니다.'); location.replace('Write.php'); </script>";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo "<script> alert('업로드 불가능한 파일입니다.'); location.replace('Write.php'); </script>";
                    default:
                    echo "<script> alert('파일이 제대로 업로드되지 않았습니다.'); location.replace('Write.php'); </script>";
                }
                exit;
        }
        
        $uploadFile = $uploads_dir.'/'.$name; // 저장될 디렉토리 및 파일명
        $fileNameWithoutExt = substr($name, 0, strrpos($name, ".")); //확장자 뺀 파일이름
        $file_ext = strtolower(substr(strrchr($name, "."), 1)); //확장자
        $fileinfo = pathinfo($uploadFile); // 첨부파일의 정보를 가져옴
        $i = 1;
        
        while(is_file($uploadFile)){
            $name = $fileNameWithoutExt."-{$i}.".$file_ext;
            $uploadFile = $uploads_dir.'/'.$name;
            $i++;
        }
        $DBFile = $uploadFile;
        $uploadFile = iconv("utf-8","EUC-KR", $uploadFile);
        echo $uploadFile;
        echo $_FILES[$fileName]['tmp_name'];
        if ( !move_uploaded_file($_FILES[$fileName]['tmp_name'], $uploadFile) ) { // 파일 이동
            echo "파일이 업로드 되지 않았습니다.";
            exit;
        }
    }

    $today = date('Y-m-d');


    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "insert into notice (title, file, contents, date, views) values ('$title', '$DBFile', '$contents', '$today', 0);";
    if (!mysqli_query ($con, $sql)){
        echo("쿼리오류 발생: " . mysqli_error($con));
    }

    mysqli_close($con);

    echo "<script> alert('등록되었습니다.'); location.replace('Notice.php'); </script>";
?>