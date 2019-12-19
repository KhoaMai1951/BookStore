<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php

include('database.php');
$month = $_POST['month'];

echo "
<table><br>
			<tr>
				<th>Customer name</th>
				<th>Product</th>
				<th>Quantity</th>
				<th>Total Price</th>
				<th>Address</th>
				<th>Email</th>
				<th>Action</th>
			</tr>";

$sql_orders1 = "SELECT * FROM orders WHERE MONTH(order_date)= '$month' ORDER BY id DESC";
$result_orders1 = $conn->query($sql_orders1);

if(mysqli_num_rows($result_orders1) > 0):
	while($row1 = $result_orders1->fetch_assoc()):
		echo "
	<tr>
				<td>".$row1['customer_name']."</td>
				<td>".$row1['order_date']."</td>
			</tr>
	";
	endwhile;
endif;

