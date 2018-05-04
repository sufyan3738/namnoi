<?php
	ob_start();
	session_start();
	
	if(isset($_GET["Line"]))
	{
		$Line = $_GET["Line"];
		$_SESSION["strp_id"][$Line] = "";
		$_SESSION["strQty"][$Line] = "";
	}
	echo "<script>";
	echo "alert(\"ลบสินค้าแล้ว\");";
	echo "window.history.back()"; //กลับไปหน้าเดิม
	echo "</script>";
?>