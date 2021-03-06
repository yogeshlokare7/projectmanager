<?php
$tblname = "tbl_account";
if (count($_POST) > 0) {
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    if ($_GET['id'] != null && $_GET['id'] > 0) {
        $update = "UPDATE $tblname set accountname='" . $_POST["accountname"] . "', accounttype='" . $_POST["accounttype"] . "' WHERE id= '" . $_GET['id'] . "'";
        print_r($update);
        MysqlConnection::executeQuery($update);
    } else {
        $_POST["entrydate"] = date("y-m-d");
        MysqlConnection::insert($tblname, $_POST);
    }
}
$resultset = MysqlConnection::fetchAll($tblname);
if(isset($_GET["del"])){
    MysqlConnection::delete($tblname, base64_decode($_GET['del']));
    header("location:mainpage.php?pagename=view_account");
}
if ($_GET['id'] > 0) {
    $resultsetUpdate = MysqlConnection::fetchByPrimary($tblname, base64_decode($_GET['id']), "id");
}
?>


<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('<?php echo $explode[1] ?> Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View <?php echo $explode[1] ?></span>
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
                                <th>#</th>
                                <th>Account Name</th>
                                <th>Account Type</th>
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
                                    <td><a href="mainpage.php?pagename=view_account&del=<?php echo base64_encode($value["id"]) ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i></a></td>
                                    <td><a href="mainpage.php?pagename=view_account&id=<?php echo base64_encode($value["id"]) ?>"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $value["accountname"] ?></td>
                                    <td><?php echo $value["accounttype"] ?></td>
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
                <h4 class="modal-title" id="myModalLabel">Add Account Information</h4>
            </div>
            <form name="frmEntry" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Account Name <i class="requred">*</i></label>
                                <input type="text" maxlength="30" required="true" minlength="3" name="accountname" value="<?php echo $resultsetUpdate["accountname"] ?>" autofocus="" placeholder="Enter Account Name" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Select Account Type</label>
                                <select class="form-control" name="accounttype" required>
                                    <option value="">Select Account Type</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
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

