<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
	<?php
		require_once('conn.php');
		if($_POST['ord']=="delete"){
			$sql = "DELETE FROM orders WHERE OrderId = '$_POST[OrderId]' and Approved = 0";
			mysqli_query($conn,$sql) or die(mysqli_error($conn));
			if(mysqli_affected_rows($conn) > 0){
				//order deleted
				$msg = "order deleted";
				$location = "../itp4513/order.php?delOrder=success";
				echo "<script language='javascript'>;alert('$msg');";
				echo "window.location = ('$location');</script>";
			}else{
				//order delete fail if approved is 1 or wrong orderId
				$msg = "Error! order is approved";
				$location = "../itp4513/order.php?delOrder=fail";
				echo "<script language='javascript'>;alert('$msg');";
				echo "window.location = ('$location');</script>";
			}
		}
	?>
</body>
</html>