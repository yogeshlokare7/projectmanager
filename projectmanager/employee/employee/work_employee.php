<?php
$tblname = "tbl_employee_workinfo";
if (count($_POST) > 0) {
    $_POST["entrydate"] = date("y-m-d");
    $_POST["update"] = date("y-m-d");
    $_POST["active"] = "Y";

    $_POST["empid"] = $id;
    $_POST["empname"] = $fullname;
    MysqlConnection::insert($tblname, $_POST);
}
$resultset = MysqlConnection::fetchAll($tblname);
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Work Experience');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Work Experience</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal">Add Work Experience</button>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Emp Id</th>
                                <th>Employee Name</th>
                                <th>Company Name</th>
                                <th>Last Position</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><?php echo $value["empid"] ?></td>
                                    <td><?php echo $value["empname"] ?></td>
                                    <td><?php echo $value["cmpname"] ?></td>
                                    <td><?php echo $value["lastposition"] ?></td>
                                    <td><?php echo $value["fromdate"] ?></td>
                                    <td><?php echo $value["todate"] ?></td>
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
                <h4 class="modal-title" id="myModalLabel">Add Work Experience</h4>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Company Name</label>
                                <input type="text" name="cmpname" autofocus="" class="form-control" required>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Company Address</label>
                                <input type="text" name="cmpaddress" class="form-control" required>
                            </div>
                        </div>
                    </div><!-- row -->
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">From</label>
                                <input type="date" name="fromdate" autofocus="" class="form-control" required>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">To</label>
                                <input type="date" name="todate" class="form-control" required>
                            </div>
                        </div>
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Last Position</label>
                                <input type="text" name="lastposition" autofocus="" class="form-control" required>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Last Salary</label>
                                <input type="number" name="lastsalary" class="form-control" step="0.01" required>
                            </div>
                        </div>
                    </div><!-- row -->
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Experience</label>
                                <input type="number" name="experience" autofocus="" class="form-control" step="0.01" required>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Contact No of Employer</label>
                                <input type="text" name="contactnumber" class="form-control" required>
                            </div>
                        </div>
                    </div><!-- row -->
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Supervisor Name</label>
                                <input type="text" name="supervisorname" autofocus="" class="form-control" required>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Email Id of Employer</label>
                                <input type="email" name="emailid" class="form-control" required>
                            </div>
                        </div>
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Leaving Reason</label>
                                <input type="text" name="leavingreason" class="form-control" required>
                            </div>
                        </div><!-- col-sm-6 -->
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