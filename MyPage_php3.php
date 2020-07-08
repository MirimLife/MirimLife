<?php
    session_start();
    $id = $_SESSION['id'];

    include ('db_conn.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "delete from members where id = '$id';";
    mysqli_query($con, $sql);
?>