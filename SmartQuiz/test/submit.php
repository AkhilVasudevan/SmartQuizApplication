<?php
session_start();
?>
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
<title>Quiz</title>
</head>
<body onload="check()" style="background:#E5E8E8">
<h6>&nbsp;</h6>
<center>
    <?php
    $testid=$_POST["testid"];
    $conn=mysqli_connect("localhost","root","","quizzer");
    $sql="select * from `tests` where `testid`='".$testid."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo "<div style=\"padding-left:100px;padding-right:100px;\">";
    echo "<fieldset style=\"width:50%;\">";
    echo "<h3>User Name:&nbsp;&nbsp;<span id=\"uname\" style=\"color:green\"></span></h3>";
    echo "<h3>Title:&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color:green\">".strtoupper($row["title"])."</span></h3>";
    echo "<h3>Test ID:&nbsp;&nbsp;&nbsp; <span style=\"color:green\">".$testid."</span></h3>";
    echo "</fieldset>";
    echo "</div>";
    mysqli_close($conn);
    ?>
    <div>
        <?php
            $quest=$row["questions"];
            $neg=$row["negative"];
            $conn=mysqli_connect("localhost","root","","quizzer");
            $sql="select * from `questions` where `testid`='".$testid."'";
            $result=mysqli_query($conn,$sql);
            $i=1;
            $attended=0;
            $notattended=0;
            $correct=0;
            $score=0;
            $wrong=0;
            while($quest>=$i)
            {
                $row=mysqli_fetch_assoc($result);
                if(isset($_POST[$i]))
                {
                    if($_POST[$i]=="")
                    {
                        $notattended=$notattended+1;
                    }
                    else
                    {
                        $attended=$attended+1;
                        if($_POST[$i]==$row["answer"])
                        {
                            $correct=$correct+1;
                            $score=$score+$row["score"];
                        }
                        else{
                            $wrong=$wrong+1;
                        }
                    }
                }
                else
                {
                    $notattended=$notattended+1;
                }
                $i=$i+1;
            }
            $score=$score-($wrong*$neg);
            echo "<h1>&nbsp;</h1>";
            echo "<div style=\"padding-left:100px;padding-right:100px;\">";
                echo "<fieldset style=\"width:50%;\">";
                    echo "<legend><h3>Result</h3></legend>";
                    echo "<h3>Number of Questions Attended:&nbsp;&nbsp;<span id=\"uname\" style=\"color:green\">".$attended."</span><br><br>Number of Questions Not Attended:&nbsp;&nbsp;<span id=\"uname\" style=\"color:red\">".$notattended."</span><br><br>";
                    echo "Correctly Answered:&nbsp;&nbsp;<span id=\"uname\" style=\"color:green\">".$correct."</span><br><br>Wrong Answers:&nbsp;&nbsp;<span id=\"uname\" style=\"color:red\">".$wrong."</span><br><br>Score:&nbsp;&nbsp;<span id=\"uname\" style=\"color:blue\">".$score."</span></h3>";
                echo "</fieldset>";
                echo "<br><br><br><a href=\"../home.html\" style=\"text-decoration:none\" class=\"regbtn1\">Home</a>";
            echo "</div>";
            mysqli_close($conn);
            $user=$_SESSION["user"];
            $conn=mysqli_connect("localhost","root","","quizzer");
            $sql="insert into `results`(`userid`,`testid`,`questions`,`correct`,`wrong`,`attended`,`notattended`,`score`) values('".$user."','".$testid."','".$quest."','".$correct."','".$wrong."','".$attended."','".$notattended."','".$score."')";
            mysqli_query($conn,$sql);
            mysqli_close($conn);
        ?>
    </div>
    <?php
        $conn=mysqli_connect("localhost","root","","quizzer");
        $sql="select `people` from `tests` where `testid`='$testid'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $people=$row["people"];
        mysqli_close($conn);
        $conn=mysqli_connect("localhost","root","","quizzer");
        $people=$people+1;
        $sql="update `tests` set `people`='".$people."' where `testid`='".$testid."'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
    ?>
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
					window.location.href="../index.html";
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