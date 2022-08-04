<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Railway | Ticket</title>
    <link rel="stylesheet" href="ticket.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="receipt">
        <div class="top">
            <div class="right">
                
                <h3>Train Ticket</h3>
            </div>
        </div>


        <?php
            session_start();
            include_once("config.php");
            $username=$_SESSION["username"];
            $stmt = $db->prepare("SELECT * FROM bookings WHERE email=?");
            $stmt->execute([$username]); 
            $user = $stmt->fetchAll();

            $pnr=$user[0]['pnr'];
            $trainnumber=$user[0]['trainnumber'];
            $name=$user[0]['name'];
            $age=$user[0]['age'];
            $class=$user[0]['class'];
            $seat=$user[0]['seat_no'];
            $fare=$user[0]['fare'];

            $stmt = $db->prepare("SELECT * FROM trains WHERE trainnumber=?");
            $stmt->execute([$trainnumber]); 
            $data = $stmt->fetch();

            $date= $data['date'];
            $trainname = $data['trainname'];

            $trainfrom= $data['trainfrom'];
            $trainto = $data['trainto'];

            $departure = $data['departure'];
            $reaches = $data['reaches'];
        ?>


        <div class="main">
            <div class="left">
                <table class="receipt_table">
                    <tbody>
                        <tr>
                            <td>Train from</td>
                            <td class="data"><?php echo "$trainfrom"?></td>
                        </tr>
                        <tr>
                            <td>Train to</td>
                            <td class="data" ><?php echo "$trainto"?></td>
                        </tr>




                        <tr>
                            <td>Name</td>
                            <td><?php echo "$name"?></td>
                        </tr>

                        <tr>
                            <td>Age</td>
                            <td class="data"><?php echo "$age"?></td>
                        </tr>
                        
                        
                        <tr>
                            <td>Class</td>
                            <td class="data"><?php echo "$class"?></td>
                        </tr>
                        
                        
                        
                    </tbody>
                </table>

            </div>

            <div class="right">
                <table class="receipt_table">

                    
                    <tr>
                        <td>Date & Time :</td>
                        <td><?php echo "$date"; echo " "; echo "$departure"; echo "$reaches";?></td>
                    </tr>
                    <tr>
                        <td>PNR number</td>
                        <td><?php echo "$pnr"?></td>
                    </tr>
                    <tr>
                        <td>Train Number</td>
                        <td><?php echo "$trainnumber"?></td>
                    </tr>

                    <tr>
                        <td>Seat No.</td>
                        <td><?php echo "$seat"?></td>
                    </tr>


                </table>
                    
                    
                    
                    

            </div>
            <div class="barcode">
                
            </div>
        </div>

        <div class="bottom">
            <p>*Please be at boarding gate well ahead of departure time.</p>

        </div>
        
    </div>
</body>
</html>