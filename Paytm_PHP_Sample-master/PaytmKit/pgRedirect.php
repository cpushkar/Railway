<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
require_once("./lib/config.php");

$checkSum = "";
$paramList = array();

$ORDER_ID = $_POST["ORDER_ID"];
$CUST_ID = "CUST_1001";
$INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
$CHANNEL_ID = $_POST["CHANNEL_ID"];
$TXN_AMOUNT = $_POST["TXN_AMOUNT"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
$paramList["CALLBACK_URL"] = "http://localhost/railway/success.php";



if(isset($_POST['login'])){
    session_start();
    $name = $_POST['name'];
    $age = $_POST['age'];

	$class = $_POST['class'];

    $_SESSION['name']=$name;
    $_SESSION['age']=$age;    
}

session_start();

$username=$_SESSION["username"];

$pnr=$_SESSION["pnr"];
$trainnumber=$_SESSION["trainnumber"];
$name=$_SESSION["name"];
$age=$_SESSION["age"];
print_r($_SESSION);
$sql = "INSERT INTO bookings (email,pnr,trainnumber,name,age,class,fare) VALUES (?,?,?,?,?,?,?)";
$stmt= $db->prepare($sql);
$stmt->execute([$username,$pnr,$trainnumber,$name,$age,$class,$TXN_AMOUNT]);

$message = "Your Train Ticket booking is successfull !!!";
$sql = "INSERT INTO notifications (email,datetime,message,status) VALUES (?,'" . date("Y-m-d H:i:s") ."',?,0)";
$stmt= $db->prepare($sql);
$stmt->execute([$username,$message]);
		

		


/*
$paramList["CALLBACK_URL"] = "http://localhost/PaytmKit/pgResponse.php";
$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
$paramList["EMAIL"] = $EMAIL; //Email ID of customer
$paramList["VERIFIED_BY"] = "EMAIL"; //
$paramList["IS_USER_VERIFIED"] = "YES"; //

*/

//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>