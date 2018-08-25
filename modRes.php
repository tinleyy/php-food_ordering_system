<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>order</title>
<body>
<?php
    require_once('conn.php');
    $resName = $_POST['resName'];
    $resDesc= $_POST['resDesc'];
    $name = $_POST['rname'];
    if(isset($name) && isset($resName) && isset($resDesc)){
    	$sql = "UPDATE restaurants
    	SET Name = '$resName', Descriptions = '$resDesc' WHERE Name = '$name'";
	    if(mysqli_query($conn, $sql)){
	        //modify information
	    	$msg = "restaurant information updated";
	    	$location = "../itp4513/resdetail.php";
	    	echo "<script language='javascript'>;alert('$msg');";
			echo "window.location = ('$location');</script>";
	    }else{
	    	//modify fail
	    	$msg = "change fail";
	    	$location = "../itp4513/resdetail.php?modify=fail";
	    	echo "<script language='javascript'>;alert('$msg');";
			echo "window.location = ('$location');</script>";
		}
    }else{
    	//check if system cannot get restaurant name
    	$msg = "restaurant name is null";
	    $location = "../itp4513/resdetail.php?modify=fail";
	    echo "<script language='javascript'>;alert('$msg');";
		echo "window.location = ('$location');</script>";
    }
?> 
</body>
</html>