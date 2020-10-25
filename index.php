<?php
include 'db.php';
$getTopDonnors=mysqli_query($con,"SELECT * from users ORDER BY totalDonated desc limit 20");
$getAllProjects=mysqli_query($con,"SELECT * from requests ORDER BY dateAdded desc,percentage desc");


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

	<!--================ Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="overlay"></div>
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content row">
					<div class="offset-lg-2 col-lg-8">
						<img class="img-fluid" src="img/banner/text-img.png" alt="">
						<p>Spare some change and make the change for the people in Lebanon</p>
						<a class="main_btn mr-10" href="causes.php">donate now</a>
						<a class="white_bg_btn" href="dashboard/">Create Cause</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Home Banner Area =================-->


	<!--================ Start important-points section =================-->
	<section class="donation_details pad_top">
		<div class="container">
			<div class="row">
				<!-- <div class="col-lg-3 col-md-6 single_donation_box">
					<img src="img/icons/home1.png" alt="">
					<h4>Total Donation</h4>
					<p>
						The French Revolutioncons tituted for the conscience of the dominant.
					</p>
				</div>
				<div class="col-lg-3 col-md-6 single_donation_box">
					<img src="img/icons/home2.png" alt="">
					<h4>Fund Raised</h4>
					<p>
						The French Revolutioncons tituted for the conscience of the dominant.
					</p>
				</div> -->
				<div class="col-lg-3 col-md-6 single_donation_box">
					<img src="img/icons/home3.png" alt="">
					<h4>Reconstruct</h4>
					<p>Help out Lebanese people keep their houses</p>
				</div>
				<div class="col-lg-3 col-md-6 single_donation_box">
					<img src="img/icons/home4.png" alt="">
					<h4>Be Awarded</h4>
					<p>Companies that donate money or resources will be advertised</p>
				</div>
			</div>
		</div>
	</section>
	<!--================ End important-points section =================-->

	<!--================ Start Our Major Cause section =================-->
	<section class="our_major_cause section_gap">
		<div class="container">
			<div class="row justify-content-center section-title-wrap">
				<div class="col-lg-12">
					<h1>Our Major Causes</h1>
					<p>

					</p>
				</div>
			</div>

			<div class="row">
				<div id="our-major-cause" class="owl-carousel">
          <?php
  				while($rows=mysqli_fetch_assoc($getAllProjects)){
  					$img=$rows['thumbnail'];
  					$percentage=$rows['percentage'];
  					$goal=$rows['goal'];
  					$title=$rows['title'];
  					$smallDescription=$rows['smallDescription'];
  					$id=$rows['id'];
  					$dateAdded=date('j-M-y',strtotime($rows['dateAdded']));
  					$getAllDonations=mysqli_query($con,"SELECT SUM(donationAmount) from donations where causeID='$id' ");
  					$donationDetails=mysqli_fetch_assoc($getAllDonations);
  					$totalRaised=$donationDetails['SUM(donationAmount)'];
  					if($totalRaised==""){
  						$totalRaised=0;
  					}


  				echo '
   					<div class="card">
  						<div class="card-body">
  							<figure>
  								<img class="card-img-top img-fluid sheeshImg" src="'.$img.'" alt="'.$title.'">
  							</figure>
  							<div class="progress">
  								<div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.'%;">
  									<span>Funded '.$percentage.'%</span>
  								</div>
  							</div>
  							<div class="card_inner_body">
  								<div class="card-body-top">
  									<span>Raised: €'.$totalRaised.'</span> / €'.$goal.'
  								</div>
  								<h4 class="card-title">'.$title.'</h4>
  								<p class="card-text">'.$smallDescription.'
  								</p>
  								<a href="causeDetails.php?id='.$id.'" class="main_btn2">View More</a>
  							</div>
  							<p>
  							Date Added: '.$dateAdded.'
  							</p>
  						</div>
   				</div>';

  			}

  				?>
			</div>
		</div>
  </div>
	</section>
	<!--================ Ens Our Major Cause section =================-->

	<!--================ Start Make Donation Area =================-->

	<!--================ End Make Donation Area =================-->

	<!--================ Start Clients Logo Area =================-->
	<section class="clients_logo_area section_gap">
		<div class="container">
			<div class="clients_slider owl-carousel">
				<div class="item">
					<img src="img/clients-logo/c-logo-1.png" alt="">
				</div>
				<div class="item">
					<img src="img/clients-logo/c-logo-2.png" alt="">
				</div>
				<div class="item">
					<img src="img/clients-logo/c-logo-3.png" alt="">
				</div>
				<div class="item">
					<img src="img/clients-logo/c-logo-4.png" alt="">
				</div>
				<div class="item">
					<img src="img/clients-logo/c-logo-5.png" alt="">
				</div>
			</div>
		</div>
	</section>
	<!--================ End Clients Logo Area =================-->

	<!--================ Support Campaign Area =================-->
	<section class="support_campaign pad_bottom">
		<div class="container">
			<div class="row justify-content-center section-title-wrap">
				<div class="col-lg-12">
					<h1>Top Donors</h1>
					<p>

					</p>
				</div>
			</div>
	<div class="row">
			<?php
			while($donnor=mysqli_fetch_assoc($getTopDonnors)){
				$name= $donnor['name'];
				$id=$donnor['id'];
				$icon=$donnor['icon'];
			 ?>

				<div class="col-lg-6 mb-30">
					<div class="campaign_box">
						<div class="camppaign d-flex">
							<div class="img-box">
								<?php
					echo '<a href="viewProfile.php?user='.$id.'"><img class="img-fluid icon" src="'.$icon.'" alt=""></a>';
						?>
							</div>

							<div>
								<?php
							echo'	<h4><a href="viewProfile.php?user='.$id.'">'.$name.'</a></h4>';
								?>
								<h4>EUR <?php echo $donnor['totalDonated'];?></h4>
							</div>
						</div>

						<!-- <div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100" style="width: 76%;">
								<span>Funded 76%</span>
							</div>
						</div> -->
					</div>
				</div>

			 <?php
		 }
			  ?>







			</div>
		</div>
	</section>
	<!--================ End Support Campaing Area =================-->

	<!--================ Start Experience Area =================-->
	<section class="experience_donation section_gap">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-12">
					<h1>Spare some change and make the change</h1>
					<p></p>
					<a href="causes.php" class="main_btn2 mr-10">make donation now</a>
					<a href="dashboard/" class="main_btn2">Create Cause today</a>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Experience Area =================-->

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
