<?php
include('database.php');
//Xóa sản phẩm
if(isset($_POST['submit']))
{	
	$image = str_replace(" ","",$_POST['image']);

	$path = "images/".$image;
	echo $path;
	echo "<br>";
	unlink($path);
	$product_id = $_POST['product_id'];
	$query = "DELETE FROM products WHERE id = ".$product_id."";
		if(!mysqli_query($conn, $query))
		{
			die('Error: '.mysqli_error($conn));
		}	
		else
		{
			echo $product_id;
			echo "Xóa sản phẩm thành công";
			echo "<a href='admin.php'>Click to return to Admin Page</a>";
			exit();
		}
}
//Xóa đơn hàng
if(isset($_POST['delete_order']))
{
	$order_id = $_POST['order_id'];
	$query = "DELETE FROM orders WHERE id = '$order_id'";
	if(!mysqli_query($conn, $query))
		{
			die('Error: '.mysqli_error($conn));
		}	
	else
		{
			echo "Xóa đơn hàng thành công";
			echo "<a href='admin.php'>Click to return to Admin Page</a>";
			exit();
		}
}

//Xác nhận đơn hàng đã được giao cho khách
if(isset($_POST['finish_order']))
{
	$order_id = $_POST['order_id'];
	$query = "UPDATE orders
			SET payment_confirm = '1'
			WHERE id = '$order_id'";
	if(!mysqli_query($conn, $query))
		{
			die('Error: '.mysqli_error($conn));
		}	
	else
		{
			echo "Giao đơn hàng thành công";
			echo "<a href='admin.php'>Click to return to Admin Page</a>";
			exit();
		}
}
?>


