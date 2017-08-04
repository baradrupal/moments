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
    		</ul>
		</div>

		<?php
            $pro_id = $_GET['id'];
            
            $query = "SELECT  m.`mc_name`, pc.`pc_name`, c.`cc_name`, p.`product_name`, p.`product_code`, p.`product_image`, p.`price`, p.`discounted_price`, p.`description`, p.`quantity`, s.`company_name`, s.`contact_person`, s.`mobile`, p.`status`, p.`created_by`, p.`creater_id`, p.`create_date` FROM `product_details` p left join seller s on p.`seller_id`=s.`seller_id` left join main_category m on m.`mc_id`= p.`mc_id` left join parent_category pc on pc.`pc_id`= p.`pc_id` left join child_category c on c.`cc_id`= p.`cc_id` WHERE `product_id`=?";
            $stmt = $conn->prepare($query);
            if($stmt) 
            {	
                $stmt->bind_param('i',$pro_id);
                $stmt->execute();
                $stmt->bind_result($mc_name, $pc_name, $cc_name, $pro_name, $pro_code, $pro_image, $pro_price, $pro_dis_price, $detail, $pro_qty, $company_name, $contact_person, $mobile, $status, $created_by, $creater_id, $create_date);
                $stmt->store_result();
                $stmt->fetch(); 
        
            }
            $stmt->close();
        ?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Product Details</h2>

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
            	
                <table class="table table-striped table-bordered responsive">
                	<tr height="10">
                    	<td width="100" colspan="1">Product SKU:-</td>
                        <td colspan="2"><?php echo $pro_code; ?></td>
                        
                        <td width="100" colspan="1">Product Name:-</td>
                        <td colspan="2"><?php echo $pro_name; ?></td>
                    </tr>
                    <tr height="10">
                    	<td width="100">Main Category:-</td>
                        <td><?php echo $mc_name; ?></td>
                   
                    	<td width="100">Parent Category:-</td>
                        <td><?php echo $pc_name; ?></td>
                    
                    	<td width="100">Child Category:-</td>
                        <td><?php echo $cc_name; ?></td>
                    </tr>
                    <tr height="10">
                    	<td width="100">Real Price:-</td>
                        <td width="100"><?php echo $pro_price; ?></td>
                        
                        <td width="100">Discounted Price:-</td>
                        <td width="100"><?php echo $pro_dis_price; ?></td>
                        
                        <td width="100">Quantity:-</td>
                        <td width="100"><?php echo $pro_qty; ?></td>
                    </tr>
                    <tr>
                    	<td colspan="6"><?php echo $detail; ?></td>
                    </tr>
                    <tr height="10">
                    	<td width="100">Company Name:-</td>
                        <td width="100"><?php echo $company_name; ?></td>
                        
                        <td width="100">Contact Person:-</td>
                        <td width="100"><?php echo $contact_person; ?></td>
                        
                        <td width="100">Mobile:-</td>
                        <td width="100"><?php echo $mobile; ?></td>
                    </tr>
                </table>
                   
                <div class="row">  
                    <div class="col-md-4">
                    	<img src="../upload/product/<?php echo $pro_image; ?>" width="100%">	
                    </div>
                    <?php
						$query1 = "SELECT `pimage_id`, `image_name` FROM `product_image` WHERE `product_id`=?";
						$stmt1 = $conn->prepare($query1) or die($conn->error);
						if($stmt1) 
						{	
							$stmt1->bind_param('i',$pro_id);
							$stmt1->execute();
							$stmt1->bind_result($image_id, $image_name);
							$stmt1->store_result();
							$count=$stmt1->num_rows;
							
							if($count>0)
							{
								while($stmt1->fetch())
								{
					?>
                                    <div class="col-md-4">
                                        <img src="../upload/product/<?php echo $image_name; ?>" width="100%">	
                                    </div>
                    <?php			
								}
							}
						}
						$stmt1->close(); 
					?>   
                </div> 
               </form> 
            </div>
        </div>
    </div>
</div>

    <hr>


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