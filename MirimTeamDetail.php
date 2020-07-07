<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.2">
    <link rel="stylesheet" type="text/css" href="./CSS/MirimTeamDetail.css?ver=1.1">
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@700&display=swap" rel="stylesheet">

    <title>MirimLife</title>
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
        
        <?php
            $num = $_GET['num'];
            include ('db_conn.php');
            if (mysqli_connect_errno()){
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $sql = "update team set views = views + 1 where num = $num;";
            mysqli_query($con, $sql);

            $sql = "select * from team where num = $num;";
            $result = mysqli_query($con, $sql);

            $title; $writer; $field; $member; $date; $Wdate; $contents; $views; $name; $grade;

            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $title = $row['title'];
                $writer = $row['writer'];
                $field = $row['field'];
                $member = $row['member'];
                $date = $row['date'];
                $Wdate = $row['Wdate'];
                $contents = $row['content'];
                $views = $row['views'];
            } 

            $sql = "select name, grade from member where id = '$writer';";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $name = $row['name'];
                $grade= $row['grade'];
            } 

            $contents = nl2br($contents);

            echo '<div class="Notice-up">';
            echo "<div id='Notice-word'>$title</div>";
            echo "<div id='Notice-plus'>$field / ${date}까지</div>";
            echo "</div>";

            echo '<div class="Title-info">';
            echo '<img src="IMG/Notice/Detail/time.png">';
            echo "<span id='time'>$Wdate</span>";

            echo '<img src="IMG/Notice/Detail/look.png">';
            echo "<span>$views</span>";
            echo "</div>";

            echo '<div class="Text-1">';
            echo "<div class='InnerText'>$contents</div>";
            echo "</div>";

            echo '<div class="Text-2">';
            echo '<div class="InnerText-item1">';
            echo '<p class="InnerText-item1 text">모집안내</p>';
            echo "<p class='InnerText-item1 detail'>${date}까지 모집</p>";
            echo "</div>";

            echo '<div class="InnerText-item2">';
                echo "<table>";
                    echo "<tr>";
                        echo "<td class='InnetText-item2 text'>개설자 정보</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>이름</td>";
                        echo "<td>$name</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>학년</td>";
                        echo "<td>$grade</td>";
                    echo "</tr>";
                echo "</table>";
            echo "</div>";

            echo '<div class="InnerText-item3">';
                echo "<p class='InnerText-item3 text'>$field</p>";
                echo "<p class='InnerText-item3 detail'>현재 구성원 : ${member}명</p>";
                echo "<button class='InnerText-item3 btn'>팀 지원하기</button>";
            echo "</div>";
            echo "</div>";
        ?>
    </div>
</body>
</html> 