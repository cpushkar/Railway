<?php
include_once("config.php");
if(isset($_POST['login'])){
    session_start();
    $name = $_POST['name'];
    $age = $_POST['age'];

    $class = $_POST['class'];
    $TXN_AMOUNT = $_POST['TXN_AMOUNT'];

$username=$_SESSION["username"];

$pnr=$_SESSION["pnr"];
$trainnumber=$_SESSION["trainnumber"];
$sql = "INSERT INTO bookings (email,pnr,trainnumber,name,age,class,fare) VALUES (?,?,?,?,?,?,?)";
$stmt= $db->prepare($sql);
$stmt->execute([$username,$pnr,$trainnumber,$name,$age,$class,$TXN_AMOUNT]);

$message = "Your Train Ticket booking is successfull !!!";
$sql = "INSERT INTO notifications (email,datetime,message,status) VALUES (?,'" . date("Y-m-d H:i:s") ."',?,0)";
$stmt= $db->prepare($sql);
$stmt->execute([$username,$message]);
if ($stmt==1){
    include 'success.php';
}
}
?>



<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Success</title>
    <link rel="stylesheet" href="success.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">

        <div class="pass">
            <form action="main.php" >
                <img src="sucess.jpeg">
                <h3>You Have Successfully Booked your ticket.</h3>
                <p>To Download Your E-Ticket <a href="http://localhost/railway/booking_status.php" style="color:dodgerblue">click here </a>.</p>
                <p>cancellation/boarding point change procedure and its rule <a href="#" style="color:dodgerblue">click here for Cancellation policy</a>.</p>
                <div class="verify">
                    <button type="submit" class="verifybtn">Back</button>
                </div> 
            </form>
        </div>
    </div>
    
</body>
</html>