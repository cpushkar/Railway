<?php
require_once('config.php');

if(isset($_POST['Send'])){
        $email = $_POST['email'];
        $phonenumber = $_POST['number'];
        $message = $_POST['message'];

        $sql = "INSERT INTO contact (email,number,message) VALUES (?,?,?)";
        $stmt= $db->prepare($sql);
        $result = $stmt->execute([$email,$phonenumber,$message]);
        if($result){
            include 'railway.html';
            ?>
                <script>
                    alert("Message sent successfully!!");
                </script>
            <?php 
        } 
          
}

?>
