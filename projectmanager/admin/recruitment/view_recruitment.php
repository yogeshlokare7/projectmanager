<?php
//
$tblname = "tbl_recruitment";

$resultset = MysqlConnection::fetchAll($tblname);

if($_GET['del'] > 0){
    MysqlConnection::delete($tblname, $_GET['del']);
    header("location:mainpage.php?pagename=view_recruitment");
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
                <span class="panel-title">View Recruitment</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <a href="mainpage.php?pagename=add_recruitment" class="btn btn-success btn-xs btn-outline btn-flat btn-rounded">
                       Add Recruitment
                    </a>
<!--                    <span class="panel-title">&nbsp;|&nbsp;</span>-->
<!--                    <button class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" data-toggle="modal" data-target="#myModalExpense">
                        Add Expense  
                    </button>-->
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
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Post Applied</th>
                                <th>Experience</th>
                                <th>Current CTC</th>
                                <th>Expected CTC</th>
                                <th>Notice Period</th>
                                <th>Selected</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($resultset as $key => $value) {
                                $empResult=MysqlConnection::fetchByPrimary("tbl_employee", $value["employeeid"], "id");
                                
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $index ?></td>
                                    <td><a href="mainpage.php?pagename=view_recruitment&del=<?php echo $value["id"] ?>" onClick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i></a></td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="mainpage.php?pagename=addshortlist_recruitment&shortlist=<?php echo $value["id"] ?>">Shortlist</a></td>
                                    <td><?php echo $value["firstname"]." ".$value["lastname"] ?></td>
                                    <td><?php echo $value["emailid"] ?></td>
                                    <td><?php echo $value["contactnumber"] ?></td>
                                    <td><?php echo $value["jobtitle"] ?></td>
                                    <td><?php echo $value["totalexperience"] ?></td>
                                    <td><?php echo $value["currentctc"] ?></td>
                                    <td><?php echo $value["expectedctc"] ?></td>
                                    <td><?php echo $value["noticeperiod"] ?></td>
                                    <td><?php echo $value["isselected"] ?></td>
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

