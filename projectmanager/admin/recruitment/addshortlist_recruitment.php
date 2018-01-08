<?php
$tblname = "tbl_recruitment";
if (count($_POST) > 0) {
    unset($_POST["btnSubmit"]);
    $update = "UPDATE $tblname set isshortlisted='" . $_POST["isshortlisted"] . "', shortlistdescription='" . $_POST["shortlistdescription"] . "' WHERE id= '" . $_GET['shortlist'] . "'";
    MysqlConnection::executeQuery($update);
    header("location:mainpage.php?pagename=shortlist_recruitment");
}
$resultset = MysqlConnection::fetchByPrimary($tblname, $_GET['shortlist'], "id");
?>
<div class="row">
    <div class="col-sm-12">
        <form class="panel form-horizontal" method="POST" >
            <div class="panel-heading" >
                <span class="panel-title" style="text-transform: capitalize"><?php echo $page ?></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Name <i class="requred">*</i></label>
                            <input type="text" maxlength="30" minlength="3" required="true" value="<?php echo $resultset["firstname"] . " " . $resultset["lastname"] ?>" readonly="true" autofocus="true" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Email  <i class="requred">*</i></label>
                            <input type="email" maxlength="30" required="true" value="<?php echo $resultset["emailid"] ?>" readonly="true" class="form-control" >
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Contact No <i class="requred">*</i></label>
                            <input type="text" maxlength="30" required="true"  value="<?php echo $resultset["contactnumber"] ?>" class="form-control" readonly="true">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Position Applied For</label>
                            <input type="text" value="<?php echo $resultset["jobtitle"] ?>" readonly="true" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Total Experience</label>
                            <input type="number" value="<?php echo $resultset["totalexperience"] ?>" readonly="true" class="form-control" step="0.01">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Notice Period(Enter Days)</label>
                            <input type="number" value="<?php echo $resultset["noticeperiod"] ?>" readonly="true" class="form-control" step="0.01">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                
                <div class="row">
                    <div class="col-sm-4">
                    <div class="form-group no-margin-hr">
                            <label class="control-label">Short Listed for Interview:*</label>
                            <select name="isshortlisted" class="form-control" required>
                                <option value="">SELECT</option>
                                <option value="Y">YES</option>
                                <option value="N">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Selection on basis / Reason for rejection</label>
                            <textarea type="text" name="shortlistdescription" class="form-control" col="2"><?php echo $resultset["shortlistdescription"] ?></textarea>
                        </div>
                    </div>
                </div><!-- row -->
            </div>
            <div class="panel-footer text-left">
                <input type="submit"  class="btn btn-primary" name="btnSubmit" value="Save"/>
                &nbsp;
                <a href="mainpage.php?pagename=view_<?php echo $explode[1] ?>" class="btn btn-primary">Cancle</a>
            </div>
        </form>
    </div>
</div>