<?php
include 'db.php';
include 'auth.php';
require 'vendor/autoload.php';

if(isset($_SESSION['cart']['causeID']) and isset($_SESSION['cart']['causeID'])){

  $id=$_SESSION['cart']['causeID'];
  $amount=$_SESSION['cart']['amount'];



}else {
  header('location: causes.php');
}
$stripeTotal=(string) $amount*100;


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



if(isset($_POST['moneyDonation'])){
  $amount=$_POST['moneyDonation'];
  if(isNumeric($amount)){
    $nAmount=round($amount,2);

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
					<h1>Make a donation to <?php echo "<a class='niceColor' href='causeDetails.php?id=".$id."'>".$title."</a>";?> </h1>
					<p>
						<?php echo $smallDescription;?>
					</p>
				</div>
			</div>

			<div class="donate_now_wrapper">
        <h3>Total: €<?php echo $amount;?></h3>

        <!-- <form id="payment-form">
          </div>
          <button id="submit">
            <div class="spinner hidden" id="spinner"></div>
            <span id="button-text">Pay</span>
          </button>
          <p id="card-error" role="alert"></p>
          <p class="result-message hidden">
            Payment succeeded, see the result in your
            <a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
          </p>
        </form> -->

        <form id="payment-form">
          <div id="card-element"><!--Stripe.js injects the Card Element--></div>
          <button class='main_btn2' id="submit">Donate</button>
          <p id="card-error" role="alert"></p>

        </form>
        <div id="payment-request-button">
  <!-- A Stripe Element will be inserted here. -->
</div>


			</div>
		</div>
	</section>

<script>
var stripe = Stripe("pk_test_51HfjfvFlRiSAml4op09N2R4XotgttOewNsMNAKnFObTf7tkKc5eNOz7xgvfC99AzNyGD99i9UrGgzx8ilYSWdj0K00nFYvG0Qb");

// The items the customer wants to buy
var purchase = {
  items: [{ id: "Donation" }]
};

// Disable the button until we have Stripe set up on the page
document.querySelector("button").disabled = true;
fetch("/create.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(purchase)
})
  .then(function(result) {
    return result.json();
  })
  .then(function(data) {
    var elements = stripe.elements();

    var style = {
      base: {
        color: "#32325d",
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
          color: "#32325d"
        }
      },
      invalid: {
        fontFamily: 'Arial, sans-serif',
        color: "#fa755a",
        iconColor: "#fa755a"
      }

    };

    var card = elements.create("card", { style: style,hidePostalCode: true,
 });
    // Stripe injects an iframe into the DOM
    card.mount("#card-element");

    card.on("change", function (event) {
      // Disable the Pay button if there are no card details in the Element
      document.querySelector("button").disabled = event.empty;
      document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
    });

    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function(event) {
      event.preventDefault();
      // Complete payment when the submit button is clicked
      payWithCard(stripe, card, data.clientSecret);
    });
  });
  var stripeTotal=<?php echo $stripeTotal; ?>;

  var paymentRequest = stripe.paymentRequest({
    country: 'CY',
    currency: 'eur',
    total: {
      label: 'Le Port Cy',
      amount: stripeTotal,
    },
    requestPayerName: true,
    requestPayerEmail: true,
  });

  var elements = stripe.elements();
var prButton = elements.create('paymentRequestButton', {
  paymentRequest: paymentRequest,
});

// Check the availability of the Payment Request API first.
paymentRequest.canMakePayment().then(function(result) {
  if (result) {
    prButton.mount('#payment-request-button');
  } else {
    document.getElementById('payment-request-button').style.display = 'none';
  }
});


// Calls stripe.confirmCardPayment
// If the card requires authentication Stripe shows a pop-up modal to
// prompt the user to enter authentication details without leaving your page.
var payWithCard = function(stripe, card, clientSecret) {
  loading(true);
  stripe
    .confirmCardPayment(clientSecret, {
      payment_method: {
        card: card
      }
    })
    .then(function(result) {
      if (result.error) {
        // Show error to your customer
        showError(result.error.message);
      } else {
        // The payment succeeded!
        location.href='thank-you.php?c='+result.paymentIntent.id;
        // orderComplete(result.paymentIntent.id);
      }
    });
};

/* ------- UI helpers ------- */

// Shows a success message when the payment is complete
// var orderComplete = function(paymentIntentId) {
//
//   window.location.href='thank-you.php';
// };

// Show the customer the error from Stripe if their card fails to charge
var showError = function(errorMsgText) {
  loading(false);
  var errorMsg = document.querySelector("#card-error");
  errorMsg.textContent = errorMsgText;
  setTimeout(function() {
    errorMsg.textContent = "";
  }, 4000);
};
function loading(sheehs){

}
// Show a spinner on payment submission
// var loading = function(isLoading) {
//   if (isLoading) {
//     // Disable the button and show a spinner
//     document.querySelector("button").disabled = true;
//     // document.querySelector("#spinner").classList.remove("hidden");
//     document.querySelector("#button-text").classList.add("hidden");
//   } else {
//     document.querySelector("button").disabled = false;
//     // document.querySelector("#spinner").classList.add("hidden");
//     document.querySelector("#button-text").classList.remove("hidden");
//   }
// };




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
