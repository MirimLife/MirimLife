<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="./CSS/Map.css">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.71">
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Black+Han+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">

    <title>코로나맵</title>
</head>
<body style = "position: fixed;" onload="document.inputForm.name.focus();" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <!-- <div id="BG">
        <img src="IMG/SignUp/BG2.png" id="BG-img">
    </div> -->

    <div id="wrapper">
        <div id="nav">   <!-- 네비게이션 바 -->
            <a href="index.php" id="Logo">
                <img id="Logo-img" src="IMG/Main/logo.png">
            </a>

            <ul class="Menu">
                <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
                <li class="Menu-item"><a href = "Calendar.php">일정확인</a></li>
                <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
                <li class="Menu-item"><a href = "Library.php">도서관</a></li>
                <li class="Menu-item"><a href = "#">학습보고서</a></li>
                <li class="Menu-item"><a href = "Map.php" class="selected">코로나맵</a></li>
                <li class="Menu-item"><a href="https://bit.ly/mirimmusic">음악신청</a></li>
            </ul>

            <div class="Sign"> <!-- 로그인, 회원가입 버튼-->
                <?php
                        include ('db_conn.php');
                    session_start();

                    if(isset($_SESSION['id'])) {
                        $id = $_SESSION['id'];
                        
                        if (mysqli_connect_errno()){
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $sql = "select name from members where id = '$id'";
                        $result = mysqli_query($con, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_array($result);
                            $name = $row['name'];
                            echo '<a href="MyPage.php"><p id="username">',$name,'님&nbsp;</p></a>';
                        }
                        echo "<a id='LogOut'  href='logout.php'>로그아웃</a>";
                    }
                    else {
                        echo '<a href="SignIn.html"><img class="Sign-In" src="IMG/Main/Login.png"></a>';
                        echo '<a href="SignUp.html"><img class="Sign-Up" src="IMG/Main/SignUp.png"></a>';
                    }
                ?> 
            </div>
        </div>

        <div class="container">
            <div class="contents">
                <div class="title">
                    <p class="title-p">코로나맵</p>
                    <p class="descriptions-p">주변 약국에서 파는 마스크를 알려드립니다</p>
                </div>
    
                <div class="window">
                    <div id="map"></div>

                    <script src="https://dapi.kakao.com/v2/maps/sdk.js?appkey=0f9a52343eadb6e074e2cd73eea45869&libraries=clusterer"></script>
                    <script src="./JS/data.js?ver=1.1"></script>
                    <script src="./JS/map.js?ver=1.1"></script>
                </div> 
            </div>
        </div>
    </div>
</html>