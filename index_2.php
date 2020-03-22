<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/index.css">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css">
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <title>MirimLife</title>
</head>
<body style = "position: fixed;" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="wrapper">
        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.html">공지사항</a></li>
            <li class="Menu-item"><a href = "#">일정확인</a></li>
            <li class="Menu-item"><a href = "#">미림팀</a></li>
            <li class="Menu-item"><a href = "#">대나무숲</a></li>
            <li class="Menu-item"><a href = "#">급식확인</a></li>
        </ul>

        <div class="Sign">
            <?php
                session_start();
                $id = $_SESSION['id'];
                $con = mysqli_connect("localhost","mirimlife","itshow1!","mirimlife");
                if (mysqli_connect_errno()){
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                $sql = "select name from members where id = '$id'";
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result) > 0) {
                   $row = mysqli_fetch_array($result);
                   $name = $row['name'];
                   echo "{$name}님";
                }
            ?>
            <a href="index.html">로그아웃</a>
        </div>

        <div class="Cont fade-in-top">
            <div class="Cont-cont1">
                <div id="Circle1" class="bounce-in-top-1"></div>                
                <div id="Circle2" class="bounce-in-top-2"></div>
                <p><span id="chat">챗봇</span>과 대화하며</p>
                <p>미림에 대해 더 알아보세요!</p>
            </div>
            <hr style="width: 550px; margin-top: -20px;">
            <div class="Cont-cont2">
                <p>미림을 다녀본 선배가 미림을 다니며 필요한 것을 여기에 담았다!</p>
                <p>함께 미림의 모든 것을 알아보자!</p>
            </div>
        
        </div>

        <img id="IMG1" class="tilt-in-top-1" src="IMG/Main/content_01.png">
        <img id="IMG2" class="tilt-in-top-2" src="IMG/Main/content_02.png">

        <a href="index.html"><img id="Logo" src="IMG/Main/logo.png"></a>
        <img id="BG" src="IMG/Main/BG_01.png">
    </div>
</body>
</html>