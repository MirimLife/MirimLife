<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="./CSS/reset.css?ver=1.71">
    <link rel="stylesheet" type="text/css" href="./CSS/Calendar.css?ver=1.1">

    <link rel="shortcut icon" href="IMG/Icon/favicon___.png">
    <link rel="icon" href="IMG/Icon/favicon___.png">

    <!-- google 폰트 -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|Noto+Sans+KR:900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic:400,700&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <title>일정확인</title>
</head>

<body oncontextmenu='return false' onselectstart='return false' ondragstart='return false'>
    
    <div id="wrapper">
    <div id="nav">   
        <a href="index.php" id="Logo">
            <img id="Logo-img" src="IMG/Main/logo.png">
        </a>

        <ul class="Menu">
            <li class="Menu-item"><a href = "Notice.php">공지사항</a></li>
            <li class="Menu-item"><a href = "Calendar.html" class="selected">일정확인</a></li>
            <li class="Menu-item"><a href = "MirimTeam.php">미림팀</a></li>
            <li class="Menu-item"><a href = "Library.php">도서관</a></li>
            <li class="Menu-item"><a href = "#">학습보고서</a></li>
            <li class="Menu-item"><a href = "Map.php">코로나맵</a></li>
            <li class="Menu-item"><a href="https://bit.ly/mirimmusic">음악신청</a></li>
        </ul>

        <div class="Sign"> <!-- 로그인, 회원가입 버튼-->
            </div>
    </div>
    <!-- nav 태그 닫기 -->
        
        <div class="container">
            <div class="Notice-up">
                <div id="Notice-word">일정확인</div>
                <div id="Notice-plus">일정을 확인할 수 있는 공간입니다.</div>
            </div>
            <div class="Content">
                <div class="calendar-left">
                    <p class="calendar-item1">2020년 7월</p>

                    <table class="calendar-item2">
                            <tr class="calendar-item2-h">
                                <td>일</td>
                                <td>월</td>
                                <td>화</td>
                                <td>수</td>
                                <td>목</td>
                                <td>금</td>
                                <td>토</td>
                            </tr>
                            <?php
                                $day = 1;
                                $yoil = date('w', strtotime('2020-7-1'));
                                $flag = true;
                                $today = date('d');

                                for($i = 0; $i < 5; $i++) {
                                    echo "<tr class='calendar-item2-d'>";
                                    for($j = 0; $j < 7; $j++) {
                                        if($i == 0 && $flag) {
                                            for($k = 0; $k < $yoil; $k++) {
                                                echo "<td></td>";
                                                $j++;
                                            }
                                            $flag = false;
                                        }
                                        if($today == $day)
                                            echo "<td><font color='orange'>$day</font></td>";
                                        else 
                                            echo "<td>$day</td>";
                                        $day++;
                                        if($day > 31) 
                                            break;
                                    }
                                    echo "</tr>";
                                }
                            ?>
                        </table>

                </div>

                <div class="calendar-right">
                    <div class="calendar-right-item">
                        <?php
                            include ('db_conn.php');
                            if (mysqli_connect_errno()){
                                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                            }

                            $sql = "select schedule from schedule where day = $today;";
                            $result = mysqli_query($con, $sql);
                            $contents;

                            if(mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_array($result);
                                $contents = $row['schedule'];
                            }

                            $contents = nl2br($contents);

                            echo $contents;
                        ?>
                    </div>
                    
                    <button class="Plus-Btn">
                        <img src="IMG/Calendar/ScheduleWindow/addBtn.png">
                    </button>
                </div>


            </div>
        </div>

        <div id="item1-Btn-evnet">
            <img src="img/Calendar/AddSchedule/window.png" alt="일정추가">
            <a href="#" class="item1-Btn-evnet close"><img src="img/Calendar/AddSchedule/cancle.png"></a>
            <P class="item1-Btn-evnet-head-item1">일정추가</p>
            <p class="item1-Btn-evnet-head-item2">일정을 추가합니다.</p>

            <div class="item1-Btn-evnet-content-item1">
                <span>제목</span> <input type="text" id="Title">
                
            </div>

            <div class="item1-Btn-evnet-content-item2">
                <span>날짜</span> <input type="date" id="Date">

            </div>

            <div class="item1-Btn-evnet-content-item3">
                <span>내용</span> <textarea id="Content"></textarea>
            </div>

            <button type="submit"></button>
        </div>
    </div>
    <!-- wrapper 닫기  -->

    <script type="text/javascript">
        $(".Plus-Btn").click(function(event){
            event.preventDefault();
            $("#item1-Btn-evnet").slideDown();
        })

        $("#item1-Btn-evnet .close").click(function(event){ //아이디 layer을 내려 보인다. 
                event.preventDefault();
                $("#item1-Btn-evnet").fadeOut("slow");
        })
    </script>
</body>
</html>