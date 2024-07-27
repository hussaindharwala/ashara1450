<?php
//include auth_session.php file on all user panel pages
// include("api/auth_session.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Contact</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand"><a href="index.html"><img src="images/logo.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="about.php">About</a>
                  </li>
                 <li class="nav-item">
                     <a class="nav-link" href="member.php">Go to Members</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="contact.php">Contact Us</a>
                  </li>
                  <?php if (isset($_SESSION['username']) == null): ?>
                     <li class="nav-item">  <a class="nav-link" href="https://ashara1450.vercel.app/login.html">Login or Register</a></li>
                 <?php else : ?>
                    <li class="nav-item">
                       <a class="nav-link" href="https://ashara1450.vercel.app/api/logout.php">Log Out</a>
                    </li>
                     <li class="nav-item">
                       <a class="nav-link"><?php echo $_SESSION['username'];?></a>   
                     </li>
                  <?php endif; ?>
               </ul>
            </div>
         </nav>
      </div>
      <!-- header section end -->
      <!-- contact section start -->
      <div class="contact_section layout_padding">
         <div class="container">
            <div class="contact_section_2">
               <div class="row">
                  <div class="col-md-6">
                     <div class="mail_section_1">
                        <h1 class="contact_taital">Contact Us</h1>
                        <input type="text" class="mail_text_1" placeholder="Name" name="text">
                        <input type="text" class="mail_text_1" placeholder="Email" name="text">
                        <input type="text" class="mail_text_1" placeholder="Phone Number" name="text">
                        <textarea class="massage-bt" placeholder="Massage" rows="5" id="comment" name="Massage"></textarea>
                        <div class="send_bt"><a href="#">SEND</a></div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="map_main">
                        <div class="map-responsive">
                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.566277513339!2d72.8491349!3d19.301218700000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b1d287afebb9%3A0x28dd98ea5244d81b!2sD&#39;Cunha%20St%2C%20Bhayandar%2C%20Bhayandar%20West%2C%20Mira%20Bhayandar%2C%20Maharashtra%20401101!5e0!3m2!1sen!2sin!4v1677567729899!5m2!1sen!2sin" width="600" height="360" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- contact section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="footer_logo"><img src="images/footer-logo.png"></div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <h4 class="footer_taital">NAVIGATION</h4>
                  <div class="footer_menu_main">
                     <div class="footer_menu_left">
                        <div class="footer_menu">
                           <ul>
                              <li><a href="index.php">Home</a></li>
                              <li><a href="counter.php">Payment</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="footer_menu_right">
                        <div class="footer_menu">
                           <ul>
                              <li><a href="about.php">About</a></li>
                              <li><a href="contact.php">Contact us</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
               </div>
               <div class="col-sm-6 col-md-6 col-lg-3">
                  <h4 class="footer_taital">Address</h4>
                  <p class="footer_text">Bhayander</p>
                  <p class="footer_text">+91 8691923653</p>
                  <p class="footer_text">dharwala.hussain@gmail.com</p>
               </div>
            </div>
            <div class="footer_section_2">
               <div class="row">
                  <div class="col-sm-4 col-md-4 col-lg-3">
                     <div class="social_icon">
                        <ul>
                           <li><a href="#"><img src="images/fb-icon.png"></a></li>
                           <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                           <li><a href="#"><img src="images/linkedin-icon.png"></a></li>
                           <li><a href="#"><img src="images/instagram-icon.png"></a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-sm-8 col-md-8 col-lg-9">
                   
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2023 All Rights Reserved. Design by <a href="https://html.design">Hussain Dharwala</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>

