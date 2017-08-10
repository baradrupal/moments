<?php  session_start();
if(!$_SESSION['login_user']) {
    header("location:index.php");
}
include './leftmenu.php';
include_once './config.php';
if(isset($_POST["update"]))
{
						 $arid=check_input($_GET['edit']);
						 $sub_folder_name=check_input($_POST['sub_folder_name']);  
						 $folder_name=check_input($_POST['folder_name']);
						 			 
             $sql_sel="UPDATE `sub_folder` SET `f_id`='".$folder_name."',`name`='".$sub_folder_name."' WHERE `id`=".$arid;
							$exe=mysqli_query($con,$sql_sel);  
if($exe>0){ ?> 
<script>
alert("Data Has been Updated Successfully");
window.location="add_sub_folder.php";
</script><?php }	
else { ?>
<script>
alert("Data Has been Updated Fail");
 window.location="add_sub_folder.php";
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
            <li class="active">Sub Folder</li>
           </ol>
        </div>
        <div class="main-content container-fluid">
          <!--Basic forms-->
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-info">
                  <div class="panel-heading panel-heading-divider">Add New Sub Folder <span class="panel-subtitle"></span></div>
				  <div class="panel-body">
				 <?php
				$sql_sel="SELECT * FROM `sub_folder` WHERE `id`=".$_GET['edit'];
				$sql_res=mysqli_query($con,$sql_sel);
				while($row=mysqli_fetch_array($sql_res))
				{
				?>
                    <form class="form-horizontal" method="post"   enctype="multipart/form-data">
                    <div class="form-group">
                     <label for="Use" class="col-sm-2 control-label">Sub Folder Name</label>
                      <div class="col-sm-5">                     
						<input type="text" name="sub_folder_name" id="sub_folder_name" value="<?php echo $row['name']; ?>" class="form-control" />
                        <br>
                      </div>
                    </div> 
                    <div class="form-group xs-mt-10">
                      <label for="name" class="col-sm-2 control-label">Folder Name</label>
                      <div class="col-sm-5">
                      <select class="form-control" id="exampleSelect1" name="folder_name">    
                      <option>Select Folder</option>
                    <?php 
					$selelect_cat="SELECT * FROM `main_folder`";
                    $exe_cat=mysqli_query($con,$selelect_cat);
                    while($tbl_cat=mysqli_fetch_array($exe_cat))
                    {       
                    ?>                            
      <option value="<?php echo $tbl_cat['id'];?>" <?php if($tbl_cat['id']==$row['f_id']){ echo 'selected="selected"';}?>><?php echo $tbl_cat['name']?></option>                      
                     <?php } ?>                            
                     </select>
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
<?php } ?>
                </div>
              </div>
            </div>
          </div> 
		  <!----------------------------------------------->          
<?php include './footer.php'; ?>

