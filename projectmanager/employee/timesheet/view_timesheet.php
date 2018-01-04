<?php
$tblname = "tbl_timesheet";
$resultset = MysqlConnection::fetchAll($tblname);

$sqlFindDate = "SELECT DISTINCT(entrydate) as entrydate FROM tbl_timesheet ORDER BY entrydate DESC; ";

$displayTimeSheet = array();

$resultSet = MysqlConnection::fetchCustom($sqlFindDate);
foreach ($resultSet as $key => $value) {
    $timeSheet = array();
    $timeSheet["entrydate"] = $value["entrydate"];

    $sqlFromToDate = "SELECT startDate,endDate FROM tbl_timesheet WHERE   entrydate = '" . $value["entrydate"] . "' AND empid = $id LIMIT 0,1 ";
    $resultSetFromDate = MysqlConnection::fetchCustom($sqlFromToDate);

    $billableHr = 0;
    $nonBillableHr = 0;
    $sqlTotalHr = "SELECT * FROM tbl_timesheet  WHERE   entrydate = '" . $value["entrydate"] . "' AND empid = $id ";
    $resultHoursBillableNonBillable = MysqlConnection::fetchCustom($sqlFromToDate);

    foreach ($resultHoursBillableNonBillable as $key1 => $value1) {

        $sqlTotalHr = "SELECT * FROM tbl_timesheet  WHERE   startDate = '" . $value1["startDate"] . "' AND endDate =  '" . $value1["endDate"] . "' AND empid = $id  ";
        $resultSetForTotal = MysqlConnection::fetchCustom($sqlTotalHr);
        foreach ($resultSetForTotal as $key2 => $value2) {
            if ($value2["isBillable"] == "N") {
                $billableHr = $billableHr + $value2["monday"] + $value2["tuesday"] + $value2["wednesday"] + $value2["thursday"] + $value2["friday"] + $value2["saturday"];
            } else {
                $nonBillableHr = $nonBillableHr + $value2["monday"] + $value2["tuesday"] + $value2["wednesday"] + $value2["thursday"] + $value2["friday"] + $value2["saturday"];
            }
        }
    }
    $timeSheet["billableHr"] = $billableHr;
    $timeSheet["nonBillableHr"] = $nonBillableHr;
    array_push($displayTimeSheet, $timeSheet);
}
?>

<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('Timesheet Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Timesheet</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <a href="mainpage.php?pagename=add_timesheet" class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" >
                        Update Timesheet
                    </a>
                </span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Duration</th>
                                <th>Employee Name</th>
                                <th>Total Time</th>
                                <th>Billable</th>
                                <th>Non Biilable</th>
                                <th>Entry Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 1;
                            foreach ($displayTimeSheet as $key => $value) {
                                ?>    
                                <tr>
                                    <td><?php echo $index ?></td>
                                    <td>
                                        <?php echo $resultSetFromDate[0]["startDate"] ?>
                                        <b>TO</b>
                                        <?php echo $resultSetFromDate[0]["endDate"] ?>
                                    </td>
                                    <td><?php echo $fullname ?></td>
                                    <td>40</td>
                                    <td><?php echo $value["billableHr"] ?></td>
                                    <td><?php echo $value["nonBillableHr"] ?></td>
                                    <td><?php echo $value["entrydate"] ?></td>
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
