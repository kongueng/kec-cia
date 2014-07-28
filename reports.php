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
		<h1 class="notice cen" style="margin-top:0">Reports</h1>
		<!-- <h2 class="tagline cen">We will get it done in a week!</h2> -->
		<div class="boxer" style="width:100%; height:400px;"></div>
	</div>
</div>
<script type="text/javascript">
	$(function () { 
    $('.boxer').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Fruit Consumption'
        },
        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
            title: {
                text: 'Fruit eaten'
            }
        },
        series: [{
            name: 'Jane',
            data: [1, 0, 4]
        }, {
            name: 'John',
            data: [5, 7, 3]
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