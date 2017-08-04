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
<!-- Prerequisites: jQuery and jQuery UI Stylesheet -->
<script type="text/javascript" src="src/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="src/jquery-ui.css" />

    <!-- Plugin files below -->
<link rel="stylesheet" type="text/css" href="src/jquery.ptTimeSelect.css" />
<script type="text/javascript" src="src/jquery.ptTimeSelect.js"></script>
<script type="text/javascript">

	   function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#pic1')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
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
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>

<?php 
	//include("top.php");
	$id = $_GET['id'];	
	
	$query1 = "SELECT s.space_type, s.`space_name`, s.`email`, s.`phone`, s.`projector`, s.`scanner_printer`, s.`parking`, s.`ac`, s.`locker`, s.`ph`, s.`mail`, s.`wifi`, s.`work_24`, s.`location`, s.`lat`, s.`lon`, s.description, s.logo, s.price, t.type_name FROM `your_space` s left join space_type t on s.space_type=t.space_type_id WHERE `your_space_id`=?";
	//echo $query1;
	$stmt1 = $conn->prepare($query1);
	if ($stmt1) {
		$stmt1->bind_param("i", $id);
		$stmt1->execute();
	  $stmt1->bind_result($type, $name, $email, $phone, $projector, $scanner, $parking, $ac, $locker, $ph, $mail, $wifi, $work, $location, $lat, $long, $description, $logo, $price, $type);
		$stmt1->store_result();
		$stmt1->fetch(); 
	}
