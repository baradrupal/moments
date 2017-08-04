<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
		
		$id = $_GET['id'];
		
		$abc='<label class="control-label" for="selectError">Select Child Category:- </label>
                
		<div class="controls">
			<select id="select" data-rel="chosen" name="cc_id">
				<option disabled selected value="">Select Child Category</option>';
					
					$query_mc = "SELECT `cc_id`, `cc_name` FROM `child_category` WHERE `pc_id`=?";
					$stmt_mc = $conn->prepare($query_mc);
					if($stmt_mc) 
					{	
						$stmt_mc->bind_param("i",$id);
						$stmt_mc->execute();
						$stmt_mc->bind_result($cc_id, $cc_name);
						$stmt_mc->store_result();
						
						while ($stmt_mc->fetch()) 
						{	

						$abc.='<option value="'.$cc_id.'">'.$cc_name.'</option>';	
				    			
						}
					}
					$stmt_mc->close();
				
			$abc.='</select>
		</div>';
		
		echo $abc;
	}
	else
	{
		header("Location:index.php");
	}
?>
									