<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>
<body>
<?php
	session_start();
	require_once('conn.php');
	if(isset($_POST['login'])){
		$uid = $_POST['uid'];
		$pwd = $_POST['pwd'];
		if( $_POST['pos']=='1'){
			//login with restaurant account
			$sql = "SELECT * from restaurants WHERE RestaurantId = '$uid'";
			$rs = mysqli_query($conn,$sql)or die(mysqli_connect_error());
			$rc = mysqli_fetch_assoc($rs);			
			if($pwd !=null && $pwd == $rc['Password']){
				//check if the input password is correct
				$_SESSION['pos'] = 	"restaurant";
				$_SESSION['id'] = $rc['RestaurantId'];
				$_SESSION['name'] = $rc['Name'];
				$_SESSION['pwd'] = $rc['Password'];
				$_SESSION['desc'] = $rc['Descriptions'];
				$msg = "success login";
				$location = "../itp4513/index.php?login=success";
				echo "<script language='javascript'>;alert('$msg');";
				echo "window.location = ('$location');</script>";
			}else{
				//fail login
				$msg = "wrong username or password";
				$location ="../itp4513/index.php?login=wrongposition";
				echo "<script language='javascript'>;alert('$msg');";
				echo "window.location = ('$location');</script>";
			}
		} else if($_POST['pos']=='2'){
			//login with restaurant account
				$sql = "SELECT * from managers WHERE ManagerId = '$uid'";
				$rs = mysqli_query($conn,$sql)or die(mysqli_connect_error());
				$rc = mysqli_fetch_assoc($rs);			
				if($pwd !=null && $pwd == $rc['Password']){
				//check if the input password is correct
					$_SESSION['pos'] = 	"manager";
					$_SESSION['id'] = $rc['ManagerId'];
					$_SESSION['name'] = $rc['Name'];
					$_SESSION['pwd'] = $rc['Password'];
					$msg = "success login";
					$location = "../itp4513/index.php?login=success";
					echo "<script language='javascript'>;alert('$msg');";
					echo "window.location = ('$location');</script>";
				}else{
					//fail login
					$msg = "wrong username or password";
					$location ="../itp4513/index.php?login=wrongposition";
					echo "<script language='javascript'>;alert('$msg');";
					echo "window.location = ('$location');</script>";
				}
		}else{
				//have not select the position
				$msg = "Please select the right position";
				$location ="../itp4513/index.php?login=wrongposition";
				echo "<script language='javascript'>;alert('$msg');";
				echo "window.location = ('$location');</script>";
		}
		mysqli_close($conn);
	}
?>
</body>
</html>