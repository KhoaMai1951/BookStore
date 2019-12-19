<?php
	session_start();
	include("database.php");
	$sql = "SELECT * FROM products ORDER BY id DESC";
	$result = $conn->query($sql);
?>

<?php
	//Thêm sản phẩm vào giỏ hàng
	if (isset($_POST["add"]))
		{
			if (isset($_SESSION["cart"]))
			{
				$item_array_id = array_column($_SESSION["cart"],"product_id");
				if (!in_array($_GET["id"],$item_array_id))
				{
					$count = count($_SESSION["cart"]);
					$item_array = array(
						'product_id' => $_GET["id"],
						'item_name' => $_POST["hidden_name"],
						'product_price' => $_POST["hidden_price"],
						'item_quantity' => $_POST["quantity"],
					);
					$_SESSION["cart"][$count] = $item_array;
					echo '<script>window.location="index.php"</script>';
				}else
				{
					echo '<script>alert("Product is already Added to Cart")</script>';
					echo '<script>window.location="index.php"</script>';
				}
			}
			else
			{
				$item_array = array(
					'product_id' => $_GET["id"],
					'item_name' => $_POST["hidden_name"],
					'product_price' => $_POST["hidden_price"],
					'item_quantity' => $_POST["quantity"],
				);
				$_SESSION["cart"][0] = $item_array;
			}
		}
		
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
					echo '<script>window.location="index.php"</script>';
				}
			}
		}
	}

	//Xuất mảng cart
	function pre_r($array)
	{
		echo '<pre>';
		print_r($array);
		echo '<pre>';
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		//Xóa sản phẩm trong giỏ  hàng
		$(".btn_remove").click(function(){
			var a = $(this).attr("id");
			var rowid = "#row"+a;
			$(rowid).remove();
				
			$.ajax({
			type: "POST",
			url: "delete_cart_ajax.php",
			data: { "ma": a },
			success: function(result){
			$("#total_data").html(result);
			}
			});
		});
	});
	</script>

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
		
		body{
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

		<form action="search.php" method="POST">
			<input type="text" name="search" placeholder="Search">
			<button type="submit" name="submit-search">Search</button>
		</form>

		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-4" style="padding-left: 20px;">
					
					<div class="div1"></div>
					
					<div class="cart-block" style=" background-color: darkgrey;">
								
								<!-- Code php xuất sản phẩm được chọn vào giỏ -->
								
								
									<table cellpadding="6" cellspacing="1" style="width:100%">
									<tr style="background-color: #008C33;">
										<th>QTY</th>
										<th>Product Name</th>
										<th>Total Price</th>
										<th>Remove Item</th>
									</tr>

									<?php
									if(!empty($_SESSION["cart"])):
						
									$total = 0;
									foreach ($_SESSION["cart"] as $key => $value):

									?>
									<tr id="row<?php echo $value["product_id"]; ?>">
										
										<td><?php echo $value["item_quantity"]; ?></td>
										<td><?php echo $value["item_name"]; ?></td>
										
										<td>
											$<?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?>
										</td>
										<td>
											<!-- Nút xóa sản phẩm trong giỏ hàng -->
											<button class="btn_remove" id="<?php echo $value["product_id"]; ?>">
												<span class="text-danger">Remove Item</span>
											</button>
										</td>
									</tr>
								<?php
								$total = $total + ($value["item_quantity"] * $value["product_price"]);
									endforeach;
								?>
										<tr style="border-bottom: 1px solid darkgrey;">
											<th style="border-bottom: 1px solid darkgrey; color: black;">Total</th>
											<th style="border-bottom: 1px solid darkgrey; color: black;"></th>
											<th id="total_data" style="border-bottom: 1px solid darkgrey; color: black;"><?php echo number_format($total,2). " $"; ?>
											</th>
											<th style="border-bottom: 1px solid darkgrey; color: black;"></th>
											</th>                           		
										</tr>
								<?php
								endif;
								?>
								</table>

							<a class="btn btn-dark" href="checkout.php">Go To Cart</a>
					</div>
					
					<!-- Danh sách catagories-->
					<div class="list-group" style="padding-top: 30px;">
						<b class="list-group-item" style="background-color: dimgray;">
							Categories
						</b>
						<?php 
						$sql_categories = "SELECT * FROM categories";
						$result_categories = $conn->query($sql_categories);
						if(mysqli_num_rows($result_categories)):
							while ($row = mysqli_fetch_array($result_categories)):
							?>
								<a href='product_by_category.php?id=<?php echo $row["id"]?>' class="list-group-item list-group-item-action">
									<?php echo $row['name']; ?>
								</a>
							<?php
							endwhile;
						endif;
						?>
					</div>
				</div>
				
				<div class="col-md-8">
					<div class="card">
						<div class="card-header" style="background:#008C33;">
							<div class="card-title" style="color:white; font-size: 25px;"><strong>Our Books</strong></div>
						</div>
						<div class="card-body" style="padding-top:0;">
							<div class="row">
							<?php
				
					if(mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_array($result)) {
							?>
							<div class="col-md-3">
								<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>" style="padding-top: 20px;">
									<div class="product">
									<a href='product_details.php?id=<?php echo $row["id"]?>'>
											<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" style='width:160px; height: 220px;' >
									</a>
										
										<h5 class="text-info" style="font-size:14px; height:40px;"><?php echo $row["title"]; ?></h5>
										<h5 class="text-danger"><?php echo $row["price"]; ?>$</h5>
										<input type="number" name="quantity" class="form-control" value="1" step="1">
										<input type="hidden" name="hidden_name" value="<?php echo $row["title"]; ?>">
										<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
										<input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
									</div>
								</form>
							</div>
							<?php
						}
					}
				?>						
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>
