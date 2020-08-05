<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--header-->
<link rel="stylesheet" type="text/css" href="css\style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--toggle-->
<link rel="stylesheet" type="text/css" href="css\toggle.css">
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
<div style="text-align: center">
	<h1>Control Panel</h1>
	<center>
      <?php
      $user=$_SESSION["user"];
      $conn=mysqli_connect("localhost","root","","quizzer");
	  $sql="select * from `tests` where `user`='$user'";
	  $result=mysqli_query($conn,$sql);
	  echo "<table border=\"2\">";
	  echo "<tr><th>Test ID</th><th>Test Title</th><th>Enable/Disable</th><th>People Attended</th><th>Edit/Upload</th></tr>";
	  if(mysqli_num_rows($result)>0)
	  {
		  while($row=mysqli_fetch_assoc($result))
		  {
			  echo "<tr align=\"center\"><td>";
			  echo $row["testid"]."</td><td>";
			  echo $row["title"]."</td>";
			  echo "<td><label class=\"switch\">";
			  echo "<input type=\"checkbox\" id=\"".$row["testid"]."\"";
			  if($row["status"]==1)
			  {
				  echo "checked ";
			  }
			  echo "onClick=myFunctions(".$row["testid"].",".$row["status"].")>";
			  echo "<span class=\"slider round\"></span>
			  </label>";
			  echo "</td><td>".$row["people"]."</td>";
			  if($row["stts"]==0)
			  {
				  echo "<td><a href=\"question.php?&question=".$row["questions"]."&testid=".$row["testid"]."&stts=".$row["stts"]."\" style=\"text-decoration:none;color:blue;\">Upload</a></td></tr>";
			  }
			  else{
				echo "<td><a href=\"question.php?&question=".$row["questions"]."&testid=".$row["testid"]."&stts=".$row["stts"]."\" style=\"text-decoration:none;color:red;\">Edit Question</a></td></tr>";
			  }
		  }
	  }
	  echo "</table>";
      mysqli_close($conn);
	  ?>
	  </center>
</div>
<!--test enabler-->
<script>
function myFunctions(testid,status)
{
	var str='&testid='+testid;
	$.ajax({
		type:"post",
		url:"php/status.php",
		data:str,
		cache:false,
		success:function(result)
		{
			alert(result);
		},
		error:function(result)
		{
			alert("Error in enable/disable. So try again later.");
		}
	});
}
</script>
<!--session checker-->
<script>
	function check(){
		if((window.fullScreen) ||
   (window.innerWidth == screen.width && window.innerHeight == screen.height)){
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
				}
			},
			error:function(data){
				alert("error");
			}
		});
   }
   else{
	   window.location.href="index.html";
   }
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