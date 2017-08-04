<?php
	include("connectionpool.php");
	session_start();
	
	function rand_password($length)
	{
		  $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		  $chars .= '0123456789' ;
		  // $chars .= '!@#%^&*()_,./<>?;:[]{}\|=+';
		
		  $str = '';
		  $max = strlen($chars) - 1;
		
		  for ($i=0; $i < $length; $i++)
			$str .= $chars[rand(0, $max)];
		
		  return $str;
	}
	
	if(isset($_SESSION['admin_name']))
	{
		
		class SimpleImage 
		{	
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
		
		$pro_id=$_POST['pro_id'];
		$mc_id=$_POST['mc_id'];
		$pc_id=$_POST['pc_id'];
		$cc_id=$_POST['cc_id'];
		$pro_name=$_POST['pro_name'];
		$seller_id=$_POST['seller_id'];
		$rate=$_POST['rate'];
		$dis_rate=$_POST['dis_rate'];
		$quantity=$_POST['quantity'];
		$details=mysql_real_escape_string($_POST['details']);
		
		$sku = $_POST['pro_code'];
		
		$q_ipro="UPDATE `product_details` SET `mc_id`=?, `pc_id`=?, `cc_id`=?, `product_name`=?, `product_code`=?, `price`=?, `discounted_price`=?, `description`=?, `quantity`=?, `seller_id`=? WHERE `product_id`=?";
		$st_ipro=$conn->prepare($q_ipro);
		
		if($st_ipro)
		{
			$st_ipro->bind_param('iiissiisiii', $mc_id, $pc_id, $cc_id, $pro_name, $sku, $rate, $dis_rate, $details, $quantity, $seller_id, $pro_id);
			$st_ipro->execute();
			
			header("Location:product_view.php?status=done&msg=Successfuly updated");	
		}
		else
			header("Location:product_add_form.php?status=error&msg=Error in insert");
				
	}
	else
	{
		header("Location:index.php");
	}
?>