?>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> <?php echo $name; ?></h2>

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
            <form method="post" action="old_space_edit.php">
                <table class="table table-striped table-bordered responsive">
                	<tr height="10">
                    	<td width="100">Name:-</td>
                        <td><input value="<?php echo $name; ?>" class="form-control" name="name"></td>
                    </tr>
                    <tr height="10">
                    	<td width="100">Type:-</td>
                        <td><?php echo $type; ?></td>
                    </tr>
                    <tr height="10">
                    	<td width="100">Email:-</td>
                        <td><input value="<?php echo $email; ?>" class="form-control" name="email"></td>
                    </tr>
                    <tr height="10">
                    	<td>Mobile:-</td>
                        <td><input value="<?php echo $phone; ?>" class="form-control" name="mobile"></td>
                    </tr>
                    <tr height="10">
                    	<td>Location:-</td>
                        <td><input value="<?php echo $location; ?>" class="form-control" name="location"></td>
                    </tr>
                   </table>
                   <input type="hidden" value="<?php echo $id; ?>" name="ysid" >
                   <table class="table table-striped table-bordered responsive"> 
                    <tr align="center">
                    	<td align="right"><b>Projector</b>
                       	<input type="checkbox" class="form-control" <?php if($projector==1) { ?> checked <?php }?> name="projector" value="1"></td>
                    
                    	<td align="right"><b>Scanner</b>
                        <input type="checkbox" class="form-control" <?php if($scanner==1) { ?> checked <?php } ?> name="scanner" value="1"></td>
                    
                    	<td align="right"><b>Parking</b>
                        <input type="checkbox" class="form-control" <?php if($parking==1) { ?> checked <?php } ?> name="parking" value="1"></td>
                    
                    	<td align="right"><b>A/C</b>
                        <input type="checkbox" class="form-control" <?php if($ac==1) { ?> checked <?php } ?> name="ac" value="1"></td>
                    
                    	<td align="right"><b>Locker</b>
                        <input type="checkbox" class="form-control" <?php if($locker==1) { ?> checked <?php } ?> name="locker" value="1"></td>
                    
                    	<td align="right"><b>Phone</b>
                        <input type="checkbox" class="form-control" <?php if($ph==1) { ?> checked <?php } ?> name="phone" value="1"></td>
                    
                    	<td align="right"><b>Mail Service</b>
                        <input type="checkbox" class="form-control" <?php if($mail==1) { ?> checked <?php } ?> name="mail" value="1"></td>
                   
                    	<td align="right"><b>Wifi</b>
                        <input type="checkbox" class="form-control" <?php if($wifi==1) { ?> checked <?php  } ?> name="wifi" value="1"></td>
                    
                    	<td align="right"><b>Work 24 hours</b>
                        <input type="checkbox" class="form-control" <?php if($work==1) { ?> checked <?php } ?> name="work" value="1"></td>
                    </tr>
                </table>
               
                <div class="row">  
                    <div class="col-md-8">
                    	<div class="form-group">
                        	<label>Description</label>
                            <textarea class="form-control" name="desc" id="desc" rows="6"><?php echo $description; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-8">
                    	<div class="form-group">
                        	<table class="table table-striped table-bordered responsive"> 
                            	<tr><th> Day </th><th> Start Time </th><th> End Time </th></tr>
                               <?php
							   		$i=1;
							   		$qi="select open_close_hour_id, your_space_id, day, open_time, close_time from open_close_hour where your_space_id=?";
									$sti=$conn->prepare($qi);
									if($sti)
									{
										$sti->bind_param('i',$id);
										$sti->execute();
										$sti->bind_result($och_id,$y_s_id,$day,$open_time,$close_time);
										$sti->store_result();
										$count=$sti->num_rows;
										if($count!=0)
										{
											while($sti->fetch())
											{
							   ?> 
                              
                              				 <tr id="sample1" class="ui-widget-content" style="padding: .5em;">
                                                <td><?php echo ucfirst($day); ?> <input type="hidden" value="<?php echo $day; ?>" name="d<?php echo $i; ?>"></td>
                                                <td><input name="dstrt<?php echo $i; ?>" value="<?php echo $open_time;  ?>" /></td>
                                                <td><input name="dend<?php echo $i; ?>" value="<?php echo $close_time;  ?>" /></td>
                                            </tr>
                              <?php
							  					$i++;
											}
										}
										else
										{
							  ?>
                               
                              <tr id="sample1" class="ui-widget-content" style="padding: .5em;">
                                	<td>Monday <input type="hidden" value="monday" name="d1"></td>
                                    <td><input name="dstrt1" /></td>
                                    <td><input name="dend1" /></td>
                                </tr>
                               
                                <tr id="sample2" class="ui-widget-content" style="padding: .5em;">
                                	<td>Tuesday <input type="hidden" value="tuesday" name="d2"></td>
                                    <td><input name="dstrt2" /></td>
                                    <td><input name="dend2" /></td>
                                </tr>
                                
								
                                <tr id="sample3" class="ui-widget-content" style="padding: .5em;">
                                	<td>Wednesday <input type="hidden" value="wednesday" name="d3"></td>
                                    <td><input name="dstrt3"  /></td>
                                    <td><input name="dend3" /></td>
                                </tr>
                               
                                 <tr id="sample4" class="ui-widget-content" style="padding: .5em;">
                                	<td>Thursday <input type="hidden" value="thursday" name="d4"></td>
                                    <td><input name="dstrt4"/></td>
                                    <td><input name="dend4"  /></td>
                                </tr>
                                
                                <tr id="sample5" class="ui-widget-content" style="padding: .5em;">
                                	<td>Friday <input type="hidden" value="friday" name="d5"></td>
                                    <td><input name="dstrt5"  /></td>
                                    <td><input name="dend5" /></td>
                                </tr>
                                
                                <tr id="sample6" class="ui-widget-content" style="padding: .5em;">
                                	<td>Saturday <input type="hidden" value="saturday" name="d6"></td>
                                    <td><input name="dstrt6"/></td>
                                    <td><input name="dend6"  /></td>
                                </tr>
                                
                                <tr id="sample7" class="ui-widget-content" style="padding: .5em;">
                                	<td>Sunday <input type="hidden" value="sunday" name="d7"></td>
                                    <td><input name="dstrt7" /></td>
                                    <td><input name="dend7" /></td>
                                </tr>
                                <?php	
									  }
								 }
							   ?>
                            </table>
                        </div>
                    </div>
                </div><br>
                <div class="row">  
                    <div class="col-md-4">
                    	<div class="form-group"> 
                        	<label>Price</label> 
                            <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                    	<div class="form-group"> 
                        	<label>Upload Logo</label> 
                            <input type="file" class="form-control" name="logo" onChange="readURL1(this);">
                        </div>
                    </div>
                    <div class="col-md-4">
                            <img alt="" id="pic1" src="upload/logo/<?php echo $logo; ?>" height="150" width="150">
                     </div>   
                </div><br>
                </div><br>
                <div class="row">  
                    <div class="col-md-4">
                    	<div class="form-group"> 
                        	<input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div> 
               </form> 
            </div>
        </div>
    </div>
</div>

   <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample1 input').ptTimeSelect();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample2 input').ptTimeSelect();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample3 input').ptTimeSelect();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample4 input').ptTimeSelect();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample5 input').ptTimeSelect();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample6 input').ptTimeSelect();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample7 input').ptTimeSelect();
        });
    </script>

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

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