<?php
    require_once('conn.php');
    $resID = $_POST['resId'];
    $stock = $_POST['stock'];
    $amount = $_POST['amt'];
    $purDate = $_POST['pdate'];
    $sql = "INSERT INTO orders(RestaurantId,SupplierStockId,Amount,PurchaseDate)
    	VALUES('$resID','$stock','$amount','$purDate')";
    if(mysqli_query($conn, $sql)){
        //insert success
    	$msg = "order added";
    	$location = "../itp4513/order.php";
    	echo "<script language='javascript'>;alert('$msg');";
		echo "window.location = ('$location');</script>";
    }else{
        //insert fail
        $msg = "Error! add order fail";
        $location = "../itp4513/order.php?order=fail";
        echo "<script language='javascript'>;alert('$msg');";
        echo "window.location = ('$location');</script>";
    }
?> 
</body>
</html>