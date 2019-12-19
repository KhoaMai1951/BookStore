<!doctype html>
<?php
session_start();
if(empty($_SESSION['logged_in']))
{
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/bookstore/login.php');
    exit;
}
?>

<?php
include ('database.php');

$sql = "SELECT * FROM products ORDER BY title ASC";
$result = $conn->query($sql);
?>



<style>
 td, th {
  border: 1px solid #ddd;
  padding: 8px;
}
</style>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Book Store</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">

<!--KHÔNG XÓA SCRIPT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	//Show danh sách đặt hàng theo tháng
  $("#btn1").click(function(){
	var thang = '06';
    $.ajax({type: "POST", 
			url: "show_order.php",  
			data: {"month": thang}, 
			success: function(result){
      $(".table_order").html(result);
    }});
  });
	
	//Show báo cáo doanh thu
	$("#btn_report").click(function(){
		var nam = $('#year_report').val();
		var thang = $('#month_report').val();
		$.ajax({
			type: "POST",
			url: "show_report.php",
			data: {"month": thang, "year": nam},
			success: function(data){
				$("#div_report").html(data);
			}
		});
	});
	
	$("#month_report").change(function(){
		var nam = $('#year_report').val();
		var thang = $('#month_report').val();
		$.ajax({
			type: "POST",
			url: "show_report.php",
			data: {"month": thang, "year": nam},
			success: function(data){
				$("#div_report").html(data);
			}
		});
	});
	
	$("#year_report").change(function(){
		var nam = $('#year_report').val();
		var thang = $('#month_report').val();
		$.ajax({
			type: "POST",
			url: "show_report.php",
			data: {"month": thang, "year": nam},
			success: function(data){
				$("#div_report").html(data);
			}
		});
	});
	
});
	
	
</script>

</head>
<body>

