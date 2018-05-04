<?php
ob_start();
session_start();
	
if(!isset($_SESSION["intLine"]))
{
	 $_SESSION["intLine"] = 0;
	 $_SESSION["strp_id"][0] = $_GET["p_id"];
	 $_SESSION["strQty"][0] = 1;
	echo "<script>";
	echo "alert(\"สินค้าอยู่ในตะกร้าแล้ว\");";
	echo "window.history.back()"; //กลับไปหน้าที่แล้ว
	echo "</script>";
}
else
{
	
	$key = array_search($_GET["p_id"], $_SESSION["strp_id"]);
	if((string)$key != "")
	{
		 $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + 1;
	}
	else
	{
		
		 $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
		 $intNewLine = $_SESSION["intLine"];
		 $_SESSION["strp_id"][$intNewLine] = $_GET["p_id"];
		 $_SESSION["strQty"][$intNewLine] = 1;
	}
	echo "<script>";
	echo "alert(\"เพิ่มสินค้าลงในตะกร้าแล้ว\");";
	echo "window.history.back()"; //กลับไปหน้าที่แล้ว
	echo "</script>";
}
?>

<?php /* This code download from www.ThaiCreate.Com */ ?>