<?php
include 'db.php';
if(isset($_GET['id'])){
  $id=$_GET['id'];
}else {
  header('location: causes.php');
}
$getProjectDetails=mysqli_query($con,"SELECT * from requests where id='$id'");
if(mysqli_num_rows($getProjectDetails) ==0){
  header('location: causes.php');
}
$projectDetails=mysqli_fetch_assoc($getProjectDetails);
$img=$projectDetails['thumbnail'];
$title=$projectDetails['title'];
$largeDescription=nl2br($projectDetails['largeDescription']);
$percentage=$projectDetails['percentage'];
$goal=$projectDetails['goal'];
$dateAdded=date('j-M-y',strtotime($projectDetails['dateAdded']));
$location=$projectDetails['location'];

?>
<!doctype html>

<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="img/favicon.png" type="image/png">
	<title>Help Lebanon Today</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="vendors/linericon/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="vendors/animate-css/animate.css">
	<link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css">
	<!-- main css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
</head>

<body>

	<!--================Header Menu Area =================-->
	<?php include 'navbar.php';?>
	<!--================Header Menu Area =================-->

	<!--================ Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Cause Details</h2>
					<div class="page_link">
						<a href="index.php">Home</a>
						<a href="causes.php">Causes</a>
						<a>Cause Details</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Banner Area =================-->


	<!--================ Start Recent Event Area =================-->
  <?php


  echo '
	<section class="event_details section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<img src="'.$img.'" alt="" class="img-fluid">
          <div class="progress">

            <div class="progress-bar" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.'%;">
            </div>
				</div>


         </div>
			</div>

			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="event_content">
						<div class="row">
							<div class="col-lg-4">
								<div class="left_content">
									<p>
										<i class="lnr lnr-calendar-full"></i>
										'.$dateAdded.'
									</p>
									<p>
										<i class="lnr lnr-location"></i>
										'.$location.'
									</p>

								</div>
							</div>
							<div class="col-lg-8">
								<div class="right_content">
									<h3>'.$title.'</h3>
									<p>'.$largeDescription.'</p>
								</div>
							</div>
              <a href="donation.php?causeID='.$id.'" class="genric-btn primary radius">Donate</a>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
  ';
  ?>
	<!--================ End Recent Event Area =================-->

	<!--================ Start Footer Area  =================-->
  <?php include 'footer.php';?>

	<!--================ End Footer Area  =================-->



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<!-- <script src="vendors/lightbox/simpleLightbox.min.js"></script> -->
	<script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<!-- <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script> -->
	<script src="vendors/isotope/isotope-min.js"></script>
	<script src="vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<!-- <script src="vendors/counter-up/jquery.waypoints.min.js"></script> -->
	<!-- <script src="vendors/flipclock/timer.js"></script> -->
	<!-- <script src="vendors/counter-up/jquery.counterup.js"></script> -->
	<script src="js/mail-script.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>
