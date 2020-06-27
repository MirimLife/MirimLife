<?php

    $title = $_POST['title'];
    $member = $_POST['member'];
    $field = $_POST['field'];
    $date = $_POST['date'];
    $contents = $_POST['contents'];

    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

    include ('db_conn.php');
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "insert into team (title, member, field, date, content, views) values ('$title', $member, '$field', '$date', '$contents', 0);";
    $result = mysqli_query($con, $sql);
    if(!$result) {
        echo "데이터 입력에 실패하였습니다.";
    }
    mysqli_close($con);
    echo "ㅇㅇㅇ";

    
?>