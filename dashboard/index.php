<!doctype html>
<?php
 include '../db.php';
 include '../auth.php';
$getAllProjects=mysqli_query($con,"SELECT * from requests where userID='$userID' ORDER BY dateAdded desc,percentage desc");


?>


<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="../img/favicon.png" type="image/png">
	<title>Help Lebanon Today</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../vendors/linericon/style.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
	<link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
	<link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
	<link rel="stylesheet" href="../vendors/animate-css/animate.css">
	<link rel="stylesheet" href="../vendors/jquery-ui/jquery-ui.css">
	<!-- main css -->
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/responsive.css">
</head>

<body>

	<!--================Header Menu Area =================-->
	<?php include '../sign-in/navbar.php';?>

	<!--================Header Menu Area =================-->

	<!--================ Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<?php if(isset($_SESSION['loggedIn']) and $_SESSION['loggedIn']==true){
						echo '<h2>My causes</h2>';
            echo '<h4 style="color:white">Hello '.$_SESSION["userDetails"]["name"].'</h4>';
					}else {
						echo '<h2>Hello, here are some causes</h2>';

					}
					?>
					<div class="page_link">
						<a href="../index.html">Home</a>
						<a>Causes</a>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!--================End Banner Area =================-->

	<!--================ Start Our Major Cause section =================-->
	<section class="our_major_cause section_gap_custom">
    <a class='main_btn2' style="float:right;margin-right:5%;" href='createCause.php'>Create Cause</a>

		<div class="container">

			<div class="row">

				<?php
				while($rows=mysqli_fetch_assoc($getAllProjects)){
					$img=$rows['thumbnail'];
					$percentage=$rows['percentage'];
					$goal=$rows['goal'];
					$title=$rows['title'];
					$smallDescription=$rows['smallDescription'];
					$id=$rows['id'];
					$dateAdded=date('j-M-y',strtotime($rows['dateAdded']));
					$getAllDonations=mysqli_query($con,"SELECT SUM(donationAmount) from donations where causeID='$id'  ");
					$donationDetails=mysqli_fetch_assoc($getAllDonations);
					$totalRaised=$donationDetails['SUM(donationAmount)'];
					if($totalRaised==""){
						$totalRaised=0;
					}


				echo '
				<div class="col-lg-4">
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
								<a href="editCauseDetails.php?id='.$id.'" class="main_btn2">Edit</a>
							</div>
							<p>
							Date Added: '.$dateAdded.'
							</p>
						</div>
					</div>
				</div>';

			}

				?>






			</div>
		</div>
	</section>
	<!--================ Ens Our Major Cause section =================-->

	<!--================ Start Footer Area  =================-->
  <?php include '../footer.php';?>

	<!--================ End Footer Area  =================-->



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="../js/popper.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<!-- <script src="../vendors/lightbox/simpleLightbox.min.js"></script> -->
	<script src="../vendors/nice-select/js/jquery.nice-select.min.js"></script>
	<!-- <script src="../vendors/isotope/imagesloaded.pkgd.min.js"></script> -->
	<script src="../vendors/isotope/isotope-min.js"></script>
	<script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
	<script src="../js/jquery.ajaxchimp.min.js"></script>
	<!-- <script src="../vendors/counter-up/jquery.waypoints.min.js"></script> -->
	<!-- <script src="../vendors/flipclock/timer.js"></script> -->
	<!-- <script src="../vendors/counter-up/jquery.counterup.js"></script> -->
	<script src="../js/mail-script.js"></script>
	<script src="../js/custom.js"></script>
</body>

</html>
