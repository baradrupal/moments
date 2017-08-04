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
		
		$j=0;
		$count=count($_FILES['photo']['name']);
		
		for($i=0;$i<$count;$i++)
		{
			$photo=$_FILES['photo']['name'][$i];
			$file_type=$_FILES['photo']['type'][$i];
			$file_tmp_photo=$_FILES['photo']['tmp_name'][$i];

			if (($file_type == "image/jpeg" || $file_type == "image/png" || $file_type == "image/gif" ))
			{
				if(move_uploaded_file($file_tmp_photo,"../upload/clients/".$photo))
				{
					$image1 = new SimpleImage(); 
					$image1->load("../upload/clients/".$photo); 
					$image1->resize(106,64); 
					$image1->save("../upload/clients/small_".$photo);

					$qd="INSERT INTO `tbl_clients`(`image`) VALUES (?)";
					$std=$conn->prepare($qd);
					if($std)
					{
						$std->bind_param('s',$photo);
						$std->execute();
						
						$j++;
					}
//					else
//					{
//						header("Location:clients.php?status=done&msg=Error in insert");
//					}					
				}
//				else
//					header("Location:clients.php?status=done&msg=Error in upload");
			}
//			else
//				header("Location:clients.php?status=done&msg=Error in type");	
		}
		
		if($j==0)
		{
			header("Location:clients.php?status=done&msg=Error in upload");
		}
		else
		{
			header("Location:clients.php?status=done&msg=".$j." images Successfuly Inserted");	
		}
		
	}
	else
	{
		header("Location:index.php");
	}
?>