<?php
require_once('config.php');
date_default_timezone_set("Asia/kolkata");
if(isset($_POST['login'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $phonenumber = $_POST['phonenumber'];
    $state = $_POST['state'];

    $Address = $_POST['Address'];

    $password = $_POST['password'];

    $photo_name= $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $file_store = "image/".$photo_name;
    move_uploaded_file($photo_tmp,$file_store);
    
    

    $stmt = $db->prepare("SELECT * FROM user_data WHERE email=?");
    $stmt->execute([$email]); 
    $user = $stmt->fetch();
    if ($user) {
        include 'signup.html';
        ?>
            <script>
                alert("User With This Email Id Already Exists!!");
            </script>
        <?php 
        
    } else {

        $sql = "INSERT INTO user_data (fullname,email,phonenumber,state,address,photo,password) VALUES (?,?,?,?,?,?,?)";
        $stmt= $db->prepare($sql);
        $stmt->execute([$fullname,$email,$phonenumber,$state,$Address,$photo_name,$password]);

        $otp = rand(100000,999999);

        $to_email = $email;
        $subject = "OTP for Railway Reservation System";
        $body = "One Time Password for Registraion on Railway Reservation System is (otp is Valid Only for 15 minutes)  ".$otp ;
        $headers = "From: sender email";

        if (mail($to_email, $subject, $body, $headers)) {
            include 'otp.html';
           /// $date=date("Y-m-d H:i:s");
            $sql = "INSERT INTO otp (email,otp,is_expired,Timestamp) VALUES (?,?,0,'" . date("Y-m-d H:i:s") ."')";
            $stmt= $db->prepare($sql);
            $stmt->execute([$email,$otp]);


        } else {
            echo "Email sending failed...";
        }   
    } 
}


if(isset($_POST['verify'])){
    $otp = $_POST['otp'];
    $stmt = $db->prepare("SELECT * FROM otp WHERE otp=? AND is_expired !=1 AND NOW() <= DATE_ADD(timestamp,INTERVAL 15 MINUTE) ");
    $stmt->execute([$otp]); 
    $count=$stmt->rowCount();

    if (!empty($count)) {
        $stmt = $db->prepare("UPDATE otp SET is_expired =1 WHERE otp=? ");
        $stmt->execute([$otp]); 
        $user = $stmt->rowCount();
        include 'railway.html';
        ?>
            <script>
                alert("Registration Succesfull !!!");
            </script>
        <?php 

    }
    else{
        include 'otp.html';
        ?>
            <script>
                alert("Invalid OTP!!");
            </script>
        <?php 
    }



}

?>