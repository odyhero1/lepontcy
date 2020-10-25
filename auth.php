<?php
if(!(isset($_SESSION['loggedIn'])) and $_SESSION['loggedIn']!=true){
  header('location: ../sign-in');

}

  ?>
