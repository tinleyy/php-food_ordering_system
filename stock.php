<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>stock</title>
    <link rel="stylesheet" type="text/css" href="../itp4513/css/info_style.css">
    <!--DataTables stylesheet-->
    <link rel="stylesheet" type="text/css" href="../itp4513/css/dataTable/jquery.dataTables.min.css">
    <!--bootstrap stylesheet-->
    <link rel="stylesheet" type="text/css" href="../itp4513/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../itp4513/css/bootstrap/bootstrap.min.css">

    <!--jquery-->
    <script src="../itp4513/js/jquery.min.js"></script>
    <!--bootstrap-->
    <script src="../itp4513/js/bootstrap/bootstrap.min.js"></script>
    <!--dataTable-->
    <script type="text/javascript" charset="utf8" src="../itp4513/js/dataTable/jquery.dataTables.min.js"></script>

</head>
<body>
    <div class="top_title">
    	View Stock in RESTAURANT
    </div> 
    <div class = "function">
    	<button type ="" id="add" data-toggle="modal" data-target="#myModal" onClick="addItem()">
        add item</button>
        <div class="txtnew">
            <h1>+</h1>
        </div>
        <br/><br/><br/><br/><br/>
    </div>
    <div class="table">
        <table id="stock_tb" class="display">
            <thead>
            <tr>
                <th width="20%">Stock Id</th>
                <th>Item Name</th>
            </tr>
            </thead>
            <?php
            require_once('conn.php');
            $sql = "SELECT s.StockId,s.Name FROM stock s
                WHERE s.StockId";
            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                printf('
                <tr>
                    <td>%s</td>
                    <td>%s</td>
                </tr>',  
               $rc['StockId'], 
               $rc['Name']);
            }
            ?>
        </table>
    </div>
</body>
</html>

<!--add item modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create new item</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="additem.php" id="insert">
                    <p>Manager Id: <br><input type="text" name="ManagerId" id="manid" value="" class='form-control' readonly><br><br>
                    <p>Item Name: <br><input type="text" name="Name" class='form-control' required><br><br>
            </div>
            <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Submit"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>   

<script type="text/javascript">
    $(document).ready(function(){
        $('#stock_tb').DataTable();
    });

    //set manager id
    function addItem(){
        var manId='<?php echo $_SESSION['id'];?>';
        document.getElementById('manid').value = manId;
    }

</script>
