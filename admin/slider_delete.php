<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connection.php");
		
		$id = $_GET['id'];
		
		$query="delete from tbl_slider where s_id=".$id;
		$sql=mysql_query($query) or die("error in query");
		
		if($sql)
		{	
			header("Location:slider.php?var=delete");	
		}
	}
	else
	{
		header("Location:index.php");
	}
?>