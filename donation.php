<?php
include 'db.php';
include 'auth.php';

if(isset($_GET['causeID'])){
  $id=$_GET['causeID'];
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
$smallDescription=nl2br($projectDetails['smallDescription']);
$percentage=$projectDetails['percentage'];
$goal=$projectDetails['goal'];
$dateAdded=date('j-M-y',strtotime($projectDetails['dateAdded']));
$location=$projectDetails['location'];



if(isset($_POST['moneyDonation']) or isset($_POST['customMoneyDonation'])){

  $amount=$_POST['moneyDonation'];

$customAmount=$_POST['customMoneyDonation'];

    if($amount!="" and $customAmount==""){
      $nAmount=round($amount,2);
      $_SESSION['cart']['causeID']=$id;
      $_SESSION['cart']['amount']=$nAmount;
      header('location: checkout.php');
    }


  if(is_numeric($customAmount) and $customAmount > 5){
    $nAmount=round($customAmount,2);
    $_SESSION['cart']['causeID']=$id;
    $_SESSION['cart']['amount']=$nAmount;
    header('location: checkout.php');
  }else{
    $msg="Donations must be greater than €5";
  }
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
					<h1>Make a donation to <?php echo "<a class='niceColor' href='causeDetails.php?id=".$id."'>".$title."</a>";?> </h1>
					<p>
						<?php echo $smallDescription;?>
					</p>
				</div>
			</div>

			<div class="donate_now_wrapper">
				<form method="post">
					<div class="row">
						<div class="col-lg-4">
							<div class="donate_box mb-30">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="moneyDonation" value='10' id="ten_doller">
									<label class="form-check-label d-flex justify-content-between" for="ten_doller">
										<div class="label_text">
											€10.00
										</div>
										<div class="label_text">
											EUR
										</div>
									</label>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="donate_box mb-30">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="moneyDonation" value='50' id="fifty_doller">
									<label class="form-check-label d-flex justify-content-between" for="fifty_doller">
										<div class="label_text">
											€50.00
										</div>
										<div class="label_text">
											EUR
										</div>
									</label>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="donate_box mb-30">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="moneyDonation" value='100' id="hundred_doller">
									<label class="form-check-label d-flex justify-content-between" for="hundred_doller">
										<div class="label_text">
											€100.00
										</div>
										<div class="label_text">
											EUR
										</div>
									</label>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="donate_box">
								<div class="form-check">
									<input type="radio" class="form-check-input" name="moneyDonation" value='250' id="two_fifty__doller">
									<label class="form-check-label d-flex justify-content-between" for="two_fifty__doller">
										<div class="label_text">
											€250.00
										</div>
										<div class="label_text">
											EUR
										</div>
									</label>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="donate_box">
								<div class="form-group">
									<input type="number" placeholder="Other" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Other'"  name='customMoneyDonation' class="form-control">
									<span class="fs-14">EUR</span>
								</div>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="donate_box">
								<button type="submit" class="main_btn w-100">donate now</button>
							</div>
						</div>
					</div>
				</form>
        <br />
        <h3 style="text-align:center;">Or Create Quote For Materials</h3>
        <br />
        <!-- <form method="post">
          <div class="row">
            <label>Create Quote For</label>
            <select class="single-input space" name="materialType">
              <option>
                Floor Tiles
              </option>
            </select>
            <label>Is it a donation?</label>
            <select class="single-input space" onchange="sheesh()" id='donation' name="donation">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>
            <label>Amount Of Materials</label>
            <input class="single-input space" type="number" placeholder="Amount of materials" name='amountOfMaterials'/>
            <label>Quote €</label>
            <input class="single-input space" type="number" id='quote' placeholder="Total Quote in EUR" name='totalQuote' />
            <label>Message</label>
            <textarea class="single-input space" name='message' placeholder="Enter a message..."></textarea>
            <input type='submit' class="main_btn2" value='Send Quote'/>

        </div>
        </form> -->
        <p>
          Sending quotes is currently under maintenance
        </p>


			</div>
		</div>
	</section>

<script>
function sheesh(){
var getDonation=document.getElementById("donation");
var donation=getDonation.options[getDonation.selectedIndex].value;
if (donation=="Yes"){
  document.getElementById('quote').value='';
  document.getElementById('quote').disabled = true;
  document.getElementById('quote').style.backgroundColor='#DCDAD1';
 }else {
   document.getElementById('quote').disabled = false;
   document.getElementById('quote').style.backgroundColor='#f9f9ff';

}
}
sheesh();

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
