<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="./CSS/index.css">
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css">
    <link rel="stylesheet" type="text/css" href="./CSS/Write.css">
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
            <p id="Notice-word">글쓰기</p>
            <img id="Notice-back" src="IMG/Notice/BG1.png">
            <hr id = "Notice-line">
            <p id="Notice-plus">HOME - 공지사항 - 글쓰기</p>
        </div>

        <div class="table">
            <table>
                <tr>
                    <td style="border-top-left-radius:15px;">제목</td>
                    <td><input type="text"/></td>
                </tr>
                <tr>
                    <td>파일첨부</td>
                    <td>
                        <div class="file_input">
                            <input type="text" readonly="readonly" id="file_route">
                            <label>
                                찾아보기...
                                <input type="file" onchange="javascript:document.getElementById('file_route').value=this.value">
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="border-bottom-left-radius: 15px;">내용</td>
                    <td style="border-bottom:1.5px solid #fac60e;">
                        <textarea></textarea>
                    </td>
                </tr>
            </table>
        </div>

        <div class="button">
            <input type="submit" value="등록">
            <a href="Notice.php"><button>취소</button></a>
        </div>

        <a href="index.php"><img id="Logo" src="IMG/Main/logo.png"></a>
    </div>
</body>
</html>