<?php
    $id = $_POST["id"];
    $pw = $_POST['pw'];

    $con = mysqli_connect("localhost","mirimlife","33glxoL1B2N2IXjO","mirimlife");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "select passwd from members where id = '$id';";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            if($row['passwd'] == $pw) {
                session_start();
                $_SESSION['id'] = $id;
                echo "<script>location.href='index.php'</script>";
            }
        }
    }
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo "<script> alert('아이디 혹은 비밀번호가 일치하지 않습니다.'); location.replace('SignIn.html'); </script>";
?>