drop database if exists db_pm;
create database db_pm;
use db_pm;

create table tbl_userrole(
    id int(11) primary key auto_increment,
    rolename varchar(30),
    active char(1) 
);

create table tbl_user(
    id int(11) primary key auto_increment,
    roleid int(11),
    fullname varchar(30),
    emailid  varchar(30),
    password  varchar(30),
    active char(1),
    foreign key (roleid) references tbl_userrole (id) 
);

create table tbl_job(
    id int(11) primary key auto_increment,
    jobtitle varchar(30),
    description text,
    maxsalary int(7),
    minsalary int(7),
    paygread varchar(10),
    active char(1) 
);


CREATE TABLE IF NOT EXISTS `tbl_addleave` (
  `txtId` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `no_count` int(10) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `added_by` varchar(30) DEFAULT NULL,
  `is_active` char(1) DEFAULT NULL,
  PRIMARY KEY (`txtId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
 
CREATE TABLE IF NOT EXISTS `tbl_applyleave` (
  `txtId` int(11) NOT NULL AUTO_INCREMENT,
  `empId` int(11) NOT NULL,
  `leave_type` varchar(40) NOT NULL,
  `availableLeave` int(50) NOT NULL,
  `leaveTaken` int(50) NOT NULL,
  `balanceLeave` int(50) NOT NULL,
  PRIMARY KEY (`txtId`),
  KEY `empId` (`empId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tbl_employee` (
  `txtId` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `fname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact` varchar(10) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `pay_scale` varchar(30) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`txtId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tbl_leavehistory` (
  `txtId` int(11) NOT NULL AUTO_INCREMENT,
  `empId` int(11) NOT NULL,
  `specialId` int(10) DEFAULT NULL,
  `leave_type` varchar(40) NOT NULL,
  `normalId` int(10) NOT NULL,
  `fromdate` date DEFAULT NULL,
  `todate` date DEFAULT NULL,
  `no_days` int(11) DEFAULT NULL,
  `approved_leave` int(50) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `place` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `restricted_leave` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `avail_ltc` varchar(20) NOT NULL,
  `ltc_details` varchar(255) NOT NULL,
  `leave_encashment` varchar(20) NOT NULL,
  `days` int(30) NOT NULL,
  `permission_hq` varchar(20) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY (`txtId`),
  KEY `empId` (`empId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
 

CREATE TABLE IF NOT EXISTS `tbl_leavesetting` (
  `txtId` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) DEFAULT NULL,
  `earned_leave` int(10) DEFAULT NULL,
  PRIMARY KEY (`txtId`),
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tbl_predefinedleave` (
  `txtId` int(11) NOT NULL AUTO_INCREMENT,
  `date_leave` date DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`txtId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `tbl_applyleave`
  ADD CONSTRAINT `tbl_applyleave_ibfk_1` FOREIGN KEY (`empId`) REFERENCES `tbl_employee` (`txtId`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tbl_leavesetting`
  ADD CONSTRAINT `tbl_leavesetting_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tbl_employee` (`txtId`) ON DELETE CASCADE ON UPDATE CASCADE;
