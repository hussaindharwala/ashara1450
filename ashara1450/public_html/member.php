<?php
//include auth_session.php file on all user panel pages
// include("api/auth_session.php");
// session_start();
include('api/memberDetails.php');
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
      <title>Members</title>
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
      <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="people-nearby">
              <?php
                if(is_array($fetchData)){      
                $sn=1;
                foreach($fetchData as $data){
              ?>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src=<?php echo $data['member_avatar'];?> alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                     <h5><a href="#" class="profile-link"><?php echo $data['member_name']??''; ?></a></h5>
                    <h6>Amount Pending: <?php echo $data['pending_amount']??''; ?></h6>
                    <h6><?php echo $data['member_occupation'];?></h6>
                    <h6 class="text-muted"><?php echo $data['member_address'];?></h6>
                  </div>
                  <form action="api/getTransaction.php" method="POST"> 
                      <input name="member_id" type="hidden"  value=<?php echo $data['member_id'];?>/>
                      <button class="btn btn-primary pull-right">Get Statement CSV</button>
                   </form> 
                  <div class="col-md-3 col-sm-3">
                   <form action="viewStatment.php" method="POST"> 
                    <input name="member_id" type="hidden" value=<?php echo $data['member_id'];?>/>
                    <button class="btn btn-primary pull-right">View Statement</button>
                   </form> 
                  </div>
                </div>
              </div>
              <?php
              }}else{ ?> <p>no data found</p>
              <?php
            }?>
              <!-- <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Mohammed Bharmal</a></h5>
                    <p>EXTC Engineer</p>
                    <p class="text-muted">London</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar5.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Mufaddal Umreth</a></h5>
                    <p>Airport Staff</p>
                    <p class="text-muted">Qatar</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Mustufa Kheroda</a></h5>
                    <p>Digital Marketting Manager</p>
                    <p class="text-muted">Bhayander</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Hussain Dahod</a></h5>
                    <p>Accountant</p>
                    <p class="text-muted">Dubai</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Burhanuddin Wadgam</a></h5>
                    <p>Event Manager</p>
                    <p class="text-muted">Mira Road</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Hussain Kapasi</a></h5>
                    <p>Business</p>
                    <p class="text-muted">Bhayander</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar8.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Burhanuddin Norawala</a></h5>
                    <p>Salesman/Nutritionist</p>
                    <p class="text-muted">Bhayander</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Burhanuddin Kadiyani</a></h5>
                    <p>Businessr</p>
                    <p class="text-muted">Bhayander</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Murtaza Moiyadi</a></h5>
                    <p>Student MBBS Gov College</p>
                    <p class="text-muted">Bhayander</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar4.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Taher Kota</a></h5>
                    <p>Business</p>
                    <p class="text-muted">Bhayander</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div>
              <div class="nearby-user">
                <div class="row">
                  <div class="col-md-2 col-sm-2">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="user" class="profile-photo-lg">
                  </div>
                  <div class="col-md-7 col-sm-7">
                    <h5><a href="#" class="profile-link">Ali Asgar Nagar</a></h5>
                    <p>Pharmasict</p>
                    <p class="text-muted">Mira Road</p>
                  </div>
                  <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Nudge</button>
                  </div>
                </div>
              </div> -->
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

