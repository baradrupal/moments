<?php
	session_start();
	if(isset($_SESSION['admin_name']))
	{
		include("connectionpool.php");
		
		$id = $_GET['id'];
		
		$abc='<label class="control-label" for="selectError">Select Parent Category:- </label>
                
		<div class="controls">
			<select id="select" data-rel="chosen" name="pc_id">
				<option disabled selected value="">Select Parent Category</option>';
					
					$query_mc = "SELECT `pc_id`, `pc_name` FROM `parent_category` WHERE `mc_id`=?";
					$stmt_mc = $conn->prepare($query_mc);
					if($stmt_mc) 
					{	
						$stmt_mc->bind_param("i",$id);
						$stmt_mc->execute();
						$stmt_mc->bind_result($pc_id, $pc_name);
						$stmt_mc->store_result();
						
						while ($stmt_mc->fetch()) 
						{	

						$abc.='<option value="'.$pc_id.'">'.$pc_name.'</option>';	
				    			
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
									