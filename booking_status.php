<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="booking.css">
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
    <div class="main">
        <h3>My Bookings</h3>
        <table class="details_table">
            
            <thead>
                <tr>
                    <th>PNR</th>
                    <th>Train Details</th>
                    <th>Date $ Time</th>
                    <th>User Details</th>
                    <th>Ticket</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php
                        session_start();
                        include_once("config.php");
                        $username=$_SESSION["username"];
                        $stmt = $db->prepare("SELECT * FROM bookings WHERE email=?");
                        $stmt->execute([$username]); 
                        $user = $stmt->fetchAll();

                        $count = 0;

                        while($count < Sizeof($user))
                        {
                            $pnr=$user[$count]['pnr'];
                            $name=$user[$count]['name'];
                            $age=$user[$count]['age'];

                            $number=$user[$count]['trainnumber'];

                            $stmt = $db->prepare("SELECT * FROM trains WHERE trainnumber=?");
                            $stmt->execute([$number]); 
                            $train = $stmt->fetchAll();

                            $trainname = $train[0]['trainname'];
                            $date = $train[0]['date'];

                            $result1 = $number . ' ' . $trainname ;
                            $result2 = $name . ' ' . $age;
                            

                        echo 
                            '<tr>
                                <td>'.$pnr.'</td>
                                <td>'.$result1. '</td>
                                <td>'.$date. '</td>
                                <td>'.$result2. '</td>
                                <td><a href="ticket.php"><i class="fas fa-download"></i></a></td>
                            </tr>';

                        $count++;   
                        }
                    ?>
                    	
                    
                </tr>

            </tbody>


        </table>
    </div>
    
</body>
</html>



