<?php
    $grade = $_GET['grade'];
    $class = $_GET['class'];
    session_start();
    $id = $_SESSION['id'];

    include ('db_conn.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "update members set grade = '$grade', class = '$class' where id = '$id';";
    mysqli_query($con, $sql);

    echo "<script> alert('수정을 완료했습니다.'); location.replace('MyPage.php');; </script>";
?>