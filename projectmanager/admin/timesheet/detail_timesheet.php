<?php
$sqlcustom = "SELECT distinct empid FROM ppms.tbl_timesheet;";
$customarray = MysqlConnection::fetchCustom($sqlcustom);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">Search</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Employee Name <i class="requred">*</i>:</label>
                            <select id="empId" name="employeeid" required="true" autofocus="true" class="form-control" tabindex="1" required>
                                <option value="">Select</option>
                                <?php
                                foreach ($resultsetEmployees as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value["id"] ?>">
                                        <?php echo $value["firstname"] ?> <?php echo $value["middlename"] ?> <?php echo $value["lastname"] ?> 
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group no-margin-hr">
                            <label class="control-label">Project Name <i class="requred">*</i>:</label>
                            <select id="empId" name="employeeid" required="true" autofocus="true" class="form-control" tabindex="1" required>
                                <option value="">Select</option>
                                <?php
                                foreach ($resultsetEmployees as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value["id"] ?>">
                                        <?php echo $value["firstname"] ?> <?php echo $value["middlename"] ?> <?php echo $value["lastname"] ?> 
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div><!-- row -->
                <div class="col-sm-12" style="text-align: right">
                    <input type="submit" class="btn btn-primary" value="Search"/>  
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function() {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Timesheet Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Time-Sheet</span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Duration</th>
                                <th>Employee Name</th>
                                <th>Project Name</th>
                                <th>Total Time</th>
                                <th>Billable</th>
                                <th>Non Billable</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($customarray as $key => $value) {
                                $fromToDate = getFromToDate($value["empid"]);
                                $projectname = getProjectName($value["empid"]);
                                $employeeName = getEmployeeName($value["empid"]);
                                $billable = getBillable($fromToDate, $value["empid"]);
                                $nonbillable = getNonBillable($fromToDate, $value["empid"]);
                                ?>    
                                <tr>
                                    <td><?php echo $index++ ?></td>
                                    <td><?php echo $fromToDate ?></td>
                                    <td><?php echo $employeeName ?></td>
                                    <td><?php echo $projectname ?></td>
                                    <td>40</td>
                                    <td><?php echo $billable ?></td>
                                    <td><?php echo $nonbillable ?></td>
                                </tr>
                                <?php
                            }
                            ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

function getFromToDate($employeeId) {
    $fetchCustom = "SELECT startDate, endDate FROM ppms.tbl_timesheet where empid = " . $employeeId;
    $resultset = MysqlConnection::fetchCustom($fetchCustom);
    return $resultset[0]["startDate"] . " TO " . $resultset[0]["endDate"];
}

function getProjectName($employeeId) {
    $fetchCustom = "SELECT p.projectname as projectname , p.projectcode as projectcode "
            . "FROM tbl_project p , tbl_employee_project ep "
            . "WHERE p.id = ep.projectId AND ep.employeeId = " . $employeeId;
    $resultset = MysqlConnection::fetchCustom($fetchCustom);
    return $resultset[0]["projectname"] . " (" . $resultset[0]["projectcode"] . ")";
}

function getEmployeeName($employeeId) {
    $fetchCustom = "SELECT firstname,middlename,lastname FROM ppms.tbl_employee where id = $employeeId";
    $resultset = MysqlConnection::fetchCustom($fetchCustom);
    return $resultset[0]["firstname"] . " " . $resultset[0]["middlename"] . " " . $resultset[0]["lastname"];
}

function getBillable($fromDate, $employeeId) {
    $explod = explode("TO", $fromDate);
    $sqlcusom = "SELECT * from ppms.tbl_timesheet WHERE "
            . "startDate = '" . $explod[0] . "' AND endDate = '" . $explod[1] . "' AND empid = $employeeId";
    $fetchcusom = MysqlConnection::fetchCustom($sqlcusom);
    $counter = 0;
    foreach ($fetchcusom as $key => $value) {
        $code = $value["code"];
        $expcode = explode("-", $code);
        if ($expcode[0] != 'L') {
            $counter = $counter +
                    $value["monday"] +
                    $value["tuesday"] +
                    $value["wednesday"] +
                    $value["thursday"] +
                    $value["friday"] +
                    $value["saturday"];
        }
    }
    return $counter;
}

function getNonBillable($fromDate, $employeeId) {
    $explod = explode("TO", $fromDate);
    $sqlcusom = "SELECT * from ppms.tbl_timesheet WHERE "
            . "startDate = '" . $explod[0] . "' AND endDate = '" . $explod[1] . "' AND empid = $employeeId";
    $fetchcusom = MysqlConnection::fetchCustom($sqlcusom);
    $counter = 0;
    foreach ($fetchcusom as $key => $value) {
        $code = $value["code"];
        $expcode = explode("-", $code);
        if ($expcode[0] == 'L') {
            $counter = $counter +
                    $value["monday"] +
                    $value["tuesday"] +
                    $value["wednesday"] +
                    $value["thursday"] +
                    $value["friday"] +
                    $value["saturday"];
        }
    }
    return $counter;
}
?>