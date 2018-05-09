<?php
session_start();

require 'connect.php';

?>
<!DOCTYPE html>
<html lang="en">

<head> 
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Ecom4Cluster</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">
				<ul class="header-links pull-left">
					<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
					<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
					<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
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

				} else if($_SESSION["type"] != "C"){
					header("Location: logout.php");
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
						<a href="#">
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

		<!-- LOGIN POPUP -->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Modal Header</h4>
					</div>
					<div class="modal-body">
						<p>
							<form class="form-inline" action="login.php" method="POST">
								<input class="form-control" type="text" name="username" placeholder="Username" required>
								<br><br>
								<input class="form-control" type="password" name="password" placeholder="Password" required>
								<br><br>
								<input class="btn btn-primary" type="submit" value="Log in">
							</form>
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /LOGIN POPUP -->

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
								<img src="img/log.png" alt="">
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
									<!-- <div class="qty">3</div> -->
								</a>
								<div class="cart-dropdown">
									<div class="cart-list">

									<?php
								if (!isset($_SESSION["intLine"])) {
									$_SESSION["intLine"] = null;
									$_SESSION["strp_id"] = null;
									echo "Cart Empty";
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
					<li class="active">
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="allproduct.php">สินค้า</a>
					</li>
					<li>
						<a href="searchorder.php">ค้นหาคำสั่งซื้อ</a>
					</li>

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
						<h3 class="breadcrumb-header"><?php echo $Result['c_name']; ?></h3>
						<ul class="breadcrumb-tree">
							<li class="active">Profile</li>
							<li><a href="insearchp.php">คำสั่งซื้อ</a></li>
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
            <div class="col-md-5">
						<!-- Billing Details -->
						<form action="save_profile.php" method="post">
						<div class="billing-details">
							<div class="form-group">ชื่อ-สกุล
								<input class="input" type="text" name="name" value="<?php echo $Result['c_name']; ?>" placeholder="<?php echo $Result['c_name']; ?>">
							</div>							
							<div class="form-group">ที่อยู่
								<input class="input" type="text" name="address" value="<?php echo $Result['c_address']; ?>" placeholder="<?php echo $Result['c_address']; ?>">
							</div>
							<div class="form-group">ตำบล
								<input class="input" type="text" name="district" value="<?php echo $Result['c_district']; ?>" placeholder="<?php echo $Result['c_district']; ?>">
							</div>
							<div class="form-group">อำเภอ
								<input class="input" type="text" name="amphur" value="<?php echo $Result['c_amphur']; ?>" placeholder="<?php echo $Result['c_amphur']; ?>">
							</div>
							<div class="form-group">จังหวัด
								<input class="input" type="text" name="province" value="<?php echo $Result['c_province']; ?>" placeholder="<?php echo $Result['c_province']; ?>">
							</div>
							<div class="form-group">รหัสไปรษณีย์
								<input class="input" type="text" name="zip-code" value="<?php echo $Result['c_zip_code']; ?>" placeholder="<?php echo $Result['c_zip_code']; ?>">
							</div>
							<div class="form-group">เบอร์โทรศัพท์
								<input class="input" type="tel" name="tel" value="<?php echo $Result['c_phone']; ?>" placeholder="<?php echo $Result['c_phone']; ?>">
							</div>
                            <div class="form-group">ยืนยันรหัสผ่าน
								<input class="input" type="password" name="password" placeholder="" required>
							</div>
						</div>
						<div class="add-to-cart">
							<button class="add-to-cart-btn">
								ยืนยันการแก้ไข
							</button>
									
						</div>
						</form>
						<!-- /Billing Details -->
					</div>

			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- NEWSLETTER -->
	<div id="newsletter" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="newsletter">
						<p>Sign Up for the
							<strong>NEWSLETTER</strong>
						</p>
						<form>
							<input class="input" type="email" placeholder="Enter Your Email">
							<button class="newsletter-btn">
								<i class="fa fa-envelope"></i> Subscribe</button>
						</form>
						<ul class="newsletter-follow">
							<li>
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-instagram"></i>
								</a>
							</li>
							<li>
								<a href="#">
									<i class="fa fa-pinterest"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /NEWSLETTER -->

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
							<p>เว็บไซต์ขายของออนไลน์ของกลุ่มวิสาหกิจชุมชน ต.น้ำน้อย</p>
							<ul class="footer-links">
								<li>
									<a href="#">
										<i class="fa fa-map-marker"></i>1734 Stonecoal Road</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-phone"></i>+021-95-51-84</a>
								</li>
								<li>
									<a href="#">
										<i class="fa fa-envelope-o"></i>email@email.com</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Categories</h3>
							<ul class="footer-links">
								<li>
									<a href="#">Hot deals</a>
								</li>
								<li>
									<a href="#">Laptops</a>
								</li>
								<li>
									<a href="#">Smartphones</a>
								</li>
								<li>
									<a href="#">Cameras</a>
								</li>
								<li>
									<a href="#">Accessories</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="clearfix visible-xs"></div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Information</h3>
							<ul class="footer-links">
								<li>
									<a href="#">About Us</a>
								</li>
								<li>
									<a href="#">Contact Us</a>
								</li>
								<li>
									<a href="#">Privacy Policy</a>
								</li>
								<li>
									<a href="#">Orders and Returns</a>
								</li>
								<li>
									<a href="#">Terms & Conditions</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-xs-6">
						<div class="footer">
							<h3 class="footer-title">Service</h3>
							<ul class="footer-links">
								<li>
									<a href="#">My Account</a>
								</li>
								<li>
									<a href="#">View Cart</a>
								</li>
								<li>
									<a href="#">Wishlist</a>
								</li>
								<li>
									<a href="#">Track My Order</a>
								</li>
								<li>
									<a href="#">Help</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /top footer -->
	</footer>
	<!-- /FOOTER -->

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