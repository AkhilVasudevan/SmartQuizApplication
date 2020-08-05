<?php
session_start();
$user=$_SESSION["user"];
$testid=$_POST["testid"];
$conn=mysqli_connect("localhost","root","","quizzer");
$sql="select * from `tests` where `testid`='".$testid."' and `user`='".$user."'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    echo "You cannot write test on test id ";
    echo $testid;
    mysqli_close($conn);
}
else{
    mysqli_close($conn);
    $conn=mysqli_connect("localhost","root","","quizzer");
    $sql="select * from `tests` where `testid`='".$testid."'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    if($row["status"]==1)
    {
        $con=mysqli_connect("localhost","root","","quizzer");
        $sq="select * from `status` where `userid`='".$user."' and `testid`='".$testid."'";
        $res=mysqli_query($con,$sq);
        $count=mysqli_num_rows($res);
        if($count==0)
        {
            $s="insert into `status`(`userid`,`testid`) values('".$user."','".$testid."')";
            mysqli_query($con,$s);
            echo "true";
        }
        else{
            echo "You had already taken this test.";
        }
        mysqli_close($con);
    }
    else
    {
        echo "Test is disabled.";
    }
    mysqli_close($conn);
}
?>