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
            xmlhttp.open("GET","getParentListForProduct.php?id="+str1,true);
        
            xmlhttp.send();
        }
		
		function childlist(str1)
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
                    document.getElementById("child_dd").innerHTML=xmlhttp.responseText;
                }
            }
            //alert(str1);
            xmlhttp.open("GET","getChildListForProduct.php?id="+str1,true);
        
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
                    <h2><i class="glyphicon glyphicon-edit"></i> Add Product</h2>
    
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
                    <form role="form" action="product_add_code.php" method="post" enctype="multipart/form-data">
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
                                <div class="control-group" id="child_dd">
                                    
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Select Seller:- </label>
                
                                    <div class="controls">
                                        <select id="select1" data-rel="chosen" name="seller_id">
                                            <option disabled selected value="">Select Seller</option>
											<?php
                                                
												$query_sell = "SELECT `seller_id`, `company_name` FROM `seller` where `status`=1";
												$stmt_sell = $conn->prepare($query_sell);
												if($stmt_sell) 
												{	
													$stmt_sell->execute();
													$stmt_sell->bind_result($seller_id, $seller_name);
													$stmt_sell->store_result();
													
													while ($stmt_sell->fetch()) 
													{	
					
                                            ?>
                                                    <option value="<?php echo $seller_id; ?>"><?php echo $seller_id." - ".$seller_name; ?></option>	
                                            <?php    			
                                                	}
												}
												$stmt_sell->close();
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Product Name:- </label>
                
                                    <div class="controls">
                                        <input type="text" name="pro_name" class="form-control" placeholder="Enter Product Name" /> 
                                    </div>
                                </div>
                            </div>
						</div>
                        <br />
                        <div class="row">      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Main Photo</label>
                                    <input type="file" name="main_photo" class="form-control" id="exampleInputEmail1" >
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">      
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Sub Photo</label>
                                    <input type="file" name="sub_photo[]" class="form-control" id="exampleInputEmail1" multiple />
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Original Rate:- </label>
                
                                    <div class="controls">
                                        <input type="number" name="rate" class="form-control" placeholder="Enter Original Rate" /> 
                                    </div>
                                </div>
                            </div>
						</div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Discounted Rate:- </label>
                
                                    <div class="controls">
                                        <input type="number" name="dis_rate" class="form-control" placeholder="Enter Discounted Rate" /> 
                                    </div>
                                </div>
                            </div>
						</div>
                        <br />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Quantity:- </label>
                
                                    <div class="controls">
                                        <input type="number" name="quantity" class="form-control" placeholder="Enter Quantity" /> 
                                    </div>
                                </div>
                            </div>
						</div>
                        <br />
                        <div class="row">
                            <div class="col-md-9">
                                <div class="control-group">
                                    <label class="control-label" for="selectError">Overview:- </label>
                
                                    <div class="controls">
                                        <textarea name="details" cols="50" rows="10" class="form-control" ></textarea> 
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