<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Food Ordering System</title>
</head>
	<link rel="stylesheet" type="text/css" href="../itp4513/css/main_style.css">
    <link rel="icon" href="../itp4513/image/order-Logo.png">
<body >
    <!--top bar-->
	<div class="top">
        <!--top bar icon-->
    	<div class="icon-bg">
    	   <img src="../itp4513/image/order-Logo.png" id="icon">
        </div>
        <!--system name-->
        <h3>IVE Food Ordering System</h3>
        <div class="username"><?php echo "Hi, ".$_SESSION['name']; ?></div>
        <form method="post" action="logout.php">
            <button type="submit" name="logout">Logout</button>
        </form>
   	</div>
    <div class="bar">
    	<ul>
        	<p><a href="../itp4513/index.php">
            <li class="home">
            	<button>
            		<img src="../itp4513/image/home.png" id="home"><h3 id="txtbar">Home</h3>
                </button>
            </li></a>
        	<p><a href="../itp4513/order.php" target="iframe_info">
            <li class="order">
            	<button>
            		<img src="../itp4513/image/order.png" id="order"><h3 id="txtbar">Order</h3>
           		</button> 
			</li></a>
            <div id="litock">
                <p><a href="../itp4513/stock.php" target="iframe_info">
                    <li class="res">
                    <button>
                    <img src="../itp4513/image/stock.png" id="stock"><h3 id="txtbar">Stock</h3>
                    </button>
                    </li></a>
            </div>
        </ul>
    </div>
    <iframe class="info" name="iframe_info">
    </iframe>
</body>
</html>