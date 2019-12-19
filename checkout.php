<?php
	session_start();
	include("database.php");
	$sql = "SELECT * FROM products ORDER BY id DESC";
	$result = $conn->query($sql);
?>

<?php
	//Xóa sản phẩm khỏi giỏ hàng
	if (isset($_GET["action"]))
	{
        if ($_GET["action"] == "delete")
		{
            foreach ($_SESSION["cart"] as $keys => $value)
			{
                if ($value["product_id"] == $_GET["id"])
				{
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("Product has been Removed...!")</script>';
                    echo '<script>window.location="checkout.php"</script>';
                }
            }
        }
	}
	
	function pre_r($array)
	{
		echo '<pre>';
		print_r($array);
		echo '<pre>';
	}
?>

<!-- Thêm từng sản phẩm được chọn vào table order_test-->
<?php
	if(isset($_POST['submit']))
	{
		if(!empty($_SESSION["cart"])):
			foreach ($_SESSION["cart"] as $key => $value):
				$product_name = $value["item_name"]; 
				$quantity = $value["item_quantity"];
				$total_price = number_format($value["item_quantity"] * $value["product_price"], 2);
				$customer_name = $_POST['customer_name'];
				$email = $_POST['email'];
				$address = $_POST['address'];
		
				date_default_timezone_set('Asia/Bangkok');
				$time = date("Y-M-d");
				$time= date("Y-m-d",strtotime($time));

				
				$query_order = "INSERT INTO orders(product_name, quantity, total_price, customer_name, email, address, order_date, payment_confirm) 
				VALUES ('$product_name', '$quantity', '$total_price', '$customer_name', '$email', '$address', '$time', 0)";
				
				if(!mysqli_query($conn, $query_order))
				{
					die('Error: '.mysqli_error($conn));
				}
				else echo '<script>alert("Order completed!")</script>'; 
		
			endforeach;
		endif;
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Book Store</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

    <!-- Bootstrap core CSS -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet" type="text/css">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
	<script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

    <style>
		table, th, td {
	
		}
		tr {
			border-bottom: 1px solid black;
  			border-collapse: collapse;
		}
		
		th {
			color:white;
		}
		
	
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		
		body {
			padding-top: 80px;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
			font-size: 3.5rem;
			}
		}
    </style>
    <!-- Custom styles for this template -->
  </head>
  <body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="index.php">Book Store</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<!-- <div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		</li>
		</ul>
	</div> -->
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-7" style="padding-left: 20px;">
				<!-- giỏ hàng -->
				<div class="cart-block" style="border-color: aqua; background-color: darkgrey;">
							<!-- Code php xuất sản phẩm được chọn vào giỏ -->
							<div class="table-responsive">
								<table class="table table-bordered">
								<tr>
									<th width="30%">Product Name</th>
									<th width="10%">Quantity</th>
									<th width="13%">Price Details</th>
									<th width="10%">Total Price</th>
									<th width="17%">Remove Item</th>
								</tr>

								<?php
								if(!empty($_SESSION["cart"])):
					
								$total = 0;
								foreach ($_SESSION["cart"] as $key => $value):

								?>
								<tr>
									<td><?php echo $value["item_name"]; ?></td>
									<td><?php echo $value["item_quantity"]; ?></td>
									<td>$<?php echo $value["product_price"]; ?></td>
									<td>
										$<?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?>
									</td>
									<td>
										<a href="checkout.php?action=delete&id=<?php echo $value["product_id"]; ?>">
											<span class="text-danger">Remove Item</span>
										</a>
									</td>
								</tr>
							<?php
							$total = $total + ($value["item_quantity"] * $value["product_price"]);
								endforeach;
							?>
									<tr>
										<td colspan="3" align="right">Total</td>
										<th align="right">$ <?php echo number_format($total, 2); ?></th>
										<td></td>
									</tr>
							<?php
							endif;
							?>
								</table>
							</div>				
				</div>
		</div>
		<div class="col-5">
			<!-- form thông tin khách hàng -->
				<div class="card">
					<div class="card-header">Customer Info</div>
					<div class="card-body">
						<form action="checkout.php" method="post" enctype="multipart/form-data">
							Customer Name: <input type="text" name="customer_name"><br><br>
							Email: <input type="text" name="email"><br><br>
							Address: <input type="text" name="address"><br><br>
							<!--Nút thanh toán đơn hàng -->
							<input type="submit" value="Checkout" name="submit">
							
						</form>
					</div>
				</div>		
			</div>
		</div>
	</div>
</body>
</html>