<div class="wrapper" style="display: flex;
    width: 100%;
    align-items: stretch;">
	
	<!-- SIDEBAR -->
	<nav id="sidebar" style="min-width: 250px;
    max-width: 250px;
    min-height: 100vh;">
		<!-- Nav pills -->
   		<ul class="nav nav-pills flex-column" role="tablist" style="background-color: #151515; min-width: 250px;  min-height: 100vh;">
   			<li class="nav-item">
   				<p style="color:aliceblue; padding: 10px 5px 5px 35px; vertical-align: length; font-size: 45px; background-color: #444444;"><b>ADMIN</b></p>
   			</li>
    		<li class="nav-item ">
     		 	<a class="nav-link active" data-toggle="pill" href="#menu1" style="color:white;">Add Product</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link" data-toggle="pill" href="#menu2" style="color:white;">Delete Product</a>
    		</li>
   		 	<li class="nav-item">
   		   		<a class="nav-link" data-toggle="pill" href="#menu3" style="color:white;">Change Product</a>
  		  	</li>
  		  	<li class="nav-item">
   		   		<a class="nav-link" data-toggle="pill" href="#menu4" style="color:white;">Orders</a>
  		  	</li>
  		  	<li class="nav-item">
   		   		<a class="nav-link" data-toggle="pill" href="#menu5" style="color:white;">Report</a>
  		  	</li>
 		 </ul>
	</nav>
	
	<!-- CONTENT -->
	<div class="tab-content">	
	<!-- THÊM SẢN PHẨM -->
	<div id="menu1" class="container tab-pane active"><br>
    	<div class="card">
    		<div class="card-header">ADD PRODUCT</div>
    		<div class="card-body">
    			<form action="upload.php" method="post" enctype="multipart/form-data">
   		 			Select image to upload:
   					<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
   					Title: <input type="text" name="title"><br><br>
   					Description: <input type="text" name="description"><br><br>
   					Price: <input type="number" min="0" step="0.01" name="price"><br><br>
   					Category: <select name="category">
    					<option value="1">Arts & Music</option>
    					<option value="2">Biographies</option>
    					<option value="3">Business</option>
						<option value="4">Kids</option>
						<option value="5">Comics</option>
						<option value="6">Computers & Tech</option>
						<option value="7">Cooking</option>
						<option value="8">Hobbies & Crafts</option>
						<option value="9">Edu & Reference</option>
						<option value="10">Health & Fitness</option>
						<option value="11">History</option>
						<option value="12">Home & Garden</option>
						<option value="13">Horror</option>
						<option value="14">Entertainment</option>
						<option value="15">Literature & Fiction</option>
						<option value="16">Medical</option>
						<option value="17">Mysteries</option>
						<option value="18">Parenting</option>
						<option value="19">Social Sciences</option>
						<option value="20">Religion</option>
						<option value="21">Science & Math</option>
						<option value="22">Self-Help</option>
						<option value="23">Sports</option>
						<option value="24">Teen</option>
						<option value="25">Travel</option>
  					</select><br><br>
    				<input type="submit" value="Upload Product" name="submit">
				</form>
    		</div>
    	</div>
	</div>
	
	<!-- XÓA SẢN PHẨM -->
	<div id="menu2" class="container tab-pane fade"><br>
    	<div class="card">
    		<div class="card-header">DELETE PRODUCT</div>
    		<div class="card-body">
    			<table>
    				<col name="title" width="100px">
    				<col name="category" width="100px">
    				<col name=description width="400px">
    				<col name="image" width="120px">
    				<col name="price" width="50px">
    				<col name="action" width="50px">
    				<tr>
    					<th>title</th>
    					<th>category</th>
    					<th>description</th>
    					<th>image</th>
    					<th>price</th>
    					<th>action</th>
    				</tr>
    				
					<!--
    				<tr style='height: 10px; overflow: hidden;'>
    				<form action="delete.php" method="post" enctype="multipart/form-data">
   						<td style='padding-right: 10px;' valign="top">Starcraft 2</td>
    					<td style='padding-right: 10px;' valign="top">XBox</td>
    					<td style='padding-right: 10px; height: 10px; overflow: hidden' valign="top">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</td>
    					<td style='padding-right: 10px; padding-top: 10px;' valign="top"><img src='images/game1.jpg' style='height:150px; width:100px;'></td>
    					<td style='padding-right: 10px;' valign="top">55.55$</td>
    					<td style='padding-right: 10px; padding-top: 10px;' valign="top"><input type="submit" value="Delete Product" name="submit"></td>
  					</form>
  					</tr>
  					-->
  				
  					<?php
					//Xuất từng sản phẩm 
					if ( mysqli_num_rows($result) >0 ):
						while($row = $result->fetch_assoc()):
							?>
		    				<tr style='height: 10px; overflow: hidden;'>
    						<form action="delete.php" method="post" enctype="multipart/form-data">
   							<td style='padding-right: 10px;' valign="top">
   							<?php 
								echo $row['title'];
							?>
 							<!-- Lấy id của product-->
  							<input type='hidden' name='product_id' value=
  							'
  							<?php echo $row['id'] ?>
  							'>
  							<!-- Lấy tên hình ảnh của product-->
  							<input type='hidden' name='image' value='<?php echo $row['image'] ?>'>
   							</td>
    						<td style='padding-right: 10px;' valign="top">
    						<?php 
								switch($row['category_id'])
								{
									case 1:
										echo "Arts & Music";
										break;
									case 2:
										echo "Biographies";
										break;
									case 3:
										echo "Business";
										break;
									case 4:
										echo "Kids";
										break;
									case 5:
										echo "Comics";
										break;
									case 6:
										echo "Computers & Tech";
										break;
									case 7:
										echo "Cooking";
										break;
									case 8:
										echo "Hobbies & Crafts";
										break;
									case 9:
										echo "Edu & Reference";
										break;
									case 10:
										echo "Health & Fitness";
										break;
									case 11:
										echo "History";
										break;
									case 12:
										echo "Home & Garden";
										break;
									case 13:
										echo "Horror";
										break;
									case 14:
										echo "Entertainment";
										break;
									case 15:
										echo "Literature & Fiction";
										break;
									case 16:
										echo "Medical";
										break;
									case 17:
										echo "Mysteries";
										break;
									case 18:
										echo "Parenting";
										break;
									case 19:
										echo "Social Sciences";
										break;
									case 20:
										echo "Religion";
										break;
									case 21:
										echo "Science & Math";
										break;
									case 22:
										echo "Self-Help";
										break;
									case 23:
										echo "Sports";
										break;
									case 24:
										echo "Teen";
										break;
									case 25:
										echo "Travel";
										break;
								}	
							?>
    						</td>
    						<td style='padding-right: 10px; height: 10px; overflow: hidden' valign="top">
    							<?php
									echo $row['description'];
								?>
    						</td>
    						<td style='padding-right: 10px; padding-top: 10px;' valign="top"><img src='images/<?php echo $row['image'] ?>' style='height:150px; width:100px;'></td>
    						<td style='padding-right: 10px;' valign="top">
    							<?php 
									echo $row['price']."$";
								?>
    						</td>
    						<td style='padding-right: 10px; padding-top: 10px;' valign="top"><input type="submit" value="Delete Product" name="submit"></td>
  							</form>
  							</tr>					
					<?php
						endwhile;
					endif;
					?>
    			</table>
    		</div>
    	</div>
	</div>
	
	<!-- SỬA SẢN PHẨM -->
	<div id="menu3" class="container tab-pane fade"><br>

    			<table width="100%">
    				<col name="title" >
    				<col name="category" >
    				<col name=description >
    				<col name="image" >
    				<col name="price"  >
    				<col name="action" >
    				<tr>
    					<th>title</th>
    					<th>category</th>
    					<th>description</th>
    					<th>image</th>
    					<th>price</th>
    					<th>action</th>
    				</tr>
    				
					<!--
    				<tr style='height: 10px; overflow: hidden;'>
    				<form action="delete.php" method="post" enctype="multipart/form-data">
   						<td style='padding-right: 10px;' valign="top">Starcraft 2</td>
    					<td style='padding-right: 10px;' valign="top">XBox</td>
    					<td style='padding-right: 10px; height: 10px; overflow: hidden' valign="top">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</td>
    					<td style='padding-right: 10px; padding-top: 10px;' valign="top"><img src='images/game1.jpg' style='height:150px; width:100px;'></td>
    					<td style='padding-right: 10px;' valign="top">55.55$</td>
    					<td style='padding-right: 10px; padding-top: 10px;' valign="top"><input type="submit" value="Delete Product" name="submit"></td>
  					</form>
  					</tr>
  					-->
  				
  					<?php
					//Xuất từng sản phẩm 
					$sql = "SELECT * FROM products ORDER BY title ASC";
					$result = $conn->query($sql);
					if ( mysqli_num_rows($result) >0 ):
						while($row = $result->fetch_assoc()):
							?>
	    			<!-- Xuất data cho 1 row -->
		    				<tr style='height: 10px; overflow: hidden;'>
    						<form action="update.php" method="post" >
    					<!-- Cột title -->
   							<td style='padding-right: 10px;' valign="top">
   								<input type="text" name="title" value="<?php echo $row['title'];?>">
   							
 								<!-- Lấy id của product-->
  								<input type='hidden' name='product_id1' value='<?php echo $row['id'] ?>'>
  								<!-- Lấy tên hình ảnh của product-->
  								<input type='hidden' name='image' value='<?php echo $row['image'] ?>'>
   							</td>
   						<!-- Cột category -->
    						<td style='padding-right: 10px;' valign="top">
    							<?php 
								switch($row['category_id'])
								{
									case 1:
										echo "Arts & Music";
										break;
									case 2:
										echo "Biographies";
										break;
									case 3:
										echo "Business";
										break;
									case 4:
										echo "Kids";
										break;
									case 5:
										echo "Comics";
										break;
									case 6:
										echo "Computers & Tech";
										break;
									case 7:
										echo "Cooking";
										break;
									case 8:
										echo "Hobbies & Crafts";
										break;
									case 9:
										echo "Edu & Reference";
										break;
									case 10:
										echo "Health & Fitness";
										break;
									case 11:
										echo "History";
										break;
									case 12:
										echo "Home & Garden";
										break;
									case 13:
										echo "Horror";
										break;
									case 14:
										echo "Entertainment";
										break;
									case 15:
										echo "Literature & Fiction";
										break;
									case 16:
										echo "Medical";
										break;
									case 17:
										echo "Mysteries";
										break;
									case 18:
										echo "Parenting";
										break;
									case 19:
										echo "Social Sciences";
										break;
									case 20:
										echo "Religion";
										break;
									case 21:
										echo "Science & Math";
										break;
									case 22:
										echo "Self-Help";
										break;
									case 23:
										echo "Sports";
										break;
									case 24:
										echo "Teen";
										break;
									case 25:
										echo "Travel";
										break;
								}	
							?>
    						</td>
    					<!-- Cột description -->
    						<td style='padding-right: 10px; height: 10px; overflow: hidden' valign="top">
    							<textarea name="description" rows="6" cols="50"><?php echo $row['description']; ?></textarea>
    						</td>
    					<!-- Cột image -->
    						<td style='padding-right: 10px; padding-top: 10px;' valign="top">	<img src='images/<?php echo $row['image'] ?>' style='height:150px; width:100px;'>
    						</td>
    					<!-- Cột price -->
    						<td style='padding-right: 10px;' valign="top">
    							<input type="number" name="price" value="<?php echo $row['price']; ?>" step="0.01">
    							
    						</td>
    					<!-- Cột button update -->
    						<td style='padding-right: 10px; padding-top: 10px;' valign="top">		<input type="submit" value="Update Product" name="update">
    						</td>
  							</form>
  							</tr>					
					<?php
						endwhile;
					endif;
					?>
    			</table>
				

			
    		
    			
    </div>
    
    <!-- ĐƠN HÀNG -->
	<div id="menu4" class="container tab-pane fade">
		<div class="table_order">
		<table><br>
			<tr>
				<th>Customer name</th>
				<th>Product</th>
				<th>Quantity</th>
				<th>Total Price</th>
				<th>Address</th>
				<th>Email</th>
				<th>Action</th>
			</tr>
			<?php
			$sql_orders = "SELECT * FROM orders WHERE payment_confirm = '0' ORDER BY id DESC";
			$result_orders = $conn->query($sql_orders);
			if(mysqli_num_rows($result_orders) > 0):
				while($row = $result_orders->fetch_assoc()):
			?>
			<tr>
				<td><?php echo $row['customer_name'];?></td>
				<td><?php echo $row['product_name'];?></td>
				<td><?php echo $row['quantity'];?></td>
				<td><?php echo $row['total_price'];?></td>
				<td><?php echo $row['address'];?></td>
				<td><?php echo $row['email'];?></td>
				<td>
					<form method='post' action='delete.php'>
						<input type="submit" name="delete_order" value="Delete Order"/>
						<input type="hidden" name="order_id" value="<?php echo $row["id"]; ?>"/>
					</form>
					<form method='post' action='delete.php'>
						<input type="submit" name="finish_order" value="Order delivered"/>
						<input type="hidden" name="order_id" value="<?php echo $row["id"]; ?>"/>
					</form>
				</td>
			</tr>
			<?php
				
				endwhile;
			endif;
			?>
		</table>
		</div>
	</div>
	
	<!-- BÁO CÁO DOANH THU -->
	<div id="menu5" class="container tab-pane fade"><br>
					<!-- Tháng -->
					<div class="form-group">
						<label for="month_report">Month:</label>
						<select id="month_report">
							<?php
							for($i=1; $i <= 12; $i++)
							{
								echo "<option>$i</option>";
							}
							?>
   		 				</select>
					</div>
					
					<!-- Năm -->
					<div class="form-group row">
					<label for="year_report" class="col-sm-2 col-form-label">Year:</label>
    				<div class="col-sm-10">
      					<input type="number" class="form-control" id="year_report" value="<?php echo date('Y'); ?>">
    				</div>
					</div>
					
					<!-- Nút báo cáo doanh thu -->
					<button id="btn_report">Report Earnings</button>
					
					<div id="div_report">
						test
					</div>
			  
	</div>
	
</div>

</body>
</html>
