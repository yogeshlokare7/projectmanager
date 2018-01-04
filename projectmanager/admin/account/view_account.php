<?php
$tblname = "tbl_account";
if (count($_POST) > 0) {
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    MysqlConnection::insert($tblname, $_POST);
}
$resultset = MysqlConnection::fetchAll($tblname);
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
                                    <td>
                                        <a href="#" onclick="setDeleteDetails('<?php echo $value["id"] ?>')" id="ui-bootbox-confirm">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
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
                                <label class="control-label">Account Name *</label>
                                <input type="text" maxlength="30" minlength="3" name="accountname" autofocus="" placeholder="Enter Account Name" class="form-control">
                            </div>
                        </div><!-- col-sm-6 -->
                        <div class="col-sm-6">
                            <div class="form-group no-margin-hr">
                                <label class="control-label">Select Account Type</label>
                                <select class="form-control" name="accounttype">
                                    <option>Select Account Type</option>
                                    <option>Income</option>
                                    <option>Expense</option>
                                </select>
                            </div>
                        </div><!-- col-sm-6 -->
                    </div><!-- row -->
                </div>  
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save"/>  
                    <button type="button"  class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
                <input type="hidden" name="deleteId" id="deleteId">
                <input type="hidden" name="tblname" id="tblname">
                <input type="hidden" name="viewpage" id="viewpage">
            </form>
        </div> 
    </div>  
</div>  
<!--- ADD POP UP DIALOG ---->


<script>
    function setDeleteDetails(deleteId) {
        alert(deleteId);
        document.getElementById("deleteId").value = deleteId;
        document.getElementById("tblname").value = "tbl_account";
        document.getElementById("viewpage").value = "view_account";
    }
</script>

<script>
    init.push(function () {
        $('#ui-bootbox-confirm').on('click', function () {
            bootbox.confirm({
                message: "Do you want to delete this record?",
                callback: function (result) {
                    if (result) {
                        var deleteId = document.getElementById("deleteId").value;
                        var tblname = document.getElementById("tblname").value;
                        var viewpage = document.getElementById("viewpage").value;
                        document.frmEntry.action = "mainpage.php?pagename=data_delete&param1="+deleteId+"&param2="+tblname+"&param3="+viewpage;
                        document.frmEntry.submit();                    
                    }
                },
                className: "bootbox-sm"
            });
        });

    });
</script>