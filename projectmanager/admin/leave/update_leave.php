<?php
$tblname = "tbl_leavapplication";
$transactionid = base64_decode($_GET["transactionid"]);

if (isset($_POST["status"])) {
    $status = $_POST["status"];
    $feedback = $_POST["feedback"];
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    echo $updateQuery = "UPDATE tbl_leavapplication SET status = '$status' AND feedback = '$feedback' WHERE id = $transactionid ";
    MysqlConnection::executeQuery($updateQuery);
//    header("location:mainpage.php?pagename=application_leave");
} else {
    $fetchCustom = "SELECT * FROM ppms.tbl_leavapplication where id = $transactionid";
    $resultSetFetchCustom = MysqlConnection::fetchCustom($fetchCustom);
}
?> 

<div class="row">
    <div class="col-sm-12">
        <form class="panel form-horizontal" method="POST" >
            <div class="panel-heading" >
                <span class="panel-title" style="text-transform: capitalize">Manage Leave</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Employee Code</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["empCode"] ?>" autofocus="" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Employee Name</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["empname"] ?>" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Applied Leave</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["leaveType"] ?>" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Applied On</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["entrydate"] ?>" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Applied From</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["fromDate"] ?>" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Applied To</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["toDate"] ?>" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Description</label>
                            <input type="text" readonly="" value="<?php echo $resultSetFetchCustom[0]["description"] ?>" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Status</label>
                            <select name="status"  class="form-control" >
                                <option value=""></option>
                                <option value="0">Approved</option>
                                <option value="1">Rejected</option>
                                <option value="2">Pending</option>
                            </select>
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Feedback</label>
                            <textarea class="form-control" name="feedback"></textarea>
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

            </div>
            <div class="panel-footer text-left">
                <input type="submit"  class="btn btn-primary" name="btnSubmit" value="Update"/>
                &nbsp;
                <a href="mainpage.php?pagename=view_<?php echo $explode[1] ?>" class="btn btn-primary">Cancle</a>
            </div>
        </form>
    </div>
</div>