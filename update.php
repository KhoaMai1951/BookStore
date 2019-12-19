<?php
include('database.php');

if(isset($_POST['update']))
{
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	// $category_id = mysqli_real_escape_string($conn, $_POST['category_id1']);
	$id =  mysqli_real_escape_string($conn, $_POST['product_id1']); 
	
	$query = "UPDATE products SET title = '".$title."', description = '".$description."', price = '".$price."' WHERE id = '".$id."'";
	
	if(!mysqli_query($conn, $query))
		{
			die('Error: '.mysqli_error($conn));
			
		}	
		else
		{
			echo $id;
			echo "Sửa thành công";
			echo "<a href='admin.php'>Click to return to Admin Page</a>";
			exit();
		}
	echo $title;
}