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

	<script type="text/javascript"> 
        function parentlist(str1)
        {
			//alert(str1);
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari(for all new browsers)
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5(for microsofts)
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){//response andd without error
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    //alert(xmlhttp.responseText);
                    document.getElementById("parent_dd").innerHTML=xmlhttp.responseText;
                }
            }
            //alert(str1);
            xmlhttp.open("GET","getparentlist.php?id="+str1,true);
        
            xmlhttp.send();
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
                    <h2><i class="glyphicon glyphicon-edit"></i> Add Child Category</h2>
    
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
                    <form role="form" action="child_category_insert.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Select Main Category:- </label>
                
                                    <div class="controls">
                                        <select id="select1" data-rel="chosen" name="mc_id" onchange="parentlist(this.value)">
                                            <option disabled selected value="">Select Main Category</option>
											<?php
                                                
												$query_mc = "SELECT `mc_id`, `mc_name` FROM `main_category` where `mc_status`=1";
												$stmt_mc = $conn->prepare($query_mc);
												if($stmt_mc) 
												{	
													$stmt_mc->execute();
													$stmt_mc->bind_result($mc_id, $mc_name);
													$stmt_mc->store_result();
													
													while ($stmt_mc->fetch()) 
													{	
					
                                            ?>
                                                    <option value="<?php echo $mc_id; ?>"><?php echo $mc_name; ?></option>	
                                            <?php    			
                                                	}
												}
												$stmt_mc->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <br />
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group" id="parent_dd">
                                    
                                </div>
                            </div>
                        </div>    
                        
                        <br />
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Name:- </label>
                
                                    <div class="controls">
                                        <input type="text" name="cat_name" class="form-control" placeholder="Enter Child Category Name" /> 
                                    </div>
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Manage Child Category</h2>

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
                            <th>Main Category</th>
                            <th>Parent Category</th>
                            <th>Child Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    <?php
						$i=1;
						$query = "SELECT c.`cc_id`, p.`pc_name`, m.`mc_name`, c.`cc_name` FROM `child_category` c left join `main_category` m on m.`mc_id`=c.`mc_id` left join `parent_category` p on p.`pc_id`=c.`pc_id`";
						$stmt = $conn->prepare($query) or die($conn->error);
						if($stmt) 
						{	
							$stmt->execute();
							$stmt->bind_result($cc_id, $mc_name, $pc_name, $cc_name);
							$stmt->store_result();
							
							while ($stmt->fetch()) 
							{	
					?>
                            <tr>
                                <td><?php echo $i; ?> </td>
                                <td><?php echo $mc_name; ?> </td>
                                <td><?php echo $pc_name; ?> </td>
                                <td><?php echo $cc_name; ?> </td>
                                <td class="center">
                                   <a class="btn btn-danger" href="child_category_delete.php?id=<?php echo $cc_id; ?>">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                    <?php
							$i++;
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