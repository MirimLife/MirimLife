<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.71">
    <link rel="stylesheet" type="text/css" href="./CSS/MirimTeam.css?ver=1.2">

    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <title>미림팀</title>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    
    <div id="wrapper">
    <div id="nav">   
        <a href="index.php" id="Logo">
            <img id="Logo-img" src="IMG/Main/logo.png">
        </a>

        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
            <li class="Menu-item"><a href = "Calendar.html">일정확인</a></li>
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
            <div class="Notice-up">
                <div id="Notice-word">미림팀</div>
                <div id="Notice-plus">함께 스터디할 팀원을 구할 수 있는 공간입니다.</div>
            </div>

            <div class="Notice-down">
                <select name="job">
                    <option value="">&nbsp;&nbsp;No</option>
                    <option value="" selected>&nbsp;&nbsp;제목</option>
                    <option value="">&nbsp;&nbsp;등록일</option>
                </select>
                <input type="text" name="id" value="" placeholder="검색어를 입력하세요">
                <div class="Search-btn"><button type="submit">검색하기</button></div>
                <a href="./MirimTeamWrite.php"><div class='Write-btn'><button href='MirimTeamWrite.php'>팀만들기</button></div></a>
            </div>

            <div class="Team-list">
                <ul>
                    <?php
                        include ('db_conn.php');
                        if (mysqli_connect_errno()){
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $sql = "select title, writer,  title, field, date from team order by num desc";
                        $result = mysqli_query($con, $sql);
                        if (!mysqli_query ($con, $sql)){
                            echo("쿼리오류 발생: " . mysqli_error($con));
                        }

                        
                        //<!-- <img id="Team-img" src="IMG/MirimTeam/library.PNG"> -->
                        

                        $title = "";
                        $writer = "";
                        $field = "";
                        $date = "";
                        $name = "";

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_array($result)) {
                                $title = $row['title'];
                                $writer = $row['writer'];
                                $field = $row['field'];
                                $date = $row['date'];
                                
                                $sql2 = "select name from members where id = '$writer'";
                                $result2 = mysqli_query($con, $sql2);

                                if(mysqli_num_rows($result2) > 0) {
                                    $row2 = mysqli_fetch_array($result2);
                                    $name = $row2['name'];
                                }
                                
                                echo "<li>";
                                echo "<div class='Team'>";
                                echo "<div class='Team-word'>";

                                echo "<a href='./MirimTeamDetail.html'><h1>$title</h1></a>";
                                echo "<h3>$name</h3>";
                                echo "<h2>$field</h2>";
                                echo "<h4>${date}까지</h4>";
                                echo '<div class="Team-under">';

                                $today = date("Y-m-d");
                                $startDay = new DateTime($today);
                                $endDay = new DateTime($date);
                                $day = date_diff($startDay, $endDay);
                                $day = $day->days;
                                if($day > 0) {
                                    echo "<p>{$day}일전</p>";
                                } 
                                else if($day < 0) {
                                    echo "<p>마감</p>";
                                }
                                else {
                                    echo "<p>오늘</p>";
                                }
                                echo '<img id="Chat-img" src="IMG/MirimTeam/Chatting.png">';
                                echo '<p id="Chat-num">2</p>';
                                echo '</div>';
                                echo '</div>';
                                
                        echo '</div>';
                            }
                        }
                        echo "<li>";
                        
                    ?>
                </ul>
            </div>

            <div class="Notice-page">
                <a href="#"><img class="Left-img" src="IMG/Team/left.png"></a>
                <div class="Page-num">1</div>
                <a href="#"><img class="Right-img" src="IMG/Team/right.png"></a>
            </div>
        </div>
    </div>
    <!-- wrapper 닫기  -->

</body>
</html>