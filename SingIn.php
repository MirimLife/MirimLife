<?php
    $id = $_POST["id"];
    $pw = $_POST['pw'];
    echo $id;
    echo $pw;
    $con = mysqli_connect("localhost","mirimlife","itshow1!","mirimlife");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "select id, passwd from members";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            if($row['id'] == $id && $row['passwd'] == $pw) {
                session_start();
                $_SESSION['id'] = $_POST["id"];
                echo("<script>location.href='index_2.php'</script>");
            }
        }
    }
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo "<script type='text/javascript' src='script.js' charset='utf-8'> alert('아이디 혹은 비밀번호가 일치하지 않습니다.'); location.replace('SignIn.html'); </script>";
?>