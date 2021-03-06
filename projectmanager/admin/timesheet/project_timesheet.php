<?php
$tblname = "tbl_project";
if (count($_POST) > 0) {
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";

    $explodFromDate = explode("/", $_POST["fromdate"]);
    $explodToDate = explode("/", $_POST["todate"]);

    $_POST["fromdate"] = $explodFromDate[2] . "-" . $explodFromDate[0] . "-" . $explodFromDate[1];
    $_POST["todate"] = $explodToDate[2] . "-" . $explodToDate[0] . "-" . $explodToDate[1];

    MysqlConnection::insert($tblname, $_POST);
}
$resultset = MysqlConnection::fetchAll($tblname);

function validateTimesheet() {
    $fetchCustom = "";
}
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Project Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Project</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal">Add Project</button>
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
                                <th>Project Id</th>
                                <th>Charge Code</th>
                                <th>Project Name</th>
                                <th>Description</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Per Day Work</th>
                                <th>Total Hr Work</th>
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
                                    <td><?php echo $value["projectid"] ?></td>
                                    <td><?php echo $value["projectcode"] ?></td>
                                    <td><?php echo $value["projectname"] ?></td>
                                    <td><?php echo $value["description"] ?></td>
                                    <td><?php echo $value["fromdate"] ?></td>
                                    <td><?php echo $value["todate"] ?></td>
                                    <td><?php echo $value["perdaywork"] ?></td>
                                    <td><?php echo $value["totalhrwork"] ?></td>
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
                <h4 class="modal-title" id="myModalLabel">Add Project Information</h4>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Project Id  <i class="requred">*</i></label>
                                <input type="text" maxlength="30" required="true" name="projectid" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Charge Code  <i class="requred">*</i></label>
                                <input type="text" maxlength="30" required="true" name="projectcode" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Project Title  <i class="requred">*</i></label>
                                <input type="text" maxlength="60" required="true" name="projectname" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Description  <i class="requred">*</i></label>
                                <textarea  name="description"  required="true" placeholder="Enter Data Here" class="form-control"></textarea>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">From Date  <i class="requred">*</i></label>
                                <div class="input-group date" id="bs-datepicker-component">
                                    <input type="text" name="fromdate" required="true" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">To Date  <i class="requred">*</i></label>
                                <div class="input-group date" id="bs-datepicker-component-to">
                                    <input type="text" name="todate" required="true" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Per Day Work  <i class="requred">*</i></label>
                                <input type="text" name="perdaywork" maxlength="30" required="true" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Total Hr Work  <i class="requred">*</i></label>
                                <input type="text" name="totalhrwork" maxlength="30" required="true" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Data Here" class="form-control">
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

<script>
    init.push(function () {
        $('#bs-datepicker-component').datepicker();
        $('#bs-datepicker-component-to').datepicker();
    });
</script>