<?php
    session_start();
    $uid=$_SESSION["user"];
    $id=$_POST["testid"];
    $conn=mysqli_connect("localhost","root","","quizzer");
    $sqlQuery = "select questions,correct,wrong,notattended from results where testid='".$id."' and userid='".$uid."'";
    $result = mysqli_query($conn,$sqlQuery);
    $row=mysqli_fetch_assoc($result);
    $correct=$row["correct"]/$row["questions"];
    $wrong=$row["wrong"]/$row["questions"];
    $notattended=$row["notattended"]/$row["questions"];
    $dataPoints = array(
        array("label"=>"correct","y"=>$correct),
        array("label"=>"wrong","y"=>$wrong),
        array("label"=>"not attended","y"=>$notattended)
    );
    echo json_encode($dataPoints, JSON_NUMERIC_CHECK);
    mysqli_close($conn);
 ?>