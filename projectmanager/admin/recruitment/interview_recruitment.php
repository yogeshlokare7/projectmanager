<?php
//
$tblname = "tbl_interview";
$resultset = MysqlConnection::fetchAll($tblname);

if($_GET['del'] > 0){
    MysqlConnection::delete($tblname, $_GET['del']);
    header("location:mainpage.php?pagename=interview_recruitment");
}
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('View Recruitment');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Interview Schedule</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                   <a href="mainpage.php?pagename=shortlist_recruitment" class="btn btn-success btn-xs btn-outline btn-flat btn-rounded">
                       Add Interview
                    </a>
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
                                <th>Employee Name</th>
                                <th>Interviewer</th>
                                <th>Position Applied</th>
                                <th>Interview Date</th>
                                <th>Interview Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                $candidateResult=MysqlConnection::fetchByPrimary("tbl_recruitment", $value["empid"], "id");
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><a href="mainpage.php?pagename=interview_recruitment&del=<?php echo $value["id"] ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i></a></td>
                                       <td><a href="mainpage.php?pagename=addinterview_recruitment&id=<?php echo $value["id"] ?>"><span class="mm-text"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $candidateResult["firstname"]." ".$candidateResult["lastname"] ?></td>
                                    <td><?php echo $value["interviewername"] ?></td>
                                    <td><?php echo $value["jobposition"] ?></td>
                                    <td><?php echo $value["interviewdate"] ?></td>
                                    <td><?php echo $value["interviewtime"] ?></td>
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

