<?php
session_start();
require 'connect.php';

$password = mysqli_real_escape_string($con,$_POST["password"]);

//เข้ารหัส รหัสผ่าน
$salt = 'ecom4cluster';
$has_password = hash_hmac('sha256', $password, $salt);
$idensql = "SELECT * FROM identity WHERE iden_id = '".$_SESSION['c_id']."'";
$idenquery = mysqli_query($con, $idensql);
$idenresult = mysqli_fetch_array($idenquery, MYSQLI_ASSOC);
if($idenresult["password"] != $has_password){
    echo "<script type='text/javascript'>";
    echo "alert('รหัสผ่านผิด โปรดกรอกใหม่อีกครั้ง');";
    echo "window.history.back()";
    echo "</script>";
}else{
    $csql = "UPDATE customer SET 
    c_name = '".$_POST["name"]."',
    c_address = '".$_POST["address"]."',
    c_district = '".$_POST["name"]."',
    c_amphur = '".$_POST["amphur"]."',
    c_province = '".$_POST["province"]."',
    c_zip_code = '".$_POST["zip-code"]."',
    c_phone = '".$_POST["tel"]."' 
    WHERE c_id = '".$_SESSION['c_id']."'";
    mysqli_query($con, $csql);
    echo "<script type='text/javascript'>";
    echo "alert('อัพเดทข้อมูลเรียบร้อยแล้ว');";
    echo "</script>";
    echo "<meta http-equiv='refresh' content='0;URL=profile.php' />";
}
?>