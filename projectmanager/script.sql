drop database if exists ppms;
create database ppms;
use ppms;


create table tbl_account(
    id int(11) primary key auto_increment,
    accountname varchar(30),
    accounttype varchar(30),
    entrydate date,
    updatedate date,
    active char(1)
);

INSERT INTO `tbl_account` VALUES 
(1,'Guest Service','Income','2030-12-17','2030-12-17','Y'),
(2,'Project Service Charge','Income','2030-12-17','2030-12-17','Y'),
(3,'Electricity Bill','Expense','2030-12-17','2030-12-17','Y'),
(4,'Product Selling','Income','2030-12-17','2030-12-17','Y'),
(5,'Product Buying','Expense','2030-12-17','2030-12-17','Y'),
(6,'Employee Salary','Expense','2030-12-17','2030-12-17','Y');

create table tbl_transaction(
    id int(11) primary key auto_increment,
    accountname varchar(30),
    accounttype varchar(30),
    amount double(8,2),
    description varchar(300),
    payment double(8,2),
    entrydate date,
    updatedate date,
    active char(1)
);

create table tbl_position(
    id int(11) primary key auto_increment,
    positionname varchar(30),
    description varchar(300),
    entrydate date,
    updatedate date,
    active char(1)
);
INSERT INTO `tbl_position` VALUES (1,'Programmer','Programmer','2030-12-17','2030-12-17','Y'),
(2,'SEO','Manage','2030-12-17','2030-12-17','Y'),
(3,'Chief Executive Officer','Chief Executive Officer - office','2030-12-17','2030-12-17','Y'),
(4,'HR Admin','HR Admin','2030-12-17','2030-12-17','Y'),
(5,'Lead Programmer','Lead Programmer','2030-12-17','2030-12-17','Y'),
(6,'Junior Software Developer','Junior Software Developer','2030-12-17','2030-12-17','Y');

create table tbl_employee(
    id int(11) primary key auto_increment,
    empId varchar(30),
    firstname varchar(30),
    middlename varchar(30),
    lastname varchar(30),
    emailid varchar(60),
    password varchar(60),
    contactnumber varchar(30),
    altercontact varchar(30),
    currentaddress text,
    permenentaddress text,
    image text,
    jobtitle varchar(200),
    entrydate date,
    updatedate date,
    active char(1)
);
INSERT INTO `tbl_employee` VALUES (1,'005','Pravin','Prabhakar','Tumsare','pravintumsare@gmail.com','^c#lBKk@','7416363492','7416363492','lodha','shantinagar','','Junior Software Developer','2018-01-02','2018-01-02','Y');

create table tbl_employeeeducation(
    id int(11) primary key auto_increment,
    empId int(11),
    degreeName varchar(30),
    university varchar(300),
    percent varchar(5),
    passingyear varchar(5),
    entrydate date,
    updatedate date,
    active char(1)
);

create table tbl_employeework(
    id int(11) primary key auto_increment,
    empId int(11),
    comanyname varchar(30),
    workingperiod varchar(300),
    jobtitle varchar(5),
    fromdate date,
    todate date,
    entrydate date,
    updatedate date,
    active char(1)
);


create table tbl_holiday(
    id int(11) primary key auto_increment,
    holidayname  varchar(100),
    fromdate  date,
    todate  date,
    noofday  int(3),
    entrydate date,
    updatedate date,
    active char(1)
);

INSERT INTO `tbl_holiday` VALUES 
(1,'Republic Day','2018-01-26','2018-01-26',1,'2017-12-30','2017-12-30','Y'),
(2,'Independence Day','2018-08-15','2018-08-15',1,'2017-12-30','2017-12-30','Y'),
(3,'Christmas Celebration','2017-12-25','2017-12-25',1,'2017-12-30','2017-12-30','Y');


create table tbl_leave(
    id int(11) primary key auto_increment,
    leavename  varchar(100),
    description varchar(300),
    unit  int(3),
    entrydate date,
    updatedate date,
    active char(1)
);
INSERT INTO `tbl_leave` VALUES 
(1,'Earned leave','Earned leave',5,'2017-12-30','2017-12-30','Y'),
(2,'Sick leave','Sick leave',4,'2017-12-30','2017-12-30','Y'),
(3,'Casual leave','Casual leave',1,'2017-12-30','2017-12-30','Y'),
(4,'Leave without pay (LWP)','Leave without pay (LWP)',1,'2017-12-30','2017-12-30','Y'),
(5,'Maternity leave (ML)','Maternity leave (ML)',30,'2017-12-30','2017-12-30','Y'),
(6,'Paternity leave','Paternity leave',7,'2017-12-30','2017-12-30','Y'),
(7,'Compensatory Off','Compensatory Off',2,'2017-12-30','2017-12-30','Y');


