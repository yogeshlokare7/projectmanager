<?php
$tblname = "tbl_recruitment";
if (count($_POST) > 0) {
    unset($_POST["btnSubmit"]);
    $_POST["entrydate"] = date("y-m-d");
    $_POST["updatedate"] = date("y-m-d");
    $_POST["active"] = "Y";
    MysqlConnection::insert($tblname, $_POST);
    header("location:mainpage.php?pagename=view_recruitment");
}
$resultset = MysqlConnection::fetchAll($tblname);
//print_r($resultsetEmployees);
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
                            <label class="control-label">First Name <i class="requred">*</i></label>
                            <input type="text" maxlength="30" minlength="3" required="true" name="firstname"  autofocus="" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Middle Name <i class="requred">*</i></label>
                            <input type="text" maxlength="30" minlength="3" required="true" name="middlename" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Last Name <i class="requred">*</i></label>
                            <input type="text"  maxlength="30" required="true" name="lastname" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Email  <i class="requred">*</i></label>
                            <input type="email" maxlength="30" required="true" name="emailid" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Contact No <i class="requred">*</i></label>
                            <input type="text" maxlength="30" required="true" onkeypress="return chkNumericKey(event)" name="contactnumber" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Alternate Contact No</label>
                            <input type="text" maxlength="30" onkeypress="return chkNumericKey(event)" name="altercontact" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Position Applied For</label>
                            <input type="text" name="jobtitle" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Total Experience</label>
                            <input type="number" name="totalexperience" class="form-control" step="0.01">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Notice Period(Enter Days)</label>
                            <input type="number" name="noticeperiod" onkeypress="return chkNumericKey(event)" class="form-control" step="0.01">
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Current CTC</label>
                            <input type="number" name="currentctc" class="form-control" step="0.01">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Expected CTC</label>
                            <input type="number" name="expectedctc" class="form-control" step="0.01">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-4">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Selected</label>
                            <select name="isselected" class="form-control" required>
                                <option value="">SELECT</option>
                                <option value="Y">YES</option>
                                <option value="N">NO</option>
                            </select>
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Current Address</label>
                            <textarea type="text" name="currentaddress" class="form-control" col="2"></textarea>
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Permanent Address</label>
                            <textarea type="text" name="permenentaddress" class="form-control" col="2"></textarea>
                        </div>
                    </div><!-- col-sm-6 -->
                </div>   
            </div>
            <div class="panel-footer text-left">
                <input type="submit"  class="btn btn-primary" name="btnSubmit" value="Save"/>
                &nbsp;
                <a href="mainpage.php?pagename=view_<?php echo $explode[1] ?>" class="btn btn-primary">Cancle</a>
            </div>
        </form>
    </div>
</div>