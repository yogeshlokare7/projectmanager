<?php
//
$tblname = "tbl_transaction";
if (count($_POST) > 0) {
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    MysqlConnection::insert($tblname, $_POST);
}
$resultset = MysqlConnection::fetchAll($tblname);

$resultsetincome = MysqlConnection::fetchCustom("SELECT * FROM tbl_account WHERE accounttype = 'Income'");
$resultsetexpense = MysqlConnection::fetchCustom("SELECT * FROM tbl_account WHERE accounttype = 'Expense'");

if($_GET['del'] > 0){
    MysqlConnection::delete($tblname, $_GET['del']);
    header("location:mainpage.php?pagename=viewtransaction_account");
}
?>
//
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Transaction Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Transaction</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModalIncome">
                        Add Incomes
                    </button>
                    <span class="panel-title">&nbsp;|&nbsp;</span>
                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModalExpense">
                        Add Expense  
                    </button>
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
                                <th>Account Type</th>
                                <th>Account Name</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Payment</th>
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
                                    <td><a href="mainpage.php?pagename=viewtransaction_account&del=<?php echo $value["id"] ?>"><i class="fa fa-times"></i></a></td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $value["accountname"] ?></td>
                                    <td><?php echo $value["accounttype"] ?></td>
                                    <td><?php echo $value["description"] ?></td>
                                    <td><?php echo $value["amount"] ?></td>
                                    <td><?php echo $value["payment"] ?></td>
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
<div id="myModalIncome" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Income Information</h4>
            </div>
            <form name="frmEntry" method="post">
                <input type="hidden" name="accountname" value="income">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Select Account Name</label>
                                <select class="form-control" name="accounttype">
                                    <option>Select Account Type</option>
                                    <?php
                                    foreach ($resultsetincome as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["accountname"] ?>">
                                            <?php echo $value["accountname"] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Amount </label>
                                <input type="text" name="amount" maxlength="30" autofocus="" onkeypress="return chkNumericKey(event)" placeholder="Enter Amount" class="form-control">
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Description </label>
                                <textarea  class="form-control" name="description"></textarea>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Payment </label>
                                <input type="text" name="payment" maxlength="30" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Payment" class="form-control">
                            </div>
                        </div> 
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

<!--- ADD POP UP DIALOG ---->
<div id="myModalExpense" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Expese Information</h4>
            </div>
            <form name="frmEntry" method="post">
                <input type="hidden" name="accountname" value="expense">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Select Account Name</label>
                                <select class="form-control" name="accounttype">
                                    <option>Select Account Type</option>
                                    <?php
                                    foreach ($resultsetexpense as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value["accountname"] ?>">
                                            <?php echo $value["accountname"] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Amount </label>
                                <input type="text" name="amount"  maxlength="30" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Amount" class="form-control">
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Description </label>
                                <textarea  class="form-control" name="description"></textarea>
                            </div>
                        </div> 
                        <div class="col-sm-12">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Payment </label>
                                <input type="text" name="payment" maxlength="30" onkeypress="return chkNumericKey(event)" autofocus="" placeholder="Enter Payment" class="form-control">
                            </div>
                        </div> 
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