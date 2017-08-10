<?php 
include_once './config.php';
$categoryId = $_POST['categoryId'];
echo "<option>Select Sub Category</option>";
$res1= mysqli_query($con,"select * from `subcategory`  WHERE `cat_id` = '$categoryId'"); 
        while($data1=mysqli_fetch_array($res1))
        {
       echo "<option value='".$data1['id']."'>".$data1['name']."</option>" ;
            
        }
?>