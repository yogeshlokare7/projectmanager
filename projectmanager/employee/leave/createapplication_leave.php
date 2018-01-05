<?php
$tblname = "tbl_leavapplication";
if (count($_POST) > 0) {
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    $_POST["empid"] = $id;
    $_POST["empCode"] = $empId;
    $_POST["empname"] = $fullname;

    $leaveId = explode("-", $_POST["leaveId"]);
    $_POST["leaveId"] = $leaveId[0];
    $_POST["leaveType"] = $leaveId[1];
    $_POST["status"] = "2";

    $explodFromDate = explode("/", $_POST["fromDate"]);
    $explodToDate = explode("/", $_POST["toDate"]);

    $_POST["fromDate"] = $explodFromDate[2] . "-" . $explodFromDate[0] . "-" . $explodFromDate[1];
    $_POST["toDate"] = $explodToDate[2] . "-" . $explodToDate[0] . "-" . $explodToDate[1];


    MysqlConnection::insert($tblname, $_POST);
}
$resultset = MysqlConnection::fetchAll($tblname);
$resultsetleaves = MysqlConnection::fetchAll("tbl_leave");
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Leave Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Applied Leaves</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal">Apply a Leave</button>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Leave Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Applied on</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><?php echo $value["leaveType"] ?></td>
                                    <td><?php echo $value["fromDate"] ?></td>
                                    <td><?php echo $value["toDate"] ?></td>
                                    <td><?php echo $value["totalDayes"] ?></td>
                                    <td>
                                        <?php
                                        switch ($value["status"]) {
                                            case 0:
                                                echo "Approved";
                                                break;
                                            case 1:
                                                echo "Rejected";
                                                break;
                                            case 2:
                                                echo "Pending";
                                                break;
                                            default:
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value["entrydate"] ?></td>
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
                <h4 class="modal-title" id="myModalLabel">Request for a Leave</h4>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Leave Type<i class="requred">*</i> </label>
                                <select class="form-control" required="true" name="leaveId">
                                    <option>Select Leave</option>
                                    <?php
                                    foreach ($resultsetleaves as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["id"] ?>-<?php echo $value["leavename"] ?>">
                                            <?php echo $value["leavename"] ?> - (<?php echo $value["unit"] ?>)
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">From Date </label>
                                <div class="input-group date" id="bs-datepicker-component">
                                    <input type="text" name="fromDate" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">To Date <i class="requred">*</i> </label>
                                <div class="input-group date" id="bs-datepicker-component-to">
                                    <input type="text" name="toDate" required="true" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Description<i class="requred">*</i></label>
                                <textarea class="form-control" required="true" name="description"></textarea>
                            </div>
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