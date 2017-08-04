<?php
	include("connection.php");
	session_start();
	
	if(isset($_SESSION['admin_name']))
	{
		
		class SimpleImage {
	 
			var $image;
			var $image_type;
			   
			function load($filename) {   
				$image_info = getimagesize($filename); 
				$this->image_type = $image_info[2]; 
				if( $this->image_type == IMAGETYPE_JPEG ) {   
					$this->image = imagecreatefromjpeg($filename); 
				} elseif( $this->image_type == IMAGETYPE_GIF ) {   
					$this->image = imagecreatefromgif($filename); 
				} elseif( $this->image_type == IMAGETYPE_PNG ) {   
					$this->image = imagecreatefrompng($filename); } 
			} 
			
			
			function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {   
				if( $image_type == IMAGETYPE_JPEG ) { 
					imagejpeg($this->image,$filename,$compression); 
				} elseif( $image_type == IMAGETYPE_GIF ) {   
					imagegif($this->image,$filename); 
				} elseif( $image_type == IMAGETYPE_PNG ) {   
					imagepng($this->image,$filename); 
				} 
				if( $permissions != null) {   
					chmod($filename,$permissions); 
				} 
			}
			
			 
			function output($image_type=IMAGETYPE_JPEG) {   
				if( $image_type == IMAGETYPE_JPEG ) { 
					imagejpeg($this->image); 
				} elseif( $image_type == IMAGETYPE_GIF ) {   
					imagegif($this->image); 
				} elseif( $image_type == IMAGETYPE_PNG ) {   
					imagepng($this->image); 
				} 
			}
			
			 
			function getWidth() {   
				return imagesx($this->image); 
			} 
			
			function getHeight() {   
				return imagesy($this->image); 
			} 
			
			function resizeToHeight($height) {   
				$ratio = $height / $this->getHeight(); 
				$width = $this->getWidth() * $ratio; $this->resize($width,$height); 
			}   
			
			function resizeToWidth($width) { 
				$ratio = $width / $this->getWidth(); 
				$height = $this->getheight() * $ratio; $this->resize($width,$height); 
			}   
			
			function scale($scale) { 
				$width = $this->getWidth() * $scale/100; 
				$height = $this->getheight() * $scale/100; $this->resize($width,$height); 
			}   
			
			function resize($width,$height) { 
				$new_image = imagecreatetruecolor($width, $height); 
				imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight()); 
				$this->image = $new_image; 
			}   
		}
		
		
		$gallery=$_POST['gallery'];
		$p_no=$_POST['p_no'];
		$p_name=$_POST['p_name'];
		$range=$_POST['range'];
		$color=$_POST['color'];
		$finish=$_POST['finish'];
		$size=$_POST['size'];
		$desc=$_POST['desc'];
		
		$photo=$_FILES['photo']['name'];
		$file_type2=$_FILES['photo']['type'];
		$file_tmp_photo=$_FILES['photo']['tmp_name'];
		
		if (($_FILES['photo']["type"] == "image/jpeg" || $_FILES['photo']["type"] == "image/png" || $_FILES['photo']["type"] == "image/gif" ))
		{
			if(move_uploaded_file($_FILES['photo']["tmp_name"],"../product/".$_FILES['photo']['name']))
			{
				$image = new SimpleImage(); 
				$image->load("../product/".$photo); 
				$image->resize(290,153); 
				$image->save("../product/small_".$photo);
					
				$query= "insert into tbl_photo (g_type, image, p_no, p_name, rang, color, finish, size, p_desc) values( $gallery, '".$_FILES['photo']['name']."', '".$p_no."', '".$p_name."', '".$range."', '".$color."', '".$finish."', '".$size."', '".$desc."' )";
				$sql=mysql_query($query) or die("ERROR IN Query");	
				
				header("Location:photo_add.php?succ");
			}
		}
		else
		{
			header("Location:photo_add.php?unsu");
		}	
	
	}
	else
	{
		header("Location:index.php");
	}
?>