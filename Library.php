<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.5">
    <link rel="stylesheet" type="text/css" href="./CSS/Library.css?ver=1.0">

    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <title>미림도서관</title>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    
    <div id="wrapper">
    <div id="nav">   
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
        <!-- nav 태그 닫기 -->
        
        <div class="container">
            <div class="Notice-up">
                <div id="Notice-word">도서관</div>
                <div id="Notice-plus">도서관의 책을 확인할 수 있는 공간입니다.</div>
            </div>
            <hr id="Notice-line" style="width:120px;">

            <div class="Notice-down">
                <select name="job">
                    <option value="">&nbsp;&nbsp;No</option>
                    <option value="" selected>&nbsp;&nbsp;제목</option>
                    <option value="">&nbsp;&nbsp;등록일</option>
                </select>
                <input type="text" name="id" value="" placeholder="검색어를 입력하세요">
                <div class="Search-btn"><button type="submit">검색하기</button></div>
            </div>

            <div class="Book-list">
                <ul>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalNo.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                    <li>
                        <div class="Book">
                            <img id="Book-img" src="IMG/Library/Book1.jpg">
                            <h4>내일 아침에는 눈을 뜰 수 없겠지만</h4>
                            <p>캐스린 매닉스 지음</p>
                            <img id="Rental-img" src="IMG/Library/RentalOk.png">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- wrapper 닫기  -->

</body>
</html>