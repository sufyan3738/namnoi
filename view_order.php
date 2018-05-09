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
							<li><a href="profile.php">Profile</a></li>
							<li class="active"><a href="#">คำสั่งซื้อ</a></li>
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
			<div class="col-md-12">
						<h3 class="breadcrumb-header">คำสั่งซื้อ</h3>						
						<div class="container"> 						
							<table class="table table-bordered">
									<br>
								<thead>
									<tr>
										<th>เลขที่ใบสั่งซื้อ</th>
										<th>วันที่สั่งซื้อ</th>
										<th>เรียกดู</th>
									</tr>
								 </thead>
									<tbody>
								<?php
										$osql = "SELECT * FROM orders WHERE c_id = '".$_SESSION["c_id"]."' ";
										$oquery = mysqli_query($con,$osql);
										while ($oresult = mysqli_fetch_array($oquery,MYSQLI_ASSOC)) {
										?>
										<tr>
											<td><?=$oresult["o_id"];?></td>
											<td><?=$oresult["date_time"];?></td>
											<td><a href="view_order_detail.php?OrderID=<?=$oresult["o_id"];?>"> รายละเอียด</a></td>
										</tr>
										<?php
										}
									?>

										

									</tbody>
							</table>
						</div>
					</div>

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
							<p>เว็บไซต์ขายของออนไลน์ของกลุ่มวิสาหกิจชุมชน ต.น้ำน้อย</p>
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

</body>

</html>