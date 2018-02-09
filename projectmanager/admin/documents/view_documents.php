<?php
$tblname = "tbl_document";
$resultset = MysqlConnection::fetchAll($tblname);
if ($_GET['del'] > 0) {
    MysqlConnection::delete($tblname, $_GET['del']);
    header("location:mainpage.php?pagename=view_documents");
}
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function() {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('View Document');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Recruitment</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <a href="mainpage.php?pagename=add_documents" class="btn btn-success btn-xs btn-outline btn-flat btn-rounded">
                        Add Documents
                    </a>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th style="width: 2%">#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th  style="width: 2%">VIew</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                $empResult = MysqlConnection::fetchByPrimary("tbl_employee", $value["employeeid"], "id");
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><?php echo $value["documentTitle"] ?></td>
                                    <td>
                                        <p style="padding: 5px;text-align: justify"><?php echo str_replace("*","'", $value["description"])?></p>
                                    </td>
                                    <td><a target="_blank" href="<?php echo $value["filepath"] ?>"><i class="fa fa-eye"></i></a></td>
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

