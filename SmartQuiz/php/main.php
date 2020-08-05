<?php
session_start();
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
}
?>