
<?php
    require_once('conn.php');
    $manID = $_POST['ManagerId'];
    $name = $_POST['Name'];
    $sql ="SELECT * FROM stock;";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rs = mysqli_query($conn, $sql);
    $exist=false;
    while ($rc = mysqli_fetch_assoc($rs)) {
        if(strtolower($name)==strtolower($rc['Name'])){
             $exist=true;
             break;
         }
     }
    if(!($exist)){
        $sql = "INSERT INTO stock (ManagerId,Name) VALUES('$manID','$name')";
        mysqli_query($conn, $sql);
        //insert success
    	$msg = "item added";
    	$location = "../itp4513/stock.php";
    	echo "<script language='javascript'>;alert('$msg');";
		echo "window.location = ('$location');</script>";
    } else {
        //insert fail[item exists]
        $msg = "Error! \nThe item already exists.";
    	$location = "../itp4513/stock.php";
    	echo '<script language="javascript">;alert("Error! \nItem already exists.");';
		echo "window.location = ('$location');</script>";
    }
    
?> 
