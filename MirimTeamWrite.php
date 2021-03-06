<?php
    session_start();
    if(!isset($_SESSION['id'])) {
        echo "<script> alert('글 작성은 회원만 가능합니다. 로그인 해주십시오.'); location.replace('MirimTeam.php');; </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.71">
    <link rel="stylesheet" type="text/css" href="./CSS/MirimTeamWrite.css?ver=1.2">

    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <title>미림팀</title>
</head>

<body style="position: fixed;" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="BG">
        <img src="IMG/MirimTeam/MakeTeam/BG.png" id="BG-img">
    </div>
    
    <div id="wrapper">
    <div id="nav">   
        <a href="index.php" id="Logo">
            <img id="Logo-img" src="IMG/Main/logo.png">
        </a>

        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
            <li class="Menu-item"><a href = "Calendar.php">일정확인</a></li>
            <li class="Menu-item"><a href = "MirimTeam.php" class="selected">미림팀</a></li>
            <li class="Menu-item"><a href = "Library.php">도서관</a></li>
            <li class="Menu-item"><a href = "#">학습보고서</a></li>
            <li class="Menu-item"><a href = "Map.php">코로나맵</a></li>
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
        <!-- nav 태그 닫기 -->
        
        <div class="container">
            <div class="MirimTeam-top">
                        <p id="MirimTeam-word">팀 만들기</p>
                        <p id="MirimTeam-plus">HOME &middot; 미림팀 &middot; 팀만들기</p>
                        <!-- <hr id="MirimTeam-line" style="width:120px;">   -->
            </div>
            <div class="MirimTeam-bottom">
                <img src="IMG/MirimTeam/MakeTeam/window.png" class="img">

                <form class="form" method="POST" action="Team_Write_php.php" enctype = "multipart/form-data"> 
                    <div class="input">
                        <!-- 제목 -->
                        <div class="input-box">
                            <h4 class="h4-title">제목</h4>
                            <input type="text" class="input-info" name="title" required>
                        </div>
                        <!-- 현재구성원 -->
                        <div class="input-box">
                            <h4 class="h4-title">현재구성원</h4>
                            <div class="select-box-1">                       
                                <select name="member">
                                    <option value="1"  selected="selected">1명(본인)</option>
                                    <option value="2">2명</option>
                                    <option value="3">3명</option>
                                    <option value="4">4명 이상</option>
                                </select>
                            </div>
                        </div>
                        <!-- 모집분야 -->
                        <div class="input-box">
                            <h4 class="h4-title">모집분야</h4>
                            <div class="button-box">
                                <input type="checkbox" name='field[]' value="Planner">Planner
                                <input type="checkbox" name='field[]' value="Front-End">Front-End
                                <input type="checkbox" name='field[]' value="Back-End">Back-End
                                <input type="checkbox" name='field[]' value="Design">Design
                            </div>
                        </div>
                        <!-- 모집기간 -->
                        <div class="input-box">
                            <h4 class="h4-title">모집 기간</h4>
                                <div class="date-box">
                                    <input type="date" class="input-info-date" name="date" required>
                                    <img src="IMG/MirimTeam/MakeTeam/calendar.png" class="input-img">
                                </div>
                        </div>

                        <!-- 프로젝트 설명 -->
                        <div class="input-box">
                            <h4 class="h4-title">프로젝트 설명</h4>
                            <textarea name = contents required></textarea>
                        </div>
                        <br>
                        <div class="button">
                            <a href="./MirimTeam.php"><button>취소</button></a>
                            <input type = "submit" value = "팀생성하기" id="sub"> 
                        </div>
                    </div>
                </form>
            </div>            
        </div>
    </div>
    <!-- wrapper 닫기  -->

</body>
</html>