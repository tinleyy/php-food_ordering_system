<?php
        require_once('conn.php');
        $id = $_POST['ordId'];
        $manId=$_POST['manId'];
        $status= $_POST['radSatus']; //) && isset($status)
        
        if(isset($id) && isset($manId) && isset($status)){
                    //update approval status and managerID
                    $sql= "UPDATE orders SET Approved = $status , ManagerId ='$manId' 
                    WHERE OrderId = '$id'";
                    if($status==1){
                    $msg = "The order is approved.";
                }else if($status == 2){
                    $msg= "The order is disapproved.";
                }
                    $location = "../itp4513/order.php?modify=success";
                    echo "<script language='javascript'>;alert('$msg');";
                    echo "window.location = ('$location');</script>";
                    if(mysqli_query($conn, $sql)){
                }
            }else{
                //check if system cannot get restaurant name
                $msg = "Error";
                //$location = "../itp4513/oder.php?modify=fail";
                echo "<script language='javascript'>;alert('$msg');";
                //echo "window.location = ('$location');;
                echo "</script>";
            }
    //$sql = "SELECT * FROM orders WHERE OrderId = $id and Approved = 0";
    mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rs = mysqli_query($conn, $sql);
	?>