<?php session_start();?>
<!DOCTYPE html><html><head><title>TODOリストβ</title><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script><link rel="icon" href="//ssl.gstatic.com/classroom/ic_product_classroom_32.png" sizes="32x32">
<script>
<?php
$user_email = $_COOKIE['email'];
$user_name = $_COOKIE['name'];
$user_id = $_COOKIE['uid'];
echo 'const name = "'.$user_name.'";const email = "'.$user_email.'";const uid = "'.$user_id.'";';
?>
var today = new Date()
var yearStr = today.getFullYear();
var monthStr = today.getMonth() + 1;
const d = document;
const se = sessionStorage;

function plus_month() {
	monthStr += 1;
	if (monthStr > 12) {
		monthStr -= 12;
		yearStr += 1;
	}
	view_calender();
}

function minus_month() {
	monthStr -= 1;
	if (monthStr < 1) {
		monthStr += 12;
		yearStr -= 1;
	}
	view_calender();
}

function view_calender() {
    
    var point=d.getElementById('point');
	point.innerHTML = "";
	
    var month_text = d.createElement('p');
	var year_text = d.createElement('p');
    month_text.innerHTML = monthStr;
	year_text.innerHTML = yearStr;
	point.appendChild(year_text);
	point.appendChild(month_text);

	var minus_button = d.createElement('button');
	minus_button.onclick = minus_month;
	minus_button.innerHTML = '←';
	var plus_button = d.createElement('button');
	plus_button.onclick = plus_month;
	plus_button.innerHTML = '→';

	var info = d.createElement("div");
	info.className = 'info';
	var date_view = d.createElement("div");
	date_view.appendChild(year_text);
	date_view.appendChild(month_text);
	date_view.className = 'date_min';

	info.appendChild(minus_button);
	info.appendChild(date_view);
	info.appendChild(plus_button);

	point.appendChild(info);

	var table = d.createElement('table');
	var dates = d.createElement('tr');
    table.className = 'calender';
	dates.className = 'date';

	const date_list = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
	
    for (var i in date_list) {
		var date_th = d.createElement('th');
		var date = d.createElement('div');
		date_th.className = date_list[i];
		date.innerHTML = date_list[i];
		date_th.appendChild(date);
		dates.appendChild(date_th);
	}

	table.appendChild(dates);
	point.appendChild(table);
	var cale = new Date(yearStr, monthStr - 1, 1);
	var start_point = cale.getDay();
	var cale = new Date(yearStr, monthStr, 0);
	var end_point = cale.getDate();
	if((""+monthStr).length==1){
	    monthStrstr = "0"+monthStr;
	}
	else{monthStrstr=monthStr;}
	if (end_point + start_point > 35) {
		var rep_weeks = 6
	} else {
		var rep_weeks = 5
	}
	for (var i = 0; i < rep_weeks; i++) {
		var days = d.createElement('tr');
		days.className = 'week' + (i + 1);
		for (var j = 0; j < 7; j++) {
			var day_num = i * 7 + (j + 1) - start_point;
			var day_th = d.createElement('th');
			if((""+day_num).length == 1){
                day_numstr = "0"+day_num;
			}else{day_numstr=day_num;}
			day_th.id = 'day' + day_numstr;
			var day = d.createElement('div');
			day.className = "day_div";
			var todolink = d.createElement('a');
			
			if (day_num > 0 && day_num <= end_point) {
				day.innerHTML = day_num;
				
				todolink.href = "calender/"+uid+"/"+yearStr+"-"+monthStrstr+"-"+day_numstr;
			} else {
				day.innerHTML = "";
			}
			var todos = d.createElement("div");
			todos.className="todos";
			todos.id=day_numstr;

			todolink.appendChild(day)
			

			day.appendChild(todos)
			day_th.appendChild(todolink);
			days.appendChild(day_th);
		}
		table.appendChild(days);
	}
	point.appendChild(table);
	
	if(JSON.parse(se.getItem("se_cl_json"))[yearStr+"-"+monthStrstr]!=undefined){
	    data = JSON.parse(se.getItem("se_cl_json"))[yearStr+"-"+monthStrstr];
	    for (var key in data) {
            var dt = data[key];
            var day_task = d.getElementById(""+dt.date);
            var task = d.createElement("div");
            task.innerHTML=dt.info;
            task.className="task";
            day_task.appendChild(task);
        }
	}
	else{
        var url="task.php?table="+uid+"&search="+yearStr+"-"+monthStrstr;
        $.getJSON(url, (data) => {
            var se_cl_json = JSON.parse(se.getItem("se_cl_json"));
            se_cl_json[yearStr+"-"+monthStrstr] = data;
            se.setItem("se_cl_json",JSON.stringify(se_cl_json));
            for (var key in data) {
                var dt = data[key];
                var day_task = d.getElementById(""+dt.date);
                var task = d.createElement("div");
                task.innerHTML=dt.info;
                task.className="task";
                day_task.appendChild(task);
            }
        });
	    
	}
	
}

