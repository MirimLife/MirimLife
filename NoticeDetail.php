<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/BoardDetail.css?ver=1.2">
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <title>MirimLife</title>
</head>
<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="wrapper">
        <div id="nav">   <!-- 네비게이션 바 -->
            <a href="index.php" id="Logo">
                <img id="Logo-img" src="IMG/Main/logo.png">
            </a>

            <ul class="Menu">
                <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
                <li class="Menu-item"><a href = "#">일정확인</a></li>
                <li class="Menu-item"><a href = "#">미림팀</a></li>
                <li class="Menu-item"><a href = "#">대나무숲</a></li>
                <li class="Menu-item"><a href = "Forest.php">급식확인</a></li>
                <li class="Menu-item"><a href = "Library.html">도서관</a></li>
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
                            echo "<p id='username'>{$name}님&nbsp;</p>";
                        }
                        echo "<a id='LogOut'  href='logout.php'>로그아웃</a>";
                    }
                    else {
                        echo '<a href="SignIn.html"><img class="Sign-In" src="IMG/Main/Login.png"></a>';
                        echo '<a href="SignUp.html"><img class="Sign-Up" src="IMG/Main/SignUp.png"></a>';
                    }
                    mysqli_close($con);
                ?>
            </div>
        </div>

        <?php
            $num = $_GET['num'];

            $con = mysqli_connect("localhost","mirimlife","itshow1!","mirimlife");
            if (mysqli_connect_errno()){
                 echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $sql = "update notice set views = views + 1 where num = $num;";
            mysqli_query($con, $sql);

            $sql = "select title, file, contents, date, views from notice where num = $num;";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $title = $row['title'];
                $file = $row['file'];
                $contents = $row['contents'];
                $date = $row['date'];
                $views = $row['views'];
        
                echo '<div class="Notice-up">';
                    echo '<div id="Notice-word">공지사항</div>';
                    echo "<div id='Notice-plus'>$title</div>";
                echo "</div>";
                echo '<hr id="Notice-line" style="width:60px;">';
    
                echo '<div class="Title-info">';
                    echo '<img src="IMG/Notice/Detail/time.png">';
                    echo "<span id='time'>$date</span>";
                    echo '<img src="IMG/Notice/Detail/look.png">';
                    echo "<span>$views</span>";
                echo "</div>";
    
                echo '<div class="Text">';
                    echo "<div class='InnerText'>$contents</div>";
                echo "</div>";
            }
            mysqli_close($con);
        ?>

        <div class="Back">
            <a href="Notice.php"><button>목록으로 가기</button></a>
        </div>
    </div>
</body>
</html>