<?php
//this file asks and does the timetable stuff
@session_start();
if(isset($_SESSION["uemailh"])) :
	$logged_in = true;
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
	if(isset($_GET["edit_mode"]) || isset($_COOKIE["tt"])) {
		$new = true;
	} else {
		$new = false;
	}
?>
<div id='notifier'><p id='content'></p><span id='closer' title="Click to close!"></span></div>
<div id="outer_container" class="clearfix">
	<div id="container" class="container95">
		<div id="target">
			<?php if($new===true): ?>
				<p class="left">Oops! We don't have a timetable for your class already. Please fill in the wizard below to get started! Just enter the 6 theory subjects one by one and <strong>just enter only the shortcodes</strong> (For ex: DS for Distributed Systems and NM for Numerical Methods). </p><hr/>
				<div id="view_container">
					<div class="sub_entry">
					<table><tbody><tr><td class="right">1st Subject: </td><td class="inputtd"><input id="t1" class="theory check_field" type="text"></td></tr><tr><td class="right">2nd Subject: </td><td class="inputtd"><input id="t2" class="theory check_field" type="text"></td></tr><tr><td class="right">3rd Subject: </td><td class="inputtd"><input id="t3" class="theory check_field" type="text"></td></tr><tr><td class="right">4th Subject: </td><td class="inputtd"><input id="t4" class="theory check_field" type="text"></td></tr><tr><td class="right">5th Subject: </td><td class="inputtd"><input id="t5" class="theory check_field" type="text"></td></tr><tr><td class="right">6th Subject: </td><td class="inputtd"><input id="t6" class="theory check_field" type="text"></td></tr><tr><td class="right">Practical 1st Subject: </td><td class="inputtd"><input id="p1" class="practical check_field" type="text"></td></tr><tr><td class="right">Practical 2nd Subject: </td><td class="inputtd"><input id="p2" class="practical check_field" type="text"></td></tr><tr><td class="right">Practical 3rd Subject: </td><td class="inputtd"><input id="p3" class="practical check_field" type="text"></td></tr></tbody>
					</table>
					</div>
					<div id="right_container" style="display:none">
					<div id="sub_shower"></div><p>Just drag and drop the above subject entries into the table below. Click the <b>"Reset"</b> button if you mess something up!</p><div id="tt_entry"><table><tbody><tr><th><button id="reset">Reset</button></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th></tr><tr><th>Monday</th><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon1" class="mon"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon2" class="mon"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon3" class="mon"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon4" class="mon"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon5" class="mon"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon6" class="mon"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="mon7" class="mon"></td></tr><tr><th>Tuesday</th><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue1" class="tue"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue2" class="tue"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue3" class="tue"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue4" class="tue"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue5" class="tue"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue6" class="tue"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="tue7" class="tue"></td></tr><tr><th>Wednesday</th><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed1" class="wed"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed2" class="wed"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed3" class="wed"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed4" class="wed"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed5" class="wed"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed6" class="wed"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="wed7" class="wed"></td></tr><tr><th>Thursday</th><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu1" class="thu"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu2" class="thu"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu3" class="thu"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu4" class="thu"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu5" class="thu"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu6" class="thu"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="thu7" class="thu"></td></tr><tr><th>Friday</th><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri1" class="fri"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri2" class="fri"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri3" class="fri"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri4" class="fri"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri5" class="fri"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri6" class="fri"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="fri7" class="fri"></td></tr><tr><th>Saturday</th><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat1" class="sat"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat2" class="sat"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat3" class="sat"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat4" class="sat"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat5" class="sat"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat6" class="sat"></td><td ondrop="drop(event)" ondragover="allowDrop(event)" id="sat7" class="sat"></td></tr></tbody>
					</table>
					</div>
					</div>
				</div>
				<hr/>
				<div id="control_div"><button id="prev_button" class="button">Previous</button><button id="next_button" class="button">Next</button>
				</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var t1,t2,t3,t4,t5,t6,p1,p2,p3,subjects,json;
		function notify(str){
			$("#notifier").slideUp();
			$("#content").html(str);
			$("#notifier").slideDown();
		}
		$("#notifier #closer").on("click",function(){
			$("#notifier").slideUp();
		});
		$("#prev_button").on("click",function(){
			$("#right_container").fadeOut("fast");
			$(".sub_entry").animate({left:"35%"},400,"linear",function(){});
			$(".check_field").removeAttr("readonly");
			$("#next_button").text("Next");
			$(this).hide();
		});
		$("#next_button").on("click",function(){
			if($("#next_button").text()=="Finish"){
				monElmts=$("#right_container td.mon");
				tueElmts=$("#right_container td.tue");
				wedElmts=$("#right_container td.wed");
				thuElmts=$("#right_container td.thu");
				friElmts=$("#right_container td.fri");
				satElmts=$("#right_container td.sat");
				var mon='"mon":{',tue='"tue":{',wed='"wed":{',thu='"thu":{',fri='"fri":{',sat='"sat":{';for(i=0;i<7;i++){length=1,accounted=true;mon+='"'+i+'":["'+$(monElmts[i]).find("span").text()+'",'+($(monElmts[i]).attr("colspan")?3:1)+","+($(monElmts[i]).find("span").hasClass("misc")?false:true)+"]";tue+='"'+i+'":["'+$(tueElmts[i]).find("span").text()+'",'+($(tueElmts[i]).attr("colspan")?3:1)+","+($(tueElmts[i]).find("span").hasClass("misc")?false:true)+"]";wed+='"'+i+'":["'+$(wedElmts[i]).find("span").text()+'",'+($(wedElmts[i]).attr("colspan")?3:1)+","+($(wedElmts[i]).find("span").hasClass("misc")?false:true)+"]";thu+='"'+i+'":["'+$(thuElmts[i]).find("span").text()+'",'+($(thuElmts[i]).attr("colspan")?3:1)+","+($(thuElmts[i]).find("span").hasClass("misc")?false:true)+"]";fri+='"'+i+'":["'+$(friElmts[i]).find("span").text()+'",'+($(friElmts[i]).attr("colspan")?3:1)+","+($(friElmts[i]).find("span").hasClass("misc")?false:true)+"]";sat+='"'+i+'":["'+$(satElmts[i]).find("span").text()+'",'+($(satElmts[i]).attr("colspan")?3:1)+","+($(satElmts[i]).find("span").hasClass("misc")?false:true)+"]";if(i!=6){mon+=",";tue+=",";wed+=",";thu+=",";fri+=",";sat+=","}}mon+="}",tue+="}",wed+="}",thu+="}",fri+="}",sat+="}";var jsonArray=new Array(mon,tue,wed,thu,fri,sat);var json="{"+jsonArray.join()+"}";subjects="{";elmts=$(".check_field");for(i=0;i<elmts.length;i++){subjects+='"'+elmts[i].id+'":"'+elmts[i].value+'"';if(i!=8)subjects+=","}subjects+="}";$.ajax({url:"/ajax/timetableUpdate.php",method:"post",data:{j:json,sub:subjects},success:function(data){if(data==2)alert("Everything is successfully saved in the Database.");location.href='/timetable.php';}})}else{elmts=$(".check_field");validate=9;for(i=0;i<elmts.length;i++)if(elmts[i].value===elmts[i].value.toUpperCase()&&elmts[i].value!=""){$(elmts[i]).removeClass("redOutline");validate--}else{$(elmts[i]).addClass("redOutline");validate++}if(validate!==0)notify("Whimp! Something is wrong. Make sure you've entered the shortcodes only and also don't forget to fill everything!");else{$("#notifier").slideUp();$(".check_field").attr("readonly","true");$(".sub_entry").animate({left:0},400,"linear",function(){$("#prev_button").show();var gen="";subjects=new Object;subjects.t=[$("#t1").val(),$("#t2").val(),$("#t3").val(),$("#t4").val(),$("#t5").val(),$("#t6").val()];subjects.p=[$("#p1").val(),$("#p2").val(),$("#p3").val()];subjects.m=["PT","LIBRARY","SPD","P&T","SEMINAR","OTHER"];json=JSON.stringify(subjects);gen+="<fieldset><legend>Theory Subjects</legend>";for(var x in subjects["t"])gen+='<span id="tspan'+x+'" class="theory" draggable="true" ondragstart="drag(event)">'+subjects["t"][x]+"</span>";gen+="</fieldset><fieldset><legend>Practical Subjects</legend>";for(var x in subjects["p"])gen+='<span id="pspan'+x+'" class="practical" draggable="true" ondragstart="drag(event)">'+subjects["p"][x]+"</span>";gen+="</fieldset><fieldset><legend>Other Periods</legend>";for(var x in subjects["m"])gen+='<span id="mspan'+x+'" class="misc" draggable="true" ondragstart="drag(event)">'+subjects["m"][x]+"</span>";gen+="</fieldset>";$("#sub_shower").html(gen);$("#right_container").fadeIn("slow");$("#next_button").text("Finish")})}}});$("#reset").on("click",function(){$("#right_container td").empty().removeAttr("style").removeAttr("colspan")})});</script>

			<?php else:	//handler for already signed in users.
			?>
			<div id="grid">
				<p>This is the last known verified timetable for your class. If you want to report an error in this timtable, you can also <a href="/timetable.php?edit_mode=true">enter the timetable</a> from the beginning.</p>
				<table><tbody><tr><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th></tr><tr id="mon_tr"><th>Monday</th></tr><tr id="tue_tr"><th>Tuesday</th></tr><tr id="wed_tr"><th>Wednesday</th></tr><tr id="thu_tr"><th>Thursday</th></tr><tr id="fri_tr"><th>Friday</th></tr><tr id="sat_tr"><th>Saturday</th></tr></tbody></table>
			</div>
			</div>
			</div>
			</div>
			<script type="text/javascript">var mon,tue,wed,thu,fri,sat;var mon_html="",tue_html="",wed_html="",thu_html="",fri_html="",sat_html="";mon=JSON.parse('<?php echo $_COOKIE["mon"]; ?>');tue=JSON.parse('<?php echo $_COOKIE["tue"]; ?>');wed=JSON.parse('<?php echo $_COOKIE["wed"]; ?>');thu=JSON.parse('<?php echo $_COOKIE["thu"]; ?>');fri=JSON.parse('<?php echo $_COOKIE["fri"]; ?>');sat=JSON.parse('<?php echo $_COOKIE["sat"]; ?>');for(i=0;i<mon.length;i++)if(mon[i][1]==3){mon_html+='<td id="mon'+(i+1)+'" class="mon" colspan="3"><span>'+mon[i][0]+"</span></td>";i+=2}else if(mon[i][1]==1)if(mon[i][2]!=false)mon_html+='<td id="mon'+(i+1)+'" class="theory mon"><span>'+mon[i][0]+"</span></td>";else mon_html+='<td id="mon'+(i+1)+'" class="misc mon"><span>'+mon[i][0]+"</span></td>";for(i=0;i<tue.length;i++)if(tue[i][1]==3){tue_html+='<td id="tue'+(i+1)+'" class="tue" colspan="3"><span>'+tue[i][0]+"</span></td>";i+=2}else if(tue[i][1]==1)if(tue[i][2]!=false)tue_html+='<td id="tue'+(i+1)+'" class="theory tue"><span>'+tue[i][0]+"</span></td>";else tue_html+='<td id="tue'+(i+1)+'" class="misc tue"><span>'+tue[i][0]+"</span></td>";for(i=0;i<wed.length;i++)if(wed[i][1]==3){wed_html+='<td id="wed'+(i+1)+'" class="wed" colspan="3"><span>'+wed[i][0]+"</span></td>";i+=2}else if(wed[i][1]==1)if(wed[i][2]!=false)wed_html+='<td id="wed'+(i+1)+'" class="theory wed"><span>'+wed[i][0]+"</span></td>";else wed_html+='<td id="wed'+(i+1)+'" class="misc wed"><span>'+wed[i][0]+"</span></td>";for(i=0;i<thu.length;i++)if(thu[i][1]==3){thu_html+='<td id="thu'+(i+1)+'" class="thu" colspan="3"><span>'+thu[i][0]+"</span></td>";i+=2}else if(thu[i][1]==1)if(thu[i][2]!=false)thu_html+='<td id="thu'+(i+1)+'" class="theory thu"><span>'+thu[i][0]+"</span></td>";else thu_html+='<td id="thu'+(i+1)+'" class="misc thu"><span>'+thu[i][0]+"</span></td>";for(i=0;i<fri.length;i++)if(fri[i][1]==3){fri_html+='<td id="fri'+(i+1)+'" class="fri" colspan="3"><span>'+fri[i][0]+"</span></td>";i+=2}else if(fri[i][1]==1)if(fri[i][2]!=false)fri_html+='<td id="fri'+(i+1)+'" class="theory fri"><span>'+fri[i][0]+"</span></td>";else fri_html+='<td id="fri'+(i+1)+'" class="misc fri"><span>'+fri[i][0]+"</span></td>";for(i=0;i<sat.length;i++)if(sat[i][1]==3){sat_html+='<td id="sat'+(i+1)+'" class="sat" colspan="3"><span>'+sat[i][0]+"</span></td>";i+=2}else if(sat[i][1]==1)if(sat[i][2]!=false)sat_html+='<td id="sat'+(i+1)+'" class="theory sat"><span>'+sat[i][0]+"</span></td>";else sat_html+='<td id="sat'+(i+1)+'" class="misc sat"><span>'+sat[i][0]+"</span></td>";$("#mon_tr").append(mon_html);$("#tue_tr").append(tue_html);$("#wed_tr").append(wed_html);$("#thu_tr").append(thu_html);$("#fri_tr").append(fri_html);$("#sat_tr").append(sat_html);</script>
			<?php endif; ?>
<?php
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';
else:
	//for non-loggedin users
	header("Location: /login.php?redirect_to=".$_SERVER['PHP_SELF']);
endif;
?>