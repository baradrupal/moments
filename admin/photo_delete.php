<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connection.php");
		
		$id = $_GET['id'];
		$gallery = $_GET['g_id'];
		
		$query="delete from tbl_photo where photo_id =".$id;
		$sql=mysql_query($query) or die("error in query");
		
		if($sql)
		{	
			if($gallery==3)
				header("Location:photo_digital.php?var=delete");
			else if($gallery==2)
				header("Location:photo_door.php?var=delete");
			else if($gallery==1)
				header("Location:photo_sleek.php?var=delete");
		}
	}
	else
	{
		header("Location:index.php");
	}
?>