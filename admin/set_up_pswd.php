<?php include_once 'config.php'; 
session_start();

if(isset($_POST['login-submit']))
{
    $user=$_POST['unm'];
    $pswd=$_POST['pswd'];
    
    $q_select="SELECT * FROM cp_admin WHERE uname='".$user."' AND password='".$pswd."'";
    
    $q_exe=mysqli_query($con,$q_select);
    
    $num=mysqli_num_rows($q_exe);
    
    if($num>0)
        {
        $_SESSION['login_user']= $user;  
        echo $_SESSION['login_user'];
            ?>
            <script>
                window.location='home.php';
            </script>
            <?php
        }
    else{
        ?>
        <script>
            alert('Username and Passwords are wrong.');
            window.location='index.php';
        </script>
         <?php
    }   
    
}
/************ Change Passwords using Forgot passwords *****************/

if(isset($_POST['chng_pswd'])){

//    $f_unm=trim($_POST['funame']);
//    $f_eml=trim($_POST['fuemail']);
    $f_pswd=trim($_POST['pswd']);
    $f_conpswd=trim($_POST['conf_pswd']);
    $eml=$_SESSION['login_user'];
    
        $frgt_pswd="UPDATE cp_admin SET password='".$f_pswd."',conf_pass='".$f_conpswd."' WHERE email='".$eml."')";
        $exe_fpswd=mysqli_query($con,$frgt_pswd);
        print_r($exe_fpswd);exit();
        if($exe_fpswd){
            ?>
        <script>
            window.location='index.php';
        </script>
            <?php
        }
        else{
            ?>
        <script>
            alert('Enter Valide Email and Username.');
            window.location='set_up_pswd.php';
        </script>
            <?php
        }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Potent | Login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="css/animate.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Concert+One|Dosis|Exo+2|Nova+Square|Orbitron|Ubuntu" rel="stylesheet">
        
        <script type="text/javascript" src="js/WOW.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        
        <script type="text/javascript">
        $(function() {
            $('#login-form-link').click(function(e) {
                $("#login-form").delay(100).fadeIn(100);
                        $("#register-form").fadeOut(100);
                        $('#register-form-link').removeClass('active');
                        $(this).addClass('active');
                        e.preventDefault();
                });
                $('#register-form-link').click(function(e) {
                        $("#register-form").delay(100).fadeIn(100);
                        $("#login-form").fadeOut(100);
                        $('#login-form-link').removeClass('active');
                        $(this).addClass('active');
                        e.preventDefault();
                });
        });
        </script>
      </head>
      
<body>
  <div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form" style="display: none;">
                  <img src="images/logo1-potent.png" class="img-responsive"><br>
                  <div class="form-group">
                    <input type="text" name="unm" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="pswd" id="password" tabindex="2" class="form-control" placeholder="Password">
                  </div>
<!--                  <div class="col-xs-6 form-group pull-left checkbox">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label for="checkbox1">Remember Me</label>   
                  </div>-->
                 
                  <div class="col-xs-6 form-group pull-right">     
                        <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                  </div>
                  <div class="col-xs-6 form-group pull-right">     
                      <input type="reset" name="login-clear" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Clear">
                  </div>
              </form>
                <form id="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="frm_reg" method="post" role="form" style="display: block;">
                    <h2><?php echo $_SESSION['login_user']; ?></h2>
                  <div class="form-group">
                    <input type="text" name="pswd" id="username" tabindex="1" class="form-control" placeholder="Passwords" value="">
                  </div>
                  <div class="form-group">
                      <input type="text" name="conf_pswd" id="email" tabindex="1" class="form-control" placeholder="Confirm Passwords" value="">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="chng_pswd" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Change Passwords">
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
            </div>
            <div class="col-xs-6 tabs">
                <a href="#" id="register-form-link"><div class="register">Forget Password?</div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

