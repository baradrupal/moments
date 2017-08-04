<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
		
		$id = $_GET['id'];
		$status = $_GET['status'];
		
		$q_mc="UPDATE `main_category` SET `mc_status`=? WHERE `mc_id`=?";
		$st_mc=$conn->prepare($q_mc);
		
		if($st_mc)
		{
			$st_mc->bind_param('ii', $status, $id);
			$st_mc->execute();
				
			header("Location:main_category.php?status=done&msg=Successfuly Deleted");	
		}
		else
			header("Location:main_category.php?status=done&msg=Error in delete");
	}
	else
	{
		header("Location:index.php");
	}
?>