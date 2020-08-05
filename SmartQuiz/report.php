<?php
session_start();
$user=$_SESSION["user"];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--header-->
<link rel="stylesheet" type="text/css" href="css\style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Favicon-->
<link rel="shortcut icon" href="images/q-icon.png">
<!--jquery-->
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<title>Quiz</title>
</head>
<body onload="check()">
<div id="container">
	<!--header-->
	<div class="header">
		<h1>Smart Quizzer</h1>
		<h2>A Smart Innovation</h2>
		<div style="text-align: right"><h4 id="uname"></h4><h4><a href="#" onclick="dest()" style="color:white;text-decoration: none;">log out</a></h4></div>
	</div>
	<!--Menus-->
	<ul>
        <li><a href="index.html">HOME</a></li>
        <li><a href="#">TEST</a>
			<ul class="dropdown">
				<li><a href="create.html">Create Test</a></li> 
				<li><a href="panel.php">Panel Test</a></li>
				<li><a href="test.html">Take Test</a></li>
			</ul>
		</li>
        <li><a href="#">REPORT</a>
			<ul class="dropdown">
				<li><a href="report.php">Other Test</a></li> 
				<li><a href="reports.php">My Test</a></li>
			</ul>
		</li>
		<li><a href="about.html">ABOUT US</a></li>
    </ul>
</div>
<div style="align-content:justify">
	<h2></h2>
	<?php
	$conn=mysqli_connect("localhost","root","","quizzer");
	$sqlQuery = "SELECT * FROM tests where `user`='".$user."'";
	$result = mysqli_query($conn,$sqlQuery);
	echo "<center><form method=\"post\">";
	echo "<select name=\"testid\">";
	echo "<option value=\"\">Test Id</option>";
	while($row=mysqli_fetch_assoc($result))
	{
		echo "<option value=\"".$row["testid"]."\">".$row["testid"]."--".$row["title"]."</option>";
	}
	echo "</select>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"grph\" value=\"Show\">";
	echo "</form></center>";
	mysqli_close($conn);
	?>
</div>
<div>
<?php
if(isset($_POST["grph"]))
{
	if($_POST["testid"]!="")
	{
		$testid=$_POST["testid"];
		$conn=mysqli_connect("localhost","root","","quizzer");
		$sql = "SELECT * FROM results where `testid`='".$testid."' order by `score` desc";
		$result=mysqli_query($conn,$sql);
		echo "<br><center>";
			echo "<table border=\"1\">";
				echo "<tr><th>Name</th><th>No. of Question</th><th>Questions Attended</th><th>Questions Not Attended</th><th>Correctly Answered</th><th>Wrongly Answered</th><th>Marks Scored</th></tr>";
				while($row=mysqli_fetch_assoc($result))
				{
					$con=mysqli_connect("localhost","root","","quizzer");
					$sq="select * from registration where `email`='".$row["userid"]."'";
					$res=mysqli_query($con,$sq);
					$r=mysqli_fetch_assoc($res);
					echo "<tr><td>".$r["name"]."</td><td>".$row["questions"]."</td><td>".$row["attended"]."</td><td>".$row["notattended"]."</td><td>".$row["correct"]."</td><td>".$row["wrong"]."</td><td>".$row["score"]."</td></tr>";
					mysqli_close($con);
				}
			echo "</table>";
		echo "</center>";
		mysqli_close($conn);
		$conn=mysqli_connect("localhost","root","","quizzer");
		$sql ="select registration.name as label,(results.correct/results.questions)*100 as y from registration INNER JOIN results on registration.email=results.userid and results.testid='".$testid."'";
		$result=mysqli_query($conn,$sql);
		/*while($row=mysqli_fetch_assoc($result))
		{
			echo $row["name"]."--".$row["questions"]."--".$row["correct"];
		}*/
		foreach ($result as $row) {
			$dataPoints[] = $row;
		 }
		mysqli_close($conn);
	}
}
?>
</div>
<br><br>
<div id="chartContainer" style="height: 370px; width: 80%;padding-left:150px;padding-right:150px;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--session checker-->
<script>
	function chartFunction()
	{
		var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Test Result"
	},
	axisY: {
		title: "Score(in percentage)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.00\"%\"",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
	}
	function check(){
		$.ajax({
			type:'post',
			url:'php/main.php',
			data:{},
			success:function(data){
				if(data=="ns"){
					window.location.href="index.html";
				}
				else{
					document.getElementById("uname").innerHTML=data;
					chartFunction();
				}
			},
			error:function(data){
				alert("error");
			}
		});
	}
	function dest(){
		$.ajax({
			type:'post',
			url:'php/dest.php',
			data:{},
			success:function(data){
				if(data=="s"){
					window.location.href="index.html";
				}
			},
			error:function(data){
				alert("error");
			}
		});
	}
</script>
</body>
</html>