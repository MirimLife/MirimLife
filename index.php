<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/index.css?ver=1.7">
    <link rel="stylesheet" type="text/css" href="./CSS/index-ani.css?ver=1.1">

    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <title>MirimLife</title>
</head>
<body style = "position: fixed;" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
   
    <div id="BG">
        <img src="IMG/Main/BG.png" id="BG-img">
    </div>

    <div id="wrapper">
        <!-- 메뉴 바 -->
        <div id="nav">   
            <a href="index.php" id="Logo">
                <img id="Logo-img" src="IMG/Main/logo.png">
            </a>

            <ul class="Menu">
                <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
                <li class="Menu-item"><a href = "#">일정확인</a></li>
                <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
                <li class="Menu-item"><a href = "Forest.php">대나무숲</a></li>
                <li class="Menu-item"><a href = "cafeteria.php">급식확인</a></li>
                <li class="Menu-item"><a href = "Library.php">도서관</a></li>
                <li class="Menu-item"><a href="https://bit.ly/mirimmusic">음악신청</a></li>
            </ul>

            <div class="Sign"> <!-- 로그인, 회원가입 버튼-->
                <?php
                    include ('db_conn.php');
                    session_start();

                    if(isset($_SESSION['id'])) {
                        $id = $_SESSION['id'];
                        // $con = mysqli_connect("localhost","mirimlife","33glxoL1B2N2IXjO","mirimlife");
                        if (mysqli_connect_errno()){
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $sql = "select name from members where id = '$id'";
                        $result = mysqli_query($con, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);
                            $name = $row['name'];
                            echo "<p id='username'>{$name}님&nbsp;</p>";
                        }
                        echo "<a id='LogOut'  href='logout.php'>로그아웃</a>";
                        mysqli_close($con);
                    }
                    else {
                        echo '<a href="SignIn.html"><img class="Sign-In" src="IMG/Main/Login.png"></a>';
                        echo '<a href="SignUp.html"><img class="Sign-Up" src="IMG/Main/SignUp.png"></a>';
                    }
                ?> 
            </div>
        </div>
        <!-- nav 태그 닫기 -->
        <div class="container">
            <div class="content-Left">
                <div class="cont1">
                    <div id="Circle1" class="bounce-in-top-1"></div>                
                    <div id="Circle2" class="bounce-in-top-2"></div>
                    <p><span id="chat">챗봇</span>과 대화하며</p>
                    <p>미림에 대해 더 알아보세요!</p>
                </div>
                <!-- <hr style="width: 550px; margin-top: -20px;"> -->
                <div class="cont2">
                    <p>미림을 다녀본 선배가 미림을 다니며 필요한 것을 여기에 담았다!</p>
                    <p>함께 미림의 모든 것을 알아보자!</p>
                </div>
            </div>

            <div class="content-Right">
                <div class="left-content">              
                    <img class="left-content-people tilt-in-top-1" src="IMG/Main/LP/people.png">
                    <img class="left-content-bubble slide-top" src="IMG/Main/LP/bubble.png">  
                    <img class="left-content-deco" src="IMG/Main/LP/deco.png">
                </div>

                <div class="right-content">
                    <img class="right-content-people tilt-in-top-2" src="IMG/Main/RP/people.png">
                    <img class="right-content-buble1 slide-top" src="IMG/Main/RP/bubble1.png">
                    <img class="right-content-buble2 slide-top" src="IMG/Main/RP/bubble2.png">
                    <img class="right-content-air slide-tr" src="IMG/Main/RP/air.png">
                </div>
            </div>

        </div>
    </div>

    <script id="embeddedChatbot" data-botId="B159mk" src="https://www.closer.ai/js/webchat.min.js"> </script>
</body>
</html>