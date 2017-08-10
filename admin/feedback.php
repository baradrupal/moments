<?php  session_start();
if(!$_SESSION['login_user']) {
    header("location:index.php");
}
?>
<?php
include './leftmenu.php';
include_once './config.php';
?>
<!-- Start Add product -->
<div class="be-content">
        <div class="page-head">
<!--          <h2 class="page-head-title">Form Elements</h2>-->
           <ol class="breadcrumb page-head-nav">
            <li><a href="#">Home</a></li>           
            <li class="active">Events</li>
          </ol>
        </div>
        
          <!--Basic forms-->
           
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
                        <th>Photo</th> 
						<th>Customer Name</th>
                        <th>Mobile</th>
        				<th>Email</th>                       
                        <th>Comments</th>                       
                        <th colspan="2">Actions</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                   if(isset($_GET['dlt'])){
                        $d_id=$_GET['dlt'];
                        
                        $dlt_rec="DELETE FROM feedback WHERE id='".$d_id."'";
                        $exe_dlt=  mysqli_query($con, $dlt_rec);
                        if($exe_dlt>0)
                        {
                            ?>
                            <script>                               
                                window.location='feedback.php';
                            </script>
                            <?php 
                        }else{
                            ?>
                            <script>                                
                                window.location='feedback.php';
                            </script>
                            <?php 
                        }
                    }
                    
                    $selelect_data="SELECT * FROM feedback";
                    $exe_data=mysqli_query($con,$selelect_data);
                    
                    while($tbl_data=mysqli_fetch_array($exe_data))
                    {       
                    ?>    
                      <tr class="odd gradeX">
						<td class="center"><?php echo $tbl_data['id']; ?></td>
                        <td><img src="upload/<?php echo $tbl_data['image']; ?>" style="max-height: 70px;max-width: 70px;"></td>
						<td><?php echo $tbl_data['f_name'];?></td> 
                        <td><?php echo $tbl_data['phone'];?></td> 
                        <td><?php echo $tbl_data['email'];?></td>                      
                        <td><?php echo $tbl_data['comments'];?></td>                        
                        <td><a href="feedback.php?dlt=<?php echo $tbl_data['id']; ?>" class="btn btn-danger" onclick="return confirm('Are You Sure To Delete this record?');"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                      </tr>
                    <?php } ?>  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>		
</div>  
<!----------------------------------------------->          
<?php include './footer.php'; ?>
    <script>
	j=1;
	$("#addmore").click(function(){
	$("#moreimages").append('<div class="form-group xs-mt-10"><label for="exampleInputFile" class="col-sm-2 control-label">Event Image '+j+'</label><div class="col-sm-5"><input type="file" class="input-sm btn-btn-primary"  id="exampleInputFile" name="project_images[]"></div></div>');
	j++;
	});
    </script>