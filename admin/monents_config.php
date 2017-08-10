<?php
$con =mysqli_connect("localhost", "root", "", "moments");
function check_input($data) 
	{
            $data = trim($data);
			//	$data=htmlentities(strip_tags($data));
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
            if (get_magic_quotes_gpc())
            $data = stripslashes($data);
			$data = addslashes($data);
			@mysqli_real_escape_string(stripslashes($con,$data));
			return $data;
     }
?>
