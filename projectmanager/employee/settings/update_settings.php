<?php
$tblname = "tbl_employee";
if (isset($_POST)) {
    $password=$_POST["password"];
    $updateQuery="UPDATE `tbl_employee` SET `password` = '$password' WHERE `tbl_employee`.`id` = $id"; 
    MysqlConnection::executeQuery($updateQuery);
}

?>
<div class="row">
    <div class="col-sm-12">
        <form class="panel form-horizontal" method="POST" >
            <div class="panel-heading" >
                <span class="panel-title" style="text-transform: capitalize">Update Password</span>
            </div>
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">New Password</label>
                            <input type="password" id="pwd" name="password" autofocus="" class="form-control" required>
                        </div>
                    </div><!-- col-sm-6 -->
                </div><!-- row -->
                <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Confirm Password</label>
                            <input type="password" id="confirmPwd" class="form-control" required>
                        </div>
                    </div><!-- col-sm-6 -->
                </div>
            </div>
            <div class="panel-footer text-left">
                <button type="submit"  class="btn btn-primary" onclick="checkPassword()"/>Update</button>
                &nbsp;
                <a href="mainpage.php?pagename=view_<?php echo $explode[1] ?>" class="btn btn-primary">Cancle</a>
            </div>
        </form>
    </div>
</div>
