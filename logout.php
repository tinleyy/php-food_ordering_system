<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logout</title>
</head>

<body>
	<?php
	//logout the system
    	if(isset($_POST['logout'])){
			session_start();
			session_unset();
			session_destroy();
			header("Location: index.php");
			exit();
		}
	?>
</body>
</html>