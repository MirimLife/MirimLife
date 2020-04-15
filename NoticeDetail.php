<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.2">
    <link rel="stylesheet" type="text/css" href="./CSS/NoticeDetail.css?ver=1.2">
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
                <li class="Menu-item"><a href = "#">급식확인</a></li>
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
            <div id="Notice-word">공지사항</div>
            <div id="Notice-plus">2019학년도 마이스터고 연구학교 운영 계획</div>
        </div>
        <hr id="Notice-line" style="width:60px;">

        <div class="Title-info">
            <img src="IMG/Notice/Detail/time.png">
            <span id="time">2020-04-04</span>

            <img src="IMG/Notice/Detail/look.png">
            <span>2,343</span>
        </div>

        <div class="Text">
            <div class="InnerText">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin id vulputate purus, et hendrerit est. Ut ut mauris congue, varius mi tempor, elementum erat. Aliquam eu ipsum accumsan, consectetur lorem vitae, gravida nunc. Nulla eu faucibus ante, et scelerisque ex. Fusce ultricies consectetur metus, sed pellentesque quam tristique ac. Vestibulum eget leo ut dui vestibulum suscipit. Phasellus condimentum leo ut enim ullamcorper bibendum. Aenean tincidunt nulla commodo consequat elementum. Curabitur auctor felis ac pellentesque volutpat. Curabitur nibh turpis, molestie non interdum vitae, luctus blandit libero. Fusce aliquam nulla eget massa lobortis blandit. Nullam molestie lorem sollicitudin, cursus odio a, varius augue.

Sed eget quam mi. Donec vel neque quam. Vivamus viverra elit neque, at cursus metus vehicula in. Duis varius leo et est mattis, semper pulvinar metus aliquet. Quisque blandit imperdiet vulputate. Vivamus eget bibendum nisl. Vivamus eget nibh eget diam laoreet varius a tristique diam. Cras vehicula odio id nibh maximus, nec venenatis odio pulvinar. Pellentesque dictum imperdiet orci in maximus. Nulla fringilla, nisl gravida varius molestie, felis nunc fermentum eros, id aliquet est sapien a nulla. Pellentesque iaculis, turpis quis sodales sagittis, nibh risus aliquam felis, vitae dapibus nisi enim ut sapien. Praesent ac magna nibh. Donec lobortis felis est, luctus ornare lectus consequat non. Praesent auctor pharetra nibh eget molestie. Nam id tortor eros. Nunc varius ligula urna, suscipit iaculis metus volutpat a.

Mauris feugiat aliquam porttitor. Fusce semper mollis nulla vitae blandit. Curabitur et mi id orci varius pellentesque. Phasellus molestie lorem mauris, vitae pretium purus rutrum vitae. Pellentesque sit amet rhoncus libero, a rutrum diam. Maecenas mattis purus in lacus gravida, at rutrum tellus facilisis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer convallis ultricies lectus. Aenean mattis, dui a tempus hendrerit, neque orci efficitur dui, sed blandit neque nibh vel leo. Quisque odio neque, laoreet et sem a, pretium luctus magna. Sed placerat consequat maximus. Ut vitae pulvinar mi. Nullam tristique pellentesque lectus sed maximus.
            </div>
        </div>

        <div class="Back">
            <a href="Notice.php"><button>목록으로 가기</button></a>
        </div>
    </div>
</body>
</html>