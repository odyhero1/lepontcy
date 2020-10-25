<?php
include 'db.php';
include 'auth.php';

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

$countries=['Cyprus','Lebanon'];

$getUser=mysqli_query($con,"SELECT * from users where id='$userID'");
$userDetails=mysqli_fetch_assoc($getUser);
$name=$userDetails['name'];
$phone=$userDetails['phone'];
$description=$userDetails['description'];
$country=$userDetails['country'];
$icon=$userDetails['icon'];


$count=count($countries);
if(isset($_POST['upload'])){
  $name=$_POST['name'];
  $phone=$_POST['phone'];
  $country=$_POST['country'];
  $description=$_POST['description'];


  if (isset($_FILES['thumbnail']['name'])){
    if($_FILES['thumbnail']['name']!=""){
 // Where the file is going to be stored
 $target_dir = "images/";
 $file = $_FILES['thumbnail']['name'];
 $path = pathinfo($file);
 $filename = bin2hex(openssl_random_pseudo_bytes(15));

 $ext = $path['extension'];
 $temp_name = $_FILES['thumbnail']['tmp_name'];
 $path_filename_ext = $target_dir.$filename.".".$ext;
 $thumbnail=$path_filename_ext;

 // Check if file already exists

 $brr=move_uploaded_file($temp_name,$path_filename_ext);

 $img = new Imagick(realpath($path_filename_ext));
 $profiles = $img->getImageProfiles("icc", true);

 $img->stripImage();
 $img->scaleImage(320, 220, true);

 //
 $img->writeImage();
 if(!empty($profiles)) {
    $img->profileImage("icc", $profiles['icc']);

 }
}

 }

if(isset($thumbnail)){
  mysqli_query($con,"UPDATE users set name='$name',phone='$phone',country='$country',description='$description',icon='$thumbnail' where id='$userID'");

}else {
   mysqli_query($con,"UPDATE users set name='$name',phone='$phone',country='$country',description='$description' where id='$userID'");

}

  header('location: my-account.php');
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
					<h2>My Account</h2>
					<div class="page_link">
						<a href="index.php">Home</a>
						<a>My Account</a>

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
      <div class="col-lg-8 offset-lg-2">


</div>
         </div>
			</div>

			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="event_content">
						<div class="row">
							<div class="col-lg-4">
								<div class="left_content">
                <img src="'.$icon.'" style="width:100%;" />



								</div>
							</div>
							<div class="col-lg-8">
								<div class="right_content">
                <label>Name</label>
						<h3>		<input type="text" class="single-input space" placeholder="Name" value="'.$name.'" name="name" maxlength="50" required /></h3>
            <label>Phone</label>
            <input type="number" class="single-input space" placeholder="Phone" value="'.$phone.'" name="phone" required />

            <p>
              <i class="lnr lnr-location"></i>



            <select size="3" class=" single-input space" name="country">
            <option selected value="'.$country.'">'.$country.'</option>

            ';

          for($x=0;$x < $count;$x++){
            if($countries[$x]==$country){

            }else {
            echo '<option value="'.$countries[$x].'">'.$countries[$x].'</option>';
          }

          }

          echo ' </select>

            </p>
            <label>Upload New Icon</label>
              <input type="file" accept="image/*" class="single-input space" name="thumbnail" />
            <label>Bio</label>

									<textarea type="text" class="single-input space" placeholder="Write something about you..."  name="description" >'.$description.'</textarea>
								</div>
                <input type="submit" class="genric-btn primary radius" name="upload" value="Save">

							</div>

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
  <?php include 'footer.php';?>

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
