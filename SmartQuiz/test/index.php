<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--header-->
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Favicon-->
<link rel="shortcut icon" href="../images/q-icon.png">
<!--jquery-->
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<!--start button-->
<style>
    .regbtn{
    background-color: #4682B4;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 30%;
    opacity: 0.9;
    font-weight: bold;}
</style>
<title>Quiz</title>
</head>
<body onload="check()" style="background:#E5E8E8">
<div id="container">
	<!--header-->
	<div class="header">
		<h1>Smart Quizzer</h1>
		<h2>A Smart Innovation</h2>
		<div style="text-align: right"><h4 id="uname"></h4><!--h4><a href="#" onclick="dest()" style="color:white;text-decoration: none;">log out</a></h4--></div>
	</div>
</div>
<br>
<center>
    <?php
    $testid=$_GET["testid"];
    $conn=mysqli_connect("localhost","root","","quizzer");
    $sql="select * from `tests` where `testid`='".$testid."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo "<fieldset style=\"width:50%;padding-left:100px;\">";
    echo "<h3>Title:&nbsp;&nbsp;&nbsp;&nbsp;".strtoupper($row["title"])."</h3>";
    echo "<h3>Test ID:&nbsp;&nbsp;&nbsp;".$testid."</h3>";
    echo "</fieldset>";
    mysqli_close($conn);
    ?>
</center>
<center><h1>Instructions</h1></center>
<div style="padding-left:300px;padding-right:300px;text-align:justify;">
        <h4>1. Each question may have different score based on the complexity.</h4>
        <h4>2. Negative mark for each wrong answer is <?php echo $row["negative"]?>.</h4>
        <h4>3. No negative mark for omitting the questions.</h4>
        <h4>4. Make sure that you are done for the test before clicking on finish test.</h4>
        <h4>5. Opening the new tab or closing while writing test will be treated as malpractice, So your test will not be taken into account.</h4>
		<h4>6. You cannot take the same test more than one time.</h4>
</div><br>
<center>
	<a href="test.php?&testid=<?php echo $testid;?>" class="regbtn" style="text-decoration:none">Start Test</a>&nbsp;&nbsp;
	<a href="../home.html" class="regbtn" style="text-decoration:none">Home</a>
</center>
<!--session checker-->
<script>
function check(){
		$.ajax({
			type:'post',
			url:'../php/main.php',
			data:{},
			success:function(data){
				if(data=="ns"){
					alert("session error");
					dest();
				}
				else{
					document.getElementById("uname").innerHTML=data;
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
			url:'../php/dest.php',
			data:{},
			success:function(data){
				if(data=="s"){
					window.location.href="../index.html";
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