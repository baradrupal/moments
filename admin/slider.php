<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
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

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Digital</h2>

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
            	<?php
						$query="select * from tbl_slider order by date desc limit 5";
						$sql=mysql_query($query) or die("error in query");
				?>
                <table id="txtHint" class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
							$i=1;
							while($row=mysql_fetch_array($sql))
							{
						?>
                        <tr>
                            <td><?php echo $i; $i++; ?></td>
                            <td><?php echo $row['s_name']; ?></td>
                            <td><img src="../images/slider/<?php echo $row['s_img']; ?>" width="220px" height="150px" ></td>
                            <td><?php echo $row['date']; ?></td>
                            <td class="center">
                                <a class="btn btn-danger" href="slider_delete.php?id=<?php echo $row['s_id']; ?>">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php
							}
						?>
                    </tbody>
            	</table>
            </div>
        </div>
    </div>
</div>


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
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
                <form action="" method="post">
                <div class="modal-body">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Members</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <tr>
                                    <td class="center" width="5%"><?php echo ++$j; ?></td>
                                    <td ><input type="text" class="form-control" id="exampleInputEmail1"></td>
                                    <td class="center"><input type="text" class="form-control" id="exampleInputEmail1"></td>
                                    <td class="center"><input type="number" class="form-control" id="exampleInputEmail1"></td>
                                    <td class="center"><input type="submit" name="submit" class="btn btn-success" value="ADD"></td>
                                </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <input type="submit" class="btn btn-primary" value="ADD">
                </div>
                </form>
            </div>
        </div>
    </div>

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