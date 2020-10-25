<?php
include 'db.php';
require 'vendor/autoload.php';
// This is your real test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51HfjfvFlRiSAml4o2947e92nfHmOZcclR2WfD9qPvertBsIu5nUvbmQb0fUjGH5R9moGm9uF7v8lv74T0fqU0yJY00UOt5JpNY');

if(isset($_SESSION['cart']['causeID']) and isset($_SESSION['cart']['causeID'])){

  $id=$_SESSION['cart']['causeID'];
  $amount=$_SESSION['cart']['amount'];



}


$stripeTotal=$amount*100;
$paymentIntent = \Stripe\PaymentIntent::create([
  'amount' => $stripeTotal,
  'currency' => 'eur',
]);
$output = [
  'clientSecret' => $paymentIntent->client_secret,
];






  header('Content-Type: application/json');

  echo json_encode($output);

 ?>
