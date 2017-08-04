<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("head.php"); ?>

</head>

<body>

    <?php include("header.php"); ?>
    
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <?php include("sidebar.php"); ?>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="#">Gallery</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-picture"></i> theme</h2>

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
                    <br>
                    <ul class="thumbnails gallery">

                    	            <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style1.css">
                                        	<img src="../images/bg_red.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									
                                    <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style2.css">
                                        	<img src="../images/bg_violet.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									
                                    <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style3.css">
                                        	<img src="../images/bg_green.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									
                                    <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style4.css">
                                        	<img src="../images/bg_blue.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									
                                    <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style5.css">
                                        	<img src="../images/bg_orange.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									
                                    <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style6.css">
                                        	<img src="../images/bg_wood.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									
                                    <li id="" class="thumbnail">
                                        <a title="Sample Image 1" href="theme_code.php?theme=style7.css">
                                        	<img src="../images/bg_white.png" alt="Sample Image 1">
                                            
                                        </a>
                                    </li>
									               
                                </ul>
                </div>
            </div>
        </div>
        <!--/span-->

    </div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
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

<!-- external javascript -->

<?php include("js.php"); ?>


</body>
</html>
<?php
	}
	else
	{
		header("Location:index.php");
	}
?>