//calender.js

function oritatami_f(){
    var idnm = d.getElementsByTagName("header")[0];
    console.log(idnm.id);
    if(idnm.id == 'oritatami-before'){  
        idnm.id ='oritatami-after';
        d.getElementsByClassName('oritatami')[0].innerHTML='▼';

    }
    else{
        idnm.id = 'oritatami-before';
        d.getElementsByClassName('oritatami')[0].innerHTML='▲';
    }
}
function build_page() {
	var data = {};
	data.title = 'TODOリストβ';
	data.sub_title = 'スケジュール管理や通知を行う予定';
	var body = d.getElementsByTagName('body')[0];
    var header = d.createElement('header');
    header.id = 'oritatami-before';
	body.appendChild(header);
	body.appendChild(d.createElement('main'));
	body.appendChild(d.createElement('footer'));

    var info = d.createElement('div');
    
	var main = d.getElementsByTagName('main')[0];
    var header = d.getElementsByTagName('header')[0];
	var title = d.createElement('h1');
	title.innerHTML = data.title;
	header.appendChild(title);

	var sub_title = d.createElement('h2');
	sub_title.innerHTML = data.sub_title;
	header.appendChild(sub_title);
	
    var li_cr = d.createElement('a');
    li_cr.href="create_task.php";
    li_cr.innerHTML="課題作成";
    header.appendChild(li_cr);
    
    var se_cl = d.createElement('button');
    se_cl.onclick = function() {
	    se.removeItem('se_cl_json');
	    se.setItem("se_cl_json","{}");
	    view_calender();
    };
    se_cl.style = "height:auto;"
    se_cl.innerHTML="更新";
    header.appendChild(se_cl);
	
    var oritatami = d.createElement('button');
    oritatami.innerHTML="▲";
    oritatami.className="oritatami";
    oritatami.setAttribute('onclick', 'oritatami_f()');
    header.appendChild(oritatami);

    var point = d.createElement('div');
	point.id = 'point';
	main.appendChild(point);
}


window.onload = function () {
    se.setItem("se_cl_json","{}")
	build_page();
	view_calender();
	
}
</script>
<style>th{width:15vw;height:15vw}.day_div{background-color:aqua;height:100%;width:100%;box-shadow:none;opacity:1}.day_div:hover{box-shadow:.5vw .5vw 1vw #aaaaaa,-.5vw -.5vw 1vw #fff;transition:all .5s;opacity:.5}.point{display:inline-block;margin:0 auto}.calender{display:inline-block}main{top:100px;text-align:center;margin:100px 0 0}button{height:5vw;width:5vw}.date_min{height:100px;width:85vw;display:inline-block}header{position:fixed;background-color:blue;width:100vw;margin:0;padding:0;line-height:0;left:0;z-index:100}.oritatami{position:fixed;display:inline-block;left:95%;height:40px;width:40px;border-radius:100%}#oritatami-before{top:0;transition:all ease .5s}#oritatami-after{top:-70px;transition:all ease .5s}.date th{height:20px}.todos{width:100%;height:90%;background-color:#9acd32}.task{background-color:#000;border-radius:10px;}</style>
</head><body><?php include("settings/signin-button.php"); ?></body></html>