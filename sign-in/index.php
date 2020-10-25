<?php
include '../db.php';
if(isset($_POST['email'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$pass=$_POST['pass'];
	$pass=hash('sha256',$pass);
	$checkUser=mysqli_query($con,"SELECT * from users where email='$email' and pass='$pass'");
	if(mysqli_num_rows($checkUser) == 0){
		$msg='Email or password is incorrect';
	}else {
		$userDetails=mysqli_fetch_assoc($checkUser);
		$_SESSION['userDetails']=$userDetails;

		$_SESSION['loggedIn']=true;
		header('location: /causes.php');
	}
}
 ?>
<!doctype html>
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
	<?php include 'navbar.php';?>

	<!--================Header Menu Area =================-->

	<!--================ Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Login</h2>
					<div class="page_link">
						<a href="../index.php">Home</a>
						<a>Login</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Banner Area =================-->

	<!--================ Start About Us Section =================-->
	<section class="about_us section_gap">
		<div class="container">
			<div class="row">
        <div class="col">

        </div>
				<div class="col-6">
          <form method="post">
            <label>Email</label>
            <input type="text" class="single-input space" name="email" placeholder="Email..." />
            <label>Password</label>
            <input type="password" placeholder="Pass..." name="pass" class="single-input space" />
            <input type="submit" class='genric-btn primary circle' value='Sign In'/>

          </form>
					<?php
					if(isset($msg)){
						echo '<p style="color:red;">'.$msg.'</p>';
					}
					 ?>
          <a href='forgot.php' class="space">Forgot Password?</a><br />
          <a href="sign-up.php">Create Account</a>
				</div>

				<!-- <div class="offset-lg-1 col-lg-6">
					<div class="content_wrapper">
						<h1>Welcome to Eventure</h1>
						<p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially
							in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate
							behavior is often laughed.</p>
						<p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially
							in the workplace.</p>
						<a href="../#" class="main_btn">view more details</a>
					</div>
				</div> -->

			</div>

			<!-- <div class="row">
				<div class="col-lg-12">
					<div class="bottom_para">
						<p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially
							in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach. inappropriate
							behavior is often laughed. inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct
							standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
							inappropriate behavior is often laughed. inappropriate behavior is often laughed off as “boys will be boys,” women
							face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on
							the job is beyond reproach. inappropriate behavior is often laughed.</p>
					</div>
				</div>
			</div> -->
		</div>
	</section>
	<!--================ End About Us Area =================-->


	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<hr>
			</div>
		</div>
	</div>

	<!--================ Start Clients Logo Area =================-->
	<section class="clients_logo_area section_gap">
		<div class="container">
			<div class="clients_slider owl-carousel">
				<div class="item">
					<img src="../img/clients-logo/c-logo-1.png" alt="">
				</div>
				<div class="item">
					<img src="../img/clients-logo/c-logo-2.png" alt="">
				</div>
				<div class="item">
					<img src="../img/clients-logo/c-logo-3.png" alt="">
				</div>
				<div class="item">
					<img src="../img/clients-logo/c-logo-4.png" alt="">
				</div>
				<div class="item">
					<img src="../img/clients-logo/c-logo-5.png" alt="">
				</div>
			</div>
		</div>
	</section>
	<!--================ End Clients Logo Area =================-->

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
