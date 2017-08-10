<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>Moments | Admin </title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/jqvmap/jqvmap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/animate.min.css">
    <script type="text/javascript" src="js/WOW.js"></script>
    <!-- Google Font Link -->    
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">      
  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
            <div class="navbar-header"><a href="home.php" class="navbar-brand"><img src="images/logo.png" class="img-responsive" width="100px"></a></div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
                <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="images/favicon.ico" alt="Avatar"><span class="user-name">Moments</span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name"><?php echo $_SESSION['login_user']; ?></div>
                      <div class="user-position online">Available</div>
                    </div>
                  </li>
                  <!--<li><a href="#"><span class="icon mdi mdi-face"></span> Account</a></li>
                  <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li>-->
                  <li><a href="logout.php"><span class="icon mdi mdi-power"></span> Logout</a></li>
                </ul>
              </li>
            </ul>
              <div class="page-title"><span>Wel-come &nbsp;Admin&nbsp; <strong class="wow fadeIn" wow-duration="2s"><?php echo $_SESSION['login_user']; ?></strong></span></div>
            <ul class="nav navbar-nav navbar-right be-icons-nav">
<!--              <li class="dropdown"><a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar">
                      <span class="icon mdi mdi-settings"></span></a>
              </li>-->
            </ul>
          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">Menu</li>
                  <li class=""><a href="home.php"><i class="icon mdi mdi-home"></i><span>Dashboard</span></a>
                  </li>
                  <!--<li class="parent"><a href="#"><i class="icon mdi mdi-collection-plus"></i><span>Main Folders</span></a>
                    <ul class="sub-menu">
                        <li><a href="add_folder.php">Add Main Folder</a>
                      </li>
                     </ul>
                  </li>-->
                  
                  <li class="parent"><a href="#"><i class="icon mdi mdi-collection-plus"></i><span>Sub Folders</span></a>
                    <ul class="sub-menu">
                        <li><a href="add_sub_folder.php">Add Sub Folder</a>
                      </li>
                     </ul>
                  </li>
                  
                  <li class="parent"><a href="#"><i class="icon mdi mdi-collection-plus"></i><span>Gallery</span></a>
                    <ul class="sub-menu">
                        <li><a href="add_folder_images.php">Add Gallery</a>
                      </li>
                     </ul>
                  </li>
                  
                 <!-- <li class="parent"><a href="#"><i class="icon mdi mdi-dot-circle"></i><span>About Us</span></a>
                    <ul class="sub-menu">
                       <!-- <li><a href="add_profile.php">Add Profile</a></li>-->
                     <!-- <li><a href="add_vission_mision.php">Add Vision & Mission</a></li>                
                    </ul>
                  </li>
                  <li class="parent"><a href="#"><i class="icon mdi mdi-border-all"></i><span> Events</span></a>
                    <ul class="sub-menu">
                      <li><a href="add_past_events.php">Add Past Event</a></li>
                      <li><a href="add_upcoming_events.php">Add Upcoming Events</a></li>
                     </ul>
                  </li>
                  
                  <li class="parent"><a href="#"><i class="icon mdi mdi-collection-plus"></i><span>Awards</span></a>
                    <ul class="sub-menu">
                        <li><a href="add_awards.php">Add New Awards</a>
                      </li>
                     </ul>
                  </li>
                  <li class="parent"><a href="#"><i class="icon mdi mdi-collection-plus"></i><span>Certificate</span></a>
                    <ul class="sub-menu">
                        <li><a href="add-certificate.php">Add New Certificate</a>
                      </li>
                     </ul>
                  </li>-->
                  
                  <!--<li class="parent"><a href="#"><i class="icon mdi mdi-border-all"></i><span> Gallery</span></a>
                    <ul class="sub-menu">
                      <li><a href="add_gallery.php">Add Gallery</a></li>
                   
                     </ul>
                  </li>-->
                  
                  <!--<li class="parent"><a href="#"><i class="icon mdi mdi-collection-plus"></i><span>Download</span></a>
                    <ul class="sub-menu">
                        <li><a href="add_download.php">Add New Download</a>
                      </li>
                     </ul>
                  </li>
                  
                  <li class="divider">Features</li>
                  <li class=""><a href="contact.php"><i class="icon mdi mdi-email"></i><span>Contact</span></a></li>
                  
                  <li class=""><a href="feedback.php"><i class="icon mdi mdi-email"></i><span>Feedback</span></a></li>
                  
                     <li class=""><a href="products_inquiry.php"><i class="icon mdi mdi-email"></i><span>Products Inquiry</span></a></li>-->
                  
                  
                </ul>
              </div>
            </div>
          </div>
          <div class="progress-widget">
            <div class="progress-data"><span class="progress-value">60%</span><span class="name">Current Project</span></div>
            <div class="progress">
              <div style="width: 80%;" class="progress-bar progress-bar-primary"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">
        <div class="main-content container-fluid">

        </div>
      </div>
     