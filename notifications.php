<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="notifications.css">
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

    <section id="notification_section">
        <h1>Notifications</h1>
        <table class="notification-table">
            <thead>
                <tr>
                    <th>Date & Time</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        session_start();
                        include_once("config.php");
                        $username=$_SESSION["username"];
                        $stmt = $db->prepare("SELECT * FROM notifications WHERE email=?");
                        $stmt->execute([$username]); 
                        $user = $stmt->fetchAll();

                        $count = 0;

                        while($count < Sizeof($user))
                        {
                            $mark ="";
                            $Date=$user[$count]['datetime'];
                            $message=$user[$count]['message'];
                            $status=$user[$count]['status'];
                           

                            if($status === '0'){
                                        
                                $mark= '<a><i class="fas fa-check"></i></a>';
                               
                        
                            }
                            else{
                                $mark='<a><i class="fas fa-check-double"></i></a>';   
                            }

                        echo 
                            '<tr>
                                <td>'.$Date.'</td>
                                <td>'.$message.'</td>
                                <td>
                                    '.$mark.'
                                </td>
            
                            </tr>';

                        $count++;   
                        }
                    ?>
                    	
                    
                </tr>

            </tbody>
        </table>
        <div class="markread">
            <form action="markread.php" method="post">
                <input type="submit" name="read" value="Mark All As Read">

            </form>
            
        </div>
    </section>
    
</body>
</html>

