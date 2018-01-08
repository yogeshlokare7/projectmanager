<?php
$tblname = "tbl_holiday";
if (count($_POST) > 0) {

    $explodFromDate = explode("/", $_POST["fromdate"]);
    $explodToDate = explode("/", $_POST["todate"]);

    $_POST["fromdate"] = $explodFromDate[2] . "-" . $explodFromDate[0] . "-" . $explodFromDate[1];
    $_POST["todate"] = $explodToDate[2] . "-" . $explodToDate[0] . "-" . $explodToDate[1];

    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    MysqlConnection::insert($tblname, $_POST);
}
$resultset = MysqlConnection::fetchAll($tblname);
if($_GET['del'] > 0){
    MysqlConnection::delete($tblname, $_GET['del']);
    header("location:mainpage.php?pagename=holiday_leave");
}
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Holiday Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Holiday</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal">Add Holiday</button>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                 <th>#</th>
                                 <th>#</th>
                                <th>Holiday Name</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>No Of Days</th>
                                <th>Entry Date</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><a href="mainpage.php?pagename=holiday_leave&del=<?php echo $value["id"] ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i></a></td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $value["holidayname"] ?></td>
                                    <td><?php echo $value["fromdate"] ?></td>
                                    <td><?php echo $value["todate"] ?></td>
                                    <td><?php echo $value["noofday"] ?></td>
                                    <td><?php echo $value["entrydate"] ?></td>
                                    <td><?php echo $value["active"] ?></td>
                                </tr>
                                <?php
                                $index++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- ADD POP UP DIALOG ---->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Holiday Information</h4>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Holiday Name </label>
                                <input type="text" maxlength="30" name="holidayname" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">From Date </label>
                                <div class="input-group date" id="bs-datepicker-component">
                                    <input type="text" name="fromdate" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">To Date </label>
                                <div class="input-group date" id="bs-datepicker-component-to">
                                    <input type="text" name="todate" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Total Days </label>
                                <input type="text" name="noofday" maxlength="30" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save"/>  
                    <button type="button"  class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div> 
    </div>  
</div>  
<!--- ADD POP UP DIALOG ---->
<script>
    init.push(function () {
        $('#bs-datepicker-component').datepicker();
        $('#bs-datepicker-component-to').datepicker();
    });
</script>