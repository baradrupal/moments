<?php 
include_once './config.php';
$categoryId = $_POST['mainfolder'];
echo "<option>Select Sub Folder Name</option>";
$res1= mysqli_query($con,"select * from `sub_folder`  WHERE `f_id` = '$categoryId'"); 
        while($data1=mysqli_fetch_array($res1))
        {
       		echo "<option value='".$data1['id']."'>".$data1['name']."</option>";            
        }
?>