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
    <form method="post" enctype="multipart/form-data">
    <?php
    if(isset($_POST["submit"]))
    {
        echo "<center><h1>Upload Questions</h1></center>";
        $question=$_POST["question"];
        $testid=$_POST["testid"];
        $stts=$_POST["stts"];
        $i=1;
        while($i<=$question)
        {
            $score=$_POST["score".$i];
            $answer=$_POST["option".$i];
            $qno= $_POST["qno".$i];
            $conn=mysqli_connect("localhost","root","","quizzer");
            $sql="INSERT INTO `questions` (`id`, `testid`, `qno`,`answer`,`score`) VALUES (NULL, '".$testid."','".$qno."','".$answer."', '".$score."')";
            mysqli_query($conn,$sql);
            mysqli_close($conn);
            if(isset($_POST[$i]))
            {
                $ques= $_POST[$i];
                $conn=mysqli_connect("localhost","root","","quizzer");
                $sql="UPDATE `questions` SET `question`='".$ques."' where`testid`='".$testid."'and `qno`='".$qno."'";
                mysqli_query($conn,$sql);
                mysqli_close($conn);
            }
            $f="i".$i;
            if($_FILES[$f]!=false)
            {
                $image =addslashes($_FILES[$f]['tmp_name']);
			    $name  =addslashes($_FILES[$f]['name']);
                if(!empty($_FILES[$f]['tmp_name']) && file_exists($_FILES[$f]['tmp_name'])) 
                {
			        $image =file_get_contents($image);
                    $image =base64_encode($image);
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `questioni`='".$image."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
            }
            if(isset($_POST["optiona".$i]))
            {
                $optiona=$_POST["optiona".$i];
                $conn=mysqli_connect("localhost","root","","quizzer");
                $sql="UPDATE `questions` SET `optiona`='".$optiona."' where`testid`='".$testid."'and `qno`='".$qno."'";
                mysqli_query($conn,$sql);
                mysqli_close($conn);
            }
            $f1="optionai".$i;
            if($_FILES[$f1]!=false)
            {
                $imagea =addslashes($_FILES[$f1]['tmp_name']);
			    $namea  =addslashes($_FILES[$f1]['name']);
                if(!empty($_FILES[$f1]['tmp_name']) && file_exists($_FILES[$f1]['tmp_name'])) 
                {
			        $imagea =file_get_contents($imagea);
                    $imagea =base64_encode($imagea);
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optionai`='".$imagea."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }   
            }
            if(isset($_POST["optionb".$i]))
            {
                $optionb= $_POST["optionb".$i];
                $conn=mysqli_connect("localhost","root","","quizzer");
                $sql="UPDATE `questions` SET `optionb`='".$optionb."' where`testid`='".$testid."'and `qno`='".$qno."'";
                mysqli_query($conn,$sql);
                mysqli_close($conn);
            }
            $f2="optionbi".$i;
            if($_FILES[$f2]!=false)
            {
                $imageb =addslashes($_FILES[$f2]['tmp_name']);
			    $nameb  =addslashes($_FILES[$f2]['name']);
                if(!empty($_FILES[$f2]['tmp_name']) && file_exists($_FILES[$f2]['tmp_name'])) 
                {
			        $imageb =file_get_contents($imageb);
                    $imageb =base64_encode($imageb);
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optionbi`='".$imageb."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
            }
            if(isset($_POST["optionc".$i]))
            {
                $optionc= $_POST["optionc".$i];
                $conn=mysqli_connect("localhost","root","","quizzer");
                $sql="UPDATE `questions` SET `optionc`='".$optionc."' where`testid`='".$testid."'and `qno`='".$qno."'";
                mysqli_query($conn,$sql);
                mysqli_close($conn);
            }
            $f3="optionci".$i;
            if($_FILES[$f3]!=false)
            {
                $imagec =addslashes($_FILES[$f3]['tmp_name']);
			    $namec  =addslashes($_FILES[$f3]['name']);
                if(!empty($_FILES[$f3]['tmp_name']) && file_exists($_FILES[$f3]['tmp_name'])) 
                {
			        $imagec =file_get_contents($imagec);
                    $imagec =base64_encode($imagec);
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optionci`='".$imagec."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
            }
            if(isset($_POST["optiond".$i]))
            {
                $optiond= $_POST["optiond".$i];
                $conn=mysqli_connect("localhost","root","","quizzer");
                $sql="UPDATE `questions` SET `optiond`='".$optiond."' where`testid`='".$testid."'and `qno`='".$qno."'";
                mysqli_query($conn,$sql);
                mysqli_close($conn);
            }
            $f4="optiondi".$i;
            if($_FILES[$f4]!=false)
            {
                $imaged =addslashes($_FILES[$f4]['tmp_name']);
			    $named  =addslashes($_FILES[$f4]['name']);
                if(!empty($_FILES[$f4]['tmp_name']) && file_exists($_FILES[$f4]['tmp_name'])) 
                {
			        $imaged =file_get_contents($imaged);
                    $imaged =base64_encode($imaged);
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optiondi`='".$imaged."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
            }
            $i=$i+1;
        }
        $stts=1;
        $conn=mysqli_connect("localhost","root","","quizzer");
        $sql="UPDATE `tests` SET `stts`='".$stts."' where `testid`='".$testid."'";
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        echo "<center><font color=\"green\"><h3>Questions uploaded Successfully</h3></font></center>";
    }
    else if(isset($_POST["sumit"]))
    {
        echo "<center><h1>Edit Questions</h1></center>";
        $question=$_POST["question"];
        $testid=$_POST["testid"];
        $stts=$_POST["stts"];
        $i=1;
            while($i<=$question)
            {
                $qno=$i;
                if(isset($_POST[$i]))
                {
                    $ques= $_POST[$i];
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `question`='".$ques."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
                $f="i".$i;
                if($_FILES[$f]!=false)
                {
                    $image =addslashes($_FILES[$f]['tmp_name']);
                    $name  =addslashes($_FILES[$f]['name']);
                    if(!empty($_FILES[$f]['tmp_name']) && file_exists($_FILES[$f]['tmp_name'])) 
                    {
                        $image =file_get_contents($image);
                        $image =base64_encode($image);
                        $conn=mysqli_connect("localhost","root","","quizzer");
                        $sql="UPDATE `questions` SET `questioni`='".$image."' where`testid`='".$testid."'and `qno`='".$qno."'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                    }
                }
                if(isset($_POST["optiona".$i]))
                {
                    $optiona=$_POST["optiona".$i];
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optiona`='".$optiona."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
                $f1="optionai".$i;
                if($_FILES[$f1]!=false)
                {
                    $imagea =addslashes($_FILES[$f1]['tmp_name']);
                    $namea  =addslashes($_FILES[$f1]['name']);
                    if(!empty($_FILES[$f1]['tmp_name']) && file_exists($_FILES[$f1]['tmp_name'])) 
                    {
                        $imagea =file_get_contents($imagea);
                        $imagea =base64_encode($imagea);
                        $conn=mysqli_connect("localhost","root","","quizzer");
                        $sql="UPDATE `questions` SET `optionai`='".$imagea."' where`testid`='".$testid."'and `qno`='".$qno."'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                    }   
                }
                if(isset($_POST["optionb".$i]))
                {
                    $optionb= $_POST["optionb".$i];
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optionb`='".$optionb."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
                $f2="optionbi".$i;
                if($_FILES[$f2]!=false)
                {
                    $imageb =addslashes($_FILES[$f2]['tmp_name']);
                    $nameb  =addslashes($_FILES[$f2]['name']);
                    if(!empty($_FILES[$f2]['tmp_name']) && file_exists($_FILES[$f2]['tmp_name'])) 
                    {
                        $imageb =file_get_contents($imageb);
                        $imageb =base64_encode($imageb);
                        $conn=mysqli_connect("localhost","root","","quizzer");
                        $sql="UPDATE `questions` SET `optionbi`='".$imageb."' where`testid`='".$testid."'and `qno`='".$qno."'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                    }
                }
                if(isset($_POST["optionc".$i]))
                {
                    $optionc= $_POST["optionc".$i];
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optionc`='".$optionc."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
                $f3="optionci".$i;
                if($_FILES[$f3]!=false)
                {
                    $imagec =addslashes($_FILES[$f3]['tmp_name']);
                    $namec  =addslashes($_FILES[$f3]['name']);
                    if(!empty($_FILES[$f3]['tmp_name']) && file_exists($_FILES[$f3]['tmp_name'])) 
                    {
                        $imagec =file_get_contents($imagec);
                        $imagec =base64_encode($imagec);
                        $conn=mysqli_connect("localhost","root","","quizzer");
                        $sql="UPDATE `questions` SET `optionci`='".$imagec."' where`testid`='".$testid."'and `qno`='".$qno."'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                    }
                }
                if(isset($_POST["optiond".$i]))
                {
                    $optiond= $_POST["optiond".$i];
                    $conn=mysqli_connect("localhost","root","","quizzer");
                    $sql="UPDATE `questions` SET `optiond`='".$optiond."' where`testid`='".$testid."'and `qno`='".$qno."'";
                    mysqli_query($conn,$sql);
                    mysqli_close($conn);
                }
                $f4="optiondi".$i;
                if($_FILES[$f4]!=false)
                {
                    $imaged =addslashes($_FILES[$f4]['tmp_name']);
			        $named  =addslashes($_FILES[$f4]['name']);
                    if(!empty($_FILES[$f4]['tmp_name']) && file_exists($_FILES[$f4]['tmp_name'])) 
                    {
			            $imaged =file_get_contents($imaged);
                        $imaged =base64_encode($imaged);
                        $conn=mysqli_connect("localhost","root","","quizzer");
                        $sql="UPDATE `questions` SET `optiondi`='".$imaged."' where`testid`='".$testid."'and `qno`='".$qno."'";
                        mysqli_query($conn,$sql);
                        mysqli_close($conn);
                    }
                }
                $i=$i+1;
            }
        echo "<center><font color=\"green\"><h3>Questions updated Successfully</h3></font></center>";
    }
    else
    {
        $question=$_GET["question"];
        $testid=$_GET["testid"];
        $stts=$_GET["stts"];
        $i=1;
        if($stts==0)
        {
            echo "<center><h1>Upload Questions</h1></center>";
            echo "<div style=\"padding-left:200px;\">";
            while($i<=$question)
            {
                echo "<fieldset style=\"width:80%;\">";
                echo "Question Number:".$i."<br>";
                echo "<input type=\"text\" name=\"qno".$i."\" style=\"display:none\" value=\"".$i."\"/>";
                echo "Question&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"".$i."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"i".$i."\" accept=\"image/*\"/><br>";
                echo "Option A&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optiona".$i."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optionai".$i."\" accept=\"image/*\"/><br>";
                echo "Option B&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optionb".$i."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optionbi".$i."\" accept=\"image/*\"/><br>";
                echo "Option C&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optionc".$i."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optionci".$i."\" accept=\"image/*\"/><br>";
                echo "Option D&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optiond".$i."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optiondi".$i."\" accept=\"image/*\"/><br>";
                echo "Answer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name=\"option".$i."\" class=\"select\">
                <option value=\"\">Select Option</option>
                <option value=\"a\">Option A</option>
                <option value=\"b\">Option B</option>
                <option value=\"c\">Option C</option>
                <option value=\"d\">Option D</option>
                </select><br>";
                echo "Score&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"score".$i."\"/><br>";
                echo "</fieldset><br>";
                $i=$i+1;
            }
            echo "<input type=\"text\" name=\"question\" style=\"display:none\" value=\"".$question."\">";
            echo "<input type=\"text\" name=\"testid\" style=\"display:none\" value=\"".$testid."\">";
            echo "<input type=\"text\" name=\"stts\" style=\"display:none\" value=\"".$stts."\">";
            echo "</div>";
            echo "<center><input type=\"submit\" value=\"Upload\" name=\"submit\" class=\"btn\" style=\"width:30%;\"/></center>";
        }
        else
        {
            $conn=mysqli_connect("localhost","root","","quizzer");
            $sql="SELECT * from `questions` where `testid`='$testid'";
            $result=mysqli_query($conn,$sql);
            echo "<center><h1>Edit Questions</h1></center>";
            echo "<div style=\"padding-left:200px;\">";
            $i=1;
            while($row=mysqli_fetch_assoc($result))
            {
                echo "<fieldset style=\"width:80%;\">";
                echo "Question Number:".$i."<br>";
                echo "<input type=\"text\" name=\"qno".$i."\" style=\"display:none\" value=\"".$i."\"/>";
                echo "Question&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"".$i."\" value=\"".$row["question"]."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"i".$i."\" accept=\"image/*\"/><br>";
                if($row["questioni"]!=NULL)
                {
                    echo "<img src=\"data:image;base64,".$row["questioni"]."\" width=500 height=500><br>";
                }
                echo "Option A&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optiona".$i."\" value=\"".$row["optiona"]."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optionai".$i."\" accept=\"image/*\"/><br>";
                if($row["optionai"]!=NULL)
                {
                    echo "<img src=\"data:image;base64,".$row["optionai"]."\" width=100 height=100><br>";
                }
                echo "Option B&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optionb".$i."\" value=\"".$row["optionb"]."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optionbi".$i."\" accept=\"image/*\"/><br>";
                if($row["optionbi"]!=NULL)
                {
                    echo "<img src=\"data:image;base64,".$row["optionbi"]."\" width=100 height=100><br>";
                }
                echo "Option C&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optionc".$i."\" value=\"".$row["optionc"]."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optionci".$i."\" accept=\"image/*\"/><br>";
                if($row["optionci"]!=NULL)
                {
                    echo "<img src=\"data:image;base64,".$row["optionci"]."\" width=100 height=100><br>";
                }
                echo "Option D&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"optiond".$i."\" value=\"".$row["optiond"]."\"/>";
                echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"file\" name=\"optiondi".$i."\" accept=\"image/*\"/><br>";
                if($row["optiondi"]!=NULL)
                {
                    echo "<img src=\"data:image;base64,".$row["optiondi"]."\" width=100 height=100><br>";
                }
                echo "Answer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name=\"option".$i."\" class=\"select\">
                <option value=\"".$row["answer"]."\">".$row["answer"]."</option>
                <option value=\"a\">Option A</option>
                <option value=\"b\">Option B</option>
                <option value=\"c\">Option C</option>
                <option value=\"d\">Option D</option>
                </select><br>";
                echo "Score&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"score".$i."\" value=\"".$row["score"]."\"/><br>";
                echo "</fieldset><br>";
                $i=$i+1;
            }
            echo "<input type=\"text\" name=\"question\" style=\"display:none\" value=\"".$question."\">";
            echo "<input type=\"text\" name=\"testid\" style=\"display:none\" value=\"".$testid."\">";
            echo "<input type=\"text\" name=\"stts\" style=\"display:none\" value=\"".$stts."\">";
            echo "</div>";
            echo "<center><input type=\"submit\" value=\"Change\" name=\"sumit\" class=\"btn\" style=\"width:30%;\"/></center>";
            mysqli_close($conn);
        }
    }
    ?>
    </form>
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