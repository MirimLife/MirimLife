<?php
    $pw = $_GET['pw'];
    session_start();
    $id = $_SESSION['id'];

    include ('db_conn.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "update members set passwd = '$pw' where id = '$id';";
    mysqli_query($con, $sql);
?>