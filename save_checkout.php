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
	$c_sql = "SELECT * FROM customer ORDER BY c_id DESC LIMIT 1";
	$c_query = mysqli_query($con,$c_sql);
	$c_result = mysqli_fetch_array($c_query,MYSQLI_ASSOC);
// เพิ่มข้อมูลลงใน identity
if (isset($_POST["password"])){

	//เข้ารหัส รหัสผ่าน
	$password = $_POST["password"];
	$salt = 'ecom4cluster';
	$has_password = hash_hmac('sha256', $password, $salt);
					
	$isql = "INSERT INTO identity (iden_id,username,password,type) 
	VALUE ('".$c_result["c_id"]."','".$c_result["c_email"]."','$has_password','".$c_result["u_type"]."')";
	$iquery = mysqli_query($con,$isql);
	if(!$iquery)
	{
	echo $con->error;
	exit();
	}
}else{

}



  $Total = 0;
  $SumTotal = 0;
	
	// เพิ่มข้อมูลลงใน orders
  $strSQL = "INSERT INTO orders (date_time,c_id,total_price,shipping_cost)
	VALUE ('".date("Y-m-d H:i:s")."','".$c_result["c_id"]."','".$_SESSION["lasttotal"]."','".$_SESSION["e_price"]."')";
  $objQuery = mysqli_query($con,$strSQL);
  if(!$objQuery)
  {
	echo $con->error;
	echo "เพิ่มข้อมูลลงใน order";
	exit();
  }

  $strOrderID = mysqli_insert_id($con);
echo $strOrderID;
  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strp_id"][$i] != "")
	  {		// เพิ่มข้อมูลลงใน orders_list
			  $orsql = "INSERT INTO orders_list (o_id,p_id,Qty)
				VALUES ('".$strOrderID."','".$_SESSION["strp_id"][$i]."','".$_SESSION["strQty"][$i]."')";
				mysqli_query($con,$orsql);
				if(!mysqli_query($con,$orsql))
				{
				echo $con->error;
				echo "เพิ่มข้อมูลลงใน orders_list";
				exit();
				}
				
				// ตัดสต๊อก
				$cal = 0;
				$num = 0;
				$psql = "SELECT * FROM product WHERE p_id = '".$_SESSION["strp_id"][$i]."' ";
				$pquery = mysqli_query($con, $psql);
				$presult = mysqli_fetch_assoc($pquery);
				$cal = $presult['p_count'] - $_SESSION["strQty"][$i];
				$num = $presult['buy'] + $_SESSION["strQty"][$i];
				if($cal >= '0'){
						$p_sql = "UPDATE product SET 
						p_count = $cal 
						buy = $num WHERE p_id = '".$_SESSION["strp_id"][$i]."'";
						$p_query = mysqli_query($con,$p_sql);
						if(!$p_query)
						{
								echo "Error Save [".$p_sql."]";
						}
						
				}else{
						$p_sql = "UPDATE product SET 
						p_count = 0, buy = $num WHERE p_id = '".$_SESSION["strp_id"][$i]."'";
						$p_query = mysqli_query($con,$p_sql);
						if(!$p_query)
						{
								echo "Error Save [".$p_sql."]";
						}
				}
	  }
  }

mysqli_close($con);

session_destroy();
echo "<script>";
echo "alert(\"สั่งซื้อเรียบร้อยแล้ว\");";
echo "</script>";
// header("location:view_order.php?OrderID=".$strOrderID);
?>