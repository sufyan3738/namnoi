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
	  </tr>
	  <?php
	  }
  }
  ?>
</table>
ราคาสินค้ารวม <?php echo number_format($SumTotal,2);?>
<br><br>
วิธีการจัดส่ง
        <!-- ค่าจัดส่ง -->
        <select class="form-control" id="type" name="type">
        <?php
        $sql = "SELECT * FROM environment ORDER BY e_id LIMIT 2";
        $query = mysqli_query($con, $sql);
        while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        ?>
            <option value="<?php echo $result["e_price"]; ?>">ส่งแบบ <?php echo $result["e_name"]; ?> ราคา <?php echo $result["e_price"]; ?> บาท</option>
        <?php
        }
        ?>
        </select>
        <!-- /ค่าจัดส่ง -->

<form name="form1" method="post" action="save_checkout.php">
  <table width="304" border="1">
    <tr>
      <td width="71">Name</td>
      <td width="217"><input type="text" name="txtName"></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><textarea name="txtAddress"></textarea></td>
    </tr>
    <tr>
      <td>Tel</td>
      <td><input type="text" name="txtTel"></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input type="text" name="txtEmail"></td>
    </tr>
  </table>
    <input type="submit" name="Submit" value="Submit">
</form>
<?php
mysqli_close($con);
?>
</body>
</html>

<?php /* This code download from www.ThaiCreate.Com */ ?>