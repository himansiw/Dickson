DROP TABLE IF EXISTS attendance;

CREATE TABLE `attendance` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_no` varchar(30) NOT NULL,
  `emp_name` varchar(40) NOT NULL,
  `att_date` date NOT NULL,
  `att_intime` time NOT NULL,
  `att_outtime` time NOT NULL,
  `att_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO attendance VALUES("1","EMP-001","Ayesha Gunawarhana","2020-11-06","01:00:07","00:00:00","1"),
("2","EMP-002","Josep Perara","2020-11-06","00:00:07","00:00:00","1"),
("3","EMP-003","Ben Cruso","2020-11-06","00:00:07","00:00:00","1"),
("4","EMP-004","Sujeewa Siriwardana","2020-11-06","00:00:07","00:00:00","1"),
("5","EMP-005","Sahan Layanal","2020-11-06","00:00:07","00:00:00","1"),
("6","EMP-006","Gayan Kaluthota","2020-11-06","00:00:07","00:00:00","1");



DROP TABLE IF EXISTS backup;

CREATE TABLE `backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_date` date NOT NULL,
  `backup_time` time NOT NULL,
  `reference` varchar(200) NOT NULL,
  `backup_name` varchar(200) NOT NULL,
  `backup_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO backup VALUES("1","2021-04-28","11:02:49","C:/xampp/htdocs/dicksons/backup/db-backup-Wed Apr 28 23-02-49 +0530 2021-86f3a35663896db0ddcf1d567f8dc024b74f97c0.sql","../backup/db-backup-Wed Apr 28 23-02-49 +0530 2021-86f3a35663896db0ddcf1d567f8dc024b74f97c0.sql","1");



DROP TABLE IF EXISTS brand;

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(30) NOT NULL,
  `brand_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO brand VALUES("1","No brand","1"),
("2","Maliban","1"),
("3","Munchee","1"),
("4","Motha","1"),
("5","Prima ","1"),
("6","Raigam ","1"),
("7","Harischandra","1"),
("8","Maggi","1"),
("9","San Remo ","1"),
("10","Jacker","1"),
("11","Uswatte","1"),
("12","Royal Hot","1"),
("13","Sugar & spice","1");



DROP TABLE IF EXISTS card_type;

