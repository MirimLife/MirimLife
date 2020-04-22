<?php
    $id = $_POST["id"];
    $pw = $_POST["pw"];
    $name = $_POST["name"];
    $birth = $_POST["birth"];
    $grade = $_POST["grade"];
    $class = $_POST["class"];

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

    include ('db_conn.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "insert into members (id, passwd, name, birth, grade, class) values ('$id', '$pw', '$name', '$birth', $grade, $class);";
    $result = mysqli_query($con, $sql);
    if(!$result) {
        echo "데이터 입력에 실패하였습니다.";
    }
    mysqli_close($con);
    

    echo "<script> alert('회원가입을 완료했습니다.'); location.replace('SignIn.html');; </script>";
?>