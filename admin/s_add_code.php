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
		
		
		$sname=$_POST['sname'];
		$datetime = date("Y-m-d H:i:s",time()+(60*330));
		
		$photo=$_FILES['photo']['name'];
		$file_type2=$_FILES['photo']['type'];
		$file_tmp_photo=$_FILES['photo']['tmp_name'];
		
		$error = '';
		if(trim($sname) == '') {
			$error .= '<li>Image name is required.</li>';
		}
		if(trim($photo) == '') {
			$error .= '<li>Photo is required.</li>';
		}
		if($error != '') {
			echo '<div class="notification error closeable"><p><strong>Attention! Please correct the errors below and try again.</strong></p>';
			echo '<ul class="error_messages">' . $error . '</ul>';
			echo '</div>';
		}
		else
		{	
			if($file_type2=="image/jpeg" || $file_type2=="image/jpg" || $file_type2=="image/png" || $file_type2=="image/gif")
			{
				if(move_uploaded_file($file_tmp_photo,"../images/slider/".$photo))
				{
					$image1 = new SimpleImage(); 
					$image1->load("../images/slider/".$photo); 
					$image1->resize(424,318); 
					$image1->save("../images/slider/small_".$photo);
					
					$query= "insert into tbl_slider (s_name, s_img, date) values('$sname','$photo','$datetime')";
					//echo $sql;
					$sql=mysql_query($query) or die("ERROR IN Query");
					
					if($sql)
					{
						header("location:s_add.php?upload=done");
					}
					else
						header("location:s_add.php?error=sql");
				}
				else
					header("location:s_add.php?error=upload");
			}
			else
				header("location:s_add.php?error=type");
		}		
	}
	else
	{
		header("Location:index.php");
	}
?>