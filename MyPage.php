<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/MyPage.css?ver=1.0">
    
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@700&display=swap" rel="stylesheet">

    <title>마이페이지</title>
</head>

<body style="position: fixed;" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="BG">
        <img src="IMG/MyPage/BG.png" id="BG-img">
    </div>
    
    <div id="wrapper">
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
                    session_start();

                    if(isset($_SESSION['id'])) {
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
                            echo `<a href="MyPage.php"><p id="username">{$name}님&nbsp;</p></a>`;
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
            <div class="MyPage-top">
                <p id="MyPage-word">마이페이지</p>
                <p id="MyPage-plus">개인정보를 수정할 수 있는 공간입니다.</p>
                <!-- <hr id="MirimTeam-line" style="width:120px;">   -->
            </div>
            
            <div class="MyPage-bottom">
                <!-- 내정보 -->
                <div class = "MyPage-left">
                    <P id="MyInfo">내정보</P>
                    <img src="IMG/MyPage/1.png" id="grade"> 
                    <p id="name">미림인</p>
                    <p id="class">3학년 6반</p>
                </div>

                <!-- 수정/ 변경/ 탈퇴 -->
                <div class = "MyPage-right">
                    <!-- 학년 반 수정 -->
                    <div class="MyPage-item-1">
                        <div class="MyPage-item-left">
                            <p class="Item">학년/반 수정</p>
                            <p class="Item-Info">학년/반을 수정합니다.</p>
                        </div>
                        <div class="MyPage-item-right">
                            <a href="#"><img src="IMG/MyPage/UpdateBtn.png"></a>
                        </div>
                    </div>

                    <!-- 비밀번호 변경 -->
                    <div class="MyPage-item-2">
                        <div class="MyPage-item-left">
                            <p class="Item">비밀번호 변경</p>
                            <p class="Item-Info">비밀번호를 변경합니다.</p>
                        </div>
                        <div class="MyPage-item-right">
                            <a href="#"><img src="IMG/MyPage/ChangeBtn.png"></a>
                        </div>
                    </div>

                    <!-- 회원탈퇴 -->
                    <div class="MyPage-item-3">
                        <div class="MyPage-item-left">
                            <p class="Item">회원탈퇴</p>
                            <p class="Item-Info">미림라이프를 탈퇴합니다.</p>
                        </div>
                        <div class="MyPage-item-right">
                            <a href="#"><img src="IMG/MyPage/SecessionBtn.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wrapper 닫기  -->

</body>
</html>