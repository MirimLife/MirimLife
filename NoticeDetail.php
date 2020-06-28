<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/BoardDetail.css?ver=1.3">
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
                <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
                <li class="Menu-item"><a href = "Forest.php">대나무숲</a></li>
                <li class="Menu-item"><a href = "cafeteria.php">급식확인</a></li>
                <li class="Menu-item"><a href = "Library.php">도서관</a></li>
                <li class="Menu-item"><a href="https://bit.ly/mirimmusic">음악신청</a></li>
            </ul>

            <div class="Sign"> <!-- 로그인, 회원가입 버튼-->
                
            </div>
        </div>

        <?php
            $num = $_GET['num'];

            include ('db_conn.php');
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
                $contents = nl2br($contents);
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
                    echo "<div class='InnerText'>$contents</div>"; ?>

                    <div class="Files">
                        <table>
                            <tr>
                                <td><img src='IMG/Notice/Detail/file.png'></td>
                                <td>첨부파일</td>
                                <td class="word">아무노래.hwp</td>
                            </tr>
                        </table>
                    </div>
                <?php
                echo "</div>";
            }
            mysqli_close($con);
        ?>

        <div class="Back">
            <?php
                $page = $_GET['page'];
                echo "<a href='Notice.php?page=$page'><button>목록으로 가기</button></a>";
            ?>
        </div>
    </div>
</body>
</html>