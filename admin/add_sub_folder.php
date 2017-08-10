<?php  session_start();
if(!$_SESSION['login_user']) {
    header("location:index.php");
}
?>
<?php
include './leftmenu.php';
include_once './config.php';
if(isset($_POST["add"]))
{				
	$sub_folder_name =check_input($_POST['sub_folder_name']);	
	$folder_name =check_input($_POST['folder_name']);	
	
	$ins_pro=("INSERT INTO `sub_folder`(f_id,name) VALUES('".$folder_name."','".$sub_folder_name."')") or die(mysqli_error());
    $exe_pro=mysqli_query($con,$ins_pro) or die(erro_no());	
	if($exe_pro > 0)
	{	
	?>
    <script>
    alert('Data has been inserted.');
	window.location='add_sub_folder.php';
    </script>
	<?php
	}
	else{
	?>    
    <script>
    alert('Failed to insert Data.');
	window.location='add_sub_folder.php';
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
                  <div class="panel-heading panel-heading-divider">Add New Sub Folder<span class="panel-subtitle"></span></div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post"  enctype = "multipart/form-data">   
                                     
                    <div class="form-group">
                     <label for="Use" class="col-sm-2 control-label">Sub Folder Name</label>
                      <div class="col-sm-5">                   
                        <input type="text" name="sub_folder_name" id="cat" class="form-control input-sm" />
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
      <option value="<?php echo $tbl_cat['id'];?>"><?php echo $tbl_cat['name']?></option>                     <?php } ?>	                             
                      </select>
                      </div>                    	
                    </div>    
                                                     
					<div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">      
                    <input  type="submit" value="Add" name="add" class="btn btn-primary">                    <input  type="reset"  value="Cancel" class="btn btn-default">
                    </div>
                   </div>					
				</form>
                </div>
              </div>
            </div>
          </div> 
<!---------------Display------------------------->
<div class="main-content container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="panel panel-default panel-table">
                <div class="panel-heading">Edit | Delete Records
<!--                  <div class="tools"><span class="icon mdi mdi-download"></span><span class="icon mdi mdi-more-vert"></span></div>-->
                </div>
                <div class="panel-body table-responsive">
                 <table id="table1" class="table table-striped table-hover table-fw-widget">
                    <thead>
                        <tr>
                        <th>No</th>		
                        <th>Sub Folder Name</th>	
                        <th>Main Folder</th>					
                        <th colspan="1">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   <?php                    
                   if(isset($_GET['dlt'])){
                        $d_id=$_GET['dlt'];                        
                        $dlt_rec="DELETE FROM sub_folder WHERE id='".$d_id."'";
                        $exe_dlt=  mysqli_query($con, $dlt_rec);
                        if($exe_dlt>0)
                        {
                        ?>
                            <script>                               
                                window.location='add_sub_folder.php';
                            </script>
                            <?php 
                        }else{
                            ?>
                            <script>
							 window.location='add_sub_folder.php';
                            </script>
                            <?php 
                        }
                    }
                    
                    $selelect_data="SELECT * FROM  `sub_folder`";
                    $exe_data=mysqli_query($con,$selelect_data);                    
                    while($tbl_data=mysqli_fetch_array($exe_data))
                    {       
                    ?>    
                      <tr class="odd gradeX">
						<td class="center"><?php echo $tbl_data['id']; ?></td>
                        
                        <td><?php echo $tbl_data['name']; ?></td>
                        <td><?php 
						$res1=mysqli_query($con,"SELECT * FROM `main_folder` WHERE `id`=".$tbl_data["f_id"]);
				    while($row1=mysqli_fetch_array($res1))
						{
						 echo $row1["name"]; 
						} ?>
                        </td>                                                 
                        <td><a href="edit_sub_folder.php?edit=<?php echo $tbl_data['id']; ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="add_sub_folder.php?dlt=<?php echo $tbl_data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete this record?');"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                      </tr>
                    <?php } ?>  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>		  
<!----------------------------------------------->          
<?php include './footer.php'; ?>

