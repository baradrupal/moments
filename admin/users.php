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

	<?php //include("top.php"); ?>
 
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Manage Users</h2>

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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
						
						$query = "SELECT `app_user_id`, `name`, `phone`, `email`, `reg_time` FROM `app_user` order by `reg_time` desc";
						$stmt = $conn->prepare($query);
						if ($stmt) {
							//$stmt->bind_param("ii", $yearid, $type);
							$stmt->execute();
							$stmt->bind_result($user_id, $name, $phone, $email, $reg_time);
							$stmt->store_result();
							
							while ($stmt->fetch()) 
							{	
					?>
                            <tr>
                            
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo date("d M Y", strtotime($reg_time)); ?></td>
                           	<td class="center"> &nbsp;
                               <!-- <a class="btn btn-info" href="pic_view.php?id=<?php echo $story_id; ?>">
                                   <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                                   Photos
                                </a>
                                <a class="btn btn-success" href="news_edit.php?id=<?php echo $story_id; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>-->
                               
                               	<!--<a class="btn btn-info" href="story_edit.php?id=<?php echo $story_id; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger" href="story_delete.php?story_id=<?php echo $story_id; ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete
                                </a>-->
								<!--<a class="btn btn-info" href="space_view.php?space_id=<?php echo $space_id; ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    View Details
                                </a>-->
                                
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
		/*$(document).ready(function() {
			$('#txtHint').DataTable( {
				aaSorting : [[0, 'desc']]
			} );
		} );*/
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