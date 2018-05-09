<?php
session_start();

$_SESSION['e_price'] = $_POST['e_price'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Checkout</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="css/style.css"/>
	</head>

	<?php
	if (!isset($_SESSION["intLine"])) {
		echo "<script>";
		echo "alert(\"ไม่มีสินค้าอยู่ในตะกร้า กรุณาเพิ่มสินค้าลงในตะกร้าก่อนชำระเงิน\");";
		echo "window.history.back()"; //กลับไปหน้าที่แล้ว
		echo "</script>";
		exit();
	}
	require 'connect.php';
	?>

	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> 074 446 983</a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i> 69/186 เมืองใหม่ 6 ซอย 1 ตำบล คลองแห อำเภอ หาดใหญ่ สงขลา 90110</a></li>
				</ul>

					<!-- ปุ่ม login logout -->
					<ul class="header-links pull-right">
						<?php
					if (!isset($_SESSION["type"])) {
						?>
							<li>
							<a href="#" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-user-o"></i> Login</a>
							</li>
							<?php

					} else {
						$c_id = $_SESSION['c_id'];

						$sql = "SELECT * FROM customer WHERE c_id=$c_id";
						$query = mysqli_query($con, $sql);
						if (!$query) {
							echo $con->error;
							exit();
						}
						$Result = mysqli_fetch_array($query, MYSQLI_ASSOC);

						$_SESSION['c_name'] = $Result['c_name'];
						?>
							<li>
							<a href="profile.php">
							<i class="fa fa-user-o"></i><?php echo $Result['c_name']; ?></a>
							</li>
							<li>
							<a href="logout.php">
							logout</a>
							</li>
						<?php
					}
					?>
					</ul>
					<!-- /ปุ่ม login logout -->

				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/log.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">

							<!-- Cart -->
							<div class="dropdown">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									<i class="fa fa-shopping-cart"></i>
									<span>Your Cart</span>
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">

									<?php
								if(!isset($_SESSION["intLine"]))
								{
									echo "<script>";
									echo "alert(\"ไม่มีสินค้าอยู่ในตะกร้า กรุณาเพิ่มสินค้าลงในตะกร้าก่อนชำระเงิน\");";
									echo "window.history.back()"; //กลับไปหน้าที่แล้ว
									echo "</script>";
									exit();
								}
								?>
									<?php
								$Total = 0;
								$SumTotal = 0;

								for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
									if ($_SESSION["strp_id"][$i] != "") {
										$strSQL = "SELECT * FROM product WHERE p_id = '" . $_SESSION["strp_id"][$i] . "' ";
										$objQuery = mysqli_query($con, $strSQL);
										$objResult = $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
										$Total = $_SESSION["strQty"][$i] * $objResult["p_price"];
										$SumTotal = $SumTotal + $Total;
										?>
										<div class="product-widget">
											<div class="product-img">
												<img src="./img/<?= $objResult["p_pictures"]; ?>" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-name">
													<a href="product.php?p_id=<?php echo $objResult["p_id"]; ?>"><?= $objResult["p_name"]; ?></a>
												</h3>
												<h4 class="product-price">
													<span class="qty"><?= $_SESSION["strQty"][$i]; ?>x</span>฿<?= number_format($Total, 2); ?></h4>
											</div>
											<button class="delete" onclick="window.location.href = 'delete.php?Line=<?= $i; ?>'">
												<i class="fa fa-close"></i>
											</button>
										</div>
										<?php

								}
							}
							?>

									</div>
									<div class="cart-summary">
										<h5>SUBTOTAL: ฿<?php echo number_format($SumTotal, 2); ?></h5>
									</div>
									<div class="cart-btns">
										<a href="cart.php">View Cart</a>
									</div>
								</div>
							</div>
							<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="allproduct.php">สินค้า</a></li>
					<li><a href="searchorder.php">ค้นหาคำสั่งซื้อ</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
						<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="allproduct.php">สินค้า</a>
					</li>
					<li>
						<a href="searchorder.php">ค้นหาคำสั่งซื้อ</a>
					</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">ที่อยู่</h3>
							</div>
							<?php
							if (!isset($_SESSION['c_id'])) {
							?>
							<form action="save_checkout.php" method="post">
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>							
							<div class="form-group">
								<input class="input" type="text" name="name" placeholder="ชื่อ-สกุล">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="ที่อยู่">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="district" placeholder="ตำบล">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="amphur" placeholder="อำเภอ">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="province" placeholder="จังหวัด">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" placeholder="รหัสไปรษณีย์">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" placeholder="เบอร์โทรศัพท์">
							</div>
							<div class="form-group">
								<div class="input-checkbox">
									<input type="checkbox" id="create-account">
									<label for="create-account">
										<span></span>
										ต้องการสมัครเพื่อเข้าใช้งานในครั้งต่อไปหรือไม่
									</label>
									<div class="caption">
										<p>ใช้ email ของท่านเป็น ID โปรดกรอกรหัสผ่านในการเข้าใช้งาน</p>
										<input class="input" type="password" name="password" placeholder="รหัสผ่าน">
									</div>
								</div>
							</div>
							<?php
							}else{
							?>
							<form action="save_checkout2.php" method="post">
							<div class="form-group">
								<input class="input" type="email" name="email" value="<?php echo $Result['c_email']; ?>">
							</div>							
							<div class="form-group">
								<input class="input" type="text" name="name" value="<?php echo $Result['c_name']; ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" value="<?php echo $Result['c_address']; ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="district" value="<?php echo $Result['c_district']; ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="amphur" value="<?php echo $Result['c_amphur']; ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="province" value="<?php echo $Result['c_province']; ?>">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="zip-code" value="<?php echo $Result['c_zip_code']; ?>">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="tel" value="<?php echo $Result['c_phone']; ?>">
							</div>
							<?php
							}
							?>
							
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<!-- <div class="shiping-details">
							<div class="section-title">
								<h3 class="title">ที่อยู่เพื่อจัดส่งสินค้า</h3>
							</div>
							<div class="input-checkbox">
								<input type="checkbox" id="shiping-address" name="">
								<label for="shiping-address">
									<span></span>
									ต้องการจัดส่งไปยังที่อยู่อื่นหรือไม่?
								</label>
								<div class="caption">
									<div class="form-group">
									<input class="input" type="text" name="dname" placeholder="ชื่อ-สกุล">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="daddress" placeholder="ที่อยู่">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="ddistrict" placeholder="ตำบล">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="damphur" placeholder="อำเภอ">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="dprovince" placeholder="จังหวัด">
									</div>
									<div class="form-group">
										<input class="input" type="text" name="dzip-code" placeholder="รหัสไปรษณีย์">
									</div>
									<div class="form-group">
										<input class="input" type="tel" name="dtel" placeholder="เบอร์โทรศัพท์">
									</div>
								</div>
							</div>
						</div> -->
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<!-- <div class="order-notes">
							<textarea class="input" placeholder="Order Notes"></textarea>
						</div> -->
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<?php
							$Total = 0;
							$SumTotal = 0;
							$LastTotal = 0;						
							for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
							{
								if($_SESSION["strp_id"][$i] != "")
								{
									$strSQL = "SELECT * FROM product WHERE p_id = '".$_SESSION["strp_id"][$i]."' ";
									$objQuery = mysqli_query($con,$strSQL);
									$objResult = $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
									$Total = $_SESSION["strQty"][$i] * $objResult["p_price"];
									$SumTotal = $SumTotal + $Total;
									$LastTotal = $SumTotal + $_SESSION['e_price'];
									$_SESSION['lasttotal'] = $LastTotal;
								?>
							<div class="order-products">
								<div class="order-col">
									<div><?=$_SESSION["strQty"][$i];?>x <?=$objResult["p_name"];?></div>
									<div>฿<?=number_format($Total,2);?></div>
								</div>
							</div>
							<?php
								}
							}
							?>
							<div class="order-col">
							<?php
							$sqle = "SELECT * FROM environment WHERE e_price = '" . $_SESSION["e_price"] . "' ";
							$querye = mysqli_query($con, $sqle);
							$resulte = mysqli_fetch_array($querye, MYSQLI_ASSOC)
							?>
								<div>วิธีการจัดส่ง <b><?php echo $resulte["e_name"]; ?></b></div>
								<div>฿<?php echo $_SESSION['e_price']; ?></div>
							</div>

							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">฿<?=number_format($LastTotal);?></strong></div>
							</div>
						</div>
						<!-- <div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div> -->
						<button class="primary-btn order-submit">ยืนยันการสั่งซื้อ</a>
					</div>
					<!-- /Order Details -->
					</form>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
								<li>
									<a href="#">
										<i class="fa fa-map-marker"></i>69/186 เมืองใหม่ 6 ซอย 1 ตำบล คลองแห อำเภอ หาดใหญ่ สงขลา 90110</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-phone"></i>074 446 983</a>
								</li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
		<?php
		mysqli_close($con);
		?>
	</body>
</html>
