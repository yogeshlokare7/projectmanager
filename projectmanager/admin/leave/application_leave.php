<?php
$tblname = "tbl_leavapplication";

if (isset($_GET["status"])) {
    $fetchCustom = "";
    switch ($_GET["status"]) {
        case "approved":
            $fetchCustom = "SELECT * FROM ppms.tbl_leavapplication where status = 0;";
            break;
        case "rejected":
            $fetchCustom = "SELECT * FROM ppms.tbl_leavapplication where status = 1;";
            break;
        case "pending":
            $fetchCustom = "SELECT * FROM ppms.tbl_leavapplication where status = 2;";
            break;
        default:
            $resultset = MysqlConnection::fetchAll($tblname);
            break;
    }
    $resultset = MysqlConnection::fetchCustom($fetchCustom);
} else {
    $resultset = MysqlConnection::fetchAll($tblname);
}
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Leave Application Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Leave Application</span>
                &nbsp;|&nbsp;
                <span class="panel-title"><a class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" href="mainpage.php?pagename=application_leave&status=approved">Approved</a></span>
                &nbsp;|&nbsp;
                <span class="panel-title"><a class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" href="mainpage.php?pagename=application_leave&status=pending">Pending</a></span>
                &nbsp;|&nbsp;
                <span class="panel-title"><a class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" href="mainpage.php?pagename=application_leave&status=rejected">Rejected</a></span>
                &nbsp;|&nbsp;
                <span class="panel-title"><a class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" href="mainpage.php?pagename=application_leave">All Leaves</a></span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>#</th>
                                <th>#</th>
                                <th>#</th>
                                <th>Emp Code</th>
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Applied on</th>
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
                                        <a href="mainpage.php?pagename=update_leave&transactionid=<?php echo base64_encode($value["id"]) ?>">
                                            Update
                                        </a>
                                    </td>
                                      <td><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                    <td><?php echo $value["empCode"] ?></td>
                                    <td><?php echo $value["empname"] ?></td>
                                    <td><?php echo $value["leaveType"] ?></td>
                                    <td><?php echo $value["fromDate"] ?></td>
                                    <td><?php echo $value["toDate"] ?></td>
                                    <td><?php echo $value["totalDayes"] ?></td>
                                    <td>
                                        <?php
                                        switch ($value["status"]) {
                                            case 0:
                                                echo "Approved";
                                                break;
                                            case 1:
                                                echo "Rejected";
                                                break;
                                            case 2:
                                                echo "Pending";
                                                break;
                                            default:
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $value["entrydate"] ?></td>
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