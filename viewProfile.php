<?php
include 'db.php';
if(isset($_GET['user'])){
  $id=$_GET['user'];
}else {
  header('location: donors.php');
}
$getUserDetails=mysqli_query($con,"SELECT * from users where id='$id'");
if(mysqli_num_rows($getUserDetails) ==0){
  header('location: donors.php');
}
$userDetails=mysqli_fetch_assoc($getUserDetails);
$img=$userDetails['icon'];
$name=$userDetails['name'];
$bio=nl2br($userDetails['description']);
$totalDonated=$userDetails['totalDonated'];
// $goal=$userDetails['goal'];
// $dateAdded=date('j-M-y',strtotime($userDetails['dateAdded']));
$location=$userDetails['country'];
$rows=[];

$getDonations=mysqli_query($con,"SELECT donations.userID,requests.id,requests.title,requests.smallDescription,requests.thumbnail,requests.percentage,requests.goal,requests.location,requests.dateAdded from donations inner join requests on requests.id=donations.causeID where donations.userID='$id' order by donations.donationAmount desc ");
while($donation=mysqli_fetch_assoc($getDonations)){
  // var_dump($donation);
  $donationID=$donation['id'];

if(empty($rows)){

  $rows['id'][]=$donation['id'];
  $rows['thumbnail'][]=$donation['thumbnail'];
  $rows['percentage'][]=$donation['percentage'];
  $rows['title'][]=$donation['title'];
  $rows['smallDescription'][]=$donation['smallDescription'];
  $rows['dateAdded'][]=$donation['dateAdded'];
  $rows['goal'][]=$donation['goal'];
} else {

$fuckoff=false;
  $count=count($rows['id']);

    for ($b=0;$b < $count;$b++){
      if($rows['id'][$b]==$donationID){
        $fuckoff[$donationID]=true;


      }else {

      }
    }
      if(!(isset($fuckoff[$donationID]))){

        $rows['id'][]=$donation['id'];
        $rows['thumbnail'][]=$donation['thumbnail'];
        $rows['percentage'][]=$donation['percentage'];
        $rows['title'][]=$donation['title'];
        $rows['smallDescription'][]=$donation['smallDescription'];
        $rows['dateAdded'][]=$donation['dateAdded'];
        $rows['goal'][]=$donation['goal'];
      }

    }
    // var_dump($fuckoff);





 // var_dump($rows);
}
$count=count($rows['id']);
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
					<h2>Donor Details</h2>
					<div class="page_link">
						<a href="index.php">Home</a>
						<a href="causes.php">Donors</a>
						<a>Donor details</a>
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



         </div>
			</div>

			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="event_content">
						<div class="row">
							<div class="col-lg-4">
								<div class="left_content">
								<img src="'.$img.'" alt="" class="img-fluid space " style="width:100%">
									<p>
										<i class="lnr lnr-location"></i>
										'.$location.'
									</p>

								</div>
							</div>
							<div class="col-lg-8">
								<div class="right_content">
									<h3>'.$name.'</h3>
									<p>'.$bio.'</p>
                  <h3>Top Donations</h3>';
                  // $getDonations=mysqli_query($con,"SELECT donations.userID,requests.id,requests.title,requests.smallDescription,requests.thumbnail,requests.percentage,requests.goal,requests.location,requests.dateAdded from donations inner join requests on requests.id=donations.causeID where donations.userID='$id' order by donations.donationAmount desc ");

                  for($x=0;$x < $count;$x++){
                    $img=$rows['thumbnail'][$x];
                    $percentage=$rows['percentage'][$x];
                    $goal=$rows['goal'][$x];
                    $title=$rows['title'][$x];
                    $smallDescription=$rows['smallDescription'][$x];
                    $id=$rows['id'][$x];
                    $dateAdded=date('j-M-y',strtotime($rows['dateAdded'][$x]));
                    $getAllDonations=mysqli_query($con,"SELECT SUM(donationAmount) from donations where causeID='$id'  ");
                    $donationDetails=mysqli_fetch_assoc($getAllDonations);
                    $totalRaised=$donationDetails['SUM(donationAmount)'];
                    $percentage=($totalRaised/$goal)*100;
                    if($totalRaised==""){
                      $totalRaised=0;
                    }


                  echo '
                  <div class="">
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
                          <a href="causeDetails.php?id='.$id.'" class="main_btn2">View More</a>
                        </div>
                        <p>
                        Date Added: '.$dateAdded.'
                        </p>
                      </div>
                    </div>
                  </div>';

                }



								echo '</div>
							</div>


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
