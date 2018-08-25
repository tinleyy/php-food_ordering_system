<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>res details</title>
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
    	Restaurant Details
    </div>
    <br>
    <!--restaurant table-->
    <div class = "table">
        <form method="POST" action="resdetail.php">
        <table id="res_tb" class="display">
            <thead>
            <tr>
                <th width="30%">Restaurant Name</th>
                <th>Descriptions</th>
                <th width="5px"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once('conn.php');
            session_start();
            $sql = "SELECT * FROM restaurants";
            if($_SESSION['pos']=='restaurant'){
                $sql.=" where RestaurantId =".$_SESSION['id'];
            }
            $rs = mysqli_query($conn, $sql);
            while ($rc = mysqli_fetch_assoc($rs)) {
                printf("
                <tr>
                    <td>%1\$s</td>
                    <td>%2\$s</td>
                    <td><button value='button' id='modbtn' name='modres' class='btn btn-warning update' onClick='showData(\"%1\$s\",\"%2\$s\")'>Modify</td>
                </tr>", 
               $rc['Name'],
               $rc['Descriptions']);
            }
            ?>
            </tbody>
        </table>
        </form>
    </div>

<!--add order modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Modify Restaurant Information</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="modRes.php" id="mod">
                    <input type ="hidden" name = "rname" value="" id="rname" >
                    <p>Restaurant name: <br><input type="text" id="name" name="resName" placeholder="" class='form-control' required><br>
                    <p>Description: <br><textarea id="desc" name="resDesc" placeholder="" cols="50" class='form-control' required></textarea><br>
   
            </div>
            <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Submit"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html> 

<script type="text/javascript">
    $(document).ready( function () {
        //dataTable
        $('#res_tb').DataTable();
    });
    function showData(n,d){
        event.preventDefault();
        document.getElementById("rname").value = n;
        document.getElementById("name").value = n;
        document.getElementById("desc").value = d;
        $('#myModal').modal('show');
    }
</script>