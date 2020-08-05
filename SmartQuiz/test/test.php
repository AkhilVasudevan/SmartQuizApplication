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
<!--button-->
<style>
    .regbtn{
    background-color: Red;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 30%;
    opacity: 0.9;
    font-weight: bold;}
    .regbtn1{
    background-color: blue;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 20%;
    opacity: 0.9;
    font-weight: bold;}
</style>
<!--tabs-->
<script>
    function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
<!--timer-->
<script>
    <?php
$testid=$_GET["testid"];
        $conn=mysqli_connect("localhost","root","","quizzer");
        $sql="select * from `tests` where `testid`='".$testid."'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);?> 
        var mins = <?php echo $row["time"];?>;
        var secs = mins * 60; 
        function countdown() { 
            setTimeout('Decrement()', 60); 
        } 
        function Decrement() { 
            if (document.getElementById) { 
                minutes = document.getElementById("minutes"); 
                seconds = document.getElementById("seconds"); 
                if (seconds < 59) { 
                    seconds.value = secs; 
                }
                else{ 
                    minutes.value = getminutes(); 
                    seconds.value = getseconds(); 
                } 
                if (mins < 1) { 
                    minutes.style.color = "red"; 
                    seconds.style.color = "red"; 
                } 
                if (mins < 0) { 
                    alert('time up');
                    minutes.value = 0; 
                    seconds.value = 0;
                    document.getElementById("dem").style.display="none";
                } 
                else { 
                    secs--; 
                    setTimeout('Decrement()', 1000); 
                } 
            } 
        }
        function getminutes() { 
            mins = Math.floor(secs / 60); 
            return mins; 
        } 
        function getseconds() { 
            return secs - Math.round(mins * 60); 
        } 
    </script>
<title>Quiz</title>
</head>
<body onload="check()" style="background:#E5E8E8">
    <h6>&nbsp;</h6>
    <center>
        <?php
        echo "<div style=\"padding-left:100px;padding-right:100px;\">";
            echo "<fieldset style=\"width:50%;\">";
                echo "<h3>User Name:&nbsp;&nbsp;<span id=\"uname\" style=\"color:green\"></span></h3>";
                echo "<h3>Title:&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color:green\">".strtoupper($row["title"])."</span></h3>";
                echo "<h3>Test ID:&nbsp;&nbsp;&nbsp; <span style=\"color:green\">".$testid."</span></h3>";
                echo "<input type=\"text\" id=\"tid\" value=\"".$testid."\" style=\"display:none;\">";
            echo "</fieldset>";
        echo "</div>";
        mysqli_close($conn);
    ?>
</center>
<div style="padding-left:200px;">
        Time Left :: 
        <input id="minutes" type="text" style="width: 20px;border: none; font-size: 16px;font-weight: bold; color: black;"><font size="5">:</font> 
        <input id="seconds" type="text" style="width: 20px;border: none; font-size: 16px;font-weight: bold; color: black;"> 
</div>
<div style="padding-left:50px;padding-right:50px;">
    <?php
        $conn=mysqli_connect("localhost","root","","quizzer");
        $sql="select * from `questions` where `testid`='".$testid."' order by `score`";
        $result=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($result);
        $i=1;
        echo "<div class=\"tab\">";
            while($i<=$count)
            {
                echo "<button class=\"tablinks\" onclick=\"openCity(event, '".$i."')\">".$i."</button>";
                $i=$i+1;
            }
        echo "</div>";
    ?>
    <form method="post" action="submit.php">
        <input type="text" value="<?php echo $testid?>" name="testid" style="display:none">
        <?php 
            $i=1;
            echo "<div id=\"dem\">";
            while($row=mysqli_fetch_assoc($result))
            {
                if($i==1){
                    echo "<div id=\"".$i."\" class=\"tabcontent\">";
                }
                else{
                    echo "<div id=\"".$i."\" class=\"tabcontent\" style=\"display:none;\">";
                }
                    if($row["question"]!=NULL)
                    {
                        echo $row["question"];
                        echo "<br>";
                    }
                    if($row["questioni"]!=NULL)
                    {
                        echo "<img src=\"data:image;base64,".$row["questioni"]."\" width=300 height=300><br>";
                    }
                    if($row["optiona"]!=NULL||$row["optionai"]!=NULL)
                    {
                        echo "<input type=\"radio\" name=\"".$i."\" value=\"a\">&nbsp;&nbsp;";
                    }
                    if($row["optiona"]!=NULL)
                    {
                        echo $row["optiona"]."<br>";
                    }
                    if($row["optionai"]!=NULL)
                    {
                        echo "<img src=\"data:image;base64,".$row["optionai"]."\" width=300 height=300><br>";
                    }
                    if($row["optionb"]!=NULL||$row["optionbi"]!=NULL)
                    {
                        echo "<input type=\"radio\" name=\"".$i."\" value=\"b\">&nbsp;&nbsp;";
                    }
                    if($row["optionb"]!=NULL)
                    {
                        echo $row["optionb"]."<br>";
                    }
                    if($row["optionbi"]!=NULL)
                    {
                        echo "<img src=\"data:image;base64,".$row["optionbi"]."\" width=300 height=300><br>";
                    }
                    if($row["optionc"]!=NULL||$row["optionci"]!=NULL)
                    {
                        echo "<input type=\"radio\" name=\"".$i."\" value=\"c\">&nbsp;&nbsp;";
                    }
                    if($row["optionc"]!=NULL)
                    {
                        echo $row["optionc"]."<br>";
                    }
                    if($row["optionci"]!=NULL)
                    {
                        echo "<img src=\"data:image;base64,".$row["optionci"]."\" width=300 height=300><br>";
                    }
                    if($row["optiond"]!=NULL||$row["optiondi"]!=NULL)
                    {
                        echo "<input type=\"radio\" name=\"".$i."\" value=\"d\">&nbsp;&nbsp;";
                    }
                    if($row["optiond"]!=NULL)
                    {
                        echo $row["optiond"]."<br>";
                    }
                    if($row["optiondi"]!=NULL)
                    {
                        echo "<img src=\"data:image;base64,".$row["optiondi"]."\" width=300 height=300><br>";
                    }
                    echo "<hr><center><div class=\"regbtn1\"><input type=\"radio\" name=\"".$i."\" value=\"\">&nbsp;&nbsp;Clear Answer</div></center>";
                echo "</div>";
                $i=$i+1;
            }
            echo "</div>";
            mysqli_close($conn);
        ?>
        <center><input type="submit" value="Finish Test" name="sumit" class="regbtn" style="width:30%;"/></center>
    </form>
</div>
<!--session checker-->
<script>
function check(){
		$.ajax({
			type:'post',
			url:'../php/main.php',
			data:{},
			success:function(data){
				if(data=="ns"){
                    window.location.href="../index.html";
				}
				else{
                    document.getElementById("uname").innerHTML=data;
                    countdown();
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