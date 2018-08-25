<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>warehouse stock</title>
    <link rel="stylesheet" type="text/css" href="../itp4513/css/info_style.css">
    <!--DataTables stylesheet-->
    <link rel="stylesheet" type="text/css" href="../itp4513/css/dataTable/jquery.dataTables.min.css">
    <!--dataTable-->
    <script type="text/javascript" charset="utf8" src="../itp4513/js/dataTable/jquery.js"></script>
    <script type="text/javascript" charset="utf8" src="../itp4513/js/dataTable/jquery.dataTables.min.js"></script>
</head>
<body>
	<div class="top_title">
    	View Stock in WAREHOUSE
    </div>
    <br/>
    <!--warehouse stock table-->
    <div class = "table">
        <table id="stock_tb" class="display">
            <thead>
            <tr>
                <th>Stock name</th>
                <th>Amount</th>
            </tr>
            </thead>
            <?php
            require_once('conn.php');
            $sql = "SELECT s.Name,ws.Amount FROM stock s,warehousestock ws
                WHERE s.StockId = ws.StockId";
            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                printf('
                <tr>
                    <td>%s</td>
                    <td>%s</td>
                </tr>',  
               $rc['Name'], 
               $rc['Amount']);
            }
            ?>
        </table>
    </div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#stock_tb').DataTable();
    } );
</script>
</body>
</html>