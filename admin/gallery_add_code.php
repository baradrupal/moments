<?php
	include("connection.php");
	session_start();
	
	if(isset($_SESSION['admin_name']))
	{
		
		$gallery=$_POST['gallery'];
		$page=$_POST['page'];
		
		$photo=$_FILES['photo']['name'];
		$file_type2=$_FILES['photo']['type'];
		$file_tmp_photo=$_FILES['photo']['tmp_name'];
		
		$query1="select * from tbl_g_type where gt_id=".$gallery;
		echo $query1;
		$sql1=mysql_query($query1) or die("error in query1");
		$row1=mysql_fetch_array($sql1);
		
		$count=0;
		$count1=0;
				
		for($i=0;$i<count($_FILES["photo"]["name"]);$i++)
		{
			if (($_FILES['photo']["type"][$i] == "image/jpeg" || $_FILES['photo']["type"][$i] == "image/png" || $_FILES['photo']["type"][$i] == "image/gif" ))
			{
				if(move_uploaded_file($_FILES['photo']["tmp_name"][$i],"../images/gallery/".$row1['gt_name']."/".$_FILES['photo']['name'][$i]))
				{
					$query= "insert into tbl_gallery (g_type, p_type, g_img) values( $gallery, $page, '".$_FILES['photo']['name'][$i]."')";
					$sql=mysql_query($query) or die("ERROR IN Query");
					
					$count++;
				}
			}
			else
				$count1++;
		}
		
		if($count!=0)	
			header("Location:gallery_add.php?succ=".$count."&unsu=".$count1);
		else
			header("Location:gallery_add.php?unsu=".$count1);
	
	
	}
	else
	{
		header("Location:index.php");
	}
?>