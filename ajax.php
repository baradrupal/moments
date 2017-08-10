<?php
//$con=mysqli_connect("localhost","","","");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moments";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





if(isset($_POST["folder_id"])){

	$f_id = $_POST["folder_id"];
	$query = "select * from sub_folder where f_id='$f_id'";
	$exe_que=mysqli_query($conn,$query);
	$output = array();
	while($row=mysqli_fetch_assoc($exe_que)){
		$output[] = array(
			"id" => $row["id"],
			"f_id" => $row["f_id"],			
			"name" => $row["name"]
		);
	}
	

	echo json_encode($output);
	// fetch and echo json

}

if(isset($_POST["sub_folder_id"])){

	$subf_id = $_POST["sub_folder_id"];
	$query = "select * from folder_images where subf_id='$subf_id'";

	$exe_que=mysqli_query($conn,$query);
	$output = array();
	while($row=mysqli_fetch_assoc($exe_que)){
		$output[] = array(
			"id" => $row["id"],
			"mf_id" => $row["mf_id"],
			"subf_id" => $row["subf_id"],
			"image" => $row["image"]
		);
	}
	

	echo json_encode($output);



}


?>