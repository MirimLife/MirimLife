<?php
    $id = $_POST["id"];
    $pw = $_POST["pw"];
    $pw_again = $_POST["pw_again"];
    $name = $_POST["name"];
    $birth = $_POST["birth"];
    $check = 1;

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    if($pw != $pw_again) {
        $check = 0;
        echo "<script> alert('비밀번호가 일치하지 않습니다.'); location.replace('SignUp.html'); </script>";
    }

    if($check) {
        $con = mysqli_connect("localhost","mirimlife","itshow1!","mirimlife");
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql = "insert into members (id, passwd, name, birth) values ('$id', '$pw', '$name', '$birth');";
        $result = mysqli_query($con, $sql);
        if(!$result) {
            echo "데이터 입력에 실패하였습니다.";
        }
        mysqli_close($con);
    }

    echo "<script> alert('회원가입을 완료했습니다.'); location.replace('SignIn.html');; </script>";
?>