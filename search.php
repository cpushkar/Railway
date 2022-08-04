<?php

require_once('config.php');
date_default_timezone_set("Asia/kolkata");
if(isset($_POST['search'])){

    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];
    $class = $_POST['class'];


    $stmt = $db->prepare("SELECT * FROM trains WHERE trainfrom=? AND trainto=? AND date=?");
    $stmt->execute([$from,$to,$date]); 
    $user = $stmt->fetch();

    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search trains | Railway</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <div class="header">
        <a><?php echo "$from"; echo "  -  "; echo "$to";?></a>
    </div>
    <div class="details">
        <div class="top">
            <div class="left">
                <br>
                <a><?php echo "$user[trainnumber]"; echo "  -   "; ?></a>
                <a><?php echo "$user[trainname]";?></a>
            </div>
            <div class="mid">
                <img src="route.jpg" alt="">
            </div>
            <div class="right">
                <a><?php echo "$from"; echo " - ";?></a>
                <a><?php echo "$user[departure]";?></a><br><br>

                <a><?php echo "$to"; echo " - ";?></a>
                <a><?php echo "$user[reaches]"; ?></a>
            </div>
        </div>
        
        <div class="bottom">
            <div class="head">
                <p>Available Seats : </p>
            </div>
            <div class="space">

            </div>
            <div class="box">
                <a><?php echo "General"; ?></a><br>
                <a class="num"><?php echo "$user[general]";?></a>

            </div>
            <div class="box">
                <a><?php echo "AC1"; ?></a><br>
                <a class="num"><?php echo "$user[AC1]";?></a>
                
            </div>
            <div class="box">
                <a><?php echo "AC2"; ?></a><br>
                <a class="num"><?php echo "$user[AC2]";?></a>
                
            </div>
            <div class="box">
                <a><?php echo "FC"; ?></a><br>
                <a class="num"><?php echo "$user[FC]";?></a>
                
            </div>
            <div class="box">
                <a><?php echo "SLP"; ?></a><br>
                <a class="num"><?php echo "$user[SLP]";?></a>
                
            </div>
        </div>
        <div class="note">
            <p>*Note : Register and Login To book Your train Ticket</p>
                
        </div>
    </div>
</body>
</html>

