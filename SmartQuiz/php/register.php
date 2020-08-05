<?php
$conn=mysqli_connect("localhost","root","","quizzer");
$name=strtoupper($_POST["name"]);
$email=strtolower($_POST["email"]);
$password=$_POST["password"];
$sqls="select * from `registration` where `email`='$email'";
$result=mysqli_query($conn,$sqls);
$count=mysqli_num_rows($result);
if($count==0)
{
    $sql="insert into `registration`(`name`,`email`,`password`) values('$name','$email','$password')";
    if(mysqli_query($conn,$sql))
    {
        echo "Registered Successfully.";
    }
    else{
        echo "Registration not Successful.";
    }
}
else{
    echo "Already registered with ".$email;
}
mysqli_close($conn);
?>