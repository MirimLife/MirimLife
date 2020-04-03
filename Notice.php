<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/index.css?ver=1">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.2">
    <link rel="stylesheet" type="text/css" href="./CSS/Notice.css?ver=1">
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <title>MirimLife</title>
</head>
<body background = "IMG/Notice/배경2.png" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="wrapper">
        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
            <li class="Menu-item"><a href = "#">일정확인</a></li>
            <li class="Menu-item"><a href = "#">미림팀</a></li>
            <li class="Menu-item"><a href = "#">대나무숲</a></li>
            <li class="Menu-item"><a href = "#">급식확인</a></li>
        </ul>

        <div class="Sign">
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
                        echo "{$name}님";
                    }
                    echo "<a href='logout.php'>로그아웃</a>";
                }
                else {
                    echo '<a href="SignIn.html"><img class="Sign-In" src="IMG/Main/Login.png"></a>';
                    echo '<a href="SignUp.html"><img class="Sign-Up" src="IMG/Main/SignUp.png"></a>';
                }
            ?>
        </div>

        <div class="Notice-up">
            <p id="Notice-word">공지사항</p>
            <img id="Notice-back" src="IMG/Notice/BG1.png">
            <hr id = "Notice-line">
            <p id="Notice-plus">미림 라이프의 공지사항을 알려드립니다.</p>
        </div>

        <div class="Notice-down">
            <select name="job">
                <option value="회사원">No</option>
                <option value="">제목</option>
                <option value="학생">등록일</option>
            </select>
            <input type="text" name="id" value="">
            <a href="#"><img src = "IMG/Notice/MagnifyingGlass.png"></a>
        </div>

        <div class="Notice-bottom">
            <table>
                <tr>
                    <td style = "width:100px;">No</td>
                    <td style = "width:700px;">제목</td>
                    <td>등록일</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
                <tr>
                    <td style = "width:100px;">1</td>
                    <td style = "width:700px;">가나다라</td>
                    <td>2020.02.24</td>
                </tr>
            </table>
        </div>

        <div class="Notice-page">
            <a href="#"><img src="IMG/Notice/Previous.png"></a>
            <span>1</span>
            <a href="#"><img src="IMG/Notice/Next.png"></a>
            <a href="Write.php"><button>글쓰기</button></a>
        </div>
        
        <a href="index.php"><img id="Logo" src="IMG/Main/logo.png"></a>
    </div>
</body>
</html>