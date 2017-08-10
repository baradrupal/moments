<?php  session_start();
if(!$_SESSION['login_user']) {
    header("location:index.php");
}
include './leftmenu.php';
?>
<div class="be-content">
    <div class="main-content container-fluid" style="top: 10%;">
        <center>
            <img src="images/logo.png" class="img-responsive" style="width: 50% !important;">
        </center>
    </div>
</div>
<?php include './footer.php'; ?>