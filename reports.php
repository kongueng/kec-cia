<?php
//this file is responsible for internal marks.
@session_start();
if(isset($_SESSION["uemailh"])) :
	$logged_in = true;
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
?>
<div id="outer_container" class="clearfix">
	<div id="container" class="container95">
		<!--<h1 class="notice cen" style="margin-top:0">Reports</h1>-->
		<div class="boxer" style="width:100%; height:400px;"></div>
	</div>
</div>
<script type="text/javascript">
$(function () { 
    $('.boxer').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Absent Report'
        },
        xAxis: {
            title: {
                text: 'Subjects'
            },
            categories: ['TQM', 'NS', 'WT', 'WCN', 'ES', 'JT', 'NSL', 'ESL', 'WTL']
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: 'Attendance Percent'
            }
        },
        series: [{
            name: 'Class Average',
            data: [55, 60, 50, 40, 55, 60, 12, 13, 11]
        },{
            name: 'You',
            data: [50, 45, 46, 35, 49, 51, 9, 11, 10]
        }]
    });
});
</script>
<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';
else:
	//for non-loggedin users
	header("Location: /login.php?redirect_to=".$_SERVER['PHP_SELF']);
endif;
?>