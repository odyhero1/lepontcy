<?php
include 'db.php';
include 'auth.php';
require 'vendor/autoload.php';
// This is your real test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51HfjfvFlRiSAml4o2947e92nfHmOZcclR2WfD9qPvertBsIu5nUvbmQb0fUjGH5R9moGm9uF7v8lv74T0fqU0yJY00UOt5JpNY');
$causeID=$_SESSION['cart']['causeID'];
$amount=$_SESSION['cart']['amount'];
$dateTime=date('Y-m-d H:i');
$getCause=mysqli_query($con,"SELECT * from requests where id='$causeID'");
$causeDetails=mysqli_fetch_assoc($getCause);
$goal=$causeDetails['goal'];
$title=$causeDetails['title'];


$getAllDonations=mysqli_query($con,"SELECT SUM(donationAmount) from donations where causeID='$causeID'");
$donationDetails=mysqli_fetch_assoc($getAllDonations);
$totalRaised=$donationDetails['SUM(donationAmount)'];
$percentage=($totalRaised/$goal)*100;
$img=$causeDetails['thumbnail'];
$smallDescription=$causeDetails['smallDescription'];
$dateAdded=$causeDetails['dateAdded'];


if(isset($_GET['c'])){
  $paymentIntent=$_GET['c'];
}else {
  header('location: causes.php');
}

$intent = \Stripe\PaymentIntent::retrieve($paymentIntent);
$charges = $intent->charges->data;
if($charges[0]['paid']==true){
  $checkPayments=mysqli_query($con,"SELECT * from payments where paymentIntent='$paymentIntent'");
  if(mysqli_num_rows($checkPayments) > 0){

  }else {
    mysqli_query($con,"INSERT into payments (paymentIntent,dateTime,userID,causeID,amount) values ('$paymentIntent','$dateTime','$userID','$causeID','$amount')");
    $getID=mysqli_query($con,"SELECT * from payments where paymentIntent='$paymentIntent'");
    $extractID=mysqli_fetch_assoc($getID);
    $paymentID=$extractID['id'];
    mysqli_query($con,"INSERT into donations (donationAmount,causeID,userID,date,paymentID) values ('$amount','$causeID','$userID','$date','$paymentID')");
    $getAllDonations=mysqli_query($con,"SELECT SUM(donationAmount) from donations where causeID='$causeID'");
    $donationDetails=mysqli_fetch_assoc($getAllDonations);
    $totalRaised=$donationDetails['SUM(donationAmount)'];
    $percentage=($totalRaised/$goal)*100;
    mysqli_query($con,"UPDATE requests set percentage='$percentage' where id='$causeID'");
    $getCurrentTotal=mysqli_query($con,"SELECT * from users where id='$userID'");
    $userD=mysqli_fetch_assoc($getCurrentTotal);
    $totalDonated=$userD['totalDonated']+$amount;
    mysqli_query($con,"UPDATE users set totalDonated='$totalDonated' where id='$userID'");
  }
}else {
  header('location: causes.php');
}


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
   <script src="https://js.stripe.com/v3/"></script>
   <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>


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
 					<h2>Make Donation</h2>
 					<div class="page_link">
 						<a href="index.html">Home</a>
 						<a href="donation.html">Donation</a>
 					</div>
 				</div>
 			</div>
 		</div>
 	</section>
 	<!--================End Banner Area =================-->

 	<!--================ Start Make Donation Area =================-->
 	<section class="make_donation section_gap">
 		<div class="container">
 			<div class="row justify-content-start section-title-wrap">
 				<div class="col-lg-12">
 					<h1>Thank you for your donation to <?php echo "<a class='niceColor' href='causeDetails.php?id=".$causeID."'>".$title."</a>";?> </h1>
 					<p>
 					</p>
 				</div>
 			</div>

 			<div class="donate_now_wrapper">
         <h3>Total: €<?php echo $amount;?></h3>

         <?php

         echo '
         <div class="col-lg-4">
           <div class="card">
             <div class="card-body">
               <figure>
                 <img class="card-img-top img-fluid" src="'.$img.'" alt="'.$title.'">
               </figure>
               <div class="progress">
                 <div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.'%;">

                 </div>
               </div>
               <div class="card_inner_body">
                 <div class="card-body-top">
                   <span>Raised: €'.$totalRaised.'</span> / €'.$goal.'
                 </div>
                 <h4 class="card-title">'.$title.'</h4>
                 <p class="card-text">'.$smallDescription.'
                 </p>
                 <a href="causeDetails.php?id='.$causeID.'" class="main_btn2">View More</a>
               </div>
               <p>
               Date Added: '.$dateAdded.'
               </p>
             </div>
           </div>
         </div>';
         ?>


 			</div>
 		</div>
 	</section>





 </script>

 	<!--================ End Make Donation Area =================-->

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
