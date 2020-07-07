<?php
    session_start();
    $id = $_SESSION['id'];
    $title = $_POST['title'];
    $member = $_POST['member'];
    $date = $_POST['date'];
    $contents = $_POST['contents'];
    $today = date('Y-m-d');

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

    $fieldContents = "";
    for($i = 0; $i < count($_POST['field']); $i++) {
        $field = $_POST['field'];
        $fieldContents = $fieldContents.$field[$i]." / ";
    }
    $fieldContents = substr($fieldContents, 0, strlen($fieldContents) - 1);

    

    include ('db_conn.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $sql = "insert into team (writer, title, member, field, date, Wdate, content, views) values ('$id', '$title', $member, '$fieldContents', '$date', '$today', '$contents', 0);";
    $result = mysqli_query($con, $sql);
    if(!$result) {
        echo("쿼리오류 발생: " . mysqli_error($con));
    }
    mysqli_close($con);

    echo "<script> alert('글 작성이 완료되었습니다.'); location.replace('MirimTeam.php');; </script>";
    
?>