create table tbl_project(
    id int(11) primary key auto_increment,
    projectid  varchar(100),
    projectcode  varchar(100),
    projectname  varchar(100),
    description varchar(300),
    fromdate date,
    todate date,
    perdaywork  int(3),
    totalhrwork  int(3),
    entrydate date,
    updatedate date,
    active char(1)
);


create table tbl_attendance(
    id int(11) primary key auto_increment,
    empid  int(11),
    empname  varchar(100),
    intime timestamp,
    outtime timestamp,
    entrydate date,
    updatedate date,
    active char(1)
);

DROP TABLE IF EXISTS `tbl_salary`;
CREATE TABLE IF NOT EXISTS `tbl_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employeeid` int(11) DEFAULT NULL,
  `basic` double(6,2) DEFAULT NULL,
  `hra` double(6,2) DEFAULT NULL,
  `transportallowance` double(6,2) DEFAULT NULL,
  `medicalallowance` double(6,2) DEFAULT NULL,
  `otherallowance` double(6,2) DEFAULT NULL,
  `onsiteallowance` double(6,2) DEFAULT NULL,
  `incentive` double(6,2) DEFAULT NULL,
  `arrears` double(6,2) DEFAULT NULL,
  `pfempl` double(6,2) DEFAULT NULL,
  `pfemplr` double(6,2) DEFAULT NULL,
  `professionaltax` double(6,2) DEFAULT NULL,
  `incometax` double(6,2) DEFAULT NULL,
  `advances` double(6,2) DEFAULT NULL,
  `mealvouchers` double(6,2) DEFAULT NULL,
  `giftvouchers` double(6,2) DEFAULT NULL,
  `grossamount` double(6,2) DEFAULT NULL,
  `totaldeduction` double(6,2) DEFAULT NULL,
  `netamount` double(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `ppms`.`tbl_employee_education` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `empid` INT(11) NULL,
  `empname` VARCHAR(100) NULL,
  `institutename` VARCHAR(255) NULL,
  `universityname` VARCHAR(100) NULL,
  `qualification` VARCHAR(100) NULL,
  `fromdate` DATE NULL,
  `todate` DATE NULL,
  `percentage` DOUBLE(6,2) NULL,
  `examseatno` VARCHAR(45) NULL,
  `entrydate` DATE NULL,
  `update` DATE NULL,
  `active` CHAR(1) NULL,
  `new_tablecol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `ppms`.`tbl_employee_workinfo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `empid` INT(11) NULL,
  `empname` VARCHAR(100) NULL,
  `cmpname` VARCHAR(100) NULL,
  `cmpaddress` VARCHAR(255) NULL,
  `fromdate` DATE NULL,
  `todate` DATE NULL,
  `experience` DOUBLE(6,2) NULL,
  `lastsalary` DOUBLE(6,2) NULL,
  `lastposition` VARCHAR(100) NULL,
  `leavingreason` VARCHAR(255) NULL,
  `contactnumber` VARCHAR(50) NULL,
  `supervisorname` VARCHAR(100) NULL,
  `emailid` VARCHAR(50) NULL,
  `entrydate` DATE NULL,
  `update` DATE NULL,
  `active` CHAR(1) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `ppms`.`tbl_employee_personalinfo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `empid` INT(11) NULL,
  `empname` VARCHAR(100) NULL,
  `personname` VARCHAR(100) NULL,
  `relationship` VARCHAR(50) NULL,
  `age` INT(11) NULL,
  `occupation` VARCHAR(50) NULL,
  `entrydate` DATE NULL,
  `updatedate` DATE NULL,
  `active` CHAR(1) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE IF NOT EXISTS `tbl_recruitment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) DEFAULT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `emailid` varchar(60) DEFAULT NULL,
  `contactnumber` varchar(30) DEFAULT NULL,
  `altercontact` varchar(30) DEFAULT NULL,
  `currentaddress` text,
  `permenentaddress` text,
  `resume` text,
  `jobtitle` varchar(200) DEFAULT NULL,
  `totalexperience` double(6,2) DEFAULT NULL,
  `noticeperiod` double DEFAULT NULL,
  `currentctc` double(6,2) DEFAULT NULL,
  `expectedctc` double(6,2) DEFAULT NULL,
  `isselected` char(1) DEFAULT NULL,
  `entrydate` date DEFAULT NULL,
  `updatedate` date DEFAULT NULL,
  `active` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


create table tbl_document(
    id int(11) primary key auto_increment,
    documentTitle varchar(500),
    filepath text,
    description text,
    active char(1)
);



create table tbl_employee_project(
    id int(11) primary key auto_increment,
    employeeId int(11),
    projectId int(11)
);
