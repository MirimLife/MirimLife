// API
const API_KEY = "비밀인데";

// 지금 날짜 관련
let Day = new Date();   
const year = Day.getFullYear(); // 년도
const month = Day.getMonth() + 1;  // 월
const date = Day.getDate();  // 날짜

//표시되는 날짜
let Today = new Date(year, month, date);

// html 가져온 것
const day = document.querySelector("#Cafeterial-ymd");
const preBtn = document.querySelector(".Left-img");
const nextBtn = document.querySelector(".Right-img");

const Breakfest = document.querySelector(".Breakfest-word");
const Lunch = document.querySelector(".Lunch-word");
const Dinner = document.querySelector(".Dinner-word");

let sccode=3;
let scnm="석식";
let scdate="20190516";

const URL = `https://open.neis.go.kr/hub/mealServiceDietInfo?Type=json&pIndex=1&pSize=100&ATPT_OFCDC_SC_CODE=B10&SD_SCHUL_CODE=7010167&KEY=${API_KEY}`

// 함수
function getMenu(scdate, sccode, scnm, handle){
    const API_URL = URL + `&MLSV_YMD=` + `${scdate}` + `&MMEAL_SC_CODE=` + `${sccode}` + `&MMEAL_SC_NM=` + `${scnm}`;
    fetch(API_URL).then(function(response){
        //  if(response.json().RESULT.MESSAGE = "해당하는 데이터가 없습니다."){
        //      handle.innerHTML = "해당하는 데이터가 없습니다.";
        //  }
         return response.json();
    }).then(function(json){
        console.log(json);
        console.log(json.mealServiceDietInfo[1].row[0].DDISH_NM);   
        handle.innerHTML = json.mealServiceDietInfo[1].row[0].DDISH_NM;
    });
}

function Previous(){
    let date_;
    Today.setDate(Today.getDate() - 1);
    //date 1의 자리 수를 01 이런 식으로 나타나게 함
    if(parseInt(Today.getDate()) < 10) date_ = `0${Today.getDate()}`;
    else date_ = Today.getDate();

    day.innerHTML = `${Today.getMonth()}월 ${Today.getDate()}일`;

    scdate = `${Today.getFullYear()}${Today.getMonth()}${date_}`;

    console.log(scdate);
    getMenu(scdate, 1, "조식", Breakfest);
    getMenu(scdate, 2, "중식", Lunch);
    getMenu(scdate, 3, "석식", Dinner);
}

function Next(){
    let date_;
    Today.setDate(Today.getDate() + 1);
    //date 1의 자리 수를 01 이런 식으로 나타나게 함
    if(parseInt(Today.getDate()) < 10) date_ = `0${Today.getDate()}`;
    else date_ = Today.getDate();

    day.innerHTML = `${Today.getMonth()}월 ${Today.getDate()}일`;

    scdate = `${Today.getFullYear()}${Today.getMonth()}${date_}`;

    console.log(scdate);
    getMenu(scdate, 1, "조식", Breakfest);
    getMenu(scdate, 2, "중식", Lunch);
    getMenu(scdate, 3, "석식", Dinner);
}

function today(){
    console.log(year);
    console.log(month);
    console.log(date);

    day.innerHTML = `${month}월 ${date}일`;
}

function init(){
    preBtn.addEventListener("click", Previous);
    nextBtn.addEventListener("click", Next);

    today();

    getMenu(scdate, 1, "조식", Breakfest);
    getMenu(scdate, 2, "중식", Lunch);
    getMenu(scdate, 3, "석식", Dinner);
}

init();