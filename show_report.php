<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<?php

include('database.php');

$month = $_POST['month'];
$year = $_POST['year'];

$total = 0;

echo "
<table><br>
			<tr>
				<th>Customer name</th>
				<th>Product</th>
				<th>Quantity</th>
				<th>Total Price</th>
				<th>Address</th>
				<th>Email</th>
			</tr>";
$sql_orders1 = "SELECT * FROM orders WHERE MONTH(order_date)= '$month' AND YEAR(order_date) ='$year' AND payment_confirm = '1' ORDER BY id DESC";
$result_orders1 = $conn->query($sql_orders1);

if(mysqli_num_rows($result_orders1) > 0):
	while($row1 = $result_orders1->fetch_assoc()):
		echo "
			<tr>
				<td>".$row1['customer_name']."</td>
				<td>".$row1['order_date']."</td>
				<td>".$row1['quantity']."</td>
				<td>".$row1['total_price']."</td>
				<td>".$row1['address']."</td>
				<td>".$row1['email']."</td>
			</tr>
	";
		$total += $row1["total_price"];
	endwhile;
endif;

echo "</table>";

echo "<br>";
echo "<p><b>Total earning (".$month."/".$year."): ".$total."$</b></p>";
