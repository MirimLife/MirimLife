<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.71">
    <link rel="stylesheet" type="text/css" href="./CSS/Library.css?ver=1.1">

    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <title>미림도서관</title>
    <!--api가져오기-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
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
            <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
            <li class="Menu-item"><a href = "Library.php" class="selected">도서관</a></li>
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
                        // $con = mysqli_connect("localhost","mirimlife","33glxoL1B2N2IXjO","mirimlife");
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
                <div id="Notice-word">도서관</div>
                <div id="Notice-plus">도서관의 책을 확인할 수 있는 공간입니다.</div>
            </div>

            <div class="Notice-down">
            <form method="post">
                <select name="job" id="op">
                    <option value="all">&nbsp;&nbsp;전체</option>
                    <option value="title" selected>&nbsp;&nbsp;제목</option>
                    <option value="author">&nbsp;&nbsp;저자</option>
                </select>
                <input type="text" id="qe" name="id" value="" placeholder="검색어를 입력하세요">
                <div class="Search-btn"><button type="submit">검색하기</button></div>
                </form>
            </div>

            <script>
                <?php
                $title=$_POST[id];
                $option=$_POST[job];

                    $myfile = fopen("./api/qe", "w") or die("Unable to open file!");
                    $txt = "{\"option\" : \"".$option."\",\n";
                    fwrite($myfile, $txt);
                    $txt = "\"title\" : \"".$title."\"}";
                    fwrite($myfile, $txt);
                    fclose($myfile);
                ?>

                $(document).ready(function() {
                    strUrl="./api/des2";
                    $.ajax({
                    url: strUrl,
                    dataType: 'json',
                    success: function (data) {
                            $('#book').empty();
                        for (var i = 0; i < data.length; i++) {
                            d = data[i];
                            if(d.rental=='대출가능'){
                                strHtml='<li><div class="Book"><img id="Book-img" src="'+d.img+'">';
                            }
                            else {
                                strHtml='<li><div class="Book" id="impossible"><img id="Book-img" src="'+d.img+'">';
                            }
                            strHtml+='<h4>'+d.title+'<h4>';
                            strHtml+='<p>'+d.author+'</p>';
                            if(d.rental=='대출가능'){
                                strHtml+='<h5 class='possible'>대여가능</h5></li>';
                            }
                            else {
                                strHtml+='<h5 class='impossible'>대여불가</h5></li>';
                            }
                            $('#book').append($(strHtml));
                        }

                    },
                    error: function(){
                        console.log("QuickMenu Ajax Load failed.");
                    }
                    });
                })

            </script>

            <div class="Book-list">
                <ul id="book">
                </ul>
            </div>
        </div>
    </div>
    <!-- wrapper 닫기  -->

</body>
</html>