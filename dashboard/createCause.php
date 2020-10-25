<?php
include '../db.php';
include '../auth.php';

if(isset($_POST['upload'])){
  $location=$_POST['location'];
  $title=$_POST['title'];
  $largeDescription=$_POST['largeDescription'];
  $smallDescription=$_POST['smallDescription'];
  $goal=$_POST['goal'];

  if (isset($_FILES['thumbnail']['name'])){

 // Where the file is going to be stored
 $target_dir = "../images/";
 $file = $_FILES['thumbnail']['name'];
 $path = pathinfo($file);
 $filename = bin2hex(openssl_random_pseudo_bytes(15));

 $ext = $path['extension'];
 $temp_name = $_FILES['thumbnail']['tmp_name'];
 $path_filename_ext = $target_dir.$filename.".".$ext;
 $thumbnail=$path_filename_ext;

 // Check if file already exists

 move_uploaded_file($temp_name,$path_filename_ext);

 $img = new Imagick(realpath($path_filename_ext));
 $profiles = $img->getImageProfiles("icc", true);

 $img->stripImage();
 $img->scaleImage(750, 750, true);

 //
 $img->writeImage();
 if(!empty($profiles)) {
    $img->profileImage("icc", $profiles['icc']);

 }

 }


  mysqli_query($con,"INSERT into requests (title,location,largeDescription,smallDescription,goal,dateAdded,userID,thumbnail) values ('$title','$location','$largeDescription','$smallDescription','$goal','$date','$userID','$thumbnail') ");
  $getID=mysqli_query($con,"SELECT * from requests where thumbnail='$thumbnail'");
  $extractID=mysqli_fetch_assoc($getID);
  $id=$extractID['id'];
  header('location: editCauseDetails.php?id='.$id);
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
	<?php include '../sign-in/navbar.php';?>
	<!--================Header Menu Area =================-->

	<!--================ Banner Area =================-->
	<section class="banner_area">
		<div class="banner_inner d-flex align-items-center">
			<div class="overlay"></div>
			<div class="container">
				<div class="banner_content text-center">
					<h2>Create Cause</h2>
					<div class="page_link">
						<a href="index.php">Home</a>
						<a href="/dashboard">Causes</a>
						<a>Create Cause</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Banner Area =================-->


	<!--================ Start Recent Event Area =================-->
  <?php
echo '<form method="post" enctype="multipart/form-data">

';

  echo '
	<section class="event_details section_gap">
		<div class="container">
			<div class="row">
      <label>Upload Thumbnail</label>
				<input type="file" accept="image/*" required class="single-input space" name="thumbnail" />



         </div>
			</div>

			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="event_content">
						<div class="row">
							<div class="col-lg-4">
								<div class="left_content">

									<p>
										<i class="lnr lnr-location"></i>
									<input type="text" class="single-input" required placeholder="Location"	name="location" required />
									</p>

								</div>
							</div>
							<div class="col-lg-8">
								<div class="right_content">
                <label>Title</label>
						<h3>		<input type="text" class="single-input space" placeholder="Title"  name="title" maxlength="50" required /></h3>
            <label>Small Description</label>
            <input type="text" class="single-input space" placeholder="Small Description"  name="smallDescription" required maxlength="156" />
            <label>Goal</label>
            €<input type="number" class="single-input space" placeholder="Goal" name="goal" required  />
            <label>Large Description</label>

									<textarea type="text" class="single-input space" placeholder="Description" required name="largeDescription" ></textarea>
								</div>
							</div>
              <input type="submit" class="genric-btn primary radius" name="upload" value="Save">

						</div>
					</div>
				</div>
			</div>
		</div>
	</section></form>
  ';



  ?>
	<!--================ End Recent Event Area =================-->

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
