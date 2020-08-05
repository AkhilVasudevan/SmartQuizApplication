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
<!--body content MVC-->
<div>
    <center><h1>Submit Questions</h1></center>
    <?php
    $question=$_POST["question"];
    $testid=$_POST["testid"];
    $stts=$_POST["stts"];
    $i=1;
    while($i<=$question)
    {
        if(isset($_POST["qno".$i]))
        {
            echo $_POST["qno".$i];
        }
        if(isset($_POST[$i]))
        {
            echo $_POST[$i];
        }
        $f="i".$i;
        if($_FILES[$f]!=false)
        {
            $image =addslashes($_FILES[$f]['tmp_name']);
			$name  =addslashes($_FILES[$f]['name']);
			$image =file_get_contents($image);
            $image =base64_encode($image);
            echo "<img height=\"100\" width=\"100\" src=\"data:image;base64,".$image."\"><br>";
        }
        /*if($_FILES['image'] == FALSE)
        {
            $image =addslashes($_FILES['image']['tmp_name']);
			$name  =addslashes($_FILES['image']['name']);
			$image =file_get_contents($image);
			$image =base64_encode($image);
        }*/
        $i=$i+1;
    }
    ?>
</div>
<!--session checker-->
<script>
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