<?php
//
$tblname = "tbl_salary";

$resultset = MysqlConnection::fetchAll($tblname);
//
?>
<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Salary Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Salary</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <a href="mainpage.php?pagename=create_salary" class="btn btn-success btn-xs btn-outline btn-flat btn-rounded">
                        Add Salary Details
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
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th colspan="3" style="text-align:center">Allowance</th>
                                <th colspan="2" style="text-align:center">Tax</th>
                                <th colspan="3" style="text-align:center">Amount</th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Employee Name</th>
                                <th>BASIC</th>
                                <th>HRA</th>
                                <th>Transport</th>
                                <th>Medical</th>
                                <th>Other</th>
                                <th>Professional</th>
                                <th>Income</th>
                                <th>Gross</th>
                                <th>Deduction</th>
                                <th>Total</th>
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
                                    <td><?php echo $empResult["firstname"]." ".$empResult["lastname"] ?></td>
                                    <td><?php echo $value["basic"] ?></td>
                                    <td><?php echo $value["hra"] ?></td>
                                    <td><?php echo $value["transportallowance"] ?></td>
                                    <td><?php echo $value["medicalallowance"] ?></td>
                                    <td><?php echo $value["otherallowance"] ?></td>
                                    <td><?php echo $value["professionaltax"] ?></td>
                                    <td><?php echo $value["incometax"] ?></td>
                                    <td><?php echo $value["grossamount"] ?></td>
                                    <td><?php echo $value["totaldeduction"] ?></td>
                                    <td><?php echo $value["netamount"] ?></td>
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

