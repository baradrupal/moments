<?php
	/*session_start();
	if(isset($_SESSION['admin_name']))
	{*/
		include("connectionpool.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<script src="js/squel.min.js" type="text/javascript"></script>
    <?php include("head.php"); ?>
</head>
<body>

	<!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            	
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Upscale 
                <span></span> </a>

            <!-- user dropdown starts -->
            <!--<div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php //echo $_SESSION['admin_name']; ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                   
                    <li><a href="admin_logout.php">Logout</a></li>
                </ul>
            </div>-->
            <!-- user dropdown ends -->


            <ul class="collapse navbar-collapse nav navbar-nav top-menu pull-right">
               
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
    
<div class="ch-container">
	
    <div class="row">

		<!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li><a class="ajax-link" href="terms.php"><i class="glyphicon glyphicon-calendar"></i><span> Terms & Conditions</span></a>
                        </li>
                        <li><a class="ajax-link" href="privacy.php"><i class="glyphicon glyphicon-calendar"></i><span> Privacy Policy</span></a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->
        

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
        <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li> 
                    <a href="#" style="color:#F00 !important"> <?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?> </a>
                </li>
            </ul>
        </div>

	<?php //include("top.php"); ?>
 
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Terms & Conditions</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>      
  
  			<div class="box-content">
            
            	<p>شكرا لإختيارك تطبيق  هايڤ و الذي سيعرف في هذا النموذج بإسم " التطبيق" , إن تطبيق هايڤ مملوك لشركة  آبسكيل و المسجلة في المملكه العربيه السعوديه لذا نرجو منك قراءة شروط إستخدام و تحميل تطبيق  هايڤ قبل ان تضغط على زر " موافق" او تحميل التطبيق لتكون على معرفة  كاملة قبل استخدام خدمات تطبيقاتنا و عليه نحن مستعدون لتفعيل خدمة هذا التطبيق الذي نقدمه لكم فقط على شرط ان تقبل شروط إستخدام تطبيق  هايڤ  بالضغط على زر أوافق، تشير إلى أنك قد فهمت  شروط الاستخدام و تم قبول </p>


				<p>إن سياسة الخصوصية المتاحة في تطبيق  هايڤ  تمنحنا الإمكانية بعرض الصور التى تحملها عبر التطبيق على كافة مستخدمي التطبيق و نضمن لك سرية  معلوماتك المسجلة على حسابك و عدم بيعها / إستخدامها من قبلنا لأي سبب تجاري إضافة الى موافقتك على إستقبال إيميلات و تنبيهات عبر التطبيق.</p>

				<p>من أجل استخدام التطبيق و ميزات معينة من الخدمة، يجب تسجيل وفتح حساب معنا. أنت مسؤول عن الحفاظ على سرية ورصد كل نشاط تحت حسابك، وتتحمل المسؤولية الكاملة عن جميع النشاطات التي تحدث تحت حسابك، نحن تحتفظ لنفسها بالحق في تعليق أو إنهاء حسابك في أي وقت، وأن تتحمل أية مسؤولية عن مثل هذا التعليق أو الإنهاء.</p>





				<p>By downloading or using the app, these terms will automatically apply to you – you should make sure therefore that you read them carefully before using the app. We are offering you this app to use for your own personal use without cost, but you should be aware that you cannot send it on to anyone else, and you’re not allowed to copy, or modify the app, any part of the app, or our trademarks in any way. You’re not allowed to attempt to extract the source code of the app, and you also shouldn’t try to translate the app into other languages, or make derivative versions. The app itself, and all the trade marks, copyright, database rights and other intellectual property rights related to it, still belong to Hive.</p>

				<p>At the bottom of these terms and conditions you will be able to find links to our website where we set out our Privacy Policy, Acceptable Use of the app, and the general Terms and Conditions for Guest & Visitors, which will be relevant if you use the app to book visits with Hive in the future.</p>

				<p>Hive is committed to ensuring that the app is as useful and efficient as possible. For that reason, we reserve the right to make changes to the app or to charge for its services, at any time and for any reason. We will never charge you for the app or its services without making it very clear to you exactly what you’re paying for </p>
                
			</div><!--/box-->
		</div>
	</div>	
</div><!--/row-->

</div><!--/fluid-row-->

    <hr>
    
   	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
     
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>

</div><!--/.fluid-container-->

	<?php include("js.php"); ?>
	<script type="text/javascript">
		/*$(document).ready(function() {
			$('#txtHint').DataTable( {
				aaSorting : [[0, 'desc']]
			} );
		} );*/
	</script>
</body>
</html>
<?php
	/*}
	else
	{
		header("Location:index.php");
	}*/
?>