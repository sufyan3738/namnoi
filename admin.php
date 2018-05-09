<?php
session_start();
?>
<?php

echo "ยินดีต้อนรับคุณ". $_SESSION["type"];
// Check Login
if($_SESSION["type"] == ''){
  echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
} else if($_SESSION['type'] != "A"){
  echo "<meta http-equiv='refresh' content='0;URL=logout.php' />";
} else
{
?>

<h1>Admin Page</h1>
<a href="logout.php" class="btn btn-primary">logout</a>
<?php
}
 ?>



<a href="addshop.php">เพิ่มร้านค้า</a>
<a href="checkorder.php">ยืนยันการโอนเงิน</a>
<a href="deleteshop.php">ลบร้านค้า</a>
<a href="deletefolk.php">ลบชาวบ้าน</a>