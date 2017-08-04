<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
	<?php include("head.php"); ?>
    <!--<script language="javascript" src="admin/js/valid.js">
	</script>-->
    
    <script type="text/javascript">
		function abcd(str)
		{
			alert(str);
			if(str=="freshers")
			{
				alert("Hello World!");
				other.style.visibility="visible";
			}
			else
			{
				other.style.visibility="hidden";
			}	
		}


function checkpass(val)
{
	if(val.length<8)
	{
		document.getElementById('divPass').innerHTML="Password must be 8 chars long.";
		return false;
	}
	else
	{	
		document.getElementById('divPass').innerHTML="";
		return true;
	}
	
	
}

function checkrepass(p1,p2)
{
	//alert('hello');
	if(p1!=p2)
	{
		document.getElementById('divRPass').innerHTML="Password do not match...";
		//alert("Password not match");
		return false;
	}
	else
	{	
		document.getElementById('divRPass').innerHTML="";
		return true;
	}
	
}

	
	</script>
    
</head>

<body>
    <?php include("header.php"); ?>
    
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
            <a href="#">Change Password</a>
        </li>
        <li> 
			<a href="#" style="color:#F00 !important"> <?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?> </a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Change Password</h2>

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
            
                <form role="form" action="change_password_code.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                              
                                <label for="exampleInputEmail1">Old Password</label>
                                
                                	<span style="color:#FF0000" id="divCPass"></span>
                                
                                <input type="password" name="oldpass" class="form-control" id="exampleInputEmail1" >
                                
                            </div>
                        </div>
                      </div>
                     
                      <div class="row">  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Password</label>
                                
                                	<span style="color:#FF0000" id="divPass"></span>
                                
                                <input type="password" name="newpass" class="form-control" id="newpas" onBlur="checkpass(this.value);">
                            </div>
                        </div>
                       </div>
                       <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Re-Enter Passwod</label>
                                
                                	<span style="color:#FF0000" id="divRPass"></span>
                               
                                  <input type="password" name="repass" class="form-control" id="repass" onBlur="checkrepass(this.value,newpas.value);" >
                            </div>
                        </div>                       
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                </form>
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