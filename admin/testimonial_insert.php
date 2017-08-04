<?php
	include("connectionpool.php");
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
		
		$name=$_POST['client_name'];
		$message=$_POST['message'];
		
		$photo=$_FILES['photo']['name'];
		$file_type=$_FILES['photo']['type'];
		$file_tmp_photo=$_FILES['photo']['tmp_name'];
		
		$photo_name=str_ireplace(" ","_",$name).rand().".jpg";
				
		if (($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif" ))
		{
			if(move_uploaded_file($file_tmp_photo,"../upload/testimonial/".$photo_name))
			{
				$image1 = new SimpleImage(); 
				$image1->load("../upload/testimonial/".$photo); 
				$image1->resize(100,100); 
				$image1->save("../upload/testimonial/small_".$photo);
				
				$q_mc="INSERT INTO `testimonial`(`name`, `image`, `description`) VALUES (?,?,?)";
				$st_mc=$conn->prepare($q_mc);
				
				if($st_mc)
				{
					$st_mc->bind_param('sss', $name, $photo_name, $message);
					$st_mc->execute();
						
					header("Location:testimonial.php?status=done&msg=Successfuly Inserted");	
				}
				else
					header("Location:testimonial.php?status=done&msg=Error in insert");
			}
			else
				header("Location:testimonial.php?status=done&msg=Error in upload");
		}
		else
			header("Location:testimonial.php?status=done&msg=Error in type");
	}
	else
	{
		header("Location:index.php");
	}
?>