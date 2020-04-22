<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/cafeteria.css?ver=1.3">
    
    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <title>MirimLife</title>
</head>

<body style="position: fixed;" oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    <div id="BG">
        <img src="IMG/cafeteria/BG.png" id="BG-img">
    </div>
    
    <div id="wrapper">
    <div id="nav">   
        <a href="index.php" id="Logo">
            <img id="Logo-img" src="IMG/Main/logo.png">
        </a>

        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
            <li class="Menu-item"><a href = "">일정확인</a></li>
            <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
            <li class="Menu-item"><a href = "Forest.php">대나무숲</a></li>
            <li class="Menu-item"><a href = "cafeteria.php">급식확인</a></li>
            <li class="Menu-item"><a href = "Library.php">도서관</a></li>
            <li class="Menu-item"><a href="https://bit.ly/mirimmusic">음악신청</a></li>
        </ul>

        <div class="Sign"> 
            <!-- 로그인, 회원가입 버튼-->
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
        <!-- nav 태그 닫기 -->
        
        <div class="container">
            <div class="Cafeterial-up">
                    <p id="Cafeterial-word">학교급식</p>
                    <p id="Cafeterial-plus">학교 급식을 확인할 수 있는 공간입니다.</p>
                    <hr id="Cafeterial-line" style="width:120px;">
                </div>


            <div class="Cafeterial-mid">
                    <button><img class="Left-img" src="IMG/cafeteria/Button/left.png"></button>
                    <P id="Cafeterial-ymd">4월 12일</p>
                    <img class="Calendar-img" src="IMG/cafeteria/Button/calendar.png">   
                    <button><img class="Right-img" src="IMG/cafeteria/Button/right.png"></button>
            </div>

            <div class="Cafeterial-bottom">
                <div id="Breakfast">
                    <img class="window-1" src="IMG/cafeteria/window.png">
                    <p class="Breakfast">조식</p>
                    <div class="Breakfest-word">
                    </div>              
                </div>
                <div id="Lunch">
                    <img class="window-2" src="IMG/cafeteria/window.png">    
                    <p class="Lunch">중식</p>             
                    <div class="Lunch-word">                  
                    </div>  
                </div>
                <div id="Dinner">
                    <img class="window-3" src="IMG/cafeteria/window.png">
                    <p class="Dinner">석식</p>  
                    <div class="Dinner-word">                 
                    </div>  
                </div>
            </div>
    </div>
    <!-- wrapper 닫기  -->

    <!-- js -->
    <script src="./JS/cafeteria.js?ver=1.2"></script>
</body>
</html>