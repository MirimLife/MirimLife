<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/Write.css?ver=1.2">
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
                <li class="Menu-item"><a href = "cafeteria.php">급식확인</a></li>
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
                ?>
            </div>
        </div>

        <div class="Notice-up">
            <div id="Notice-word">글쓰기</div>
            <div id="Notice-plus">HOME - 공지사항 - 글쓰기</div>
        </div>
        <hr id="Notice-line" style="width:120px;">

        <div class="window">
            <img src="IMG/Notice/Write/window.png" id="window-img">

            <form method="POST" action="Write_php.php" enctype = "multipart/form-data"> 
                <div class="input">
                    <div class="input-box">
                        <h4 class="h4-title">제목</h4>
                        <input type="text" class="input-info" name="title" required>
                    </div>
                    <div class="input-box">
                        <h4 class="h4-file">파일첨부</h4>
                        <div class="file_input">
                            <input type="text" readonly="readonly" id="file_route" name="file">
                            <label>
                                찾아보기...
                                <input type="file" onchange="javascript:document.getElementById('file_route').value=this.value" name="file">
                            </label>
                        </div>
                    </div>
                    <div class="input-box">
                        <h4 class="h4-text">내용</h4>
                        <textarea name = contents required></textarea>
                    </div>
                    <br>
                    <div class="button">
                        <a href="Notice.php"><button>취소</button></a>
                        <input type = "submit" value = "등록" id="sub"> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>