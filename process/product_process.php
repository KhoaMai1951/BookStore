<!doctype html>
<html>
<head>
<link href="../css/custom.css" rel="stylesheet" type="text/css">
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = null;
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
	
//hàm xuất danh sách sản phẩm
	function Product_list($result)
	{
		if ( mysqli_num_rows($result) >0 )
		{
			// output data of each row 
			while($row = $result->fetch_assoc()) 
			{	
				/*
					<div class='col-md-4 game' style='padding-top: 30px; display: flex; flex-direction: column; background: white;'>
					<form method='post' action='index.php?action=add&id=".$row['id']."'>
						<div style='position: relative;'>
							<a href='product_details.php?id=".$row["id"]."'>
							
							<img src='images/".$row["image"]."' style='width:170px; height: 220px;'/>
							<div class='game-price' style='background:green; position: absolute; bottom: 10px; right: 39px; color:white; font-size:25px; padding:5px;'>"
								.$row["price"]."$
						</div>
							</a>
						</div>
						
						<div class='game-title' style='color:blue; font-size: 20px;' >"
							.$row["title"].
						"</div>
						<input type='hidden' name='title' value='".$row['title']."' />
						
						<input type='hidden' name='price' value='".$row['price']."' />						
						<div class='game-add' style='margin-top: auto;'>
							<input type='text' name='quantity' class='form-control' value='1'/ style='margin-bottom: 5px;'>
							<button class='btn btn-dark' type='submit' name='add_to_cart'>Add To Cart</button>
						</div>
					</form>
					</div>

				*/
				echo "
				
					<div class='col-md-4 game' style='padding-top: 30px; display: flex; flex-direction: column; background: white;'>
					<form method='post' action='index.php?action=add&id=".$row['id']."'>
						<div style='position: relative;'>
							<a href='product_details.php?id=".$row["id"]."'>
							
							<img src='images/".$row["image"]."' style='width:170px; height: 220px;'/>
							<div class='game-price' style='background:green; position: absolute; bottom: 10px; right: 39px; color:white; font-size:25px; padding:5px;'>"
								.$row["price"]."$
							</div>
							</a>
						</div>
						
						<div class='game-title' style='color:blue; font-size: 20px;' >"
							.$row["title"].
						"</div>
						<input type='hidden' name='title' value='".$row['title']."' />
						
						<input type='hidden' name='price' value='".$row['price']."' />						
						<div class='game-add' style='margin-top: auto;'>
							<input type='text' name='quantity' class='form-control' value='1'/ style='margin-bottom: 5px;'>
							<button class='btn btn-dark' type='submit' name='add_to_cart'>Add To Cart</button>
						</div>
					</form>
					</div>
				";
    		}
		}
	}
	
	function Product_list_by_category($result, $row)
	{
		echo "
		
		<div class='col-md-4 game' style='padding-top: 30px; display: flex; flex-direction: column; background: white;'>
						<div style='position: relative;'>
							<a href='product_details.php?id=".$row["id"]."'>
							
							<img src='images/".$row["image"]."' style='width:170px; height: 220px;'/>
							<div class='game-price' style='background:green; position: absolute; bottom: 10px; right: 39px; color:white; font-size:25px; padding:5px;'>"
								.$row["price"]."$
						</div>
							</a>
						</div>
						
						<div class='game-title' style='color:blue; font-size: 20px;' >"
							.$row["title"].
						"</div>
						<div class='game-add' style='margin-top: auto;'>
							<input type='text' name='quantity' class='form-control' value='1'/ style='margin-bottom: 5px;'>
							<button class='btn btn-dark' type='submit' name='add_to_cart'>Add To Cart</button>
						</div>
					</div>
	";
	}
?>
</body>
</html>