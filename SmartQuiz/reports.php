<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--header-->
<link rel="stylesheet" type="text/css" href="css\style.css">
<link rel="stylesheet" type="text/css" href="css\script.css">
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
<div style="align-content:center">
<?php
$conn=mysqli_connect("localhost","root","","quizzer");
$user=$_SESSION["user"];
$sql="select * from results where `userid`='".$user."'";
$result=mysqli_query($conn,$sql);
echo "<center><h2>Test Attended</h2></center>";
echo "<center><h3>Table Report</h3><table border=\"1\">";
echo "<tr><th>Test ID</th><th>Subject</th><th>No. of Question</th><th>Questions Attended</th><th>Questions Not Attended</th><th>Correctly Answered</th><th>Wrongly Answered</th><th>Marks Scored</th></tr>";
while($row=mysqli_fetch_assoc($result))
{
	$con=mysqli_connect("localhost","root","","quizzer");
	$s="select * from tests where `testid`='".$row["testid"]."'";
	$res=mysqli_query($con,$s);
	$r=mysqli_fetch_assoc($res);
	echo "<tr><td>".$row["testid"]."</td><td>".$r["title"]."</td><td>".$row["questions"]."</td><td>".$row["attended"]."</td><td>".$row["notattended"]."</td><td>".$row["correct"]."</td><td>".$row["wrong"]."</td><td>".$row["score"]."</td></tr>";
	mysqli_close($con);
}
echo "</table></center>";
mysqli_close($conn);
echo "<center><h3>Graph Report</h3>";
echo "<form id=\"graph_form\" method=\"post\">";
echo "<select name=\"testid\">";
echo "<option value=\"\">Test Id</option>";
$conn=mysqli_connect("localhost","root","","quizzer");
$sql="select * from results where `userid`='".$user."'";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{
	$con=mysqli_connect("localhost","root","","quizzer");
	$s="select * from tests where `testid`='".$row["testid"]."'";
	$res=mysqli_query($con,$s);
	$r=mysqli_fetch_assoc($res);
	echo "<option value=\"".$row["testid"]."\">".$row["testid"]."--".$r["title"]."</option>";
	mysqli_close($con);
}
mysqli_close($conn);
echo "</select>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"grph\" value=\"Show\">";
echo "</form></center>";
?>
</div>
<?php
if(isset($_POST["grph"])||isset($_POST["testid"]))
{
	if($_POST["testid"]!="")
	{
		$id=$_POST["testid"];
		$conn=mysqli_connect("localhost","root","","quizzer");
		$sqlQuery = "select questions,correct,wrong,notattended from results where testid='".$id."' and userid='".$user."'";
		$result = mysqli_query($conn,$sqlQuery);
		$row=mysqli_fetch_assoc($result);
		$correct=$row["correct"]/$row["questions"];
		$wrong=$row["wrong"]/$row["questions"];
		$notattended=$row["notattended"]/$row["questions"];
    	$dataPoints = array(
        	array("label"=>"correct","y"=>$correct),
        	array("label"=>"wrong","y"=>$wrong),
        	array("label"=>"not attended","y"=>$notattended)
		);
		mysqli_close($conn);
	}
}
?>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!--graph-->
<script>
 </script>
<!--session checker-->
<script>
function graphFunction() {
 var chart = new CanvasJS.Chart("chartContainer", {
	 animationEnabled: true,
	 title: {
		 text: "Test Result"
	 },
	 subtitles: [{
		 text: <?php echo $id;?>
	 }],
	 data: [{
		 type: "pie",
		 yValueFormatString: "#,##0.00\"%\"",
		 indexLabel: "{label} ({y})",
		 dataPoints: <?php 
		 if($_POST["testid"]!=""){
			echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
			}?>
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
					graphFunction();
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