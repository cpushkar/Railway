<?php
        session_start();
        include_once("config.php");
        $username=$_SESSION["username"];
        if(isset($_POST['button1'])) {

            $pnr = $_POST['pnr'];
            $trainnumber = $_POST['trainnumber'];
            $sql = "DELETE from bookings where email=? AND pnr=? AND trainnumber= ? ";
            $stmt = $db->prepare($sql);
            $stmt->execute([$username,$pnr,$trainnumber]);


            $message = "Your Ticket For PNR Number ".$pnr. " is cancelled.";
            $sql = "INSERT INTO notifications (email,datetime,message,status) VALUES (?,'" . date("Y-m-d H:i:s") ."',?,0)";
            $stmt= $db->prepare($sql);
            $stmt->execute([$username,$message]);

            if($stmt){
                
                ?>
                    <script>
                        alert("Ticket Cancelled Succesfully !!!");
                    </script>
                <?php 
            }
            else{
                ?>
                    <script>
                        alert("Entered Details Are unavailable !!!");
                    </script>
                <?php
            }
        }
        
?>









<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="cancel_ticket.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sidebar">
        <header>
        <div class="details">
            <?php
                error_reporting(0);
                session_start();
                include_once("config.php");
                $username=$_SESSION["username"];

                $stmt = $db->prepare("SELECT * FROM user_data WHERE email=?");
                $stmt->execute([$username]); 
                $user = $stmt->fetch();

                $image = "<img src='image/".$user["photo"]."'>";
                echo "$image"; 
            ?>
            <h3><?php echo '<span >' . $user['fullname'] . '</span>';?></h3>

            
        </div>
        <a href="main.php"><i class="fas fa-home"></i>  Home</a>
        </header>
        

        <ul>
            <li><a href="search_train.php"><i class="fas fa-search"></i>Search Train</a></li>
            <li><a href="booking_status.php"><i class="far fa-clipboard"></i>Booking Status</a></li>
            <li><a href="cancel_ticket.php"><i class="fas fa-ticket-alt"></i>Cancel Ticket</a></li>
            <li><a href="notifications.php"><i class ="fas fa-bell"></i>Notifications    <?php 
                                                    
                                                    session_start();
                                                    include_once("config.php");
                                                    $username=$_SESSION["username"];
                                                    
                                                    $stmt = $db->prepare("SELECT * FROM notifications WHERE email=? AND status=0");
                                                    $stmt->execute([$username]); 
                                                    $user = $stmt->rowCount();
                                                    
                                                    echo "(";
                                                    echo "$user";
                                                    echo ")";?></i></a></li>
            <li><a href="railway.html"><i class ="fas fa-sign-out-alt"></i>Log Out</a></li>
        </ul>
    </div>


    <div class="cancel-box">
        <h3>Cancel Ticket<h3>
        <form method="post">
            <div class="inputbox">
                <span>Enter PNR Number : </span><br>
                <input type="text" name="pnr" required>
            </div>
            <div class="inputbox">
                <span>Enter Train Number : </span><br>
                <input type="text" name="trainnumber" required>
            </div>
            
            <input type="checkbox" required><p>I have read cancellation/boarding point change procedure and its rule. <a href="#" style="color:dodgerblue">click here for Cancellation policy</a>.</p><br><br>

            <div class="inputbox">
                <input type="submit" value="Cancel Ticket" name="button1">                
            </div>
        </form>
    </div>
    
</body>
</html>


