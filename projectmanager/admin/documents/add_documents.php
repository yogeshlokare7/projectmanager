<?php
$tblname = "tbl_document";
if (count($_POST) > 0) {
    unset($_POST["btnSubmit"]);
    $filePath = MysqlConnection::uploadFile($_FILES["uploadFile"], "../documents/");
    $_POST["filepath"] = $filePath;
    $_POST["description"] = str_replace("'", "*", $_POST["description"]);
    MysqlConnection::insert($tblname, $_POST);
    header("location:mainpage.php?pagename=view_documents");
}
$resultset = MysqlConnection::fetchAll($tblname);
?>
<div class="row">
    <div class="col-sm-12">
        <form class="panel form-horizontal" method="POST" enctype="multipart/form-data" >
            <div class="panel-heading" >
                <span class="panel-title" style="text-transform: capitalize"><?php echo $page ?></span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Document Title <i class="requred">*</i></label>
                            <input type="text" maxlength="30" minlength="3" required="true" name="documentTitle"  autofocus="" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-12">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">File<i class="requred">*</i></label>
                            <input type="file" maxlength="30" minlength="3" required="true" name="uploadFile"  autofocus="" class="form-control">
                        </div>
                    </div><!-- col-sm-6 -->
                    <div class="col-sm-12">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Description<i class="requred">*</i></label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                    </div><!-- col-sm-6 -->
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