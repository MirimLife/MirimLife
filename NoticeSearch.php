<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/Board.css?ver=1.8">
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
                <li class="Menu-item"><a href = "Notice.php" class="selected">공지사항</a></li>
                <li class="Menu-item"><a href = "Calender.html">일정확인</a></li>
                <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
                <li class="Menu-item"><a href = "Library.php">도서관</a></li>
                <li class="Menu-item"><a href = "#">학습보고서</a></li>
                <li class="Menu-item"><a href = "Map.html">코로나맵</a></li>
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
                        mysqli_close($con);
                    }
                    else {
                        echo '<a href="SignIn.html"><img class="Sign-In" src="IMG/Main/Login.png"></a>';
                        echo '<a href="SignUp.html"><img class="Sign-Up" src="IMG/Main/SignUp.png"></a>';
                    }
                ?>
            </div>
        </div>

        <div class="Notice-up">
            <div id="Notice-word">공지사항</div>
            <div id="Notice-plus">미림 라이프의 공지사항을 알려드립니다.</div>
        </div>

        <div class="Notice-down">
            <form method="GET" action="NoticeSearch.php">
                <select name="search_select">
                    <option value="num">&nbsp;&nbsp;No</option>
                    <option value="title" selected>&nbsp;&nbsp;제목</option>
                    <option value="date">&nbsp;&nbsp;등록일</option>
                </select>
                <input type="text" name="search" placeholder="검색어를 입력하세요">
                <div class="Search-btn"><button type="submit">검색하기</button></div>
            </form>
            <?php
                session_start();
                if(isset($_SESSION['id'])) {
                    if($_SESSION['id'] == 's2018s00') {
                        echo "<div class='Write-btn'><a href='NoticeWrite.php'><button>글쓰기</button></a></div>";
                    }
                }
                
            ?>
        </div>

        <div class="Notice-bottom">
            <table>
                <tr>
                    <td style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">No</td>
                    <td>제목</td>
                    <td>조회수</td>
                    <td style="border-top-right-radius: 12px; border-bottom-right-radius: 12px;">등록일</td>
                </tr>

                <?php
                    include ('db_conn.php');
                    $list = 8;
                    $block = 5;
                    
                    $search = $_GET["search"];
                    $search_select = $_GET["search_select"];

                    if (mysqli_connect_errno()){
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $sql = "select num, title, date from notice order by num desc;";
                    $result = mysqli_query($con, $sql);

                    $num = mysqli_num_rows($result);
                    $pageNum = ceil($num/$list); // 총 페이지
                    $blockNum = ceil($pageNum/$block); // 총 블록
                    $nowBlock = ceil($page/$block);
                    $s_page = ($nowBlock * $block) - ($block - 1);

                    if ($s_page <= 1) {
                        $s_page = 1;
                    }
                    $e_page = $nowBlock*$block;
                    if ($pageNum <= $e_page) {
                        $e_page = $pageNum;
                    }

                    $page = ($_GET['page'])?$_GET['page']:1;

                    $s_point = ($page-1) * $list;

                    $sql = "select num, title, date from notice where $search_select like '%{$search}%' order by num desc limit $s_point, $list;";
                    $result = mysqli_query($con, $sql);
                    
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_array($result)) {
                            $num = $row['num'];
                            $title = $row['title'];
                            $date = $row['date'];

                            echo "<tr>";
                            echo "<td style = 'width:120px;'> $num </td>";
                            echo "<td style = 'width:550px; text-align: left; padding-left:20px;'><a href='NoticeDetail.php?num=$num&page=$page '> $title </a></td>";
                            echo "<td style = 'width:150px;'> $views </td>";
                            echo "<td style = 'width:150px;'> $date </td>";
                            echo "</tr>";
                        }
                    }
                

            echo "</table>";
        echo "</div>";

        echo '<div class="Notice-page">';
            $page1 = $page == 1?1:$page-1;
            $page2 = $page == $pageNum?$pageNum:$page+1;
            echo "<a href='$PHP_SELP?search_select=$search_select&search=$search&page=$page1'><img class='Left-img' src='IMG/Notice/LeftArrow.png'></a>";
                for ($p=$s_page; $p<=$e_page; $p++) {
                    echo "<a href='$PHP_SELP?page=$p'>$p</a>";
                }
            echo "<a href='$PHP_SELP?search_select=$search_select&search=$search&page=$page2'><img class='Right-img' src='IMG/Notice/RightArrow.png'></a>";
        echo '</div>';
        ?>
    </div>
</body>
</html>