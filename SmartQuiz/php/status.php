<?php
$testid=$_POST["testid"];
$conn=mysqli_connect("localhost","root","","quizzer");
$sql="select * from `tests` where `testid`='".$testid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$st=$row["status"];
mysqli_close($conn);
$conn=mysqli_connect("localhost","root","","quizzer");
if($st==1)
{
    $st=0;
    echo "Test Id ".$testid." is Disabled";
}
else{
    $st=1;
    echo "Test Id ".$testid." is Enabled";
}
$sql="UPDATE `tests` set `status`='".$st."' where `testid`='".$testid."'";
mysqli_query($conn,$sql);
mysqli_close($conn);
?>