CREATE TABLE `card_type` (
  `card_tid` int(11) NOT NULL AUTO_INCREMENT,
  `card_method` varchar(30) NOT NULL,
  PRIMARY KEY (`card_tid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO card_type VALUES("1","Visa"),
("2","MasterCard");



DROP TABLE IF EXISTS category;

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_code` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("1","Vegetable","12345","1"),
("2","Fruit","78345","1"),
("3","Grocery","63412","1");



DROP TABLE IF EXISTS customer;

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_no` varchar(30) NOT NULL,
  `cus_fname` varchar(50) NOT NULL,
  `cus_lname` varchar(50) NOT NULL,
  `cus_mob` varchar(20) NOT NULL,
  `cus_email` varchar(60) NOT NULL,
  `cus_nic` varchar(28) NOT NULL,
  `cus_house_no` varchar(25) NOT NULL,
  `cus_street` varchar(30) NOT NULL,
  `cus_city` varchar(30) NOT NULL,
  `loyalty_point` double(10,2) NOT NULL,
  `cus_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO customer VALUES("1","DFC0001","Kalpana","Gunawardhana","+94773745678","kapila@gmail.com","890765342V","234/7c","gannamulla","Galle","79.20","1"),
("2","DFC0002","Kumara","Alvis","+94712209876","kumara@gmail.com","806712345V","98/7","Wakwalla","Galle","106.38","1");



DROP TABLE IF EXISTS department;

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `department_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO department VALUES("1","Fresh Produce","Fresh vegetables and fruit","1"),
("2","Frozen foods","Cool food","1"),
("3","Grocery","canned & boxed non-refrigerated items","1"),
("4","Homeware","Home items","1"),
("5","Dali","can be just sliced meats and cheeses ","1"),
("6","Meat","","1"),
("7","Dairy","milk, eggs, yogurt","1"),
("8","Health and Beauty","everything from vitamins to makeup","1");



DROP TABLE IF EXISTS employee;

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_no` varchar(30) NOT NULL,
  `employee_fname` varchar(50) NOT NULL,
  `employee_lname` varchar(50) NOT NULL,
  `employee_email` varchar(80) NOT NULL,
  `employee_nic` varchar(12) NOT NULL,
  `employee_dob` date NOT NULL,
  `employee_gender` int(11) NOT NULL,
  `employee_con` varchar(20) NOT NULL,
  `employee_mob` varchar(20) NOT NULL,
  `employee_role` int(11) NOT NULL,
  `employee_house_no` varchar(20) NOT NULL,
  `employee_street` varchar(40) NOT NULL,
  `employee_city` varchar(40) NOT NULL,
  `employee_account_no` varchar(50) NOT NULL,
  `employee_account_name` varchar(50) NOT NULL,
  `employee_bank_name` varchar(50) NOT NULL,
  `employee_account_branch` varchar(50) NOT NULL,
  `employee_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO employee VALUES("1","EMP-001","Ayesha","Gunawaradana","hansi3914@gmail.co","967854391V","1996-01-13","1","+94912277786","+94715677786","2","39/5C","Wakunugoda","Galle","4125369782","Ayesha Gunawarhana","Commercial","Pannipitiya","1"),
("2","EMP-002","Josep","Perara","josep@gmail.com","958494201V","1995-05-20","0","+94912266659","+94783748886","5","230/5","Kaleganna","Galle","890253697","Josep Perara","Commercial","Galle","1"),
("3","EMP-003","Ben","Cruso","ben@gmail.com","942311567V","1994-10-16","0","+94913355678","+94723749776","2","56/8V","aluth para","Galle","1284909782","Ben Cruso","HNB","Galle","1"),
("4","EMP-004","Sujeewa","Siriwardhana","suj123@gmail.com","986654801V","1988-06-10","0","+94112257658","+94723749776","5","267/A","Ganemulla","Hikaduwwa","345672156","Sujeewa Siriwardhana","LOC","Galle","1"),
("5","EMP-005","Sanhan","Layanal","sahan@gmail.com","890753124V","1989-09-12","0","+94912245694","+94772380714","3","34/8","Kahatagasdeniya","Galle","784257952","Sahan Layanal","HNB","Galle","1"),
("6","EMP-006","Gayan","Kaluthota","gayan12@gmail.com","960964391V","1996-03-30","0","+942245631","+94717563290","6","23/6N","Kubalwella","Galle","678561234","Gayan Kaluthota","Commercial","Galle","1");



DROP TABLE IF EXISTS employee_role;

CREATE TABLE `employee_role` (
  `empr_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_role` varchar(40) NOT NULL,
  PRIMARY KEY (`empr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO employee_role VALUES("1","Owner"),
("2","Supervisor"),
("3","Cashier"),
("4","Purchasing manager"),
("5","Stock keeper"),
("6","Helper");



DROP TABLE IF EXISTS expire;

CREATE TABLE `expire` (
  `expire_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `eqty` double(10,3) NOT NULL,
  `date_expired` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `st_id` int(11) NOT NULL,
  `e_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`expire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO expire VALUES("1","13","8.000","2021-04-10","2021-03-29 09:23:44","0","1"),
("2","13","8.000","2021-04-10","2021-03-29 09:27:04","0","1"),
("3","4","1.000","2021-04-30","2021-04-17 18:19:47","39","1"),
("4","7","2.000","2021-04-28","2021-04-20 07:52:16","38","1"),
("5","1","2.960","2021-05-03","2021-04-20 08:35:48","34","1"),
("6","2","2.000","2021-05-05","2021-05-02 07:06:05","6","1");



DROP TABLE IF EXISTS function;

CREATE TABLE `function` (
  `function_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_name` varchar(30) NOT NULL,
  `module_id` int(11) NOT NULL,
  `function_status` int(11) DEFAULT '1',
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO function VALUES("1","Add User","1","1"),
("2","Update User","1","1"),
("3","Active User","1","1"),
("4","Add Update Product","2","1"),
("5","Delete Product","2","1"),
("6","View Product","2","1"),
("7","Add Update Brands","2","1"),
("8","View Brands","2","1"),
("9","Delete Brands","2","1"),
("10","Add Requisition Notes","3","1"),
("11","View Requisition Notes","3","1"),
("12","Cancel Requisitions","3","1"),
("13","Manage Purchase Order","3","1"),
("14","Add Update Supplier","3","1"),
("15","View Supplier","3","1"),
("16","Delete Supplier","3","1"),
("17","Add Update Stock","5","1"),
("18","Add Update GRN","5","1"),
("19","Manage Record Levels","5","1"),
("20","Generate Report","8","1"),
("21","Update Report","8","1"),
("22","Add Customer","9","1"),
("23","Update Customer","9","1"),
("24","Black List Customer","9","1"),
("25","Active Customer","9","1"),
("26","View Customer Performance","1","1"),
("27","Update Customer Performance","1","1");



DROP TABLE IF EXISTS function_user;

CREATE TABLE `function_user` (
  `user_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO function_user VALUES("1","1"),
("1","2"),
("1","3"),
("1","4"),
("1","5"),
("1","6"),
("1","7"),
("1","8"),
("1","9"),
("1","10"),
("1","11"),
("1","12"),
("1","13"),
("1","14"),
("1","15"),
("1","16"),
("1","17"),
("1","18"),
("1","19"),
("1","20"),
("1","21"),
("1","22"),
("1","23"),
("1","24"),
("1","25"),
("1","26"),
("1","27"),
("2","4"),
("2","5"),
("2","6"),
("2","7"),
("2","8"),
("2","9"),
("2","10"),
("2","11"),
("2","12"),
("2","13"),
("2","14"),
("2","15"),
("2","16"),
("2","22"),
("2","23"),
("2","24"),
("2","25"),
("3","10"),
("3","11"),
("3","12"),
("3","13"),
("3","14"),
("3","15"),
("3","16"),
("3","17"),
("3","18"),
("3","19"),
("4","10"),
("4","11"),
("4","12"),
("4","13"),
("4","14"),
("4","15"),
("4","16"),
("4","17"),
("4","18"),
("4","19"),
("4","22"),
("4","23"),
("4","24"),
("4","25"),
("5","17"),
("5","18"),
("5","19"),
("5","22"),
("5","23"),
("5","24"),
("5","25"),
("6","4"),
("6","5"),
("6","6"),
("6","7"),
("6","8"),
("6","9"),
("6","10"),
("6","11"),
("6","12"),
("6","13"),
("6","14"),
("6","15"),
("6","16"),
("6","17"),
("6","18"),
("6","19"),
("6","20"),
("6","21"),
("7","4"),
("7","5"),
("7","6"),
("7","7"),
("7","8"),
("7","9"),
("7","10"),
("7","11"),
("7","12"),
("7","13"),
("7","14"),
("7","15"),
("7","16"),
("7","20"),
("7","21"),
("7","22"),
("7","23"),
("7","24"),
("7","25"),
("8","22"),
("8","23"),
("8","24"),
("8","25"),
("9","4"),
("9","5"),
("9","6"),
("9","7"),
("9","8"),
("9","9"),
("9","10"),
("9","11"),
("9","12"),
("9","13"),
("9","14"),
("9","15"),
("9","16"),
("9","22"),
("9","23"),
("9","24"),
("9","25"),
("10","20"),
("10","21");



DROP TABLE IF EXISTS login;

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_username` varchar(80) NOT NULL,
  `login_password` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_status` int(11) NOT NULL,
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `login_username` (`login_username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("1","dickson@gmail.lk","40BD001563085FC35165329EA1FF5C5ECBDBBEEF","1","1"),
("2","ayesha@gmail.com","325b890a600d8d9967ce3699f73a69a5b2651f2c","2","1"),
("3","josep@gmail.com","6acf7bd1535cd8fe34bd277eb37b041751e6f80b","3","1"),
("4","ben@gmail.com","2e738b4329595bbcef0d843f5cf9ad9cd83ac4b3","4","1"),
("5","suj123@gmail.com","c82149d763e7a9695f2ba392cf60eef74f6fb098","5","1"),
("6","himansiw@gmail.lk","896187c1269866cadfba99e99b743e5352202a8d","6","1");



DROP TABLE IF EXISTS low;

CREATE TABLE `low` (
  `low_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `lqty` double(10,3) NOT NULL,
  `mqty` double(10,3) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `st_id` int(11) NOT NULL,
  `l_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`low_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO low VALUES("1","2","2.000","2.000","2021-05-02 08:45:28","6","1");



DROP TABLE IF EXISTS loyalty_detail;

CREATE TABLE `loyalty_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_cardno` varchar(30) NOT NULL DEFAULT 'DCF0000',
  `apoint` double(10,2) NOT NULL,
  `c_point` double(10,2) NOT NULL,
  `point_use` varchar(30) NOT NULL DEFAULT '0',
  `r_point` double(10,2) NOT NULL,
  `r_value` double(10,2) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `scus_id` varchar(30) NOT NULL,
  `invoice_no` varchar(40) NOT NULL,
  `detai_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`detail_id`),
  KEY `loyalty_detail_ibfk_1` (`cus_id`),
  CONSTRAINT `loyalty_detail_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

INSERT INTO loyalty_detail VALUES("1","DFC0002","27.70","22.70","yes","0.00","0.00","2"," Kumara Alvis ","INV-0006","1"),
("2","DFC0001","5.00","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0007","1"),
("3","DFC0001","5.00","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0013","1"),
("4","DFC0001","5.00","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0013","1"),
("5","DFC0001","5.00","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0013","1"),
("6","DFC0001","5.00","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0014","1"),
("7","DFC0001","5.00","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0015","1"),
("8","DFC0001","30.48","12.74","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0016","1"),
("9","DFC0002","118.20","12.50","yes","20.00","20.00","2"," Kumara Alvis ","INV-0017","1"),
("10","DFC0001","36.84","6.37","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0018","1"),
("11","DFC0002","118.20","0.00","","0.00","0.00","2"," Kumara Alvis ","INV-0019","1"),
("12","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0020","1"),
("13","DFC0002","118.20","0.00","","0.00","0.00","2"," Kumara Alvis ","INV-0021","1"),
("14","DFC0002","118.20","0.00","","0.00","0.00","2"," Kumara Alvis ","INV-0022","1"),
("15","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0023","1"),
("16","DFC0002","118.20","0.00","","0.00","0.00","2"," Kumara Alvis ","INV-0024","1"),
("17","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0025","1"),
("22","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0026","1"),
("23","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0026","1"),
("24","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0026","1"),
("25","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0027","1"),
("26","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0027","1"),
("27","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0028","1"),
("28","DFC0001","36.84","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0029","1"),
("31","DFC0001","47.01","10.16","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0031","1"),
("33","DFC0001","50.81","3.80","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0033","1"),
("34","DFC0001","63.31","12.50","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0034","1"),
("35","DFC0001","63.31","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0035","1"),
("36","DFC0001","63.31","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0036","1"),
("37","DFC0001","63.31","0.00","","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0037","1"),
("39","DFC0001","76.05","12.74","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0039","1"),
("42","DFC0002","106.38","10.16","yes","20.00","20.00","2"," Kumara Alvis ","INV-0042","1"),
("43","DFC0001","79.20","3.15","yes","0.00","0.00","1"," Kalpana Gunawardhana ","INV-0043","1");



DROP TABLE IF EXISTS module;

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(30) NOT NULL,
  `module_status` int(11) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO module VALUES("1","User Management","1"),
("2","Product Master","1"),
("3","Purchase","1"),
("4","Sales & Billing","1"),
("5","Inventory & Stock","1"),
("6"," Employee Management","1"),
("7","Security & Backup","1"),
("8","Report","1"),
("9","Customer & Loyalty","1");



DROP TABLE IF EXISTS module_role;

CREATE TABLE `module_role` (
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`module_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO module_role VALUES("1","1"),
("2","1"),
("2","2"),
("3","1"),
("3","2"),
("3","4"),
("4","1"),
("4","3"),
("5","1"),
("5","5"),
("6","1"),
("6","2"),
("7","1"),
("8","1"),
("8","2"),
("9","1"),
("9","3");



DROP TABLE IF EXISTS notification;

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO notification VALUES("1","A New User Himansi  was added!!!","1","1"),
("2","A New User Himansi  was added!!!","1","1"),
("3","A New User Himansi  was added!!!","1","1");



DROP TABLE IF EXISTS notification_user;

CREATE TABLE `notification_user` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`notification_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO notification_user VALUES("3","1","1");



DROP TABLE IF EXISTS pay_type;

CREATE TABLE `pay_type` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_status` varchar(30) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO pay_type VALUES("1","Due"),
("2","Paid");



DROP TABLE IF EXISTS payment_method;

CREATE TABLE `payment_method` (
  `payment_mid` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(30) NOT NULL,
  `payment_mstatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payment_mid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO payment_method VALUES("1","Cash","1"),
("2","Card","1"),
("3","Cheque","1");



DROP TABLE IF EXISTS product;

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcode` varchar(30) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `pbarcode` varchar(30) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `product_image` text NOT NULL,
  `ppurchase_price` double(10,2) NOT NULL,
  `pdis` int(11) NOT NULL,
  `reqty` double(10,3) NOT NULL,
  `product_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO product VALUES("1","DS0001","Brinjals 1Kg","1","1","1","1","1001","1","brinjals.jpg","637.50","1","3.000","1"),
("2","DS0002","Green Beans 1Kg","1","1","1","2","1002","1","1597728366_organic green beans.jpg","399.00","0","3.000","1"),
("3","DS0003","Dambala 1Kg","1","1","1","2","1003","1","1597906934_dambala.jpg","315.00","0","3.000","1"),
("4","DS0004","Long Beans 1Kg","1","1","1","2","1004","1","1597912651_long_beans.jpg","397.80","0","3.000","1"),
("5","DS0005","Green Chilies 1Kg","1","1","1","3","1005","1","1597913580_green_chilies.jpg","690.00","0","3.500","1"),
("6","DS0006","Green Cucumber 1Kg","1","1","1","4","1006","1","1598193969_green_cucumber.jpg","210.00","0","2.000","1"),
("7","DS0007"," Cucumber 1Kg","1","1","1","4","1007","1","cucumber.jpg","190.00","0","3.000","1"),
("8","DS0008","Bitter Gourd 1Kg","1","1","1","5","1008","1","1598506159_bitter_gourd.jpg","510.00","0","2.000","1"),
("9","DS0009","Curry Leaves 1Kg","1","1","1","6","1009","1","1598518804_curry_leaves.jpg","150.00","0","1.000","1"),
("10","DS0010","Red Onions 1Kg","1","1","1","7","1010","1","1598518883_red_onion.jpg","160.00","0","5.000","1"),
("11","DS0011","Garlic 1Kg","1","1","1","7","1011","1","1598519316_garlic.jpg","450.00","0","5.000","1"),
("12","DS0012","Apple - Red Royal Gala 1Kg","1","1","2","9","1012","1","1598974887_apple-redroyalgala.jpg","630.00","10","3.000","1"),
("13","DS0013","Grapes - Red 1Kg","1","1","2","9","1013","1","1599481464_grapes.jpg","1554.00","0","3.000","1"),
("14","DS0014","Orange 1Kg","1","1","2","9","1014","1","1599587664_orange.jpg","560.00","0","3.000","1"),
("15","DS0015","Melon - Dark Bell 1Kg","1","1","2","10","1015","1","1603980172_melon-dark.jpg","90.00","0","2.000","1"),
("16","DS0016","Mango - Vilad 1Kg","1","1","2","10","1016","1","1603980998_mango - vilad.jpg","280.00","0","2.000","1"),
("17","DS0017","Banana - Kolikuttu 1Kg","1","1","1","10","1017","1","1603981226_banana - kolikuttu.jpg","244.80","2","5.000","1"),
("18","DS0018","Mango","1","1","2","9","1018","1","1612171466_icon.png","0.00","0","2.000","1");



DROP TABLE IF EXISTS product_location;

CREATE TABLE `product_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `rack_no` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `position` varchar(30) NOT NULL,
  `location_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO product_location VALUES("1","0","1","Medium","1"),
("2","0","2","Bottom","1"),
("3","0","3","Medium","1"),
("4","2","5","Top","1"),
("5","1","4","Bottom","1"),
("6","1","6","Top","1");



DROP TABLE IF EXISTS purchase;

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseref_no` varchar(50) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `pusup_id` varchar(40) NOT NULL,
  `supplier_email` varchar(30) NOT NULL,
  `purchase_date` datetime NOT NULL,
  `message` varchar(200) NOT NULL,
  `ptotal` double(10,2) NOT NULL,
  `purchase_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO purchase VALUES("1","REF-001","1"," Pushpa Gunawardhana ","hansi3914@gmail.com","2021-04-25 09:55:24","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","2685.60","0"),
("2","REF-001","0"," Pushpa Gunawardhana ","hansi3914@gmail.com","2021-04-27 08:51:10","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","3945.60","1"),
("3","REF-001","0"," Pushpa Gunawardhana ","hansi3914@gmail.com","2021-04-27 08:51:10","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","3945.60","1"),
("4","REF-001","0"," Pushpa Gunawardhana ","hansi3914@gmail.com","2021-04-27 08:51:10","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","3945.60","1"),
("5","REF-001","0"," Pushpa Gunawardhana ","hansi3914@gmail.com","2021-05-02 08:51:10","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","3945.60","1");



DROP TABLE IF EXISTS purchase_item;

CREATE TABLE `purchase_item` (
  `purchaseitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `purproduct_id` varchar(40) NOT NULL,
  `pqty` double(10,3) NOT NULL,
  `purchaseorder_price` double(10,2) NOT NULL,
  `ppurchase_price_amount` double(10,2) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  PRIMARY KEY (`purchaseitem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO purchase_item VALUES("1","Apple - Red Royal Gala 1Kg ","3.000","630.00","1890.00","1"),
("2","Long Beans 1Kg ","2.000","397.80","795.60","1"),
("3","Apple - Red Royal Gala 1Kg ","3.000","630.00","1890.00","2"),
("4","Long Beans 1Kg ","2.000","397.80","795.60","2"),
("5","Apple - Red Royal Gala 1Kg ","2.000","630.00","1260.00","2"),
("6","Apple - Red Royal Gala 1Kg ","3.000","630.00","1890.00","3"),
("7","Long Beans 1Kg ","2.000","397.80","795.60","3"),
("8","Apple - Red Royal Gala 1Kg ","2.000","630.00","1260.00","3"),
("9","Apple - Red Royal Gala 1Kg ","3.000","630.00","1890.00","4"),
("10","Long Beans 1Kg ","2.000","397.80","795.60","4"),
("11","Apple - Red Royal Gala 1Kg ","2.000","630.00","1260.00","4"),
("12","Apple - Red Royal Gala 1Kg ","3.000","630.00","1890.00","5"),
("13","Long Beans 1Kg ","2.000","397.80","795.60","5"),
("14","Apple - Red Royal Gala 1Kg ","2.000","630.00","1260.00","5");



DROP TABLE IF EXISTS receive;

CREATE TABLE `receive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(50) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `stock_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` double(10,2) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `rstatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO receive VALUES("1","REF0001","1","2021-04-22 09:46:33","3940.00","2","1"),
("2","REF0003","1","2021-04-25 08:23:01","1530.00","2","0"),
("3","REF0004","2","2021-04-27 06:51:46","200.00","1","0");



DROP TABLE IF EXISTS receive_item;

CREATE TABLE `receive_item` (
  `receive_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `rproduct_id` varchar(40) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rqty` double(10,3) NOT NULL,
  `rpurchase_price` double(10,2) NOT NULL,
  `purchase_price_amount` double(10,2) NOT NULL,
  `rdis` int(11) NOT NULL,
  `regullar_price` double(10,2) NOT NULL,
  `rm_date` date NOT NULL,
  `rexp_date` date NOT NULL,
  `id` int(11) NOT NULL,
  `r_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`receive_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO receive_item VALUES("1","Apple - Red Royal Gala 1Kg ","1","4.000","625.00","1440.00","2","637.50","2020-12-26","2021-01-09","1","1"),
("2","Banana - Kolikuttu 1Kg ","7","6.000","240.00","1440.00","2","244.80","2020-12-26","2021-01-09","1","1"),
("3","Apple - Red Royal Gala 1Kg ","1","2.000","360.00","810.00","2","367.20","2021-04-25","2021-04-29","2","1"),
("4","Apple - Red Royal Gala 1Kg ","2","3.000","270.00","810.00","3","278.10","2021-04-07","2021-03-31","2","1"),
("5","Apple - Red Royal Gala 1Kg ","1","2.000","100.00","200.00","2","102.00","2021-04-27","2021-05-05","3","1");



DROP TABLE IF EXISTS receive_payment;

CREATE TABLE `receive_payment` (
  `rpay_id` int(11) NOT NULL AUTO_INCREMENT,
  `gtotal` double(10,2) NOT NULL,
  `rpaid` double(10,2) NOT NULL,
  `rdue` double(10,2) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `payment_mid` int(11) NOT NULL,
  `card_tid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`rpay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO receive_payment VALUES("1","3940.00","3940.00","0.00","2","1","0","1"),
("2","1530.00","1530.00","0.00","2","1","0","2"),
("3","200.00","100.00","100.00","1","2","1","3");



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  `role_status` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO role VALUES("1","Administrator","1"),
("2","Supervisor","1"),
("3","Cashier","1"),
("4","Purchasing Manager","1"),
("5","Stock keeper","1");



DROP TABLE IF EXISTS sale;

CREATE TABLE `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(80) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `scus_id` varchar(80) NOT NULL,
  `sales_sdate` datetime NOT NULL,
  `stotal` double(10,2) NOT NULL,
  `distotal` double(10,2) NOT NULL,
  `netotal` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `due` double(10,2) NOT NULL,
  `sales_fdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sale_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

INSERT INTO sale VALUES("1","INV-0001","1"," Kalpana Gunawardhana ","2021-03-10 11:14:56","2510.00","0.00","2510.00","0.00","0.00","2021-04-26 16:20:06","1"),
("2","INV-0002","0"," Walking Customer ","2021-04-21 11:16:19","1250.00","0.00","1250.00","2000.00","750.00","2021-04-26 15:19:46","1"),
("3","INV-0003","2"," Kumara Alvis ","2021-04-23 12:08:01","1250.00","0.00","1250.00","0.00","0.00","2021-04-26 15:20:05","1"),
("4","INV-0004","1"," Kalpana Gunawardhana ","2021-04-26 12:09:45","1250.00","0.00","1250.00","2000.00","750.00","2021-04-26 12:10:07","1"),
("5","INV-0005","1"," Kalpana Gunawardhana ","2021-04-26 12:11:46","1250.00","0.00","1250.00","2000.00","750.00","2021-04-26 12:12:06","1"),
("6","INV-0006","2"," Kumara Alvis ","2021-04-26 12:13:05","2270.00","0.00","2270.00","5000.00","2730.00","2021-04-26 12:13:51","1"),
("7","INV-0007","1"," Kalpana Gunawardhana ","2021-04-26 12:15:49","2900.00","0.00","2900.00","5000.00","2100.00","2021-04-26 12:16:16","1"),
("8","INV-0008","2"," Kumara Alvis ","2021-04-26 12:46:07","1670.00","0.00","1670.00","2000.00","330.00","2021-04-26 12:47:53","1"),
("9","INV-0009","1"," Kalpana Gunawardhana ","2021-04-27 07:51:00","1250.00","0.00","1250.00","1000.00","-250.00","2021-04-27 19:51:37","1"),
("10","INV-0010","2"," Kumara Alvis ","2021-04-27 07:59:18","1250.00","0.00","1250.00","2000.00","750.00","2021-04-27 19:59:42","1"),
("11","INV-0011","2"," Kumara Alvis ","2021-04-27 08:01:28","1250.00","0.00","1250.00","2000.00","750.00","2021-04-27 20:01:52","1"),
("12","INV-0012","1"," Kalpana Gunawardhana ","2021-04-29 11:42:18","1274.00","0.00","1274.00","2000.00","726.00","2021-04-29 23:42:38","1"),
("13","INV-0013","1"," Kalpana Gunawardhana ","2021-04-30 10:54:06","1250.00","0.00","1250.00","2000.00","750.00","2021-04-30 10:55:12","1"),
("14","INV-0013","1"," Kalpana Gunawardhana ","2021-04-30 10:54:06","1250.00","0.00","1250.00","2000.00","750.00","2021-04-30 10:55:17","1"),
("15","INV-0013","1"," Kalpana Gunawardhana ","2021-04-30 10:54:06","1250.00","0.00","1250.00","2000.00","750.00","2021-04-30 10:55:32","1"),
("16","INV-0014","1"," Kalpana Gunawardhana ","2021-04-30 10:55:55","1274.00","0.00","1274.00","2000.00","726.00","2021-04-30 10:56:45","1"),
("17","INV-0015","1"," Kalpana Gunawardhana ","2021-04-30 11:00:04","1274.00","0.00","1274.00","1500.00","226.00","2021-04-30 11:00:30","1"),
("18","INV-0016","1"," Kalpana Gunawardhana ","2021-04-30 08:00:25","1274.00","0.00","1274.00","2000.00","726.00","2021-04-30 20:03:16","1"),
("19","INV-0017","2"," Kumara Alvis ","2021-04-30 09:13:32","1250.00","0.00","1250.00","2000.00","770.00","2021-04-30 21:16:54","1"),
("20","INV-0018","1"," Kalpana Gunawardhana ","2021-04-30 10:40:31","636.50","0.00","636.50","1000.00","363.50","2021-04-30 22:41:39","1"),
("21","INV-0019","2"," Kumara Alvis ","2021-04-30 10:43:20","2549.00","0.00","2549.00","3000.00","451.00","2021-04-30 22:45:26","1"),
("22","INV-0020","1"," Kalpana Gunawardhana ","2021-04-30 10:46:49","2549.00","0.00","2549.00","3000.00","451.00","2021-04-30 22:47:15","1"),
("23","INV-0021","2"," Kumara Alvis ","2021-04-30 10:48:24","2549.00","0.00","2549.00","3000.00","451.00","2021-04-30 22:49:02","1"),
("24","INV-0022","2"," Kumara Alvis ","2021-04-30 10:50:14","1274.00","0.00","1274.00","0.00","0.00","2021-04-30 22:50:36","1"),
("25","INV-0023","1"," Kalpana Gunawardhana ","2021-04-30 10:54:21","1250.00","0.00","1250.00","2000.00","750.00","2021-04-30 22:54:45","1"),
("26","INV-0024","2"," Kumara Alvis ","2021-04-30 11:07:38","1274.00","0.00","1274.00","2000.00","726.00","2021-04-30 23:08:10","1"),
("27","INV-0025","1"," Kalpana Gunawardhana ","2021-04-30 11:08:32","1274.00","0.00","1274.00","0.00","0.00","2021-04-30 23:12:04","1"),
("28","","0","","0000-00-00 00:00:00","0.00","0.00","0.00","0.00","0.00","2021-04-30 23:14:39","1"),
("29","","0","","0000-00-00 00:00:00","0.00","0.00","0.00","0.00","0.00","2021-04-30 23:14:42","1"),
("30","","0","","0000-00-00 00:00:00","0.00","0.00","0.00","0.00","0.00","2021-04-30 23:14:43","1"),
("31","","0","","0000-00-00 00:00:00","0.00","0.00","0.00","0.00","0.00","2021-04-30 23:14:44","1"),
("32","INV-0026","1"," Kalpana Gunawardhana ","2021-04-30 11:15:31","1274.00","0.00","1274.00","0.00","0.00","2021-04-30 23:15:50","1"),
("33","INV-0026","1"," Kalpana Gunawardhana ","2021-04-30 11:15:31","1274.00","0.00","1274.00","0.00","0.00","2021-04-30 23:15:51","1"),
("34","INV-0026","1"," Kalpana Gunawardhana ","2021-04-30 11:15:31","1274.00","0.00","1274.00","0.00","0.00","2021-04-30 23:16:21","1"),
("35","INV-0027","1"," Kalpana Gunawardhana ","2021-04-30 11:16:26","1274.00","0.00","1274.00","2000.00","726.00","2021-04-30 23:16:47","1"),
("36","INV-0027","1"," Kalpana Gunawardhana ","2021-04-30 11:16:26","1274.00","0.00","1274.00","2000.00","726.00","2021-04-30 23:16:49","1"),
("37","INV-0028","1"," Kalpana Gunawardhana ","2021-04-30 11:17:11","1911.50","0.00","1911.50","0.00","0.00","2021-04-30 23:35:37","1"),
("38","INV-0029","1"," Kalpana Gunawardhana ","2021-04-30 11:36:04","1911.50","0.00","1911.50","0.00","0.00","2021-04-30 23:36:45","1"),
("39","INV-0030","0"," Walking Customer ","2021-05-01 02:21:21","570.00","1.00","564.30","1000.00","435.70","2021-05-01 02:24:03","1"),
("40","INV-0030","0"," Walking Customer ","2021-05-01 02:21:21","570.00","1.00","564.30","1000.00","435.70","2021-05-01 02:24:24","1"),
("41","INV-0031","1"," Kalpana Gunawardhana ","2021-05-01 02:27:49","1016.50","0.00","1016.50","2000.00","983.50","2021-05-01 02:35:56","1"),
("42","INV-0032","0"," Walking Customer ","2021-05-01 02:36:38","1274.00","0.00","1274.00","2000.00","726.00","2021-05-01 02:37:29","1"),
("43","INV-0033","1"," Kalpana Gunawardhana ","2021-05-01 02:38:26","380.00","0.00","380.00","500.00","120.00","2021-05-01 02:39:51","1"),
("44","INV-0034","1"," Kalpana Gunawardhana ","2021-05-01 02:57:13","1250.00","0.00","1250.00","2000.00","750.00","2021-05-01 02:57:47","1"),
("45","INV-0035","1"," Kalpana Gunawardhana ","2021-05-01 03:05:32","1911.50","0.00","1911.50","2000.00","88.50","2021-05-01 03:11:44","1"),
("46","INV-0036","1"," Kalpana Gunawardhana ","2021-05-01 03:16:30","1911.50","0.00","1911.50","2000.00","88.50","2021-05-01 03:16:56","1"),
("47","INV-0037","1"," Kalpana Gunawardhana ","2021-05-01 03:34:38","3541.50","0.00","3541.50","4000.00","458.50","2021-05-01 03:35:27","1"),
("48","INV-0038","0"," Walking Customer ","2021-05-01 03:50:41","1250.00","0.00","1250.00","2990.00","1740.00","2021-05-01 03:51:30","1"),
("49","INV-0039","1"," Kalpana Gunawardhana ","2021-05-01 04:07:41","1274.00","0.00","1274.00","2000.00","726.00","2021-05-01 04:08:25","1"),
("50","INV-0040","0"," Walking Customer ","2021-05-01 02:27:48","636.50","0.00","636.50","1000.00","363.50","2021-05-01 14:28:57","1"),
("51","INV-0041","0"," Walking Customer ","2021-05-01 19:48:35","1016.50","0.00","1016.50","2000.00","983.50","2021-05-01 19:49:56","1"),
("53","INV-0043","1"," Kalpana Gunawardhana ","2021-05-02 20:17:01","315.00","0.00","315.00","500.00","185.00","2021-05-02 09:43:35","1"),
("54","INV-0044","0"," Walking Customer ","2021-05-02 20:59:15","826.50","0.00","826.50","1000.00","173.50","2021-05-02 10:19:42","1"),
("55","INV-0045","0"," Walking Customer ","2021-05-02 21:05:07","636.50","0.00","636.50","1000.00","363.50","2021-05-02 09:43:26","1");



DROP TABLE IF EXISTS sale_item;

CREATE TABLE `sale_item` (
  `sale_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL,
  `saleproduct_id` varchar(90) NOT NULL,
  `sqty` double(10,3) NOT NULL,
  `sdiscount` double(10,2) NOT NULL,
  `sale_rprice` double(10,2) NOT NULL,
  `subprice_amount` double(10,2) NOT NULL,
  `id` int(11) NOT NULL,
  `invoice_no` varchar(40) NOT NULL,
  `s_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sale_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

INSERT INTO sale_item VALUES("1","12","Apple - Red Royal Gala 1Kg","4.000","10.00","630.00","2510.00","1","INV-0001","1"),
("2","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","2","INV-0002","1"),
("3","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","3","INV-0003","1"),
("4","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","4","INV-0004","1"),
("5","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","5","INV-0005","1"),
("6","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","6","INV-0006","1"),
("7","8","Bitter Gourd 1Kg","2.000","0.00","510.00","1020.00","6","INV-0006","1"),
("8","12","Apple - Red Royal Gala 1Kg","3.000","10.00","630.00","1880.00","7","INV-0007","1"),
("9","8","Bitter Gourd 1Kg","2.000","0.00","510.00","1020.00","7","INV-0007","1"),
("10","6","Green Cucumber 1Kg","2.000","0.00","210.00","420.00","8","INV-0008","1"),
("11","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","9","INV-0009","1"),
("12","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","10","INV-0010","1"),
("13","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","12","INV-0012","1"),
("14","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","13","INV-0013","1"),
("15","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","14","INV-0013","1"),
("16","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","15","INV-0013","1"),
("17","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","16","INV-0014","1"),
("18","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","17","INV-0015","1"),
("19","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","18","INV-0016","1"),
("20","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","19","INV-0017","1"),
("21","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","20","INV-0018","1"),
("22","1","Brinjals 1Kg","4.000","1.00","637.50","2549.00","21","INV-0019","1"),
("23","1","Brinjals 1Kg","4.000","1.00","637.50","2549.00","22","INV-0020","1"),
("24","1","Brinjals 1Kg","4.000","1.00","637.50","2549.00","23","INV-0021","1"),
("25","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","24","INV-0022","1"),
("26","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","25","INV-0023","1"),
("27","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","26","INV-0024","1"),
("28","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","27","INV-0025","1"),
("29","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","32","INV-0026","1"),
("30","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","33","INV-0026","1"),
("31","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","34","INV-0026","1"),
("32","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","35","INV-0027","1"),
("33","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","36","INV-0027","1"),
("34","1","Brinjals 1Kg","3.000","1.00","637.50","1911.50","37","INV-0028","1"),
("35","1","Brinjals 1Kg","3.000","1.00","637.50","1911.50","38","INV-0029","1"),
("36","7"," Cucumber 1Kg","3.000","0.00","190.00","570.00","39","INV-0030","1"),
("37","7"," Cucumber 1Kg","3.000","0.00","190.00","570.00","40","INV-0030","1"),
("38","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","41","INV-0031","1"),
("39","7"," Cucumber 1Kg","2.000","0.00","190.00","380.00","41","INV-0031","1"),
("40","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","42","INV-0032","1"),
("41","7"," Cucumber 1Kg","2.000","0.00","190.00","380.00","43","INV-0033","1"),
("42","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","44","INV-0034","1"),
("43","1","Brinjals 1Kg","3.000","1.00","637.50","1911.50","45","INV-0035","1"),
("44","1","Brinjals 1Kg","3.000","1.00","637.50","1911.50","46","INV-0036","1"),
("45","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","47","INV-0037","1"),
("46","1","Brinjals 1Kg","3.000","1.00","637.50","1911.50","47","INV-0037","1"),
("47","7"," Cucumber 1Kg","2.000","0.00","190.00","380.00","47","INV-0037","1"),
("48","12","Apple - Red Royal Gala 1Kg","2.000","10.00","630.00","1250.00","48","INV-0038","1"),
("49","1","Brinjals 1Kg","2.000","1.00","637.50","1274.00","49","INV-0039","1"),
("50","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","50","INV-0040","1"),
("51","7"," Cucumber 1Kg","2.000","0.00","190.00","380.00","51","INV-0041","1"),
("52","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","51","INV-0041","1"),
("53","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","52","INV-0042","1"),
("54","7"," Cucumber 1Kg","2.000","0.00","190.00","380.00","52","INV-0042","1"),
("55","3","Dambala 1Kg","1.000","0.00","315.00","315.00","53","INV-0043","1"),
("56","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","54","INV-0044","1"),
("57","7"," Cucumber 1Kg","1.000","0.00","190.00","190.00","54","INV-0044","1"),
("58","1","Brinjals 1Kg","1.000","1.00","637.50","636.50","55","INV-0045","1");



DROP TABLE IF EXISTS sale_payment;

CREATE TABLE `sale_payment` (
  `spay_id` int(11) NOT NULL AUTO_INCREMENT,
  `netotal` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `due` double(10,2) NOT NULL,
  `payment_mid` int(11) NOT NULL,
  `card_tid` int(11) NOT NULL,
  `invoice_no` varchar(30) NOT NULL,
  PRIMARY KEY (`spay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

INSERT INTO sale_payment VALUES("1","1274.00","2000.00","726.00","2","0","INV-0016"),
("2","1250.00","2000.00","770.00","2","0","INV-0017"),
("3","636.50","1000.00","363.50","2","0","INV-0018"),
("4","2549.00","3000.00","451.00","1","0","INV-0019"),
("5","2549.00","3000.00","451.00","1","0","INV-0020"),
("6","1250.00","2000.00","750.00","0","0",""),
("7","1274.00","2000.00","726.00","0","0","INV-0024"),
("8","1274.00","0.00","0.00","0","0","INV-0025"),
("9","0.00","0.00","0.00","0","0",""),
("10","0.00","0.00","0.00","0","0",""),
("11","0.00","0.00","0.00","0","0",""),
("12","0.00","0.00","0.00","0","0",""),
("13","1274.00","0.00","0.00","0","0","INV-0026"),
("14","1274.00","0.00","0.00","0","0","INV-0026"),
("15","1274.00","0.00","0.00","0","0","INV-0026"),
("16","1274.00","2000.00","726.00","0","0","INV-0027"),
("17","1274.00","2000.00","726.00","0","0","INV-0027"),
("18","1911.50","0.00","0.00","0","0","INV-0028"),
("19","1911.50","0.00","0.00","0","0","INV-0029"),
("20","564.30","1000.00","435.70","1","0","INV-0030"),
("21","564.30","1000.00","435.70","1","0","INV-0030"),
("22","1016.50","2000.00","983.50","2","0","INV-0031"),
("23","1274.00","2000.00","726.00","1","0","INV-0032"),
("24","380.00","500.00","120.00","1","0","INV-0033"),
("25","1250.00","2000.00","750.00","1","0","INV-0034"),
("26","1911.50","2000.00","88.50","1","0","INV-0035"),
("27","1911.50","2000.00","88.50","1","0","INV-0036"),
("28","3541.50","4000.00","458.50","0","1",""),
("29","1250.00","2990.00","1740.00","0","2",""),
("30","1274.00","2000.00","726.00","0","2",""),
("31","636.50","1000.00","363.50","0","2",""),
("32","1016.50","2000.00","983.50","2","1","INV-0041"),
("33","1016.50","1000.00","3.50","1","0","INV-0042"),
("34","315.00","500.00","185.00","1","0","INV-0043"),
("35","826.50","1000.00","173.50","2","1","INV-0044"),
("36","636.50","1000.00","363.50","1","0","INV-0045");



DROP TABLE IF EXISTS stock;

CREATE TABLE `stock` (
  `st_id` int(11) NOT NULL AUTO_INCREMENT,
  `st_qty` double(10,3) NOT NULL,
  `current_qty` double(10,3) NOT NULL,
  `st_date` date NOT NULL,
  `exp_date` date NOT NULL,
  `price` double(10,2) NOT NULL,
  `st_type` int(11) NOT NULL COMMENT '1=stockIn,2=stockOut',
  `p_id` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `expired_confirmed` int(11) NOT NULL DEFAULT '0',
  `reorder_confirmed` int(11) NOT NULL DEFAULT '0',
  `stock_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO stock VALUES("1","4.000","0.000","2020-12-26","2021-01-09","637.50","1","1","1","0","0","2021-04-22 09:53:42","0"),
("2","6.000","3.000","2020-12-26","2021-01-09","244.80","1","7","1","0","0","2021-04-22 09:53:42","1"),
("3","0.000","0.000","2021-04-25","0000-00-00","0.00","2","0","44","0","0","2021-04-25 16:42:54","1"),
("4","2.000","0.000","2021-04-25","2021-04-29","367.20","1","1","2","0","0","2021-04-25 20:26:49","0"),
("5","3.000","3.000","2021-04-25","2021-05-04","278.10","1","2","2","0","0","2021-04-25 20:26:49","1"),
("6","2.000","2.000","2021-04-27","2021-05-05","102.00","1","2","1","1","1","2021-04-27 18:53:57","1");



DROP TABLE IF EXISTS sub_category;

CREATE TABLE `sub_category` (
  `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_cat_name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sub_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO sub_category VALUES("1","Aubergine","1","1"),
("2","Beans","1","1"),
("3","Chilies","1","1"),
("4","Cucumber","1","1"),
("5","Gourd","1","1"),
("6","Herbs","1","1"),
("7","Onions","1","1"),
("8","Pumpkin","1","1"),
("9","Imported Fruits","2","1"),
("10","Local Fruits","2","1"),
("11","Roots","1","1"),
("12","Tomotoes","1","1"),
("13","Onion","1","1"),
("14","Unclassified","1","1"),
("15","Yam","1","1"),
("16","Pasta & Noodles","3","1"),
("17","Snacks","3","1"),
("18","Biscuits","3","1"),
("19","Sugur","3","1");



DROP TABLE IF EXISTS supplier;

CREATE TABLE `supplier` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(50) NOT NULL,
  `sup_fname` varchar(50) NOT NULL,
  `sup_lname` varchar(50) NOT NULL,
  `sup_email` varchar(30) NOT NULL,
  `sup_nic` varchar(20) NOT NULL,
  `sup_dob` date NOT NULL,
  `sup_gender` int(11) NOT NULL,
  `sup_mob` varchar(20) NOT NULL,
  `sup_con` varchar(20) NOT NULL,
  `sup_house_no` varchar(20) NOT NULL,
  `sup_street` varchar(30) NOT NULL,
  `sup_city` varchar(30) NOT NULL,
  `sup_account_no` varchar(50) NOT NULL,
  `sup_account_name` varchar(50) NOT NULL,
  `sup_bank_name` varchar(50) NOT NULL,
  `sup_account_branch` varchar(30) NOT NULL,
  `sup_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("1","Pushpa Enterprices","Pushpa","Gunawardhana","hansi3914@gmail.com","893456837V","2020-11-18","1","+94774556091","+94912277848","39/5A","Negambo Road","Dambadeniya","456789230","Pushpa Gunawardhana","Commercial","Dambadeniya","1"),
("2","Kandy fruit Pvt  Ltd","Rajitha","Laksiri","kandyfruits127kf@gmail.com","863458837V","2020-12-09","1"," +94768208950","+94815707400","34/9","Bulumulla Road"," Kandy ","123409867","Rajitha Laksiri","HNB","Kiribathkumbura","1"),
("3","Dilarshad Enterprise  ","Anura","Kariyawasam","anuraz2dil@gmail.com","863458837V","2020-12-23","0","+94714706091","+94112300715","30/1","Nawam Mawatha","Galle","3456879762","Anura Kariyawasam","Commercial","Galle","1"),
("4","","","","","","0000-00-00","0","","","","","","","","","","1");



DROP TABLE IF EXISTS tbl_order;

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_customer_name` varchar(255) NOT NULL,
  `order_item` varchar(255) NOT NULL,
  `order_value` double(12,2) NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO tbl_order VALUES("1","David E. Gary","Shuttering Plywood","1500.00","2017-01-14"),
("2","Eddie M. Douglas","Aluminium Heavy Windows","2000.00","2017-01-08"),
("3","Oscar D. Scoggins","Plaster Of Paris","150.00","2016-12-29"),
("4","Clara C. Kulik","Spin Driller Machine","350.00","2016-12-30"),
("5","Christopher M. Victory","Shopping Trolley","100.00","2017-01-01"),
("6","Jessica G. Fischer","CCTV Camera","800.00","2017-01-02"),
("7","Roger R. White","Truck Tires","2000.00","2016-12-28"),
("8","Susan C. Richardson","Glass Block","200.00","2017-01-04"),
("9","David C. Jury","Casing Pipes","500.00","2016-12-27"),
("10","Lori C. Skinner","Glass PVC Rubber","1800.00","2016-12-30"),
("11","Shawn S. Derosa","Sony HTXT1 2.1-Channel TV","180.00","2017-01-03"),
("12","Karen A. McGee","Over-the-Ear Stereo Headphones ","25.00","2017-01-01"),
("13","Kristine B. McGraw","Tristar 10\" Round Copper Chef Pan with Glass Lid","20.00","2016-12-30"),
("14","Gary M. Porter","ROBO 3D R1 Plus 3D Printer","600.00","2017-01-02"),
("15","Sarah D. Hunter","Westinghouse Select Kitchen Appliances","35.00","2016-12-29"),
("16","Diane J. Thomas","SanDisk Ultra 32GB microSDHC","12.00","2017-01-05"),
("17","Helena J. Quillen","TaoTronics Dimmable Outdoor String Lights","16.00","2017-01-04"),
("18","Arlette G. Nathan","TaoTronics Bluetooth in-Ear Headphones","25.00","2017-01-03"),
("19","Ronald S. Vallejo","Scotchgard Fabric Protector, 10-Ounce, 2-Pack","20.00","2017-01-03"),
("20","Felicia L. Sorensen","Anker 24W Dual USB Wall Charger with Foldable Plug","12.00","2017-01-04");



DROP TABLE IF EXISTS unit;

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(30) NOT NULL,
  `short_name` varchar(30) NOT NULL,
  `allow_decimal` int(11) NOT NULL DEFAULT '1',
  `unit_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO unit VALUES("1","Kilogram","Kg","1","1"),
("2","Gram","g","0","1"),
("3","Liter","L","1","1"),
("4","Packets","pa","0","1"),
("5","Mili liter","ml","0","1");



DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(30) NOT NULL,
  `user_lname` varchar(30) NOT NULL,
  `user_image` text NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_nic` varchar(12) NOT NULL,
  `user_dob` date NOT NULL,
  `user_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_gender` int(11) NOT NULL,
  `user_cno1` varchar(20) NOT NULL,
  `user_cno2` varchar(20) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("1","Saman","Kumara","1591450482_admin.png","dickson@gmail.lk","208494201V","1989-05-10","2020-06-06 19:04:42","2021-04-26 08:34:15","0","+94912277658","+94773749886","1","1"),
("2","Ayesha","Gunawardhana","1618033085_cashier_1.png","ayesha@gmail.com","967854391V","1996-08-12","2021-04-10 11:08:05","2021-04-26 08:35:03","0","+94912277786","+94774547886","3","1"),
("3","Josep","Perara","1618033945_stock.png","josep@gmail.com","958494201V","1995-10-09","2021-04-10 11:22:25","2021-04-25 06:14:42","0","+94912266659","+94783748886","5","1"),
("4","Ben","Cruso","1618034218_cashier.png","ben@gmail.com","942311567V","1994-09-22","2021-04-10 11:26:58","2021-04-26 08:35:24","0","+94913355678","+94723749776","3","1"),
("5","Sujeewa","Siriwardhana","1618034386_stock (2).png","suj123@gmail.com","986654801V","1998-11-12","2021-04-10 11:29:46","2021-04-26 08:29:40","0","+94112257658","+94723749776","5","1"),
("6","Himansi","Waraniyagoda","1619893410_supervisor.jpg","himansiw@gmail.lk","983256201V","1998-11-20","2021-05-01 23:53:30","2021-05-01 23:53:30","1","+94912277436","+94716734713","2","1");



