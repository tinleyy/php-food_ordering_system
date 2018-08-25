<!doctype html>
<?php session_start(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order</title>
    <link rel="stylesheet" type="text/css" href="../itp4513/css/info_style.css">
    <!--DataTables stylesheet-->
    <link rel="stylesheet" type="text/css" href="../itp4513/css/dataTable/jquery.dataTables.min.css">
    <!--bootstrap stylesheet-->
    <link rel="stylesheet" type="text/css" href="../itp4513/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../itp4513/css/bootstrap/bootstrap.min.css">
    <!--datepicker-->
    <link rel="stylesheet" type="text/css" href="../itp4513/css/datePicker/bootstrap-datepicker.css"> 

    <!--jquery-->
    <script src="../itp4513/js/jquery.min.js"></script>  
    <!--bootstrap-->
    <script src="../itp4513/js/bootstrap/bootstrap.min.js"></script>  
    <!--dataTable-->
    <script type="text/javascript" charset="utf8" src="../itp4513/js/dataTable/jquery.dataTables.min.js"></script>
    <!--datepicker-->
    <script type="text/javascript" src="../itp4513/js/datePicker/bootstrap-datepicker.js"></script>

</head>
<body>
	<div class="top_title">
    	Manage order
    </div>
    <!--add button-->
	<div class = "function">
        <div id="btnAddOrder" style="display: none;">
            <button type = "button" id="add" data-toggle="modal" data-target="#addModal" onClick="addOrder()">
            add order</button>
            <div class="txtnew">
                <h1>+</h1>
            </div>
            <br/><br/><br/>
        </div>
    </div>
    <br/>
    <!--change status button-->
    <div class="status_button">
        <form method="POST" action="order.php">
        <button type="button" id="status" name="all" onclick="chkStatus('all');"/>ALL</button>
        <button type="button" id="status" name="pend" onclick="chkStatus('pending');" />Pending</button>
        <button type="button" id="status" name="approve" onclick="chkStatus('approved');"/>Approved</button>
        <button type="button" id="status" name="disapprove" onclick="chkStatus('disapproved');"/>Disapproved</button>
        <input type ="hidden" name="orderStatus" id="orderStatus" value="">
        </form>
    </div>
    <br/>
    <!--order table-->
    <div class = "table">
        <form method="POST" action="delOrder.php">
        <table id="order_tb" class="display">
            <thead>
            <tr>
                <th>OrderID</th> 
                <th>Supplier Name</th>
                <th>Stock Name</th>
                <th>Amount</th> 
                <th>Purchase Date</th>
                <th>Delivery Date</th> 
                <th>Received Date</th>
                <th width="5px">Status</th>
                <th width="5px"></th>
                <th width></th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once('conn.php');
            $sql = "SELECT o.OrderId,s.Name AS suppliername,sk.Name AS stockname,o.Amount,
                            o.PurchaseDate,o.DeliveryDate,o.ReceivedDate, o.Approved, o.RestaurantId 
                FROM orders o,supplierstock ss,suppliers s,stock sk
                WHERE o.SupplierStockId = ss.SupplierStockId and
                        ss.StockId = sk.StockId and
                        ss.SupplierId = s.SupplierId";
     
            $ordTable=<<<EOD
            <tr>
                    <td>%1\$s</td>
                    <td>%2\$s</td>
                    <td>%3\$s</td>
                    <td>%4\$s</td>
                    <td>%5\$s</td>
                    <td>%6\$s</td>
                    <td>%7\$s</td>
                    <td>%8\$s</td>
                             
EOD;
        //check order status
        if(isset($_POST['orderStatus'])){
            if($_POST['orderStatus']=="pending"){
                $sql.=" and approved = 0";
            } else if ($_POST['orderStatus']=="approved"){
                $sql.=" and approved = 1";
            } else if ($_POST['orderStatus']=="disapproved"){
                $sql.=" and approved = 2";
            }
        }
        //find order data with restaurant id
        if($_SESSION['pos']=='restaurant'){
            $sql.=" and RestaurantId =".$_SESSION['id'];
        }
            $sql.=";";
            $rs = mysqli_query($conn, $sql);
            if($_SESSION['pos']=='restaurant'){
                $ordTable.="<td><button value='delete' class='btn btn-danger'
                 onClick='delOrder(%1\$s)'  %9\$s>Delete</td><td></td></tr>";
            } else if ($_SESSION['pos']=='manager'){
                $ordTable.="<td><button value='button' id='btnApprove' 
                class='btn btn-warning update' data-toggle='modal' data-target='#editModal' 
                onClick='approve(%1\$s)' %9\$s>Approve</td>
                <td><button value='delete' class='btn btn-danger' 
                onClick='delOrder(%1\$s)'  %9\$s>Delete</td></tr>";
            }
            while ($rc = mysqli_fetch_assoc($rs)) {
                if($rc['Approved']=='0'){
                    printf($ordTable, 
                    $rc['OrderId'], $rc['suppliername'], $rc['stockname'], $rc['Amount'], 
                    $rc['PurchaseDate'],'-','-','Pending','');
                } else if($rc['Approved']=='1'){
                    printf($ordTable, 
                    $rc['OrderId'], $rc['suppliername'], $rc['stockname'], $rc['Amount'], 
                    $rc['PurchaseDate'],($rc['DeliveryDate']=='' ? 'Waiting' : $rc['DeliveryDate']),
                    ($rc['ReceivedDate']=='' ? 'Waiting' : $rc['ReceivedDate']),'Approved',"style='visibility:hidden'");
                } else if ($rc['Approved']=='2'){
                    printf($ordTable, 
                    $rc['OrderId'], $rc['suppliername'], $rc['stockname'], $rc['Amount'], 
                    $rc['PurchaseDate'],'Unavailable','Unavailable','Disapproved',"style='visibility:hidden'");
                }
            }
            ?>
            </tbody>
        </table>
        <input type ="hidden" name = "OrderId" id="OrderId" value="">
        <input type ="hidden" name = "ord" id="del" value="delete">
    </form>
    </div>
</body>
</html>

<!--add order modal-->
<div class="modal fade" id="addModal" role="dialog" aria-labelledby="addLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Create new order</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="addorder.php" id="insert">
                <div class="modal-body">
                <div class="form-group">
                    <p>Restaurant Id: <br><input type="text" id="resId" name="resId" value="" readonly class="form-control" ><br>
                    </div>
                    <div class="form-group">
                    <p>Stock:<br>
                        <?php
                            require_once('conn.php');
                            $stock = "<select name='stock' class='form-control' required>
                            <option value='' selected hidden>Select Stock:</option>";
                            $sql = "SELECT Distinct s.Name,ss.SupplierStockId 
                            FROM supplierstock ss,stock s WHERE ss.StockId = s.StockId";
                            $rs = mysqli_query($conn, $sql);
                            for ($i=1; $rc = mysqli_fetch_assoc($rs) ; $i++) { 
                                $stock .= "<option value ='".$rc['SupplierStockId']."'>".$rc['Name'].
                                "</option>";
                            }
                            $stock .= "</select>";
                            echo $stock;
                        ?>
                    </div>
                    <div class="form-group">  
                    <p><br>Amount: <br><input type="number" name="amt" min="1" class='form-control' required><br>
                    </div>
                    <div class="form-group">
                    <p>PurchaseDate: <br>
                        <div class="input-append date">
                        <input type="text" class="form-control" id="datePicker" name="pdate" required
                        placeholder="yyyy-mm-dd">
                        <p id="remind" name=""> </p>
                        <span class="add-on"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" id="addfmSub" value="Submit" disabled="true">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div> 

<!--edit order modal-->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Approving the Pending Order</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" action="approve_order.php" id="approveOrder">
                    <input type ="hidden" name = "ordId" value="" id="ordId"><br>
                    <p>Manager Id: <br><input type="text" name="manId" value="" id="manId" readonly class="form-control"><br><br>
                    <p>Status: 
                    <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-info active">
                    <input type="radio" name="radSatus" id="option1" value="1" autocomplete="off" checked> Approve
                    </label>
                    <label class="btn btn-info">
                    <input type="radio" name="radSatus" id="option2" value="2" autocomplete="off"> Disapprove
                    </label></div>
                    <br><br>  
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Update"></button> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div> 

<script type="text/javascript">
$(document).ready( function () {
    var position='<?php echo $_SESSION['pos'];?>';
    if(position=="restaurant"){
        document.getElementById("btnAddOrder").style.display="block";
    }
    //dataTable
    $('#order_tb').DataTable();
    //datepicker
    $('.input-append.date').datepicker({
        format: "yyyy-mm-dd",
        startDate: "today",
        autoclose: true,
    });

} );
</script>

<script type="text/javascript">
    //check if position is manager->change page style
    function chkPosition(){
        var position='<?php echo $_SESSION['pos'];?>';
        if(position=="manager"){
            document.getElementById("btnAddOrder").style.display="none";
            //btnAddOrder.style.visibility="hidden";
        }
    }
    
    //set order status
    function chkStatus(btnStatus){
        document.getElementById('orderStatus').value = btnStatus;
        document.forms[0].submit();
    }
    //set restaurant id in the order form.
    function addOrder(){
        var resId='<?php echo $_SESSION['id'];?>';
        document.getElementById('resId').value = resId;
    }

    //check add order input 
    function chkAddVaule(){
        if($('#nm').val()==""||$('#em').val()==""||$('#al').val()==""){
            alert("Please fill out all the fields");
        }
        else{
    }}

    //set orderid
    function delOrder(id){
        document.getElementById('OrderId').value = id;
        document.forms[1].submit();
    }

    //set approve order
    function approve(id){
        event.preventDefault();
        //show data that will be updated
        document.getElementById('del').value = '';
        document.getElementById('ordId').value = id;
        var manId='<?php echo $_SESSION['id'];?>';
        document.getElementById('manId').value = manId;
    }

    $('#datePicker').change(function(){
        document.getElementById('remind').style.color = "red";
        document.getElementById('addfmSub').disabled = "true";
        var inputdate = document.getElementById("datePicker").value;
        var count = 0; //check date format
        var yymmdd; //get away blank space
        var str = "";
        for (var i = 0; i<inputdate.length; i++) {
            if(inputdate.charAt(i) === '-'){
                count++;
            }
        }
        //check "-" "-"
        if(count==2){
            yymmdd = inputdate.split("-");//explore date into array
            for (var i = 0; i < yymmdd.length; i++) {
                str += yymmdd[i]; //get string yymmdd
            }
            if(str.length<8){
                //valid date format
                document.getElementById('remind').innerHTML = "Please input valid date format: yyyy-mm-dd";
            }
            var myyear = parseInt(str.substr(0,4));
            var mymonth = str.substr(4,2);
            var myday = str.substr(6,2);
            //today date
            var today = new Date();
            var to_mm = today.getMonth()+1;//today month
            var to_dd = today.getDate();//today day
            var to_yyyy = parseInt(today.getFullYear()); //today year
            //check input year
            if(myyear<to_yyyy){
                //past year
                document.getElementById('remind').innerHTML = "Please input year greater than or equal to this year";
            }else if ((myyear-to_yyyy)>=1){
                //future year
                document.getElementById('remind').innerHTML = "Please remind the date is correct";
                document.getElementById('remind').style.color = "#D7DF01";
                document.getElementById('addfmSub').disabled = "";
            }else{
                //check input month
                switch(mymonth){
                    //check invalid month
                    case "01": ;case "02": ;case "03": ;case "04": ;case "05": ;
                    case "06": ;case "07": ;case "08": ;case "09": ;case "10": ;
                    case "11": ;case "12": break;
                    default:document.getElementById('remind').innerHTML = "Incorrect month";
                }
                if(mymonth<to_mm){
                    //input past month
                    document.getElementById('remind').innerHTML = 
                        "Please input month greater than or equal to this month";
                }else if(mymonth==to_mm && myday<to_dd){
                    //input same month and past day
                    document.getElementById('remind').innerHTML = 
                        "Please input day greater than or equal to this day";
                }else{
                    switch(myday){
                        //check invalid day
                        case "01": ;case "02": ;case "03": ;case "04": ;case "05": ;
                        case "06": ;case "07": ;case "08": ;case "09": 
                        document.getElementById('remind').innerHTML = "Correct";
                        document.getElementById('remind').style.color = "green";
                        document.getElementById('addfmSub').disabled = "";break;
                        default:
                            if((31-parseInt(myday))>=0){
                            //valid date format
                            document.getElementById('remind').innerHTML = "Correct";
                            document.getElementById('remind').style.color = "green";
                            document.getElementById('addfmSub').disabled = "";}
                            else{document.getElementById('remind').innerHTML = "Incorrect day";
                            document.getElementById('remind').style.color = "red"; break;}
                    }
                }
            }
        }else if(count!=2){
            //invalid date format
            document.getElementById('remind').innerHTML = "Please input valid date format: yyyy-mm-dd";
        }

    });
</script>
