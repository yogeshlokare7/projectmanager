<?php
$tblname = "tbl_interview";
if (count($_POST) > 0) {
    unset($_POST["btnSubmit"]);
    $explodFromDate = explode("/", $_POST["interviewdate"]);
    $_POST["interviewdate"] = $explodFromDate[2] . "-" . $explodFromDate[0] . "-" . $explodFromDate[1];
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    if (isset($_GET["id"])) {
        $update = "UPDATE $tblname set interviewername='" . $_POST["interviewername"] . "', interviewdate='" . $_POST["interviewdate"] . "' WHERE id= '" . $_GET['id'] . "'";
        MysqlConnection::executeQuery($update);
    } else {
        $_POST["entrydate"] = date("y-m-d");
        MysqlConnection::insert($tblname, $_POST);
    }
    header("location:mainpage.php?pagename=interview_recruitment");
}

if (isset($_GET["id"])) {
    $resultsetEdit = MysqlConnection::fetchByPrimary($tblname, $_GET['id'], "id");
    $resultsetCandidate = MysqlConnection::fetchByPrimary("tbl_recruitment", $resultsetEdit['empid'], "id"); 
}else{
   $resultsetCandidate = MysqlConnection::fetchByPrimary("tbl_recruitment", $_GET['recruitmentid'], "id"); 
}
?>
<div class="row">
    <div class="col-sm-12">
        <form class="panel form-horizontal" method="POST" >
            <div class="panel-heading" >
                <span class="panel-title" style="text-transform: capitalize">Add/Edit Interview</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Candidate Name <i class="requred">*</i>:</label>
                            <select name="empId" required="true" autofocus="true" class="form-control" tabindex="1" readonly="true">
                                <option value="<?php echo $resultsetCandidate["id"] ?>">
                                    <?php echo $resultsetCandidate["firstname"] ?> <?php echo $resultsetCandidate["middlename"] ?> <?php echo $resultsetCandidate["lastname"] ?> 
                                </option>
                            </select>
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Position Applied For</label>
                            <input type="text" name="jobposition" value="<?php echo $resultsetCandidate["jobtitle"] ?>" readonly="true" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Contact No <i class="requred">*</i></label>
                            <input type="text" maxlength="30" required="true"  value="<?php echo $resultsetCandidate["contactnumber"] ?>" class="form-control" readonly="true">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Interviewer</label>
                            <input type="text" name="interviewername" value="<?php echo $resultsetEdit["interviewername"] ?>" required="true" autofocus="true" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Interview Date</label>
                            <div class="input-group date" id="bs-datepicker-component">
                                <input type="text" name="interviewdate" value="<?php echo $resultsetEdit["interviewdate"] ?>" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Interview Time</label>
                             <div class="input-group date" id="bs-datepicker-component-to">
                                <input type="text" alue="<?php echo $resultsetEdit["interviewtime"] ?>" class="form-control"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
            </div>
            <div class="panel-footer text-left">
                <input type="submit"  class="btn btn-primary" name="btnSubmit" value="Save"/>
                &nbsp;
                <a href="mainpage.php?pagename=interview_recruitment" class="btn btn-primary">Cancle</a>
            </div>
        </form>
    </div>
</div>
<script>
    init.push(function () {
        $('#bs-datepicker-component').datepicker();
        $('#bs-datepicker-component-to').datepicker();
    });
</script>