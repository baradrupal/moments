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
                <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Manage Product</h2>

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
                            <th>Image</th>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Seller</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
						$query = "SELECT p.`product_id`, c.`cc_name`, p.`product_name`, p.`product_code`, p.`product_image`, p.`price`, p.`discounted_price`, p.`quantity`, s.`company_name` FROM `product_details` p left join seller s on p.`seller_id`=s.`seller_id` left join child_category c on c.`cc_id`=p.`cc_id` WHERE p.`status`=1";
						$stmt = $conn->prepare($query) or die($conn->error);
						if($stmt) 
						{	
							$stmt->execute();
							$stmt->bind_result($pro_id, $cc_name, $pro_name, $pro_code, $pro_image, $pro_price, $pro_dis_price, $pro_qty, $company_name);
							$stmt->store_result();
						
							while ($stmt->fetch()) 
							{	
					?>
                            <tr>
                                <td><img src="../upload/product/<?php echo $pro_image; ?>" width="100" height="100" ></td>
                                <td><?php echo $pro_code; ?> </td>
                                <td><?php echo $pro_name; ?> </td>
                                <td><?php echo $cc_name; ?></td>
                                <td><strike><?php echo $pro_price.'</strike> '.$pro_dis_price; ?></td>
                                <td><?php echo $pro_qty; ?></td>
                                <td><?php echo $company_name; ?></td>
                                <td class="center">
                                   	<a class="btn btn-info" href="product_detail.php?id=<?php echo $pro_id; ?>">
                                        <i class="glyphicon glyphicon-edit icon-white"></i>
                                        View
                                   	</a>
                                    <a class="btn btn-warning" href="product_edit_form.php?id=<?php echo $pro_id; ?>">
                                        Edit
                                    </a> 
								   <a class="btn btn-danger" href="product_delete.php?id=<?php echo $pro_id; ?>">
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