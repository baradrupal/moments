<?php  session_start();
if(!$_SESSION['login_user']) {
    header("location:index.php");
}
?>
<?php
include './leftmenu.php';
include_once './config.php';
if(isset($_POST["update"]))
{
						 $arid=check_input($_GET['edit']);
						 $sub_cat=check_input($_POST['sub_cat']);  
						 $cat_name=check_input($_POST['cat']);
						 
						$sql_sel="UPDATE `subcategory` SET `name`='".$sub_cat."',`cat_id`='".						$cat_name."' WHERE `id`=".$arid;
	mysqli_query($con,$sql_sel);                                         
						
?>
<script>
 window.location="add_subcategory.php";
</script>
<?php

}
?>
<!-- Start Add product -->
<div class="be-content">
        <div class="page-head">
<!--          <h2 class="page-head-title">Form Elements</h2>-->
            <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>           
            <li class="active">Category</li>
           </ol>
        </div>
        <div class="main-content container-fluid">
          <!--Basic forms-->
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-info">
                  <div class="panel-heading panel-heading-divider">Add New Category <span class="panel-subtitle"></span></div>
				  <div class="panel-body">
				 <?php
				$sql_sel="SELECT * FROM `subcategory` WHERE `id`=".$_GET['edit'];
				$sql_res=mysqli_query($con,$sql_sel);
				while($row=mysqli_fetch_array($sql_res))
				{
				?>
                    <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="Use" class="col-sm-2 control-label">Sub Category Name</label>
                      <div class="col-sm-5">                     
						<input type="text" name="sub_cat" id="cat" value="<?php echo $row['name']; ?>" class="form-control" />
                        <br>
                      </div>
                    </div> 
                    <div class="form-group xs-mt-10">
                      <label for="name" class="col-sm-2 control-label">Category Name</label>
                      <div class="col-sm-5">
                         <select class="form-control" id="exampleSelect1" name="cat">
                         	 <option>Select Category</option>
                         	<?php 
					$selelect_cat="SELECT * FROM `category`";
                    $exe_cat=mysqli_query($con,$selelect_cat);
                    while($tbl_cat=mysqli_fetch_array($exe_cat))
                    {       
                    ?>                            
      <option value="<?php echo $tbl_cat['id'];?>" <?php if($tbl_cat['id']==$row['cat_id']){ echo 'selected="selected"';}?>><?php echo $tbl_cat['name']?></option>                      
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

