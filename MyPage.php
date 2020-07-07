<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.71">
    <link rel="stylesheet" type="text/css" href="./CSS/MyPage.css?ver=1.0">
    
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <title>마이페이지</title>
</head>

<body style="position: fixed;" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="BG">
        <img src="IMG/MyPage/BG.png" id="BG-img">
    </div>
    
    <div id="wrapper">
    <div id="nav">   
        <a href="index.php" id="Logo">
            <img id="Logo-img" src="IMG/Main/logo.png">
        </a>

        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
            <li class="Menu-item"><a href = "Calendar.php">일정확인</a></li>
            <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
            <li class="Menu-item"><a href = "Library.php">도서관</a></li>
            <li class="Menu-item"><a href = "#">학습보고서</a></li>
            <li class="Menu-item"><a href = "Map.php">코로나맵</a></li>
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
        <!-- nav 태그 닫기 -->
        
        <div class="container">
            <div class="MyPage-top">
                <p id="MyPage-word">마이페이지</p>
                <p id="MyPage-plus">개인정보를 수정할 수 있는 공간입니다.</p>
                <!-- <hr id="MirimTeam-line" style="width:120px;">   -->
            </div>
            
            <div class="MyPage-bottom">
                <!-- 내정보 -->
                <div class = "MyPage-left">
                    <P id="MyInfo">내정보</P>
                    <img src="IMG/MyPage/1.png" id="grade"> 
                    <p id="name">미림인</p>
                    <p id="class">3학년 6반</p>
                </div>

                <!-- 수정/ 변경/ 탈퇴 -->
                <div class = "MyPage-right">
                    <!-- 학년 반 수정 -->
                    <div class="MyPage-item-1">
                        <div class="MyPage-item-left">
                            <p class="Item">학년/반 수정</p>
                            <p class="Item-Info">학년/반을 수정합니다.</p>
                        </div>
                        <div class="MyPage-item-right">
                            <a href="#" class="item1-Btn"><img src="IMG/MyPage/UpdateBtn.png"></a>
                        </div>
                    </div>

                    <!-- 비밀번호 변경 -->
                    <div class="MyPage-item-2">
                        <div class="MyPage-item-left">
                            <p class="Item">비밀번호 변경</p>
                            <p class="Item-Info">비밀번호를 변경합니다.</p>
                        </div>
                        <div class="MyPage-item-right">
                            <a href="#" class="item2-Btn"><img src="IMG/MyPage/ChangeBtn.png"></a>
                        </div>
                    </div>

                    <!-- 회원탈퇴 -->
                    <div class="MyPage-item-3">
                        <div class="MyPage-item-left">
                            <p class="Item">회원탈퇴</p>
                            <p class="Item-Info">미림라이프를 탈퇴합니다.</p>
                        </div>
                        <div class="MyPage-item-right">
                            <a href="#" class="item3-Btn"><img src="IMG/MyPage/SecessionBtn.png"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="item1-Btn-evnet">
            <img src="IMG/MyPage/UpdateClass/Window.png" alt="학년 반 수정">
            <a href="#" class="item1-Btn-evnet close"><img src="IMG/MyPage/UpdateClass/Cancle.png"></a>
            <P class="item1-Btn-evnet-head-item1">학년/반 수정</p>
            <p class="item1-Btn-evnet-head-item2">학년/반을 수정합니다.</p>
            <select id="grade-select">
                <option value="1">1학년</option>
                <option value="2">2학년</option>
                <option value="3">3학년</option>
            </select>

            <select id="class-select">
                <option value="class1">1반</option>
                <option value="class2">2반</option>
                <option value="class3">3반</option>
                <option value="class4">4반</option>
                <option value="class5">5반</option>
                <option value="class6">6반</option>
            </select>
    </div>

    <div id="item2-Btn-evnet">
            <img src="IMG/MyPage/UpdatePw/Window.png" alt="비밀번호 변경">
            <a href="#" class="item2-Btn-evnet close"><img src="IMG/MyPage/UpdatePw/Cancle.png"></a>
            <P class="item2-Btn-evnet-head-item1">비밀번호 변경</p>
            <p class="item2-Btn-evnet-head-item2">비밀번호를 변경합니다.</p>

            <p id="item2-content-item1">비밀번호</p>
            <input type="text" id="item2-content-item2" placeholder="비밀번호"></input>
            <button id="item2-content-item3"></button>

    </div>

    <div id="item3-Btn-evnet">
            <img src="IMG/MyPage/Delete/Window.png" alt="회원탈퇴">
            <a href="#" class="item3-Btn-evnet close"><img src="IMG/MyPage/Delete/Cancle.png"></a>
            <P class="item3-Btn-evnet-head-item1">회원탈퇴</p>
            <p class="item3-Btn-evnet-head-item2">미림라이프에서 탈퇴하시겠습니까?</p>
            <button id="item3-content-item1"></button>
            <button id="item3-content-item2"></button>
    </div>
    <!-- wrapper 닫기  -->

    <script type="text/javascript">
            //학년 반 수정
            $(".item1-Btn").click(function(event){
                event.preventDefault();
                //$("#layer").css("display","block");
                $("#item1-Btn-evnet").slideDown();
            })

            //비밀번호 변경
            $(".item2-Btn").click(function(event){ 
                event.preventDefault();
                //$("#layer").css("display","block");
                $("#item2-Btn-evnet").slideDown();
            })

            //탈퇴
            $(".item3-Btn").click(function(event){
                event.preventDefault();
                //$("#layer").css("display","block");
                $("#item3-Btn-evnet").slideDown();
            })

            
            $("#item1-Btn-evnet .close").click(function(event){ //아이디 layer을 내려 보인다. 
            // $("#layer").fadeOut("slow")
                event.preventDefault();
                $("#item1-Btn-evnet").fadeOut("slow");
            })

            $("#item2-Btn-evnet .close").click(function(event){ //아이디 layer을 내려 보인다. 
            // $("#layer").fadeOut("slow")
                event.preventDefault();
                $("#item2-Btn-evnet").fadeOut("slow");
            })

            $("#item3-Btn-evnet .close").click(function(event){ //아이디 layer을 내려 보인다. 
            // $("#layer").fadeOut("slow")
                event.preventDefault();
                $("#item3-Btn-evnet").fadeOut("slow");
            })

    </script>
</body>
</html>