<div id="main-menu-inner">
    <div class="menu-content top" id="menu-content-demo">
        <div>
            <div class="text-bg" style="padding-left: 0px;">
                <span class="text-slim">Welcome </span> 
                <span class="text-semibold"><?php echo $_SESSION["logindetails"][0]["firstname"]; ?></span>
            </div>
        </div>
    </div>
    <ul class="navigation">
        <li><a href="mainpage.php"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a></li>

        <li class="mm-dropdown">
            <a href="#"><i class="menu-icon fa fa-users"></i><span class="mm-text">Attendance</span></a>
            <ul>
                <li><a tabindex="-1" href="mainpage.php?pagename=view_attendance"><span class="mm-text">Manage Attendance</span></a></li>
            </ul>
        </li>

        <li class="mm-dropdown">
            <a href="#"><i class="menu-icon fa fa-user"></i><span class="mm-text">Employee</span></a>
            <ul>
                <li><a tabindex="-1" href="mainpage.php?pagename=view_employee_education"><span class="mm-text">Educational Information</span></a></li>
                <li><a tabindex="-1" href="mainpage.php?pagename=work_employee"><span class="mm-text">Working Experience</span></a></li>
                <li><a tabindex="-1" href="mainpage.php?pagename=personalinfo_employee"><span class="mm-text">Personal Info</span></a></li>
                <li><a tabindex="-1" href="mainpage.php?pagename=view_employee"><span class="mm-text">View Profile</span></a></li>
            </ul>
        </li>

        <li class="mm-dropdown">
            <a href="#"><i class="menu-icon fa fa-dollar"></i><span class="mm-text">Salary</span></a>
            <ul>
                <li><a tabindex="-1" href="mainpage.php?pagename=view_salary"><span class="mm-text">View Salary</span></a></li>
            </ul>
        </li>

        <li class="mm-dropdown">
            <a href="#"><i class="menu-icon fa fa-plane"></i><span class="mm-text">Leave</span></a>
            <ul>
                <li><a tabindex="-1" href="mainpage.php?pagename=view_leave"><span class="mm-text">View Leave</span></a></li>
                <li><a tabindex="-1" href="mainpage.php?pagename=viewholiday_leave"><span class="mm-text">View Holidy</span></a></li>
                <li><a tabindex="-1" href="mainpage.php?pagename=createapplication_leave"><span class="mm-text">Leave Application</span></a></li>
            </ul>
        </li>

        <li class="mm-dropdown">
            <a href="#"><i class="menu-icon fa fa-calendar"></i><span class="mm-text">Timesheet</span></a>
            <ul>
                <li><a tabindex="-1" href="mainpage.php?pagename=add_timesheet"><span class="mm-text">Update Timesheet</span></a></li>
                <li><a tabindex="-1" href="mainpage.php?pagename=view_timesheet"><span class="mm-text">View Timesheet</span></a></li>
            </ul>
        </li>
    </ul>
</div>