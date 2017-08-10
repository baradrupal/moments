<?php  session_start();
if(!$_SESSION['login_user']) {
    header("location:index.php");
}
include './leftmenu.php';
include_once './config.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('#type').on("change",function () {
        var mainfolder = $(this).find('option:selected').val();
        $.ajax({
            url: "monents_ajax.php",
            type: "POST",
            data: "mainfolder="+mainfolder,
            success: function (response) {
                console.log(response);
                $("#type1").html(response);
            },
        });
    }); 

});

</script>
<?php
if(isset($_POST["update"]))
{
								 $arid=check_input($_REQUEST['edit']);				 
								 $type= check_input($_REQUEST['type']);				 
								 $type1=check_input($_REQUEST['type1']);
								 
							   	$filename = $_FILES['images']['name'];
                               	if($filename=="") 
                                 {
    								$sql_sel="UPDATE `folder_images` SET								 `mf_id`='".$type."',`subf_id`='".$type1."' WHERE `id`=".$arid;
                                   $exce= mysqli_query($con,$sql_sel);                           
                                 }     
                                 else 
								 {
                                 
									$filename=  time().$filename;
									$ext = substr($filename, strrpos($filename, '.') + 1);
									if (($ext == "jpg") || ($ext == "png") || ($ext == "jpeg") || ($ext == "JPG") || ($ext == "PNG")|| ($ext == "gif")) 
									 { 
									  $newname =$filename;
									   move_uploaded_file($_FILES["images"]["tmp_name"],"upload/".$newname);         
									//$hex_string = base64_encode($newname);
									 }
									 $sql_sel="UPDATE `folder_images` SET `mf_id`='".$type."',`subf_id`='".$type1."',`image`='".$newname."' WHERE `id`=".$arid;
									$exce=mysqli_query($con,$sql_sel);
                }
if($exce>0){?> <script>
alert("Data has been Updated Successfully");
 window.location="add_folder_images.php";
</script><?php } else {?>
<script>
alert("Data has been Updated  Fail")
 window.location="add_folder_images.php";
</script>
<?php
}
}
?>
<!-- Start Add product -->
<div class="be-content">
        <div class="page-head">
<!--          <h2 class="page-head-title">Form Elements</h2>-->
           <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>           
            <li class="active">Products</li>
          </ol>
        </div>
        <div class="main-content container-fluid">
          <!--Basic forms-->
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-info">
                  <div class="panel-heading panel-heading-divider">Add New Products<span class="panel-subtitle"></span></div>
				  <div class="panel-body">
				 <?php
				$sql_sel="SELECT * FROM folder_images,main_folder,sub_folder WHERE folder_images.mf_id = main_folder.id  AND folder_images.subf_id = sub_folder.id AND folder_images.id='".$_GET['edit']."'";
				$sql_res=mysqli_query($con,$sql_sel);
				$row=mysqli_fetch_array($sql_res);
				?>
                    <form class="form-horizontal" method="post"  enctype="multipart/form-data">                    
                    <div class="form-group xs-mt-10">
                      <label for="name" class="col-sm-2 control-label">Main Folder Name</label>
                      <div class="col-sm-5">
                         <select class="form-control" id="type" name="type">
                         	 <option value="<?php if(isset($_GET['edit'])){ echo $row['mf_id'];} ?>">Select Folder</option>
                    <?php 
					$selelect_cat1="SELECT * FROM `main_folder`";
                    $exe_cat1=mysqli_query($con,$selelect_cat1);
                    while($tbl_cat1=mysqli_fetch_array($exe_cat1))
                    {       
                    ?>                            
                  		<option value="<?php echo $tbl_cat1['id']?>" <?php if($tbl_cat1['id']==$row['mf_id']) echo 'selected="selected" '?>><?php echo $tbl_cat1['name']?></option>
                              
                           <?php } ?>                             
                           </select>
                      </div>                    	
                    </div>    
                    <div class="form-group xs-mt-10">
                      <label for="name" class="col-sm-2 control-label">Sub Folder Name</label>
                      <div class="col-sm-5">
                       <select name="type1" id="type1" class="form-control">
                       <option value="<?php if(isset($_GET['edit'])){ echo $row['subf_id'];} ?>"><?php if(isset($_GET['edit'])){ echo $row['name'];}else{ ?>Select Folder<?php } ?></option>
                        </select>
                      </div>                    	
                    </div>                
                                     
                    
                	<div class="form-group xs-mt-10">
                     <label for="name" class="col-sm-2 control-label">Folder Images</label>
                      <div class="col-sm-5">                     
                          <input id="inputEmail3" name="images" type="file" class="input-sm btn-btn-primary">
                      </div>
                      <div class="col-sm-5">
							<img src="upload/<?php echo $row['image']; ?>" style="max-height: 100px;max-width: 100px;"><br/>
 							
                      </div>	
                    </div>
                     
					<div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">      
                    <input  type="submit" value="Update" name="update" class="btn btn-primary">                      
                    <input  type="reset"  value="Cancel" class="btn btn-default">
                    </div>
                   </div>					
				</form>
<?php  ?>
                </div>
              </div>
            </div>
          </div>
		  <!----------------------------------------------->         
<?php include './footer.php'; ?>