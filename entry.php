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