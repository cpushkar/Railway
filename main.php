<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="main.css">
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
    <div class="content">
        <div class="head">
            <h1>Welcome to Railway Reservation System</h1>
        </div>
        <div class="text">
        <p>WELCOME TO YOUR ACCOUNT....... </p>

        </div>
        
        <img src="main1.png" alt="">
    </div>
</body>
</html>
