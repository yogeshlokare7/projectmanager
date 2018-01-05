<?php
$tblname = "tbl_timesheet";


$array = array();
$array["monday"] = date("Y-m-d", strtotime('monday this week'));
$startDate = date("Y-m-d", strtotime('monday this week'));
$array["tuesday"] = date("Y-m-d", strtotime('tuesday this week'));
$array["wednesday"] = date("Y-m-d", strtotime('wednesday this week'));
$array["thursday"] = date("Y-m-d", strtotime('thursday this week'));
$array["friday"] = date("Y-m-d", strtotime('friday this week'));
$array["satuday"] = date("Y-m-d", strtotime('saturday this week'));
$endDate = date("Y-m-d", strtotime('saturday this week'));

$timesheetarray = array();

$arrproject = MysqlConnection::fetchAll("tbl_project");
$arrleaves = MysqlConnection::fetchAll("tbl_leave");

$timesheetdropdown = array();
foreach ($arrproject as $key => $value) {
    $details = array();
    $details["P"] = "P";
    $details["projectid"] = $value["projectid"];
    $details["projectcode"] = $value["projectcode"];
    $details["projectname"] = $value["projectname"];
    array_push($timesheetdropdown, $details);
}
foreach ($arrleaves as $key => $value) {
    $details["P"] = "L";
    $details["projectname"] = $value["leavename"];
    array_push($timesheetdropdown, $details);
}



$sqlTotalHr = "SELECT * FROM tbl_timesheet  WHERE   startDate = '" . $startDate . "' AND endDate =  '" . $endDate . "' AND empid = $id  ";
$customResult = MysqlConnection::fetchCustom($sqlTotalHr);

if (count($customResult) > 0) {
    $isValidate = "";
    $invalid = "You have already filled timesheet for this period !!!";
}
if (isset($_POST["btnValidate"]) || isset($_POST["btnSubmit"])) {

    $isValidate = "Yes";
    $totalHours = 0;
    for ($ind = 1; $ind < 6; $ind++) {
        $timesheet = $_POST["timesheet$ind"];
        if (strlen(trim($timesheet)) != 0) {
            $timesheetdata = array();
            $timesheetdata["empid"] = $id;
            $timesheetdata["empname"] = $fullname;
            $timesheetdata["code"] = $timesheet;
            $timesheetdata["monday"] = validateNumeric($_POST["txtTime$ind" . "0"]);
            $timesheetdata["tuesday"] = validateNumeric($_POST["txtTime$ind" . "1"]);
            $timesheetdata["wednesday"] = validateNumeric($_POST["txtTime$ind" . "2"]);
            $timesheetdata["thursday"] = validateNumeric($_POST["txtTime$ind" . "3"]);
            $timesheetdata["friday"] = validateNumeric($_POST["txtTime$ind" . "4"]);
            $timesheetdata["saturday"] = validateNumeric($_POST["txtTime$ind" . "5"]);
            $timesheetdata["isBillable"] = "N";
            $timesheetdata["entrydate"] = date("y-m-d");
            $timesheetdata["updatedate"] = date("y-m-d");
            $timesheetdata["startDate"] = $startDate;
            $timesheetdata["endDate"] = $endDate;
            $timesheetdata["active"] = "Y";
            if (isset($_POST["btnSubmit"])) {
                MysqlConnection::insert($tblname, $timesheetdata);
            } else {
                for ($indexCal = 0; $indexCal < 6; $indexCal++) {
                    $totalHours = $totalHours + validateNumeric($_POST["txtTime$ind" . $indexCal]);
                }
            }
        }
    }
    if ($totalHours < 40 || $totalHours > 48) {
        $isValidate = "";
        $invalid = "Please validate your timesheet";
    } else {
        $isValidate = "Yes";
    }
    if (isset($_POST["btnSubmit"])) {
        header("location:mainpage.php?pagename=view_timesheet");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading"> 
                <span class="panel-title">Update Timesheet</span> 
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">
                    <a href="mainpage.php?pagename=view_timesheet" class="btn btn-success btn-xs btn-outline btn-flat btn-rounded" >
                        My Timesheet
                    </a>
                </span>
            </div>

            <div class="panel-body">
                <p style="color: red"><?php echo $invalid ?></p>
                <div class="table-primary">
                    <form name="frmTimesheet" method="post">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Code / Leaves</th>
                                    <?php
                                    foreach ($array as $key => $value) {
                                        ?>
                                        <th style="width: 10%;text-align: center">
                                            <?php echo strtoupper($key) ?> <br/>
                                            <?php echo strtoupper($value) ?> 
                                        </th>
                                        <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($index = 1; $index < 6; $index++) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $index ?></td>
                                        <td>

                                            <select name="timesheet<?php echo $index ?>" class="form-control">
                                                <option value="">Please select</option>
                                                <?php
                                                foreach ($timesheetdropdown as $key => $value) {

                                                    $selected = "";
                                                    if ($_POST["timesheet$index"] == implode("-", $value)) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    ?>
                                                    <option value="<?php echo implode("-", $value) ?>" <?php echo $selected ?>>
                                                        <?php echo $value["P"] ?>- 
                                                        <?php echo $value["P"] == "P" ? $value["projectid"] . "-" : "" ?>
                                                        <?php echo $value["P"] == "P" ? $value["projectcode"] . "-" : "" ?> 
                                                        <?php echo $value["projectname"] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <?php
                                        $index2 = 0;
                                        foreach ($array as $key => $value) {
                                            ?>
                                            <td style="width: 10%;text-align: center">
                                                <input type="text" onkeypress="return chkNumericKey(event)" maxlength="1"
                                                       name="txtTime<?php echo $index ?><?php echo $index2 ?>" 
                                                       value="<?php echo $_POST["txtTime$index" . "$index2"] ?>"
                                                       class="form-control" >
                                            </td>
                                            <?php
                                            $index2++;
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="modal-footer" style="margin: 0 auto;text-align: center">
                            <?php
                            if ($isValidate == "Yes" && $invalid == "") {
                                ?>
                                <input type="submit" class="btn btn-success" value="Submit" name="btnSubmit"/>  
                                <input type="submit" class="btn btn-success" value="Clear" name="btnCancle"/>  
                                <?php
                            } else {
                                ?>
                                <input type="submit" class="btn btn-primary" value="Validate" name="btnValidate"/>  
                                <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php

function isWeekend($date) {
    $weekDay = date('w', strtotime($date));
    return ($weekDay == 0 || $weekDay == 6);
}

function validateNumeric($number) {
    if ($number == "") {
        return 0;
    } else {
        return $number;
    }
}
?>