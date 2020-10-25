<header class="header_area">
  <div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand logo_h" href="index.php">
          <img src="img/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
         aria-expanded="false" aria-label="Toggle navigation">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
          <div class="row ml-0 w-100">
            <div class="col-lg-12 pr-0">
              <ul class="nav navbar-nav center_nav pull-right">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">home</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="causes.php">causes</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="dashboard/">my causes</a>
                </li>
                <!-- <li class="nav-item ">
                  <a class="nav-link" href="events.php">events</a>
                </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="blog.php">Blog</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <?php if($loggedIn==true){
                    echo '<a class="main_btn" href="../my-account.php">My Account</a>';
                  }else{
                    echo '<a class="main_btn" href="../sign-in">Login</a>';
                  }
                  ?>
                 </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</header>
