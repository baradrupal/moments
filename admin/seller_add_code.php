<?php
	include("connectionpool.php");
	session_start();
	
	if(isset($_SESSION['admin_name']))
	{
		$company_name=$_POST['company_name'];
		$contact_person=$_POST['contact_person'];
		$email=$_POST['email'];
		$mobile=$_POST['mobile'];
		$landline=$_POST['landline'];
		$address=mysql_real_escape_string($_POST['address']);
		$password="craft".rand();
		
		$q_ipro="INSERT INTO `seller` (`company_name`, `contact_person`, `email`, `password`, `mobile`, `landline`, `address`, `status`) VALUES (?,?,?,?,?,?,?,1)";
		$st_ipro=$conn->prepare($q_ipro) or die($conn->error);
		
		if($st_ipro)
		{
			$st_ipro->bind_param('sssssss', $company_name, $contact_person, $email, md5($password), $mobile, $landline, $address);
			$st_ipro->execute();
			
			$product_id=$st_ipro->insert_id;
			
			header("Location:seller_view.php?status=done&msg=Successfuly Inserted");	
		}
		else
			header("Location:seller_add_form.php?status=error&msg=Error in insert");
				
	}
	else
	{
		header("Location:index.php");
	}
?>