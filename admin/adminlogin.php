<?php
	ob_start();
	include("connectionpool.php");
	session_start();

 	$name = $_REQUEST['username'];
 	$password = md5($_REQUEST['password']);

	$query = "select admin_id, a_name, a_pass, a_type from tbl_admin where a_name=? and a_pass=?";
	$stmt = $conn->prepare($query) or die("Error");
	if ($stmt){
		
		$stmt->bind_param("ss", $name, $password);
		$stmt->execute();
		$stmt->bind_result($admin_id, $a_name, $a_pass, $a_type);
		$stmt->store_result();
		$count=$stmt->num_rows();
		$stmt->fetch();
		
		if($count==1)
		{
			if($a_name==$name && $a_pass==$password)
			{
				$_SESSION['admin_name'] = $a_name;
				
				if($a_type=="super_admin")
					$_SESSION['admin_type'] = 1;
				else
					$_SESSION['admin_type'] = 2;
					
				$_SESSION['admin_id'] = $admin_id;
				
				header("Location:admin_home.php");
			}
			else
			{
				header("location:index.php?error=status");	
			}
		}
		else
		{
			header("location:index.php?error=count");
		}
	}
	$stmt->close();
?>