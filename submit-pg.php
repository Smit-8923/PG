<?php
session_start();
require 'admin/myclass/connection.php';
if (isset($_POST['btn'])) {
	$pg_name = $_POST['pg_name'];
	$pg_details = $_POST['pg_details'];
	$pg_areaid = $_POST['pg_areaid'];
	$pg_address = $_POST['pg_address'];
	$pg_amount = $_POST['pg_amount'];
	$category_id = $_POST['category_id'];
	$owner_id = $_POST['owner_id'];
	$pg_photos = $_FILES['pg_photos']['name'];
	$filepath = $_FILES['pg_photos']['tmp_name'];
	$sql = "INSERT INTO tbl_pgmaster(pg_name,pg_details,pg_areaid,pg_address,pg_photos,pg_amount,category_id,owner_id)
			VALUES ('$pg_name','$pg_details','$pg_areaid','$pg_address','$pg_photos','$pg_amount','$category_id','$owner_id')";

	if ($conn->query($sql) === TRUE) {
		move_uploaded_file($filepath, "uploads/" . $pg_photos);
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from ary-themes.com/html/noor_tech/dream-property/submit-property.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Mar 2021 10:53:32 GMT -->

<head>
	<meta charset="utf-8">
	<title>BOOK MY PG| Submit Property</title>
	<!-- Stylesheets -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">

	<!--Color Switcher Mockup-->
	<link href="css/color-switcher-design.css" rel="stylesheet">
	<!--Color Themes-->
	<link id="theme-color-file" href="css/color-themes/default-theme.css" rel="stylesheet">

	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
	<link rel="icon" href="images/favicon.png" type="image/x-icon">

	<!-- Responsive -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
	<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

	<div class="page-wrapper">
		<!-- Preloader -->
		<div class="preloader"></div>

		<?php
		include './themepart/header.php';
		?>
		<!-- End Main Header -->

		<!-- Page Title -->
		<section class="page-title" style="background-image:url(images/background/2.jpg);">
			<div class="auto-container">
				<div class="inner-box">
					<h1>Submit PG Houses</h1>
					<div class="bread-crumb"><a href="index.php">Home &nbsp; /</a> <i class="current">Submit PG Houses</i></div>
				</div>
			</div>
		</section>
		<!-- End Page Title -->

		<!-- Submit Property Section -->
		<section class="submit-property-section">
			<div class="auto-container">

				<!-- Submit Property Header -->
				<div class="submit-property-header-section">
					<div class="row clearfix">
						<!-- Column -->
						<div class="column col-lg-6 col-md-12 col-sm-12">
							<h1>Submit PG Houses</h1>
						</div>
						<!-- Column -->
						<div class="column col-lg-6 col-md-12 col-sm-12">
							<ul class="dashboard-nav">
								<li><a href="index.html">Index</a></li>
								<li><a href="#">Messages</a></li>
								<li><a href="booking.php">Booking</a></li>
								<li class="active"><a href="submit-pg.php">Submit Property</a></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Submit Property Section -->
				<div class="dashboard-property-section">
					<h2>Basic Information</h2>

					<!-- Property Search Form -->
					<div class="property-search-form">
						<form method="post" enctype="multipart/form-data" class="form-horizontal" id="myform">

							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">PG_Name</label>
								</div>
								<div class="col-12 col-md-12">
									<input type="text" id="name-input" name="pg_name" title="Enter PG Name" class="form-control" pattern="^[A-Za-z -]+$" class="required" required>
								</div>
							</div>

							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">PG_Details</label>
								</div>
								<div class="col-12 col-md-12">
									<input type="text" id="details-input" name="pg_details" title="Enter Details" class="form-control" class="required" required>
								</div>
							</div>

							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">PG_AreaId</label>
								</div>

								<div class="col-12 col-md-12">
									<select name="pg_areaid" class='form-control'>						
											<option value="1-Ambawadi">1-Ambawadi</option>
											<option value="2 -Navrangpura">2 -Navrangpura</option>
											<option value="3 -Vastral">3 -Vastral</option>
											<option value="4 -Naranpura">4 -Naranpura</option>
											<option value="5 -Vastrapur">5 -Vastrapur</option>
											<option value="6 -Shella">6 -Shella</option>
											<option value="7 -Bopal">7 -Bopal</option>
											<option value="8 -Prahladnagar">8 -Prahladnagar</option>
											<option value="9 -Gota">9 -Gota</option>
											<option value="10-Thaltej">10-Thaltej</option>
											<option value="11-C.G.Road">11-C.G.Road</option>
											<option value="12-Paldi">12-Paldi</option>
											<option value="13-Vasna">13-Vasna</option>
									</select>
								</div>
							</div>

							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">PG_Address</label>
								</div>
								<div class="col-12 col-md-12">
									<input type="text" id="address-input" name="pg_address" title="Enter Address" class="form-control" class="requird" required>

								</div>
							</div>

							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">PG_Photos</label>
								</div>
								<div class="col-12 col-md-12">
									<input type="file" id="photo-input" name="pg_photos" title="upload image" class="form-control" class="requird" required>
								</div>
							</div>

							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">PG_Amount</label>
								</div>
								<div class="col-12 col-md-12">
									<input type="text" id="amount-input" name="pg_amount" title="Enter Amount" class="form-control" class="required" required>
								</div>
							</div>


							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">Category Id</label>
								</div>

								<div class="col-12 col-md-12">
									<select name="category_id" class='form-control'>
										<?php
										$q = mysqli_query($connection, "select * from tbl_category");
										while ($row = mysqli_fetch_array($q)) {
											echo "<option value = '{$row['category_id']}'>{$row['category_name']}</option>";
										}
										?>
									</select>
								</div>
							</div>


							<div class="row form-group">
								<div class="col col-md-3">
									<label for="text-input" class=" form-control-label">Owner Id </label>
								</div>
								<div class="col-12 col-md-12">
									<select name="owner_id" class='form-control'>
										<?php
										$q = mysqli_query($connection, "select * from tbl_owner");
										while ($row = mysqli_fetch_array($q)) {
											echo "<option value = '{$row['owner_id']}'>{$row['owner_name']}</option>";
										}
										?>
									</select>
								</div>
								<br><br>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary btn-sm" name="btn">
										<i class="fa fa-dot-circle-o"></i> Submit
									</button><br>
									<button type="reset" class="btn btn-danger btn-sm">
										<i class="fa fa-ban"></i> Reset
									</button>
								</div>

						</form>
					</div>

				</div>

			</div>
		</section>
		<!-- End Submit Property Section -->

		<!--Newsleter Section-->
		<section class="newsletter-section" style="background-image:url(images/background/1.jpg)">
			<div class="auto-container">
				<div class="inner-container">
					<div class="row clearfix">

						<!--Title Column-->
						<div class="title-column col-lg-5 col-md-12 col-sm-12">
							<div class="inner-column">
								<div class="icon-box">
									<span class="icon flaticon-door-knob"></span>
								</div>
								<h4>Newsletter Subscription</h4>
								<div class="title">Get latest news & updates</div>
							</div>
						</div>

						<!--Form Column-->
						<div class="form-column col-lg-7 col-md-12 col-sm-12">
							<div class="inner-column">

								<!--Subscribe Form-->
								<div class="subscribe-form">
									<form method="post" action="http://ary-themes.com/html/noor_tech/dream-property/contact.php">
										<div class="form-group">
											<input type="email" name="email" value="" placeholder="Email Address" required>
											<button type="submit" class="submit-btn">Submit Now</button>
										</div>
									</form>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
		<!--End Newsleter Section-->

		<!--Main Footer-->
		<?php
		include './themepart/footer.php';
		?>

	</div>
	<!--End pagewrapper-->

	<!--Scroll to top-->
	<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

	<!--Search Popup-->
	<div id="search-popup" class="search-popup">
		<div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
		<div class="popup-inner">
			<div class="overlay-layer"></div>
			<div class="search-form">
				<form method="post" action="http://ary-themes.com/html/noor_tech/dream-property/index.php">
					<div class="form-group">
						<fieldset>
							<input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required>
							<input type="submit" value="Search Now!" class="theme-btn">
						</fieldset>
					</div>
				</form>

				<br>
				<h3>Recent Search Keywords</h3>
				<ul class="recent-searches">
					<li><a href="#">Business</a></li>
					<li><a href="#">Appartment</a></li>
					<li><a href="#">Flat</a></li>
					<li><a href="#">Commercial</a></li>
					<li><a href="#">Villa</a></li>
				</ul>

			</div>

		</div>
	</div>


	<!--Scroll to top-->
	<script src="js/jquery.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.fancybox.js"></script>
	<script src="js/jquery.countdown.js"></script>
	<script src="js/owl.js"></script>
	<script src="js/wow.js"></script>
	<script src="js/dropzone.js"></script>
	<script src="js/appear.js"></script>
	<script src="js/script.js"></script>
	<script src="js/color-settings.js"></script>

</body>

<!-- Mirrored from ary-themes.com/html/noor_tech/dream-property/submit-property.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Mar 2021 10:53:32 GMT -->

</html>