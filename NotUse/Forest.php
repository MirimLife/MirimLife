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
                <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
                <li class="Menu-item"><a href = "Calendar.html">일정확인</a></li>
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

        <div class="Notice-up">
            <div id="Notice-word">대나무숲</div>
            <div id="Notice-plus">말 못한 고민을 나눌 수 있는 공간입니다.</div>
        </div>
        <hr id="Notice-line" style="width:120px;">

        <div class="Notice-down">
            <select name="job">
                <option value="회사원">&nbsp;&nbsp;No</option>
                <option value="" selected>&nbsp;&nbsp;제목</option>
                <option value="">&nbsp;&nbsp;등록일</option>
            </select>
            <input type="text" name="id" value="" placeholder="검색어를 입력하세요">
            <div class="Search-btn"><button type="submit">검색하기</button></div>
            <?php
                session_start();
                if(isset($_SESSION['id'])) {
                    if($_SESSION['id'] == 'test') {
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
                    <td style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">등록일</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:170px;">1</td>
                    <td style = "width:550px;"><a href="NoticeDetail.php">가나다라</a></td>
                    <td>2020.02.24</td>
                </tr>
            </table>
        </div>

        <div class="Notice-page">
            <a href="#"><img class="Left-img" src="IMG/Notice/Left.png"></a>
            <a href="#"><div class="Page-num">1</div></a>
            <a href="#"><div class="Page-num-no-click">2</div></a>
            <a href="#"><div class="Page-num-no-click">3</div></a>
            <a href="#"><img class="Right-img" src="IMG/Notice/Right.png"></a>
        </div>
    </div>
</body>
</html>