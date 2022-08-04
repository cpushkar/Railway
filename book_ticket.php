<?php
session_start();
require_once('config.php');
date_default_timezone_set("Asia/kolkata");
if(isset($_POST['search'])){

    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];
    $class = $_POST['class'];


    $stmt = $db->prepare("SELECT * FROM trains WHERE trainfrom=? AND trainto=? AND date=?");
    $stmt->execute([$from,$to,$date]); 
    $userdata = $stmt->fetch();

    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    $trainnumber = $userdata['trainnumber'];
    $pnr = rand(100000000,999999999);


    $_SESSION['trainnumber']=$trainnumber ;
    $_SESSION['pnr']=$pnr;

   




    
    
    

}

?>




<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="book_ticket.css">
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

    <div class="head">
        <a><?php echo "$from"; echo "  -  "; echo "$to";?></a>
    </div>
    <div class="train">
        <div class="top">
            <div class="left">
                <br>
                <a><?php echo "$userdata[trainnumber]"; echo "  -   "; ?></a>
                <a><?php echo "$userdata[trainname]";?></a>
            </div>
            <div class="mid">
                <img src="route.jpg" alt="">
            </div>
            <div class="right">
                <a><?php echo "$from"; echo " - ";?></a>
                <a><?php echo "$userdata[departure]";?></a><br><br>

                <a><?php echo "$to"; echo " - ";?></a>
                <a><?php echo "$userdata[reaches]"; ?></a>
            </div>
        </div>
        
        <div class="bottom">
            <div class="head1">
                <p>Available Seats : </p>
            </div>
            <div class="space">

            </div>
            <div class="box">
                <a><?php echo "General"; ?></a><br>
                <a class="num"><?php echo "$userdata[general]";?></a>

            </div>
            <div class="box">
                <a><?php echo "AC1"; ?></a><br>
                <a class="num"><?php echo "$userdata[AC1]";?></a>
                
            </div>
            <div class="box">
                <a><?php echo "AC2"; ?></a><br>
                <a class="num"><?php echo "$userdata[AC2]";?></a>
                
            </div>
            <div class="box">
                <a><?php echo "FC"; ?></a><br>
                <a class="num"><?php echo "$userdata[FC]";?></a>
                
            </div>
            <div class="box">
                <a><?php echo "SLP"; ?></a><br>
                <a class="num"><?php echo "$userdata[SLP]";?></a>
                
            </div>
            <div class="button">
                <input type="submit" value="Book Ticket" id="book" name="Book">
            </div>
        </div>
        
    </div>




    <div class="login-box" >
        <div class="contentbox">
            <div class="close">
                <a id="close">+</a>
            </div>
            <div class="traindetails">
                <div class="from">
                    <a><?php echo "$userdata[trainnumber]"; echo "  -   "; ?></a>

 
                    <a><?php echo "$userdata[trainname]";?></a>
                </div>
                <div class="mid">
                    <img src="route.jpg" alt="">
                </div>
                <div class="time">
                    <a><?php echo "$from"; echo " - ";?></a>
                    <a><?php echo "$userdata[departure]";?></a><br><br>

                    <a><?php echo "$to"; echo " - ";?></a>
                    <a><?php echo "$userdata[reaches]"; ?></a>
                </div>

            </div>
            
            <hr>
            <div class="formbox">
                <form action="Paytm_PHP_Sample-master/PaytmKit/pgRedirect.php" method="POST">
                <input type="hidden" name="ORDER_ID" value="<?php echo "ORDS" . rand(10000,99999999);?>">
                    <div class="personal">
                        <div class="inputbox">
                            <span>Passenger Name</span><br>
                            <input type="text" name="name" required>
                        </div>
                        
                        <div class="inputbox">
                            <span>Age</span><br>
                            <input type="text" name="age" required>
                        </div>

                    </div>
                    
                    

                    <div class="selectbox">
                        <span for="class">Class :</span>
                        <select name="class" id="class">
                            <option >Select</option>
                            <option value="AC First Class">AC First Class</option>
                            <option value="AC 2-Tier">AC 2-Tier</option>
                            <option value="AC 3-Tier">AC 3-Tier</option>
                            <option value="First Class">First Class</option>
                            <option value="Sleeper">Sleeper</option>
                        </select>
                    </div>


                    <?php
                        $number = $userdata['trainnumber'];
                        $stmt = $db->prepare("SELECT * FROM fare WHERE trainnumber=?");
                        $stmt->execute([$number]); 
                        $fare = $stmt->fetch();


                        
                    ?>


                    <div class="amt">
                        <input type="text"  name="TXN_AMOUNT">

                    </div>
                  
                    
                    
                    <div class="login">
                        <div class="inputbox">
                            <input type="submit" value="Book Ticket" name="login">
                        </div>
                    </div>

                    
                    
                    
                </form>
                <hr>
                
            </div>
            <div class="faretable">

                

                <table >
                        <thead>
                            <tr>
                                <th>AC1</th>
                                <th>AC2</th>
                                <th>AC3</th>
                                <th>First class</th>
                                <th>Sleeper</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo "$fare[General]"; ?></td>
                                <td><a><?php echo "$fare[AC1]"; ?></a></td>
                                <td><a><?php echo "$fare[AC2]"; ?></a></td>
                                <td><a><?php echo "$fare[FC]"; ?></a></td>
                                <td><a><?php echo "$fare[SLP]"; ?></a></td>
                            </tr>
                            
                        </tbody>


                </table>

            </div>
            

        </div>
    </div>


    <script>
        document.getElementById("book").addEventListener("click",function(){
            document.querySelector(".login-box").style.display = "flex";
            document.querySelector(".home").style.opacity = "0.9";
        })
        
        document.getElementById("close").addEventListener("click",function(){
            document.querySelector(".login-box").style.display = "none";
            document.querySelector(".home").style.opacity = "1";
        })
    </script>

    
</body>
</html>