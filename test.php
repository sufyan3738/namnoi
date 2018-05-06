<?php
require 'connect.php';

$c_sql = "SELECT * FROM customer ORDER BY c_id DESC LIMIT 1";
$c_query = mysqli_query($con,$c_sql);
$c_result = mysqli_fetch_array($c_query,MYSQLI_ASSOC);
echo $c_result['c_id'];


// session_start();
// require 'connect.php';

// $_SESSION["strQty"] = 4;
// $_SESSION["strp_id"] = 6;
// $cal = 0;
// $psql = "SELECT * FROM product WHERE p_id = '".$_SESSION["strp_id"]."' ";
// $pquery = mysqli_query($con, $psql);

// $presult = mysqli_fetch_assoc($pquery);
// $cal = $presult['p_count'] - $_SESSION["strQty"];

// if($cal >= '0'){
//     $p_sql = "UPDATE product SET 
//     p_count = $cal WHERE p_id = '".$_SESSION["strp_id"]."'";
//     $p_query = mysqli_query($con,$p_sql);
//     if($p_query)
//     {
//         echo "Save Done.";
//     }
//     else{
//         echo "Error Save [".$p_sql."]";
//     }
    
// }else{
//     $p_sql = "UPDATE product SET 
//     p_count = 0, buy = buy+ABS($cal) WHERE p_id = '".$_SESSION["strp_id"]."'";
//     $p_query = mysqli_query($con,$p_sql);
//     if($p_query)
//     {
//         echo "Save Done.";
//     }
//     else{
//         echo "Error Save [".$p_sql."]";
//     }
//     $b_sql = "INSERT INTO ";
// }


// mysqli_close($con);
?>