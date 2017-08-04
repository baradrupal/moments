<?php
	ob_start();
	include("connectionpool.php");
	session_start();

 	$ysid=$_POST['ysid'];
	
	$name=$_POST['name'];
	$type=$_POST['type'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$location=$_POST['location'];
	
	if(!isset($_POST['projector']))
	{
		$projector=0;
	}
	else
	{
		$projector=$_POST['projector'];
	}
	if(!isset($_POST['scanner']))
	{
		$scanner=0;
	}
	else
	{
		$scanner=$_POST['scanner'];
	}
	if(!isset($_POST['parking']))
	{
		$parking=0;
	}
	else
	{
		$scanner=$_POST['parking'];
	}
	
	if(!isset($_POST['ac']))
	{
		$ac=0;
	}
	else
	{
		$ac=$_POST['ac'];
	}
	
	if(!isset($_POST['locker']))
	{
		$locker=0;
	}
	else
	{
		$locker=$_POST['locker'];
	}
	
	if(!isset($_POST['phone']))
	{
		$phone=0;
	}
	else
	{
		$phone=$_POST['phone'];
	}
	
	if(!isset($_POST['mail']))
	{
		$mail=0;
	}
	else
	{
		$mail=$_POST['mail'];
	}
	
	if(!isset($_POST['wifi']))
	{
		$wifi=0;
	}
	else
	{
		$wifi=$_POST['wifi'];
	}
	
	if(!isset($_POST['work']))
	{
		$work=0;
	}
	else
	{
		$work=$_POST['work'];
	}
	
	$desc=$_POST['desc'];
	$price=$_POST['price'];
	
	$qy="select your_space_id from your_space where your_space_id=?";
	$sty=$conn->prepare($qy);
	if($sty)
	{
		$sty->bind_param('i',$ysid);
		$sty->execute();
		$sty->bind_param($ys_id);
		$sty->store_result();
		$sty->fetch();
		$count_ys=$sty->num_rows;
		if($count_ys != 0)
		{
			$qu="update your_space set space_name=?, email=?, phone=?, projector=?, scanner_printer=?, parking=?, ac=?, locker=?, ph=?, mail=?, wifi=?, work_24=?, location=?, description=?, price=? where your_space_id=?";
			$stu=$conn->prepare($qu);
			if($stu)
			{
				$stu->bind_param('sssiiiiiiiiisssi',$name,$email,$mobile,$projector,$scanner,$parking,$ac,$locker,$phone,$mail,$wifi,$work,$location,$desc,$lname,$price,$ysid);
				$stu->execute();
				
				if(!empty($_FILES['logo']['name']))
				{
					$lname=$_FILES['logo']['name'];
					$ftype=$_FILES['logo']['type'];
					$tmp_name=$_FILES['logo']['tmp_name'];
					if(($_FILES["logo"]["type"]=="image/jpeg" || $_FILES["logo"]["type"]=="image/jpg" || $_FILES["logo"]["type"]=="image/png" || $_FILES["logo"]["type"]=="image/gif"))
					{
						if(move_uploaded_file($tmp_name,"upload/logo/".$lname))
						{
							$qimg="update your_space set logo=? where your_space_id=?";
							$stimg=$conn->prepare($qimg);
							$stimg->bind_param('si',$lname,$ysid);
							$stimg->execute();
						}
						else
							header("Location:space_details.php?msg=Logo not upload&id=$ysid");
					}
					else
						header("Location:space_details.php?msg=Not an image&id=$ysid");
				}
					
				$qdelete="delete from open_close_hour where your_space_id=?";
				$stde=$conn->prepare($qdelete);
				$stde->bind_param('i',$ysid);
				$stde->execute();
				
				$flag=0;
				for($i=1;$i<8;$i++)
				{
					$day=$_POST['d'.$i];
					$start=$_POST['dstrt'.$i];
					$close=$_POST['dend'.$i];
					
					$qd="insert into open_close_hour (your_space_id,day,open_time,close_time) values (?,?,?,?)";
					$std=$conn->prepare($qd);
					if($std)
					{
						$std->bind_param('isss',$ysid,$day,$start,$close);
						$std->execute();
						$flag=1;
					}
					else
					{
						$flag=0;
					}
				}
				if($flag==1)
				{
					header("Location:admin_home.php?msg=Success...");
				}
			}
		}
		else
			header("Location:admin_home?msg=No space found.");
	}
	
?>