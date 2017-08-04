<?php
	include("connectionpool.php");
	session_start();
	
	if(isset($_SESSION['admin_name']))
	{
		
		$name=$_POST['cat_name'];
		$mc_id=$_POST['mc_id'];
				
		$q_mc="INSERT INTO `parent_category` (`mc_id`, `pc_name`) VALUES (?,?)";
		$st_mc=$conn->prepare($q_mc);
		
		if($st_mc)
		{
			$st_mc->bind_param('is', $mc_id, $name);
			$st_mc->execute();
				
			header("Location:parent_category.php?status=done&msg=Successfuly Inserted");	
		}
		else
			header("Location:parent_category.php?status=done&msg=Error in insert");
		
	}
	else
	{
		header("Location:index.php");
	}
?>