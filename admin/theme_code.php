<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connection.php");
		
		$theme = $_GET['theme'];
		
		$query="update tbl_theme set theme_name='$theme' where theme_id =1";
		$sql=mysql_query($query) or die("error in query");
		if($sql)
			header("Location:theme.php?Theme=Done");
		else
			header("Location:theme.php?Theme=error");
	}
	else
	{
		header("Location:index.php");
	}
?>