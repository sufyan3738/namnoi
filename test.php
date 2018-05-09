<?php

$Keyword = null;

if (isset($_POST["Keyword"])) {
  $Keyword = $_POST["Keyword"];
}
?>
  	<!-- SEARCH BAR -->
	  <div class="col-md-3">
		<div class="header-search">
			<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
				<input class="input" value="<?php echo $Keyword; ?>" placeholder="กรอกรหัสคำสั่งซื้อ">
				<button class="search-btn">Search</button>
			</form>
		</div>
	</div>
	<!-- /SEARCH BAR -->

<?php
  require 'connect.php';

  $o_sql = "SELECT * FROM orders WHERE o_id LIKE '%".$Keyword."%' ";
  $o_query = mysqli_query($con,$o_sql);
?>

<table width="600" border="1">
  <tr>
    <th width="100"><div align="center">รูปภาพ</div></th>
    <th width="100"><div align="center">ชื่อสินค้า</div></th>
    <th width="100"><div align="center">ประเภทสินค้า</div></th>
    <th width="100"><div align="center">แก้ไข</div></th>  
  </tr>
<?php
  while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
  {
?>
  <tr>
    <td><img src="img/<?php echo $result["p_pictures"];?>"></td>
    <td><?php echo $result["p_name"];?></td>
    <td><?php echo $result["t_id"];?></td>
    <td align="center"><a href="edit.php?p_id=<?php echo $result["p_id"];?>">แก้ไข</a></td>
  </tr>
<?php
  }
?>
</table>