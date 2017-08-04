<?php
	
	$name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$city=$_POST['city'];
	$exp=$_POST['exp'];
	$comment=$_POST['comment'];

	$subject=$name." want FRANCHISE. Sent from moments website";

	//$from = $email; 
	$from = "info@momentsunlimited.in"; 
	$headers = "From:".$from."\r\n";
	$headers.= "MIME-Version: 1.0\r\n"; 
	$headers.= "Content-Type: text/html; charset=utf-8\r\n"; 
	$headers.= "X-Priority: 1\r\n";

	$text=" <html>
			<body>
				<h3>Details of ASK FOR FRANCHISE form:</h3><br/><br/>
				<b>Name:</b>".$name."<br/>
				<b>email:</b>".$email."<br/>
				<b>Mobile:</b>".$mobile."<br/>
				<b>City:</b>".$city."<br/>
				<b>Business Experience:</b>".$exp."<br/>
				<b>Message:</b><p>".$comment."</p><br/>
			</body>
			</html>";
						  
	mail("shahhirav@gmail.com", $subject, $text, $headers); //shahhirav@gmail.com
	
	header("Location:index.html");

?>