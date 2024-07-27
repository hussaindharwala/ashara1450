<?php
//include auth_session.php file on all user panel pages
// include("api/auth_session.php");
// session_start();
include('api/getStatment.php');
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
      <title>Statement</title>
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
                     <a class="nav-link" href="member.php">Back to Members</a>
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
      <!-- statement section start -->
      <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> User Account Statement </h3>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Transactions</h4>
                    </p>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Payment ID</th>
                            <th>Payment Amount</th>
                            <th>Payment Source</th>
                            <th>Payment Status</th>
                            <th>Payment Date</th>
							<th>Total Amount Paid</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                              if(is_array($fetchPayment)){      
                              $sn=1;
                              foreach($fetchPayment as $data){
                          ?>  
                          <tr>
                            <td><?php echo $data['payment_id'];?></td>
                            <td><?php echo $data['payment_amount'];?></td>
                            <td><?php echo $data['payment_source'];?></td>
                            <td><?php echo $data['payment_status'];?></td>
                            <td><?php echo $data['payment_date'];?></td>
							<td><?php echo round($data['payment_tot_amount'],2);?></td>
                          </tr>
                           <?php
              }}else{ ?> <td>No Data Found</td>
              <?php
            }?>
                        </tbody>
                      </table>
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

