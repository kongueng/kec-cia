<?php
//this file is responsible for internal marks.
@session_start();
if(isset($_SESSION["uemailh"])) :
	$logged_in = true;
	require_once $_SERVER["DOCUMENT_ROOT"].'/db/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
	$json_array = json_decode($_COOKIE["sub"], true);
?>
<div id="outer_container" class="clearfix">
	<div id="container" class="container95">
		<p>Enter your internal marks below: <b>(out of 100)</b></p>
		<div id="grid">
			<table>
				<tr>
					<th>Subject</th>
					<th><?php echo $json_array["t1"]; ?></th>
					<th><?php echo $json_array["t2"]; ?></th>
					<th><?php echo $json_array["t3"]; ?></th>
					<th><?php echo $json_array["t4"]; ?></th>
					<th><?php echo $json_array["t5"]; ?></th>
					<th><?php echo $json_array["t6"]; ?></th>
				</tr>
				<tr>
					<th>Module 1</th>
					<td><input type="number" class="s1 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s2 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s3 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s4 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s5 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s6 inputs" min="0" max="100" value="0"/></td>
				</tr>
				<tr>
					<th>Module 2</th>
					<td><input type="number" class="s1 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s2 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s3 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s4 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s5 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s6 inputs" min="0" max="100" value="0"/></td>
				</tr>
				<tr>
					<th>Module 3</th>
					<td><input type="number" class="s1 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s2 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s3 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s4 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s5 inputs" min="0" max="100" value="0"/></td>
					<td><input type="number" class="s6 inputs" min="0" max="100" value="0"/></td>
				</tr>
				<tr>
					<th>Total</th>
					<td class="result1"></td>
					<td class="result2"></td>
					<td class="result3"></td>
					<td class="result4"></td>
					<td class="result5"></td>
					<td class="result6"></td>
				</tr>
			</table>
			<div id="options">
				<button id="save">Save Permanently</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var changed = false;
		$.ajax ({
			url: '/ajax/internal.php',
			method: 'post',
			data: {
				f: "fetch"
			},
			success: function(response){
				ar = [0, 0, 0, 0, 0, 0];
				console.log(ar);
				response = JSON.parse(response);
				for(i=0;i<18;i++) {
					$(".inputs:eq("+i+")").val(response[i]);
					switch (i%6) {
						case 0:	ar[0] += parseInt(response[i]);
						break;
						case 1: ar[1] += parseInt(response[i]);
						break;
						case 2: ar[2] += parseInt(response[i]);
						break;
						case 3: ar[3] += parseInt(response[i]);
						break;
						case 4: ar[4] += parseInt(response[i]);
						break;
						case 5: ar[5] += parseInt(response[i]);
						break;
					}
				}
				for(i=0; i<6; i++) {
					ar[i] = ar[i]/10;
					$(".result"+(i+1)).html(ar[i] + "/30");
				}
				console.log(ar);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert("Status: " + textStatus);
				alert("Error: " + errorThrown);
			}
		})
		$(".inputs").on("change",function(){
			changed = true;
		});
		$("#save").on("click",function(){
			if(changed === true) {
				var da = new Array();
				for(i=0;i<18;i++) {
					da[i] = $(".inputs:eq("+i+")").val();
				}
				$.ajax ({
					url: '/ajax/internal.php',
					method: 'post',
					data: {
						d: JSON.stringify(da)
					},
					success: function(response){
						if(response === '1') {
							alert("Saved Successfully");
						} else if(response === '0') {
							alert("Oops! Something went wrong!");
						}
						location.reload();
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						alert("Status: " + textStatus); alert("Error: " + errorThrown);
					}
				})
			} else {
				alert("Nothing to save!");
			}
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