<?php
session_start();

require 'connect.php';

// เพิ่มข้อมูลลงใน customer
$csql = "INSERT INTO customer (c_name,c_email,c_address,c_district,c_amphur,c_province,c_zip_code,c_phone)
VALUE ('".$_POST["name"]."','".$_POST["email"]."','".$_POST["address"]."','".$_POST["district"]."','".$_POST["amphur"]."','".$_POST["province"]."','".$_POST["zip-code"]."','".$_POST["tel"]."')";
$cquery = mysqli_query($con,$csql);
if(!$cquery)
{
echo $con->error;
exit();
}

// เพิ่มข้อมูลลงใน identity
if (!isset($_POST["password"])){
}else{
	$cresult = mysqli_fetch_array($cquery,MYSQLI_ASSOC);
		//เข้ารหัส รหัสผ่าน
		$password = $_POST['password'];
    $salt = 'ecom4cluster';
    $has_password = hash_hmac('sha256', $password, $salt);
						
		$isql = "INSERT INTO identity (iden_id,username,password,type) 
		VALUE ('".$cquery["c_id"]."','".$cquery["email"]."','$has_password','".$cquery["u_type"]."')";
}



  $Total = 0;
  $SumTotal = 0;
	$LastTotal = 0;

  $strSQL = "
	INSERT INTO order (c_id,date_time,total_price,)
	VALUES
	('".$_SESSION['c_id']."','".date("Y-m-d H:i:s")."','".$_POST["txtName"]."') 
  ";
  $objQuery = mysqli_query($con,$strSQL);
  if(!$objQuery)
  {
	echo $objCon->error;
	exit();
  }

  $strOrderID = mysqli_insert_id($objCon);

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
			  $strSQL = "
				INSERT INTO orders_detail (OrderID,ProductID,Qty)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."') 
			  ";
			  mysqli_query($objCon,$strSQL);
	  }
  }

mysqli_close($objCon);

session_destroy();

header("location:finish_order.php?OrderID=".$strOrderID);
?>

<?php /* This code download from www.ThaiCreate.Com */ ?>