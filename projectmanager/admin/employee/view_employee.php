<?php
$tblname = "tbl_employee";
if (isset($_POST["btnSaveEmp"]) && count($_POST) > 0) {
    $_POST["password"] = randomPassword(8);
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    MysqlConnection::insert($tblname, $_POST);
}

if (isset($_POST["btnSaveProjectToEmp"]) && count($_POST) > 0) {
    unset($_POST["btnSaveProjectToEmp"]);

    $sqlcustom = "SELECT * FROM tbl_employee_project where employeeId = " . $_POST["employeeId"] . " AND projectId = " . $_POST["projectId"];
    $resultset = MysqlConnection::fetchCustom($sqlcustom);
    $counter = count($resultset);
    if ($counter == 0) {
        MysqlConnection::insert("tbl_employee_project", $_POST);
    } else {
        $error = "Project is already allocated to employee";
    }
}


if ($_GET['del'] > 0) {
    MysqlConnection::delete($tblname, $_GET['del']);
    header("location:mainpage.php?pagename=view_employee");
}
$resultset = MysqlConnection::fetchAll($tblname);
$resultsetposition = MysqlConnection::fetchAll("tbl_position");
$project = MysqlConnection::fetchAll("tbl_project");
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function() {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('<?php echo ucwords($explode[1]) ?> Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <p style="color: red"><?php echo $error ?></p>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View <?php echo $explode[1] ?></span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal">Add <?php echo $explode[1] ?></button>
                </span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModal1">Add Project</button>
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
                                <th>Emp Code</th>
                                <th>Emp Name</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Email Id</th>
                                <th>Contact No</th>
                                <th>Entry Date</th>
                                <th>Active</th>
                                <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><a href="mainpage.php?pagename=view_employee&del=<?php echo $value["id"] ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i></a></td>
                                    <td><a data-toggle="modal" data-target="#myModal" data-formid="<?php echo $value["id"] ?>"><span class="mm-text"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $value["empId"] ?></td>
                                    <td><?php echo $value["firstname"] ?> <?php echo $value["middlename"] ?> <?php echo $value["lastname"] ?></td>
                                    <td><img src="../assets/images/custom/user-dummy.png" style="width: 60px;height: 60px;"/></td>
                                    <td><?php echo $value["jobtitle"] ?></td>
                                    <td><?php echo $value["emailid"] ?></td>
                                    <td><?php echo $value["contactnumber"] ?></td>
                                    <td><?php echo $value["entrydate"] ?></td>
                                    <td><?php echo $value["active"] ?></td>
                                    <td>
                                        <a href="mainpage.php?pagename=detail_employee">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
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
    <?php
    $id = $_REQUEST['id'];
    echo $id;
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Employee Information</h4>
                <?php
                $id = $_REQUEST['id'];
                echo $id;
                ?>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">First Name  <i class="requred">*</i></label>
                                <input type="text" minlength="3" maxlength="30"required="true" name="firstname" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Middle Name  </label>
                                <input type="text" minlength="3" maxlength="30"  name="middlename" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Last Name  <i class="requred">*</i></label>
                                <input type="text"  minlength="3" maxlength="30" required="true" name="lastname" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Employee Code  <i class="requred">*</i></label>
                                <input type="text" name="empId" required="true" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Job Title  <i class="requred">*</i></label>
                                <select class="form-control" name="jobtitle">
                                    <option>Select Account Type</option>
                                    <?php
                                    foreach ($resultsetposition as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["positionname"] ?>">
                                            <?php echo $value["positionname"] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Image  <i class="requred">*</i></label>
                                <input type="file" name="image" required="true" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Email Id  <i class="requred">*</i></label>
                                <input type="text" name="emailid" required="true" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Contact Number  <i class="requred">*</i></label>
                                <input type="text" name="contactnumber" required="true" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-4">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Alternet Number </label>
                                <input type="text" name="altercontact" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Data Here" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Current Address  <i class="requred">*</i></label>
                                <textarea name="currentaddress" required="true" class="form-control"></textarea>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Permanent Address</label>
                                <textarea name="permenentaddress"  class="form-control"></textarea>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div>


                </div>  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" name="btnSaveEmp"/>  
                    <button type="button"  class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div> 
    </div>  
</div>  
<!--- ADD POP UP DIALOG ---->



<!--- ADD POP UP DIALOG ---->
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Assign Project to employee</h4>
            </div>
            <form name="frmEntryProject" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Employee <i class="requred">*</i></label>
                                <select name="employeeId" class="form-control">
                                    <?php
                                    foreach ($resultset as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["id"] ?>">
                                            <?php echo $value["empId"] ?> 
                                            <?php echo $value["firstname"] ?> 
                                            <?php echo $value["middlename"] ?> 
                                            <?php echo $value["lastname"] ?>
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
                                <label class="control-label">Project  </label>
                                <select name="projectId" class="form-control">
                                    <?php
                                    foreach ($project as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["id"] ?>">
                                            <?php echo $value["projectcode"] ?>-
                                            <?php echo $value["projectname"] ?> 
                                        </option>   
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->
                </div>  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" name="btnSaveProjectToEmp"/>  
                    <button type="button"  class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div> 
    </div>  
</div>

<?php

function randomPassword($length = 8) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr(str_shuffle($chars), 0, $length);
    return $password;
}
?>