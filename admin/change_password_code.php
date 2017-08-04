<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
		
		$id=$_SESSION['admin_id'];
		//echo $id;
		$oldpass = $_POST['oldpass'];
		$newpass = $_POST['newpass'];
		$repass = $_POST['repass'];
		//echo $oldpass;
		$quary1="select * from tbl_admin where admin_id=?";
		$st_c=$conn->prepare($quary1)or die('error in select admin.	.');
		$st_c->bind_param('i',$id);
		$st_c->execute();
		$st_c->bind_result($admin_id,$a_name,$a_pass,$a_type);
		$st_c->store_result();
		$st_c->fetch();
		
			if($a_pass == md5($oldpass))
			{
				if($newpass==$repass)
				{
     				$sql="update tbl_admin set a_pass='".md5($newpass)."' where admin_id=?";
					$st_pass=$conn->prepare($sql)or die('error in update...');
					$st_pass->bind_param('i',$id);
					$st_pass->execute();
					if($st_pass)
					{
						header("location:change_password.php?msg=Password Change Success...");
					}	
					else
					{
						header("location:change_password.php?msg=ReEnter Password...");
					}	
				}
				else	
				header("location:change_password.php?msg=Password Mismatch...");
			}
			else
			{
				header("location:change_password.php?msg=Old Password is Wrong...");
				
			}
	 }
	else
	{
		header("Location:index.php");
	}
?>