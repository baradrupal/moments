<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<script src="js/squel.min.js" type="text/javascript"></script>
    <?php include("head.php"); ?>
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
                    <a href="#">Dashboard</a>
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
                    <h2><i class="glyphicon glyphicon-edit"></i> Add Testimonial</h2>
    
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
                    <form role="form" action="testimonial_insert.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Client Name:- </label>
                
                                    <div class="controls">
                                        <input type="text" name="client_name" class="form-control" placeholder="Enter Client Name" /> 
                                    </div>
                                </div>
                            </div>
						</div>
                        <br />
                        
                        <div class="row">      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Client Logo</label>
                                    <input type="file" name="photo" class="form-control" id="exampleInputEmail1" >
                                </div>
                            </div>
                        </div>
                        <br />
                        
                        <div class="row">      
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Message</label>
                                    <textarea name="message" style="display: block;" rows="5" cols="70"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <br />
                        
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                    </form>
    
                </div>
            </div>
        </div>
        <!--/span-->
    
    </div><!--/row-->

    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Manage Testimonials</h2>

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
            
                <table id="txtHint" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                	<thead>
                        <tr>
                            <th>No</th>	
                            <th>Name</th>	
                            <th>Image</th>
                            <th>Message</th>	
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
						$query = "SELECT `testi_id`, `name`, `image`, `description` FROM `testimonial`";
						$stmt = $conn->prepare($query);
						if($stmt) 
						{	
							$stmt->execute();
							$stmt->bind_result($testi_id, $name, $image, $description);
							$stmt->store_result();
							$i=1;
							while ($stmt->fetch()) 
							{	
					?>
                            <tr>
                                <td><?php echo $i; $i++;?> </td>
                                <td><?php echo $name; ?> </td>
                                <td><img src="../upload/testimonial/<?php echo $image; ?>" width="100" height="100" ></td>
                                <td><?php echo $description; ?></td>
                                <td class="center">
                                   <a class="btn btn-primary" href="testimonial_edit.php?id=<?php echo $testi_id; ?>">
                                        Edit
                                   </a>
                                   <a class="btn btn-danger" href="testimonial_delete.php?id=<?php echo $testi_id; ?>">
                                        Delete
                                   </a>
                                </td>
                            </tr>
                            <?php
					
								}
							}
							$stmt->close();
							?>	
                    </tbody>
         			    
            	</table>
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
//		$(document).ready(function() {
//			$('#txtHint').DataTable( {
//				//aaSorting : [[0, 'desc']]
//			} );
//		} );
	</script>
</body>
</html>
<?php
	}
	else
	{
		header("Location:index.php");
	}
?>