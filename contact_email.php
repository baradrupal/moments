<?php
	
	$name=$_POST['name'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];

	$subject=$name." has contact you from moments website";

	//$from = $email; 
	$from = "info@momentsunlimited.in"; 
	//$from = "jaydeep.wwe@gmail.com"; 
	$headers = "From:".$from."\r\n";
	$headers.= "MIME-Version: 1.0\r\n"; 
	$headers.= "Content-Type: text/html; charset=utf-8\r\n"; 
	$headers.= "X-Priority: 1\r\n";

	$text=" <html>
			<body>
				<h3>Details of contact form:</h3><br/><br/>
				<b>Name:</b>".$name."<br/>
				<b>email:</b>".$email."<br/>
				<b>Subject:</b>".$subject."<br/>
				<b>Message:</b><p>".$message."</p><br/>
			</body>
			</html>";
						  
	mail("smile@momentsunlimited.in", $subject, $text, $headers); //smile@momentsunlimited.in
	
	header("Location:index.html");

?>