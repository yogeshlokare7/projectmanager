<?php
$tblname = "tbl_attendance";
if (count($_POST) > 0) {
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";

    $empid = explode("-", $_POST["empid"]);

    $_POST["empid"] = $empid[0];
    $_POST["empname"] = $empid[1];

    if ($_POST["type"] == "in") {
        unset($_POST["type"]);
        $_POST["intime"] = date("y-m-d g:i:s");
        MysqlConnection::insert($tblname, $_POST);
    } else {
        $id = $_POST["empid"];
        $update = "UPDATE tbl_attendance SET outtime =  '" . date("y-m-d g:i:s") . "' WHERE empid =  $id AND entrydate = '" . date("y-m-d") . "' ";
        MysqlConnection::executeQuery($update);
    }
}
$resultset = MysqlConnection::fetchAll($tblname);
$resultsetemployee = MysqlConnection::fetchAll("tbl_employee");
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Attendance Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Attendance</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal">Add <?php echo $explode[1] ?></button>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                  <th>#</th>

                                <th>Emp Id</th>
                                <th>Employee Name</th>
                                <th>In Time</th>
                                <th>Out Time</th>
                                <th>Total Time</th>
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
                                       <td><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $value["empid"] ?></td>
                                    <td><?php echo $value["empname"] ?></td>
                                    <td><?php echo $value["intime"] ?></td>
                                    <td><?php echo $value["outtime"] ?></td>
                                    <td>
                                        <?php echo $hourdiff = round((strtotime($value["intime"]) - strtotime($value["outtime"])) / 3600, 1); ?> Hr
                                    </td>
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
                <h4 class="modal-title" id="myModalLabel">Add Attendance Information</h4>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Select Employee</label>
                                <select class="form-control" name="empid">
                                    <option>Employee Name</option>
                                    <?php
                                    foreach ($resultsetemployee as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["id"] ?>-<?php echo $value["firstname"] ?> <?php echo $value["middlename"] ?> <?php echo $value["lastname"] ?>">
                                            <?php echo $value["firstname"] ?> <?php echo $value["middlename"] ?> <?php echo $value["lastname"] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Select Preference</label>
                                <select class="form-control" name="type">
                                    <option>Select Preference</option>
                                    <option value="in">In Time</option>
                                    <option value="out">Out Time</option>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->
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