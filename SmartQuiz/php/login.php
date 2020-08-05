<?php
session_start();
$conn = mysqli_connect("localhost","root","","quizzer");
$email=strtolower($_POST["email"]);
$password=$_POST["password"];
$sql="select * from `registration` where `email`='$email' and `password`='$password'";
$result=mysqli_query($conn,$sql);
$count=mysqli_num_rows($result);
if($count==1){
    $_SESSION["user"]=$email;
    echo "true";
}
else{
    echo "Invalid Credentials.";
}
mysqli_close($conn);
?>