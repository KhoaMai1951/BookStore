<?php
	session_start();

	//Dò id sản phẩm trong giỏ hàng và xóa sản phẩm trong giỏ được chọn
	if(!empty($_SESSION["cart"])):
		foreach ($_SESSION["cart"] as $keys => $value):
			if ($value["product_id"] == $_POST['ma'])
			{
				unset($_SESSION["cart"][$keys]);
				//Xuất thông báo đã xóa
				echo '<script>alert("Product has been Removed...!")</script>';
			}
		endforeach;
	endif;

	//Nếu trong giỏ vẫn còn hàng, xuất tổng tiền cho các sản phẩm còn trong giỏ
	if(!empty($_SESSION["cart"])):
		$total=0;
		foreach ($_SESSION["cart"] as $keys => $value):
			$total = $total + ($value["item_quantity"] * $value["product_price"]);
		endforeach;
		echo number_format($total,2). " $"; 
	endif;

	//Nếu trong giỏ hết hàng, tổng tiền = 0
	if(empty($_SESSION["cart"])):
		echo "0";
	endif;
?>