<?php
session_start();
$user=$_SESSION["user"];
$title=$_POST["title"];
$ques=$_POST["no"];
$time=$_POST["time"];
$maxmark=$_POST["mark"];
$neg=$_POST["neg"];
$conn=mysqli_connect("localhost","root","","quizzer");
$sql="insert into `tests`(`user`,`title`,`questions`,`time`,`max`,`negative`) values('$user','$title','$ques','$time','$maxmark','$neg')";
if(mysqli_query($conn,$sql))
{
    echo "true";
}
else{
    echo "ns";
}
mysqli_close($conn);
?>