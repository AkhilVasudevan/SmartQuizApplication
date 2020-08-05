<?php
session_start();
$testid=$_POST["testid"];
echo $testid;
if(!isset($_SESSION["user"]))
{
    echo "ns";
}
else{
    $user=$_SESSION["user"];
    $conn=mysqli_connect("localhost","root","","quizzer");
    $sql="select * from `registration` where `email`='$user'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo strtoupper($row["name"]);
    mysqli_close($conn);
    $conn=mysqli_connect("localhost","root","","quizzer");
    $sql="select * from `status` where `testid`=='".$testid."' and `userid`='".$user."'";
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    if($row["status"]!=0)
    {
        echo "ns";
    }
    else
    {
        $st=1;
        $sql="update `status` set `status`='".$st."' where `testid`=='".$testid."' and `userid`='".$user."'";
        mysqli_query($conn,$sql);
    }
    mysqli_close($conn);
}
?>