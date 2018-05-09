<?php
session_start();
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
			<title>ใบสั่งซื้อ</title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<style>
					* {
						box-sizing: border-box;
					}
					
					/* Create two equal columns that floats next to each other */
					.column {
						float: left;
						width: 33.3%;
						padding: 10px;
						height: 300px; /* Should be removed. Only for demonstration */
					}

					.columnt {
						float: right;
						width: 30%;
						padding: 10px;
						height: 100%; /* Should be removed. Only for demonstration */
					}
					
					/* Clear floats after the columns */
					.row:after {
						content: "";
						display: table;
						clear: both;
					}
					</style>
<?php
$viewsql = "SELECT orders.*,customer.* FROM orders,customer WHERE orders.c_id = customer.c_id AND o_id = '".$_GET["OrderID"]."'";
$viewquery = mysqli_query($con,$viewsql);
$viewresult = mysqli_fetch_array($viewquery,MYSQLI_ASSOC);
?>

<div class="container">
		<div class="row">
				<div class="column">
					 <b></b>
					 <br>
					 
					 <br>
					 <br>
					 <br>
					 <br>
					 <br><b> ข้อมูลลูกค้า</b>
					<br> <b>ชื่อ-นามสกุล :</b><?php echo $viewresult["c_name"]?>
					<br> <b>ที่อยู่ :</b><?php echo $viewresult["c_address"], " ตำบล ", $viewresult["c_district"], " อำเภอ " , $viewresult["c_amphur"], " จังหวัด ", $viewresult["c_province"], " ", $viewresult["c_zip_code"]?>
					<br> <b>เบอร์โทรศัพท์ :</b><?php echo $viewresult["c_phone"]?>
				</div>
				<div class="column">
					<center>
						<a href="index.php">
						<img src="img/4clusternamnoi.png" width="50%" height="50%"></img></a>
						<h4>กลุ่มวิสาหกิจชุมชนน้ำน้อย</h4>
						<h4>ใบสั่งซือ</h4>
					</center>
				</div>
					<div class="column" >
						<b>เลขที่ใบสั่งซื้อ <?php echo $viewresult["o_id"]?></b><br>
						<b>วัน/เดือน/ปี :</b> <?php echo $viewresult["date_time"]?>
				</div>				
		</div>
	</div>
		
    </head>
	<body>
		<div class="container">          
			<table class="table table-bordered">
    		    <thead>
					<tr>
						<th>ชื่อสินค้า</th>
						<th>สี</th>
						<th>ขนาด</th>
                        <th>จำนวน</th>
                        <th>ราคาสินค้าต่อหน่วย</th>
                        <th>ราคารวม</th>
					</tr>
				 </thead>
				 <?php
				 $total = 0;
				 	$viewpsql = "SELECT product.*,orders_list.* FROM product,orders_list WHERE product.p_id = orders_list.p_id AND orders_list.o_id = '".$_GET["OrderID"]."'";
					 $viewpquery = mysqli_query($con,$viewpsql);
					 while ($viewpresult = mysqli_fetch_array($viewpquery)) {
						$total = $viewpresult["p_amount"] * $viewpresult["Qty"];
						 ?>
							<tbody>
								<tr>
									<td><?php echo $viewpresult["p_name"]?></td>
									<td><?php echo $viewpresult["p_color"]?></td>
									<td><?php echo $viewpresult["p_size"]?></td>
									<td><?php echo $viewpresult["Qty"]?></td>
									<td><?php echo $viewpresult["p_amount"]?></td>
									<td><?php echo $total?></td>
								</tr>
							</tbody>
						 <?php
					 }
				 ?>
            </table>
            <table class="columnt table table-bordered">
			    <tbody>
                    <tr>
                        <td><b>อัตราค่าบริการส่งแบบลงทะเบียน/EMS</b></td>
                        <td><?=number_format($viewresult["shipping_cost"]);?></td>
                    </tr>
                    <tr>
                       <td><b>ราคาสุทธิ</b></td>
                      <td><?php echo $viewresult["total_price"]?></td>
                    </tr>
            </table>
        </div>
        <div class="container">
            <b>ช่องทางการชำระเงิน</b>
            <table border="3px" width="100%">
                <tr>
                    <td>โอนผ่านธนาคาร <br>
                        เลขที่บัญชี : xxx-xxx-xxxx <br>
                        ชื่อบัญชี : Nicky WIN<br>
                        ประเภทบัญชี : ออมทรัพย์
                    </td>
                    <td>QR Code<br>
                    <img height="100px" width="100px" src="img/10.png">
                    </td>
                </tr>
            </table>
        </div>
	</body>
	<footer>
		<center>
			<b>ติดต่อ</b>
			<p>ที่อยู่: 69/186 เมืองใหม่ 6 ซอย 1 ตำบล คลองแห อำเภอ หาดใหญ่ สงขลา 90110 </p>
			<p>โทรศัพท์: 074 446 983</p>
		</center>
	</footer>
</html>
