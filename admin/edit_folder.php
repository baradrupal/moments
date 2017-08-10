l<?php  session_start();
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
						 $title=check_input($_POST['folder_name']);  						 
					     $sql_sel="UPDATE `main_folder` SET `name`='".$title."' WHERE `id`=".$arid;
									$exce=mysqli_query($con,$sql_sel);                            
			 
	if($exce>0){?><script>
    alert("Data has been updated")
    window.location="add_folder.php";
</script>
<?php
  }			
  else {
    ?>
    <script>
    alert("Data has been updated Fail")
 window.location="add_folder.php";
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
            <li class="active">Folder</li>
           </ol>
        </div>
        <div class="main-content container-fluid">
          <!--Basic forms-->
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-border-color panel-border-color-info">
                  <div class="panel-heading panel-heading-divider">Add New Folder <span class="panel-subtitle"></span></div>
				  <div class="panel-body">
				 <?php
				$sql_sel="SELECT * FROM `main_folder` WHERE `id`=".$_GET['edit'];
				$sql_res=mysqli_query($con,$sql_sel);
				while($row=mysqli_fetch_array($sql_res))
				{
				?>
                    <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="Use" class="col-sm-2 control-label">Folder Name</label>
                      <div class="col-sm-8">                     
						<input type="text" name="folder_name" id="cat" value="<?php echo $row['name']; ?>" class="form-control input-sm" />
                        <br>
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

