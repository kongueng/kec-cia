<?php
/*
 * bugs:fix double equal comparision,save change
 */
	$logged_in=false;
	@session_start();
	//checks for a logged_in
	if( isset($_SESSION['uemailh']) ) :
		// For returning users
		$logged_in=true;
		require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
		if(isset($_COOKIE["tt"]) && ($_COOKIE["tt"]=="new")){
?>
<div id="outer_container" class="clearfix">
	<div id="container">
		<h1 class="cen notice">You've not entered your timetable yet.</h1>
	</div>
</div>
<?php
		}else{
			$mon_json=json_decode($_COOKIE["mon"],true);
			$tue_json=json_decode($_COOKIE["tue"],true);
			$wed_json=json_decode($_COOKIE["wed"],true);
			$thu_json=json_decode($_COOKIE["thu"],true);
			$fri_json=json_decode($_COOKIE["fri"],true);
			$sat_json=json_decode($_COOKIE["sat"],true);
			$mon='<td class="valign"><input type="checkbox" class="toggle_input" id="whole"><label for="whole">All Day</label></td>';
			$tue='<td class="valign"><input type="checkbox" class="toggle_input" id="whole"><label for="whole">All Day</label></td>';
			$wed='<td class="valign"><input type="checkbox" class="toggle_input" id="whole"><label for="whole">All Day</label></td>';
			$thu='<td class="valign"><input type="checkbox" class="toggle_input" id="whole"><label for="whole">All Day</label></td>';
			$fri='<td class="valign"><input type="checkbox" class="toggle_input" id="whole"><label for="whole">All Day</label></td>';
			$sat='<td class="valign"><input type="checkbox" class="toggle_input" id="whole"><label for="whole">All Day</label></td>';
			for($i=0; $i<7; $i++){
				$mon .= '<td class="valign"';
				if($mon_json[$i][1]==3){
					$mon .=' colspan=3><input type="checkbox" class="toggle_input subinputs" id="mon'.$i.'"><label for="mon'.$i.'" class="sublabels">'.$mon_json[$i][0].'</label></td>';$i+=2;
					
				}else{
					$mon .='><input type="checkbox" class="toggle_input subinputs" id="mon'.$i.'"><label for="mon'.$i.'" class="sublabels">'.$mon_json[$i][0].'</label></td>';
				}
			}
			for($i=0; $i<7; $i++){
				$tue .= '<td class="valign"';
				if($tue_json[$i][1]==3){
					$tue .=' colspan=3><input type="checkbox" class="toggle_input subinputs" id="tue'.$i.'"><label for="tue'.$i.'" class="sublabels">'.$tue_json[$i][0].'</label></td>';$i+=2;
					
				}else{
					$tue .='><input type="checkbox" class="toggle_input subinputs" id="tue'.$i.'"><label for="tue'.$i.'" class="sublabels">'.$tue_json[$i][0].'</label></td>';
				}
			}	
			for($i=0; $i<7; $i++){
				$wed .= '<td class="valign"';
				if($wed_json[$i][1]==3){
					$wed .=' colspan=3><input type="checkbox" class="toggle_input subinputs" id="wed'.$i.'"><label for="wed'.$i.'" class="sublabels">'.$wed_json[$i][0].'</label></td>';$i+=2;
					
				}else{
					$wed .='><input type="checkbox" class="toggle_input subinputs" id="wed'.$i.'"><label for="wed'.$i.'" class="sublabels">'.$wed_json[$i][0].'</label></td>';
				}
			}	
			for($i=0; $i<7; $i++){
				$thu .= '<td class="valign"';
				if($thu_json[$i][1]==3){
					$thu .=' colspan=3><input type="checkbox" class="toggle_input subinputs" id="thu'.$i.'"><label for="thu'.$i.'" class="sublabels">'.$thu_json[$i][0].'</label></td>';$i+=2;
					
				}else{
					$thu .='><input type="checkbox" class="toggle_input subinputs" id="thu'.$i.'"><label for="thu'.$i.'" class="sublabels">'.$thu_json[$i][0].'</label></td>';
				}
			}	
			for($i=0; $i<7; $i++){
				$fri .= '<td class="valign"';
				if($fri_json[$i][1]==3){
					$fri .=' colspan=3><input type="checkbox" class="toggle_input subinputs" id="fri'.$i.'"><label for="fri'.$i.'" class="sublabels">'.$fri_json[$i][0].'</label></td>';$i+=2;
					
				}else{
					$fri .='><input type="checkbox" class="toggle_input subinputs" id="fri'.$i.'"><label for="fri'.$i.'" class="sublabels">'.$fri_json[$i][0].'</label></td>';
				}
			}	
			for($i=0; $i<7; $i++){
				$sat .= '<td class="valign"';
				if($sat_json[$i][1]==3){
					$sat .=' colspan=3><input type="checkbox" class="toggle_input subinputs" id="sat'.$i.'"><label for="sat'.$i.'" class="sublabels">'.$sat_json[$i][0].'</label></td>';$i+=2;
					
				}else{
					$sat .='><input type="checkbox" class="toggle_input subinputs" id="sat'.$i.'"><label for="sat'.$i.'" class="sublabels">'.$sat_json[$i][0].'</label></td>';
				}
			}
?>
<div id="outer_container" class="clearfix">
	<div id="container">
		<div id="target">
			<p class="bold inline-block" style="vertical-align:middle">View Calendar for:</p>
			<div id="navigator" class="clearfix">
				<span id="prevMonth" class="prev"></span>
				<span id="month"><?php echo date('n'); ?></span>
				<span id="sep">&mdash;</span>
				<span id="year"><?php echo date('Y'); ?></span>
				<span id="nextMonth" class="next"></span>
				<span id="sep"></span>
				<button id="changeMonth">Change Calendar</button>
			</div>
			<div id="grid" style="text-align:center"><?php require_once($_SERVER["DOCUMENT_ROOT"].'/ajax/date.php'); ?></div>
		</div>
	</div>
</div>
<div id="popup-container">
	<div id="popup-closer"></div>
	<div id="popup-inner">
		<div id="popup-closebutton"></div>
		<div id="popup-content">
		<p>Just tick the periods you're absent:</p>
		<table id="popup_table"><tbody><tr><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr><tr id="period_data"></tr><tr id="period_entry"></tr></tbody></table><div id="options"></div><p id="please_wait" class="cen" style="display:none">Please wait...</p>
		</div>
	</div>
</div>
<div id="loading"></div>
<div id="footer">
	<p>Made in love from Strapper Team.</p>
</div>
<script>
	$(document).ajaxStart(function(){$("#please_wait").show();});$(document).ajaxComplete(function(){$("#please_wait").hide();});$(document).ready(function(){var popup_displayed;function dayAssigner(){var elem=$("li.empty,li.dateli");for(i=0;i<elem.length;)$(elem[i++]).addClass("sun"),$(elem[i++]).addClass("mon"),$(elem[i++]).addClass("tue"),$(elem[i++]).addClass("wed"),$(elem[i++]).addClass("thu"),$(elem[i++]).addClass("fri"),$(elem[i++]).addClass("sat");$(".dateli.sat:eq(1),.dateli.sat:eq(3)").removeClass("dateli").addClass("empty");elem=$(".dateli.mon,.dateli.tue,.dateli.wed,.dateli.thu,.dateli.fri,.dateli.sat");}dayAssigner();$("#grid").on("click",".dateli.mon,.dateli.tue,.dateli.wed,.dateli.thu,.dateli.fri,.dateli.sat",function(){commonFunc(this);});$(document).on("keyup",function(e){if(e.keyCode===27&&popup_displayed===true){$("#popup-container").fadeOut("slow");popup_displayed=false;}});$("#changeMonth").on("click",function(){var month=$("#month").text();var year=$("#year").text();$.post('/ajax/date.php',{change:"1",month:month,year:year},function(data){$("#grid").html(data);dayAssigner();});});var absence;function commonFunc(e){popup_displayed=true;var mon,tue,wed,thu,fri,sat,html='';mon='<?php echo $mon;?>';tue='<?php echo $tue;?>';wed='<?php echo $wed;?>';thu='<?php echo $thu;?>';fri='<?php echo $fri;?>';sat='<?php echo $sat;?>';$("#popup-container").fadeIn("slow");switch($(e).attr("class")){case "dateli mon":html+=mon;break;case "dateli tue":html+=tue;break;case "dateli wed":html+=wed;break;case "dateli thu":html+=thu;break;case "dateli fri":html+=fri;break;case "dateli sat":html+=sat;break;default:html+="error:[code 19]";}$("#period_data").html(html);$("#options").html('<span class="valign"><input type="checkbox" id="nosub"/><label for="nosub">Overall attendance only</label></span><div class="button_set"><button id="save">Save</button><button id="cancel">Cancel</button></div>');var dataset=$(e).data("abs-set"),pa=[0,0,0,0,0,0,0,0,0,0],subjson=JSON.parse('<?php echo $_COOKIE["sub"];?>');if(dataset!==0){if(dataset==8){$(".toggle_input").prop("checked",true);}else{if(dataset.toString().length>1){numarr=dataset.split(",");for (i=0;i<numarr.length;i++){$(".toggle_input:eq("+numarr[i]+")").prop("checked",true);}}else{$(".toggle_input:eq("+dataset+")").prop("checked",true);}}}$("#nosub").on("change",function(){if($(this).prop("checked")){for(i=0;i<9;i++){pa[i]=0;}$(this).prop("disabled",true);$("#options label").css("color","gray");}});$(".subinputs").on("change",function(){var total=$(".subinputs").length,checked=0,name=$(this).next().text(),index=0;if($(this).prop("checked")==true){for(key in subjson){if(subjson[key]==name){pa[index]++;};index++;}pa[9]++;}else{for(key in subjson){if(subjson[key]==name){pa[index]--;};index++;}pa[9]--;}if($("#nosub").prop("checked")){for(i=0;i<9;i++){pa[i]=0;}}for(i=0;i<$(".subinputs").length;i++){if($(".subinputs:eq("+i+")").prop("checked")==true){checked++;}}if(checked===total){$("#whole").prop("checked",true);}else{$("#whole").prop("checked",false);}});$("#whole").on("click",function(){if($(this).prop("checked")==true){elmts=$(".subinputs").not(":checked").prop("checked",true).change();}else{elmts=$(".subinputs:checked").prop("checked",false).change();}});$("button#save").on("click",function(){var data='0',date,i,elmts,j=0;elmts=$(".toggle_input");if($(elmts[0]).prop("checked")==true){data='8';}else{for (i=1;i<elmts.length;i++){if($(elmts[i]).prop("checked")==true){if(j==0){data=i;}else{data=data+","+(i);}j++;}}}date=$(e).text();year=$("#year").html();absence=$(e).data("abs-set").toString();entry=(absence==0)?0:1;if(absence!=data){$.ajax({type:'post',url:'/ajax/data.php',data:{entry:entry,date:date,year:year,data:data,order:JSON.stringify(pa)}}).done(function(reply){if(reply=='0'){alert("Saved!");}else{alert("Sorry Something went wrong. [Code:"+reply+"]");}location.reload();});}else{alert("Nothing to save!");}});$("button#cancel").on("click",function(){$("#popup-container").fadeOut("medium");});}$("#prevMonth").on("click",function(){var a=parseInt($("#month").html()),b=parseInt($("#year").html());a--;0===a&&(a=12,b-=1);$("#month").html(a);$("#year").html(b)});$("#nextMonth").on("click",function(){var a=parseInt($("#month").html()),b=parseInt($("#year").html());a++;13==a&&(a=1,b+=1);$("#month").html(a);$("#year").html(b)});$("#popup-closer,#popup-closebutton").on("click",function(){$("#popup-container").fadeOut("slow");popup_displayed=!1});
		});
</script>
<?php
	}
		require_once __DIR__.'/includes/footer.php';
	else:
		//for non-loggedin users
		header("Location:/login.php?redirect_to=".$_SERVER['PHP_SELF']);
	endif;
?>
