<?php
session_start();
?>
<html>
<head>
<title>ThaiCreate.Com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php

if(!isset($_SESSION["intLine"]))
{
	echo "<script>";
	echo "alert(\"ไม่มีสินค้าอยู่ในตะกร้า กรุณาเพิ่มสินค้าลงในตะกร้าก่อนชำระเงิน\");";
	echo "window.history.back()"; //กลับไปหน้าที่แล้ว
	echo "</script>";
	exit();
}

require 'connect.php';

?>
<table width="400"  border="1">
  <tr>
    <td width="101">ProductID</td>
    <td width="82">ProductName</td>
    <td width="82">Price</td>
    <td width="79">Qty</td>
    <td width="79">Total</td>
    <td width="10">Del</td>
  </tr>
  <?php
  $Total = 0;
  $SumTotal = 0;

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strp_id"][$i] != "")
	  {
		$strSQL = "SELECT * FROM product WHERE p_id = '".$_SESSION["strp_id"][$i]."' ";
		$objQuery = mysqli_query($con,$strSQL);
		$objResult = $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
		$Total = $_SESSION["strQty"][$i] * $objResult["p_price"];
		$SumTotal = $SumTotal + $Total;
	  ?>
	  <tr>
		<td><?=$_SESSION["strp_id"][$i];?></td>
		<td><?=$objResult["p_name"];?></td>
		<td><?=$objResult["p_price"];?></td>
		<td><?=$_SESSION["strQty"][$i];?></td>
		<td><?=number_format($Total,2);?></td>
		<td><a href="delete.php?Line=<?=$i;?>">x</a></td>
	  </tr>
	  <?php
	  }
  }
  ?>
</table>
Sum Total <?php echo number_format($SumTotal,2);?>
<br><br><a href="allproduct.php">Go to Product</a>
<?php
	if($SumTotal > 0)
	{
?>
	| <a href="checkout.php">CheckOut</a>
<?php
	}
?>
<?php
mysqli_close($con);
?>
</body>
</html>

<?php /* This code download from www.ThaiCreate.Com */ ?>