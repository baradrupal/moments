<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
		
		$id = $_GET['id'];
		
		$q_mc="DELETE FROM `child_category` WHERE `cc_id`=?";
		$st_mc=$conn->prepare($q_mc);
		
		if($st_mc)
		{
			$st_mc->bind_param('i', $id);
			$st_mc->execute();
				
			header("Location:child_category.php?status=done&msg=Successfuly Deleted");	
		}
		else
			header("Location:child_category.php?status=done&msg=Error in delete");
	}
	else
	{
		header("Location:index.php");
	}
?>