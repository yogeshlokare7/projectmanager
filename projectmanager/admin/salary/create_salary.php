<?php
$tblname = "tbl_salary";
if (count($_POST) > 0) {
    unset($_POST["btnSubmit"]);
    if ($_GET['id'] != null && $_GET['id'] > 0) {
        $update = "UPDATE $tblname set employeeid='" . $_POST["employeeid"] . "', basic='" . $_POST["basic"] . "', hra='" . $_POST["hra"] . "', medicalallowance='" . $_POST["medicalallowance"] . "', otherallowance='" . $_POST["otherallowance"] . "', onsiteallowance='" . $_POST["onsiteallowance"] . "', incentive='" . $_POST["incentive"] . "', pfempl='" . $_POST["pfempl"] . "', pfemplr='" . $_POST["pfemplr"] . "', professionaltax='" . $_POST["professionaltax"] . "', incometax='" . $_POST["incometax"] . "', advances='" . $_POST["advances"] . "', mealvouchers='" . $_POST["mealvouchers"] . "', giftvouchers='" . $_POST["giftvouchers"] . "', grossamount='" . $_POST["grossamount"] . "', totaldeduction='" . $_POST["totaldeduction"] . "', netamount='" . $_POST["netamount"] . "', transportallowance='" . $_POST["transportallowance"] . "' WHERE id= '" . $_GET['id'] . "'";
        MysqlConnection::executeQuery($update);
    } else {
        MysqlConnection::insert($tblname, $_POST);
    }
    header("location:mainpage.php?pagename=view_salary");
}
if ($_GET['id'] > 0) {
    $resultsetSalary = MysqlConnection::fetchByPrimary($tblname, $_GET['id'], "id");
}
$resultset = MysqlConnection::fetchAll($tblname);
$resultsetEmployees = MysqlConnection::fetchAll("tbl_employee");
//print_r($resultsetEmployees);
?>
<div class="row">
    <div class="col-sm-12">
        <form class="panel form-horizontal" method="POST" >
                <div class="panel-heading" >
                    <span class="panel-title" style="text-transform: capitalize"><?php echo $page ?></span>
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
                    </div><!-- row -->
                    <br/>
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <thead>
                                <tr>
                                    <th>Earnings</th>
                                    <th>Rs</th>
                                    <th>Deduction</th>
                                    <th>Rs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX">
                                    <td>Basic</td>
                                    <td><input type="text"  maxlength="30" id="basic" name="basic" value="<?php echo $resultsetSalary["basic"] ?>" onkeypress="return chkNumericKey(event)"  class="form-control" tabindex="2" onkeyup="calcuateGrossAmount()" autofocus="true" required></td>
                                    <td>PF-Empl</td>
                                    <td><input type="text" maxlength="30"   id="pfempl" name="pfempl" value="<?php echo $resultsetSalary["pfempl"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="10" onkeyup="calcuateDeductionAmount()" required></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>HRA</td>
                                    <td><input type="text" maxlength="30"  id="hra" name="hra" value="<?php echo $resultsetSalary["hra"] ?>" onkeypress="return chkNumericKey(event)"  class="form-control" tabindex="3" onkeyup="calcuateGrossAmount()" required></td>
                                    <td>PF-Emplr</td>
                                    <td><input type="text" maxlength="30"  id="pfemplr" name="pfemplr" value="<?php echo $resultsetSalary["pfemplr"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="11" onkeyup="calcuateDeductionAmount()" required></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Transport Allowance</td>
                                    <td><input type="text" maxlength="30"   id="transportallowance" name="transportallowance" value="<?php echo $resultsetSalary["transportallowance"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="4" onkeyup="calcuateGrossAmount()" required></td>
                                    <td>Professional Tax</td>
                                    <td><input type="text" maxlength="30"  id="professionaltax" name="professionaltax" value="<?php echo $resultsetSalary["professionaltax"] ?>" class="form-control" onkeypress="return chkNumericKey(event)"  tabindex="12" onkeyup="calcuateDeductionAmount()" required></td>

                                </tr>
                                <tr class="odd gradeX">
                                    <td>Medical Allowance</td>
                                    <td><input type="text"  maxlength="30"  id="medicalallowance" name="medicalallowance" value="<?php echo $resultsetSalary["medicalallowance"] ?>" class="form-control" onkeypress="return chkNumericKey(event)" tabindex="5" onkeyup="calcuateGrossAmount()" required></td>
                                    <td>Income Tax</td>
                                    <td><input type="text" maxlength="30"  id="incometax" name="incometax" value="<?php echo $resultsetSalary["incometax"] ?>" class="form-control" onkeypress="return chkNumericKey(event)" tabindex="13" onkeyup="calcuateDeductionAmount()" required></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Other Allowance</td>
                                    <td><input type="text" maxlength="30"  id="otherallowance" name="otherallowance" value="<?php echo $resultsetSalary["otherallowance"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="6" onkeyup="calcuateGrossAmount()" required></td>
                                    <td>Advances</td>
                                    <td><input type="text" maxlength="30"  id="advances" name="advances" value="<?php echo $resultsetSalary["advances"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="14" onkeyup="calcuateDeductionAmount()" required></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>On Site Allowance</td>
                                    <td><input type="text" maxlength="30"  id="onsiteallowance" name="onsiteallowance" value="<?php echo $resultsetSalary["onsiteallowance"] ?>" onkeypress="return chkNumericKey(event)"  class="form-control" tabindex="7" onkeyup="calcuateGrossAmount()" required></td>
                                    <td>Meal Vouchers</td>
                                    <td><input type="text" maxlength="30"  id="mealvouchers" name="mealvouchers" value="<?php echo $resultsetSalary["mealvouchers"] ?>" class="form-control" onkeypress="return chkNumericKey(event)" tabindex="15" onkeyup="calcuateDeductionAmount()" required></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Incentives/ Commission</td>
                                    <td><input type="text" maxlength="30"  id="incentive" name="incentive"  value="<?php echo $resultsetSalary["incentive"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="8" onkeyup="calcuateGrossAmount()" required></td>
                                    <td>Gift Vouchers</td>
                                    <td><input type="text" maxlength="30"  id="giftvouchers" name="giftvouchers" value="<?php echo $resultsetSalary["giftvouchers"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="16" onkeyup="calcuateDeductionAmount()" required></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Arrears</td>
                                    <td><input type="text" maxlength="30"  id="arrears" name="arrears" value="<?php echo $resultsetSalary["arrears"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" tabindex="9" onkeyup="calcuateGrossAmount()" required></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="odd gradeX">
                                    <td>Gross Amount</td>
                                    <td><input type="text" maxlength="30"  id="grossamount" name="grossamount" value="<?php echo $resultsetSalary["grossamount"] ?>" onkeypress="return chkNumericKey(event)" class="form-control" value="0" readonly></td>
                                    <td>Total Deduction</td>
                                    <td><input type="text" maxlength="30"  id="totaldeduction"  name="totaldeduction" value="<?php echo $resultsetSalary["totaldeduction"] ?>" onkeypress="return chkNumericKey(event)"  class="form-control"  value="0" readonly></td>
                                </tr>

                            <input type="hidden" id="netamount" maxlength="30"  name="netamount" onkeypress="return chkNumericKey(event)"  class="form-control" value="0"></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer text-left">
                        <input type="submit" class="btn btn-primary" name="btnSubmit" value="Save" onclick="calcualteTotalAmount()"/>
                        &nbsp;
                        <a href="mainpage.php?pagename=view_salary" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function calcuateDeductionAmount() {
        var sum = 0;

        var pfemplAmt = document.getElementById("pfempl").value;
        var b = isNaN(parseFloat(pfemplAmt)) ? 0 : parseFloat(pfemplAmt);

        var pfemplrAmt = document.getElementById("pfemplr").value;
        var c = isNaN(parseFloat(pfemplrAmt)) ? 0 : parseFloat(pfemplrAmt);
        var professional = document.getElementById("professionaltax").value;
        var d = isNaN(parseFloat(professional)) ? 0 : parseFloat(professional);

        var income = document.getElementById("incometax").value;
        var e = isNaN(parseFloat(income)) ? 0 : parseFloat(income);

        var advances = document.getElementById("advances").value;
        var f = isNaN(parseFloat(advances)) ? 0 : parseFloat(advances);

        var meal = document.getElementById("mealvouchers").value;
        var g = isNaN(parseFloat(meal)) ? 0 : parseFloat(meal);

        var giftvouchersAmt = document.getElementById("giftvouchers").value;
        var h = isNaN(parseFloat(giftvouchersAmt)) ? 0 : parseFloat(giftvouchersAmt);
        sum = b + c + d + e + f + g + h;
        document.getElementById("totaldeduction").value = sum;
    }

    function calcuateGrossAmount() {
        var sum = 0;

        var basicAmt = document.getElementById("basic").value;
        var b = isNaN(parseFloat(basicAmt)) ? 0 : parseFloat(basicAmt);

        var hraAmt = document.getElementById("hra").value;
        var c = isNaN(parseFloat(hraAmt)) ? 0 : parseFloat(hraAmt);

        var transport = document.getElementById("transportallowance").value;
        var d = isNaN(parseFloat(transport)) ? 0 : parseFloat(transport);

        var medical = document.getElementById("medicalallowance").value;
        var e = isNaN(parseFloat(medical)) ? 0 : parseFloat(medical);

        var other = document.getElementById("otherallowance").value;
        var f = isNaN(parseFloat(other)) ? 0 : parseFloat(other);

        var onsite = document.getElementById("onsiteallowance").value;
        var g = isNaN(parseFloat(onsite)) ? 0 : parseFloat(onsite);

        var incentiveAmt = document.getElementById("incentive").value;
        var h = isNaN(parseFloat(incentiveAmt)) ? 0 : parseFloat(incentiveAmt);

        var arrears = document.getElementById("arrears").value;
        var i = isNaN(parseFloat(arrears)) ? 0 : parseFloat(arrears);

        sum = b + c + d + e + f + g + h + i;
        document.getElementById("grossamount").value = sum;
    }
    function calcualteTotalAmount() {
        var abc = document.getElementById("grossamount").value;
        var grossValue = isNaN(parseFloat(abc)) ? 0 : parseFloat(abc);
        var cde = document.getElementById("totaldeduction").value;
        var deductionValue = isNaN(parseFloat(cde)) ? 0 : parseFloat(cde);
        var diff = grossValue - deductionValue;
        document.getElementById("netamount").value = diff;
    }
</script>


