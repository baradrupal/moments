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
		
		
		$mc_id=$_POST['mc_id'];
		$pc_id=$_POST['pc_id'];
		$cc_id=$_POST['cc_id'];
		$pro_name=$_POST['pro_name'];
		$seller_id=$_POST['seller_id'];
		$rate=$_POST['rate'];
		$dis_rate=$_POST['dis_rate'];
		$quantity=$_POST['quantity'];
		$details=mysql_real_escape_string($_POST['details']);
		
		$photo_name=str_ireplace(" ","_",$pro_name).rand().".jpg";
				
		if(isset($_FILES['main_photo']['name']))
		{
			$main_photo=$_FILES['main_photo']['name'];
			$main_type=$_FILES['main_photo']['type'];
			$main_tmp_photo=$_FILES['main_photo']['tmp_name'];
		
			if(($main_type == "image/jpeg" || $main_type == "image/png" || $main_type == "image/gif" ))
			{
				if(move_uploaded_file($main_tmp_photo,"../upload/product/".$photo_name))
				{
					/*$image1 = new SimpleImage(); 
					$image1->load("../images/clients/".$photo); 
					$image1->resize(290,153); 
					$image1->save("../images/clients/small_".$photo);*/
					
					$sku = rand_password(5);
					
					$q_ipro="INSERT INTO `product_details`(`mc_id`, `pc_id`, `cc_id`, `product_name`, `product_code`, `product_image`, `price`, `discounted_price`, `description`, `quantity`, `seller_id`, `status`, `created_by`, `creater_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,1,?,?)";
					$st_ipro=$conn->prepare($q_ipro);
					
					if($st_ipro)
					{
						$st_ipro->bind_param('iiisssiisiiii', $mc_id, $pc_id, $cc_id, $pro_name, $sku, $photo_name, $rate, $dis_rate, $details, $quantity, $seller_id, $_SESSION['admin_type'], $_SESSION['admin_id']);
						$st_ipro->execute();
						
						$product_id=$st_ipro->insert_id;
						
						if(isset($_FILES['sub_photo']) && !empty($_FILES['sub_photo']))
						{
							//print_r($_FILES['sub_photo']);
							$count=count($_FILES['sub_photo']['name']);
							//echo $count;
							for($i=0;$i<$count;$i++)
							{
								//echo $i;
								$sub_photo=$_FILES['sub_photo']['name'][$i];
								$sub_type=$_FILES['sub_photo']['type'][$i];
								$sub_tmp_photo=$_FILES['sub_photo']['tmp_name'][$i];
								
								$sub_name=str_ireplace(" ","_",$pro_name).rand().".jpg";
								
								if($sub_type == "image/jpeg" || $sub_type == "image/png" || $sub_type == "image/gif" )
								{
									if(move_uploaded_file($sub_tmp_photo,"../upload/product/".$sub_name))
									{
										$q_mc="INSERT INTO `product_image`(`product_id`, `image_name`) VALUES (?,?)";
										$st_mc=$conn->prepare($q_mc);
										
										if($st_mc)
										{
											$st_mc->bind_param('is', $product_id, $sub_name);
											$st_mc->execute();
										}
									}
								}
							}
						}
						
						header("Location:product_view.php?status=done&msg=Successfuly Inserted");	
					}
					else
						header("Location:product_add_form.php?status=error&msg=Error in insert");
				}
				else
					header("Location:product_add_form.php?status=error&msg=Error in upload");
			}
			else
				header("Location:product_add_form.php?status=error&msg=Error in image type");
		}
		else
			header("Location:product_add_form.php?status=error&msg=Main photo is compulsory");
	}
	else
	{
		header("Location:index.php");
	}
?>