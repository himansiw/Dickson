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

INSERT INTO attendance VALUES("1","1""EMP-001","EMP-001""Ayesha Gunawarhana","Ayesha Gunawarhana""2020-11-06","2020-11-06""01:00:07","01:00:07""00:00:00","00:00:00""1""1"),
("2","2""EMP-002","EMP-002""Josep Perara","Josep Perara""2020-11-06","2020-11-06""00:00:07","00:00:07""00:00:00","00:00:00""1""1"),
("3","3""EMP-003","EMP-003""Ben Cruso","Ben Cruso""2020-11-06","2020-11-06""00:00:07","00:00:07""00:00:00","00:00:00""1""1"),
("4","4""EMP-004","EMP-004""Sujeewa Siriwardana","Sujeewa Siriwardana""2020-11-06","2020-11-06""00:00:07","00:00:07""00:00:00","00:00:00""1""1"),
("5","5""EMP-005","EMP-005""Sahan Layanal","Sahan Layanal""2020-11-06","2020-11-06""00:00:07","00:00:07""00:00:00","00:00:00""1""1"),
("6","6""EMP-006","EMP-006""Gayan Kaluthota","Gayan Kaluthota""2020-11-06","2020-11-06""00:00:07","00:00:07""00:00:00","00:00:00""1""1");



DROP TABLE IF EXISTS backup;

CREATE TABLE `backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_date` date NOT NULL,
  `backup_time` time NOT NULL,
  `reference` varchar(200) NOT NULL,
  `backup_name` varchar(200) NOT NULL,
  `backup_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS brand;

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(30) NOT NULL,
  `brand_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO brand VALUES("1","1""No brand","No brand""1""1"),
("2","2""Maliban","Maliban""1""1"),
("3","3""Munchee","Munchee""1""1"),
("4","4""Motha","Motha""1""1"),
("5","5""Prima ","Prima ""1""1"),
("6","6""Raigam ","Raigam ""1""1"),
("7","7""Harischandra","Harischandra""1""1"),
("8","8""Maggi","Maggi""1""1"),
("9","9""San Remo ","San Remo ""1""1"),
("10","10""Jacker","Jacker""1""1"),
("11","11""Uswatte","Uswatte""1""1"),
("12","12""Royal Hot","Royal Hot""1""1"),
("13","13""Sugar & spice","Sugar & spice""1""1");



DROP TABLE IF EXISTS card_type;

CREATE TABLE `card_type` (
  `card_tid` int(11) NOT NULL AUTO_INCREMENT,
  `card_method` varchar(30) NOT NULL,
  PRIMARY KEY (`card_tid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO card_type VALUES("1","1""Visa""Visa"),
("2","2""MasterCard""MasterCard");



DROP TABLE IF EXISTS category;

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) NOT NULL,
  `cat_code` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO category VALUES("1","1""Vegetables","Vegetables""12345","12345""1""1"),
("2","2""Fruits","Fruits""2345","2345""1""1");



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

INSERT INTO customer VALUES("1","1""DFC0001","DFC0001""Kalpana","Kalpana""Gunawardhana","Gunawardhana""+94773745678","+94773745678""kapila@gmail.com","kapila@gmail.com""890765342V","890765342V""234/7c","234/7c""gannamulla","gannamulla""Galle","Galle""5.00","5.00""1""1"),
("2","2""DFC0002","DFC0002""Kumara","Kumara""Alvis","Alvis""+94712209876","+94712209876""kumara@gmail.com","kumara@gmail.com""806712345V","806712345V""98/7","98/7""Wakwalla","Wakwalla""Galle","Galle""27.70","27.70""1""1");



DROP TABLE IF EXISTS department;

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `department_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO department VALUES("1","1""Fresh Produce","Fresh Produce""Fresh vegetables and fruit","Fresh vegetables and fruit""1""1"),
("2","2""Frozen foods","Frozen foods""Cool food","Cool food""1""1"),
("3","3""Grocery","Grocery""canned & boxed non-refrigerated items","canned & boxed non-refrigerated items""1""1"),
("4","4""Homeware","Homeware""Home items","Home items""1""1"),
("5","5""Dali","Dali""can be just sliced meats and cheeses ","can be just sliced meats and cheeses ""1""1"),
("6","6""Meat","Meat""","""1""1"),
("7","7""Dairy","Dairy""milk, eggs, yogurt","milk, eggs, yogurt""1""1"),
("8","8""Health and Beauty","Health and Beauty""everything from vitamins to makeup","everything from vitamins to makeup""1""1");



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

INSERT INTO employee VALUES("1","1""EMP-001","EMP-001""Ayesha","Ayesha""Gunawaradana","Gunawaradana""hansi3914@gmail.co","hansi3914@gmail.co""967854391V","967854391V""1996-01-13","1996-01-13""1","1""+94912277786","+94912277786""+94715677786","+94715677786""2","2""39/5C","39/5C""Wakunugoda","Wakunugoda""Galle","Galle""4125369782","4125369782""Ayesha Gunawarhana","Ayesha Gunawarhana""Commercial","Commercial""Pannipitiya","Pannipitiya""1""1"),
("2","2""EMP-002","EMP-002""Josep","Josep""Perara","Perara""josep@gmail.com","josep@gmail.com""958494201V","958494201V""1995-05-20","1995-05-20""0","0""+94912266659","+94912266659""+94783748886","+94783748886""5","5""230/5","230/5""Kaleganna","Kaleganna""Galle","Galle""890253697","890253697""Josep Perara","Josep Perara""Commercial","Commercial""Galle","Galle""1""1"),
("3","3""EMP-003","EMP-003""Ben","Ben""Cruso","Cruso""ben@gmail.com","ben@gmail.com""942311567V","942311567V""1994-10-16","1994-10-16""0","0""+94913355678","+94913355678""+94723749776","+94723749776""2","2""56/8V","56/8V""aluth para","aluth para""Galle","Galle""1284909782","1284909782""Ben Cruso","Ben Cruso""HNB","HNB""Galle","Galle""1""1"),
("4","4""EMP-004","EMP-004""Sujeewa","Sujeewa""Siriwardhana","Siriwardhana""suj123@gmail.com","suj123@gmail.com""986654801V","986654801V""1988-06-10","1988-06-10""0","0""+94112257658","+94112257658""+94723749776","+94723749776""5","5""267/A","267/A""Ganemulla","Ganemulla""Hikaduwwa","Hikaduwwa""345672156","345672156""Sujeewa Siriwardhana","Sujeewa Siriwardhana""LOC","LOC""Galle","Galle""1""1"),
("5","5""EMP-005","EMP-005""Sanhan","Sanhan""Layanal","Layanal""sahan@gmail.com","sahan@gmail.com""890753124V","890753124V""1989-09-12","1989-09-12""0","0""+94912245694","+94912245694""+94772380714","+94772380714""3","3""34/8","34/8""Kahatagasdeniya","Kahatagasdeniya""Galle","Galle""784257952","784257952""Sahan Layanal","Sahan Layanal""HNB","HNB""Galle","Galle""1""1"),
("6","6""EMP-006","EMP-006""Gayan","Gayan""Kaluthota","Kaluthota""gayan12@gmail.com","gayan12@gmail.com""960964391V","960964391V""1996-03-30","1996-03-30""0","0""+942245631","+942245631""+94717563290","+94717563290""6","6""23/6N","23/6N""Kubalwella","Kubalwella""Galle","Galle""678561234","678561234""Gayan Kaluthota","Gayan Kaluthota""Commercial","Commercial""Galle","Galle""1""1");



DROP TABLE IF EXISTS employee_role;

CREATE TABLE `employee_role` (
  `empr_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_role` varchar(40) NOT NULL,
  PRIMARY KEY (`empr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO employee_role VALUES("1","1""Owner""Owner"),
("2","2""Supervisor""Supervisor"),
("3","3""Cashier""Cashier"),
("4","4""Purchasing manager""Purchasing manager"),
("5","5""Stock keeper""Stock keeper"),
("6","6""Helper""Helper");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO expire VALUES("1","1""13","13""8.000","8.000""2021-04-10","2021-04-10""2021-03-29 09:23:44","2021-03-29 09:23:44""0","0""1""1"),
("2","2""13","13""8.000","8.000""2021-04-10","2021-04-10""2021-03-29 09:27:04","2021-03-29 09:27:04""0","0""1""1"),
("3","3""4","4""1.000","1.000""2021-04-30","2021-04-30""2021-04-17 18:19:47","2021-04-17 18:19:47""39","39""1""1"),
("4","4""7","7""2.000","2.000""2021-04-28","2021-04-28""2021-04-20 07:52:16","2021-04-20 07:52:16""38","38""1""1"),
("5","5""1","1""2.960","2.960""2021-05-03","2021-05-03""2021-04-20 08:35:48","2021-04-20 08:35:48""34","34""1""1");



DROP TABLE IF EXISTS function;

CREATE TABLE `function` (
  `function_id` int(11) NOT NULL AUTO_INCREMENT,
  `function_name` varchar(30) NOT NULL,
  `module_id` int(11) NOT NULL,
  `function_status` int(11) DEFAULT '1',
  PRIMARY KEY (`function_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO function VALUES("1","1""Add User","Add User""1","1""1""1"),
("2","2""Update User","Update User""1","1""1""1"),
("3","3""Active User","Active User""1","1""1""1"),
("4","4""Add Update Product","Add Update Product""2","2""1""1"),
("5","5""Delete Product","Delete Product""2","2""1""1"),
("6","6""View Product","View Product""2","2""1""1"),
("7","7""Add Update Brands","Add Update Brands""2","2""1""1"),
("8","8""View Brands","View Brands""2","2""1""1"),
("9","9""Delete Brands","Delete Brands""2","2""1""1"),
("10","10""Add Requisition Notes","Add Requisition Notes""3","3""1""1"),
("11","11""View Requisition Notes","View Requisition Notes""3","3""1""1"),
("12","12""Cancel Requisitions","Cancel Requisitions""3","3""1""1"),
("13","13""Manage Purchase Order","Manage Purchase Order""3","3""1""1"),
("14","14""Add Update Supplier","Add Update Supplier""3","3""1""1"),
("15","15""View Supplier","View Supplier""3","3""1""1"),
("16","16""Delete Supplier","Delete Supplier""3","3""1""1"),
("17","17""Add Update Stock","Add Update Stock""5","5""1""1"),
("18","18""Add Update GRN","Add Update GRN""5","5""1""1"),
("19","19""Manage Record Levels","Manage Record Levels""5","5""1""1"),
("20","20""Generate Report","Generate Report""8","8""1""1"),
("21","21""Update Report","Update Report""8","8""1""1"),
("22","22""Add Customer","Add Customer""9","9""1""1"),
("23","23""Update Customer","Update Customer""9","9""1""1"),
("24","24""Black List Customer","Black List Customer""9","9""1""1"),
("25","25""Active Customer","Active Customer""9","9""1""1"),
("26","26""View Customer Performance","View Customer Performance""1","1""1""1"),
("27","27""Update Customer Performance","Update Customer Performance""1","1""1""1");



DROP TABLE IF EXISTS function_user;

CREATE TABLE `function_user` (
  `user_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`function_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO function_user VALUES("1","1""1""1"),
("1","1""2""2"),
("1","1""3""3"),
("1","1""4""4"),
("1","1""5""5"),
("1","1""6""6"),
("1","1""7""7"),
("1","1""8""8"),
("1","1""9""9"),
("1","1""10""10"),
("1","1""11""11"),
("1","1""12""12"),
("1","1""13""13"),
("1","1""14""14"),
("1","1""15""15"),
("1","1""16""16"),
("1","1""17""17"),
("1","1""18""18"),
("1","1""19""19"),
("1","1""20""20"),
("1","1""21""21"),
("1","1""22""22"),
("1","1""23""23"),
("1","1""24""24"),
("1","1""25""25"),
("1","1""26""26"),
("1","1""27""27"),
("2","2""4""4"),
("2","2""5""5"),
("2","2""6""6"),
("2","2""7""7"),
("2","2""8""8"),
("2","2""9""9"),
("2","2""10""10"),
("2","2""11""11"),
("2","2""12""12"),
("2","2""13""13"),
("2","2""14""14"),
("2","2""15""15"),
("2","2""16""16"),
("2","2""22""22"),
("2","2""23""23"),
("2","2""24""24"),
("2","2""25""25"),
("3","3""10""10"),
("3","3""11""11"),
("3","3""12""12"),
("3","3""13""13"),
("3","3""14""14"),
("3","3""15""15"),
("3","3""16""16"),
("3","3""17""17"),
("3","3""18""18"),
("3","3""19""19"),
("4","4""10""10"),
("4","4""11""11"),
("4","4""12""12"),
("4","4""13""13"),
("4","4""14""14"),
("4","4""15""15"),
("4","4""16""16"),
("4","4""17""17"),
("4","4""18""18"),
("4","4""19""19"),
("4","4""22""22"),
("4","4""23""23"),
("4","4""24""24"),
("4","4""25""25"),
("5","5""17""17"),
("5","5""18""18"),
("5","5""19""19"),
("5","5""22""22"),
("5","5""23""23"),
("5","5""24""24"),
("5","5""25""25"),
("6","6""10""10"),
("6","6""11""11"),
("6","6""12""12"),
("6","6""13""13"),
("6","6""14""14"),
("6","6""15""15"),
("6","6""16""16"),
("6","6""17""17"),
("6","6""18""18"),
("6","6""19""19"),
("7","7""4""4"),
("7","7""5""5"),
("7","7""6""6"),
("7","7""7""7"),
("7","7""8""8"),
("7","7""9""9"),
("7","7""10""10"),
("7","7""11""11"),
("7","7""12""12"),
("7","7""13""13"),
("7","7""14""14"),
("7","7""15""15"),
("7","7""16""16"),
("7","7""20""20"),
("7","7""21""21"),
("7","7""22""22"),
("7","7""23""23"),
("7","7""24""24"),
("7","7""25""25"),
("8","8""22""22"),
("8","8""23""23"),
("8","8""24""24"),
("8","8""25""25"),
("9","9""4""4"),
("9","9""5""5"),
("9","9""6""6"),
("9","9""7""7"),
("9","9""8""8"),
("9","9""9""9"),
("9","9""10""10"),
("9","9""11""11"),
("9","9""12""12"),
("9","9""13""13"),
("9","9""14""14"),
("9","9""15""15"),
("9","9""16""16"),
("9","9""22""22"),
("9","9""23""23"),
("9","9""24""24"),
("9","9""25""25"),
("10","10""20""20"),
("10","10""21""21");



DROP TABLE IF EXISTS login;

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_username` varchar(80) NOT NULL,
  `login_password` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_status` int(11) NOT NULL,
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `login_username` (`login_username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("1","1""dickson@gmail.lk","dickson@gmail.lk""40BD001563085FC35165329EA1FF5C5ECBDBBEEF","40BD001563085FC35165329EA1FF5C5ECBDBBEEF""1","1""1""1"),
("2","2""ayesha@gmail.com","ayesha@gmail.com""325b890a600d8d9967ce3699f73a69a5b2651f2c","325b890a600d8d9967ce3699f73a69a5b2651f2c""2","2""1""1"),
("3","3""josep@gmail.com","josep@gmail.com""6acf7bd1535cd8fe34bd277eb37b041751e6f80b","6acf7bd1535cd8fe34bd277eb37b041751e6f80b""3","3""1""1"),
("4","4""ben@gmail.com","ben@gmail.com""2e738b4329595bbcef0d843f5cf9ad9cd83ac4b3","2e738b4329595bbcef0d843f5cf9ad9cd83ac4b3""4","4""1""1"),
("5","5""suj123@gmail.com","suj123@gmail.com""c82149d763e7a9695f2ba392cf60eef74f6fb098","c82149d763e7a9695f2ba392cf60eef74f6fb098""5","5""1""1");



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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO loyalty_detail VALUES("1","1""DFC0002","DFC0002""27.70","27.70""22.70","22.70""yes","yes""0.00","0.00""0.00","0.00""2","2"" Kumara Alvis "," Kumara Alvis ""INV-0006","INV-0006""1""1"),
("2","2""DFC0001","DFC0001""5.00","5.00""0.00","0.00""","""0.00","0.00""0.00","0.00""1","1"" Kalpana Gunawardhana "," Kalpana Gunawardhana ""INV-0007","INV-0007""1""1");



DROP TABLE IF EXISTS module;

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(30) NOT NULL,
  `module_status` int(11) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO module VALUES("1","1""User Management","User Management""1""1"),
("2","2""Product Master","Product Master""1""1"),
("3","3""Purchase","Purchase""1""1"),
("4","4""Sales & Billing","Sales & Billing""1""1"),
("5","5""Inventory & Stock","Inventory & Stock""1""1"),
("6","6"" Employee Management"," Employee Management""1""1"),
("7","7""Security & Backup","Security & Backup""1""1"),
("8","8""Report","Report""1""1"),
("9","9""Customer & Loyalty","Customer & Loyalty""1""1");



DROP TABLE IF EXISTS module_role;

CREATE TABLE `module_role` (
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`module_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO module_role VALUES("1","1""1""1"),
("2","2""1""1"),
("2","2""2""2"),
("3","3""1""1"),
("3","3""2""2"),
("3","3""4""4"),
("4","4""1""1"),
("4","4""3""3"),
("5","5""1""1"),
("5","5""5""5"),
("6","6""1""1"),
("6","6""2""2"),
("7","7""1""1"),
("8","8""1""1"),
("8","8""2""2"),
("9","9""1""1"),
("9","9""3""3");



DROP TABLE IF EXISTS pay_type;

CREATE TABLE `pay_type` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_status` varchar(30) NOT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO pay_type VALUES("1","1""Due""Due"),
("2","2""Paid""Paid");



DROP TABLE IF EXISTS payment_method;

CREATE TABLE `payment_method` (
  `payment_mid` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type` varchar(30) NOT NULL,
  `payment_mstatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payment_mid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO payment_method VALUES("1","1""Cash","Cash""1""1"),
("2","2""Card","Card""1""1"),
("3","3""Cheque","Cheque""1""1");



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

INSERT INTO product VALUES("1","1""DS0001","DS0001""Brinjals 1Kg","Brinjals 1Kg""1","1""1","1""1","1""1","1""1001","1001""1","1""brinjals.jpg","brinjals.jpg""637.50","637.50""1","1""5.000","5.000""1""1"),
("2","2""DS0002","DS0002""Green Beans 1Kg","Green Beans 1Kg""1","1""1","1""1","1""2","2""1002","1002""1","1""1597728366_organic green beans.jpg","1597728366_organic green beans.jpg""399.00","399.00""0","0""5.000","5.000""1""1"),
("3","3""DS0003","DS0003""Dambala 1Kg","Dambala 1Kg""1","1""1","1""1","1""2","2""1003","1003""1","1""1597906934_dambala.jpg","1597906934_dambala.jpg""315.00","315.00""0","0""4.000","4.000""1""1"),
("4","4""DS0004","DS0004""Long Beans 1Kg","Long Beans 1Kg""1","1""1","1""1","1""2","2""1004","1004""1","1""1597912651_long_beans.jpg","1597912651_long_beans.jpg""397.80","397.80""0","0""7.000","7.000""1""1"),
("5","5""DS0005","DS0005""Green Chilies 1Kg","Green Chilies 1Kg""1","1""1","1""1","1""3","3""1005","1005""1","1""1597913580_green_chilies.jpg","1597913580_green_chilies.jpg""690.00","690.00""0","0""6.000","6.000""1""1"),
("6","6""DS0006","DS0006""Green Cucumber 1Kg","Green Cucumber 1Kg""1","1""1","1""1","1""4","4""1006","1006""1","1""1598193969_green_cucumber.jpg","1598193969_green_cucumber.jpg""210.00","210.00""0","0""4.000","4.000""1""1"),
("7","7""DS0007","DS0007"" Cucumber 1Kg"," Cucumber 1Kg""1","1""1","1""1","1""4","4""1007","1007""1","1""cucumber.jpg","cucumber.jpg""190.00","190.00""0","0""4.000","4.000""1""1"),
("8","8""DS0008","DS0008""Bitter Gourd 1Kg","Bitter Gourd 1Kg""1","1""1","1""1","1""5","5""1008","1008""1","1""1598506159_bitter_gourd.jpg","1598506159_bitter_gourd.jpg""510.00","510.00""0","0""4.000","4.000""1""1"),
("9","9""DS0009","DS0009""Curry Leaves 1Kg","Curry Leaves 1Kg""1","1""1","1""1","1""6","6""1009","1009""1","1""1598518804_curry_leaves.jpg","1598518804_curry_leaves.jpg""150.00","150.00""0","0""2.000","2.000""1""1"),
("10","10""DS0010","DS0010""Red Onions 1Kg","Red Onions 1Kg""1","1""1","1""1","1""7","7""1010","1010""1","1""1598518883_red_onion.jpg","1598518883_red_onion.jpg""160.00","160.00""0","0""10.000","10.000""1""1"),
("11","11""DS0011","DS0011""Garlic 1Kg","Garlic 1Kg""1","1""1","1""1","1""7","7""1011","1011""1","1""1598519316_garlic.jpg","1598519316_garlic.jpg""450.00","450.00""0","0""10.000","10.000""1""1"),
("12","12""DS0012","DS0012""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""1","1""1","1""2","2""9","9""1012","1012""1","1""1598974887_apple-redroyalgala.jpg","1598974887_apple-redroyalgala.jpg""630.00","630.00""10","10""3.000","3.000""1""1"),
("13","13""DS0013","DS0013""Grapes - Red 1Kg","Grapes - Red 1Kg""1","1""1","1""2","2""9","9""1013","1013""1","1""1599481464_grapes.jpg","1599481464_grapes.jpg""1554.00","1554.00""0","0""3.000","3.000""1""1"),
("14","14""DS0014","DS0014""Orange 1Kg","Orange 1Kg""1","1""1","1""2","2""9","9""1014","1014""1","1""1599587664_orange.jpg","1599587664_orange.jpg""560.00","560.00""0","0""4.000","4.000""1""1"),
("15","15""DS0015","DS0015""Melon - Dark Bell 1Kg","Melon - Dark Bell 1Kg""1","1""1","1""2","2""10","10""1015","1015""1","1""1603980172_melon-dark.jpg","1603980172_melon-dark.jpg""90.00","90.00""0","0""2.000","2.000""1""1"),
("16","16""DS0016","DS0016""Mango - Vilad 1Kg","Mango - Vilad 1Kg""1","1""1","1""2","2""10","10""1016","1016""1","1""1603980998_mango - vilad.jpg","1603980998_mango - vilad.jpg""280.00","280.00""0","0""2.000","2.000""1""1"),
("17","17""DS0017","DS0017""Banana - Kolikuttu 1Kg","Banana - Kolikuttu 1Kg""1","1""1","1""1","1""10","10""1017","1017""1","1""1603981226_banana - kolikuttu.jpg","1603981226_banana - kolikuttu.jpg""244.80","244.80""2","2""7.000","7.000""1""1"),
("18","18""DS0018","DS0018""Mango","Mango""1","1""1","1""2","2""9","9""1018","1018""1","1""1612171466_icon.png","1612171466_icon.png""0.00","0.00""0","0""5.000","5.000""1""1");



DROP TABLE IF EXISTS product_location;

CREATE TABLE `product_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `rack_no` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `position` varchar(30) NOT NULL,
  `location_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO product_location VALUES("1","1""0","0""1","1""Medium","Medium""1""1"),
("2","2""0","0""2","2""Bottom","Bottom""1""1"),
("3","3""0","0""3","3""Medium","Medium""1""1"),
("4","4""2","2""5","5""Top","Top""1""1"),
("5","5""1","1""4","4""Bottom","Bottom""1""1"),
("6","6""1","1""6","6""Top","Top""1""1");



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

INSERT INTO purchase VALUES("1","1""REF-001","REF-001""1","1"" Pushpa Gunawardhana "," Pushpa Gunawardhana ""hansi3914@gmail.com","hansi3914@gmail.com""2021-04-25 09:55:24","2021-04-25 09:55:24""Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ""2685.60","2685.60""0""0"),
("2","2""REF-001","REF-001""0","0"" Pushpa Gunawardhana "," Pushpa Gunawardhana ""hansi3914@gmail.com","hansi3914@gmail.com""2021-04-27 08:51:10","2021-04-27 08:51:10""Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ""3945.60","3945.60""1""1"),
("3","3""REF-001","REF-001""0","0"" Pushpa Gunawardhana "," Pushpa Gunawardhana ""hansi3914@gmail.com","hansi3914@gmail.com""2021-04-27 08:51:10","2021-04-27 08:51:10""Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ""3945.60","3945.60""1""1"),
("4","4""REF-001","REF-001""0","0"" Pushpa Gunawardhana "," Pushpa Gunawardhana ""hansi3914@gmail.com","hansi3914@gmail.com""2021-04-27 08:51:10","2021-04-27 08:51:10""Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ""3945.60","3945.60""1""1"),
("5","5""REF-001","REF-001""0","0"" Pushpa Gunawardhana "," Pushpa Gunawardhana ""hansi3914@gmail.com","hansi3914@gmail.com""2021-04-27 08:51:10","2021-04-27 08:51:10""Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ","Please supply your order to us within a week. Let us know if any delivery is difficult.\n                ""3945.60","3945.60""1""1");



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

INSERT INTO purchase_item VALUES("1","1""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""3.000","3.000""630.00","630.00""1890.00","1890.00""1""1"),
("2","2""Long Beans 1Kg ","Long Beans 1Kg ""2.000","2.000""397.80","397.80""795.60","795.60""1""1"),
("3","3""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""3.000","3.000""630.00","630.00""1890.00","1890.00""2""2"),
("4","4""Long Beans 1Kg ","Long Beans 1Kg ""2.000","2.000""397.80","397.80""795.60","795.60""2""2"),
("5","5""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""2.000","2.000""630.00","630.00""1260.00","1260.00""2""2"),
("6","6""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""3.000","3.000""630.00","630.00""1890.00","1890.00""3""3"),
("7","7""Long Beans 1Kg ","Long Beans 1Kg ""2.000","2.000""397.80","397.80""795.60","795.60""3""3"),
("8","8""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""2.000","2.000""630.00","630.00""1260.00","1260.00""3""3"),
("9","9""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""3.000","3.000""630.00","630.00""1890.00","1890.00""4""4"),
("10","10""Long Beans 1Kg ","Long Beans 1Kg ""2.000","2.000""397.80","397.80""795.60","795.60""4""4"),
("11","11""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""2.000","2.000""630.00","630.00""1260.00","1260.00""4""4"),
("12","12""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""3.000","3.000""630.00","630.00""1890.00","1890.00""5""5"),
("13","13""Long Beans 1Kg ","Long Beans 1Kg ""2.000","2.000""397.80","397.80""795.60","795.60""5""5"),
("14","14""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""2.000","2.000""630.00","630.00""1260.00","1260.00""5""5");



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

INSERT INTO receive VALUES("1","1""REF0001","REF0001""1","1""2021-04-22 09:46:33","2021-04-22 09:46:33""3940.00","3940.00""2","2""1""1"),
("2","2""REF0003","REF0003""1","1""2021-04-25 08:23:01","2021-04-25 08:23:01""1530.00","1530.00""2","2""0""0"),
("3","3""REF0004","REF0004""2","2""2021-04-27 06:51:46","2021-04-27 06:51:46""200.00","200.00""1","1""0""0");



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

INSERT INTO receive_item VALUES("1","1""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""1","1""4.000","4.000""625.00","625.00""1440.00","1440.00""2","2""637.50","637.50""2020-12-26","2020-12-26""2021-01-09","2021-01-09""1","1""1""1"),
("2","2""Banana - Kolikuttu 1Kg ","Banana - Kolikuttu 1Kg ""7","7""6.000","6.000""240.00","240.00""1440.00","1440.00""2","2""244.80","244.80""2020-12-26","2020-12-26""2021-01-09","2021-01-09""1","1""1""1"),
("3","3""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""1","1""2.000","2.000""360.00","360.00""810.00","810.00""2","2""367.20","367.20""2021-04-25","2021-04-25""2021-04-29","2021-04-29""2","2""1""1"),
("4","4""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""2","2""3.000","3.000""270.00","270.00""810.00","810.00""3","3""278.10","278.10""2021-04-07","2021-04-07""2021-03-31","2021-03-31""2","2""1""1"),
("5","5""Apple - Red Royal Gala 1Kg ","Apple - Red Royal Gala 1Kg ""1","1""2.000","2.000""100.00","100.00""200.00","200.00""2","2""102.00","102.00""2021-04-27","2021-04-27""2021-05-05","2021-05-05""3","3""1""1");



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

INSERT INTO receive_payment VALUES("1","1""3940.00","3940.00""3940.00","3940.00""0.00","0.00""2","2""1","1""0","0""1""1"),
("2","2""1530.00","1530.00""1530.00","1530.00""0.00","0.00""2","2""1","1""0","0""2""2"),
("3","3""200.00","200.00""100.00","100.00""100.00","100.00""1","1""2","2""1","1""3""3");



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  `role_status` int(11) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO role VALUES("1","1""Administrator","Administrator""1""1"),
("2","2""Supervisor","Supervisor""1""1"),
("3","3""Cashier","Cashier""1""1"),
("4","4""Purchasing Manager","Purchasing Manager""1""1"),
("5","5""Stock keeper","Stock keeper""1""1");



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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO sale VALUES("1","1""INV-0001","INV-0001""1","1"" Kalpana Gunawardhana "," Kalpana Gunawardhana ""2021-03-10 11:14:56","2021-03-10 11:14:56""2510.00","2510.00""0.00","0.00""2510.00","2510.00""0.00","0.00""0.00","0.00""2021-04-26 16:20:06","2021-04-26 16:20:06""1""1"),
("2","2""INV-0002","INV-0002""0","0"" Walking Customer "," Walking Customer ""2021-04-21 11:16:19","2021-04-21 11:16:19""1250.00","1250.00""0.00","0.00""1250.00","1250.00""2000.00","2000.00""750.00","750.00""2021-04-26 15:19:46","2021-04-26 15:19:46""1""1"),
("3","3""INV-0003","INV-0003""2","2"" Kumara Alvis "," Kumara Alvis ""2021-04-23 12:08:01","2021-04-23 12:08:01""1250.00","1250.00""0.00","0.00""1250.00","1250.00""0.00","0.00""0.00","0.00""2021-04-26 15:20:05","2021-04-26 15:20:05""1""1"),
("4","4""INV-0004","INV-0004""1","1"" Kalpana Gunawardhana "," Kalpana Gunawardhana ""2021-04-26 12:09:45","2021-04-26 12:09:45""1250.00","1250.00""0.00","0.00""1250.00","1250.00""2000.00","2000.00""750.00","750.00""2021-04-26 12:10:07","2021-04-26 12:10:07""1""1"),
("5","5""INV-0005","INV-0005""1","1"" Kalpana Gunawardhana "," Kalpana Gunawardhana ""2021-04-26 12:11:46","2021-04-26 12:11:46""1250.00","1250.00""0.00","0.00""1250.00","1250.00""2000.00","2000.00""750.00","750.00""2021-04-26 12:12:06","2021-04-26 12:12:06""1""1"),
("6","6""INV-0006","INV-0006""2","2"" Kumara Alvis "," Kumara Alvis ""2021-04-26 12:13:05","2021-04-26 12:13:05""2270.00","2270.00""0.00","0.00""2270.00","2270.00""5000.00","5000.00""2730.00","2730.00""2021-04-26 12:13:51","2021-04-26 12:13:51""1""1"),
("7","7""INV-0007","INV-0007""1","1"" Kalpana Gunawardhana "," Kalpana Gunawardhana ""2021-04-26 12:15:49","2021-04-26 12:15:49""2900.00","2900.00""0.00","0.00""2900.00","2900.00""5000.00","5000.00""2100.00","2100.00""2021-04-26 12:16:16","2021-04-26 12:16:16""1""1"),
("8","8""INV-0008","INV-0008""2","2"" Kumara Alvis "," Kumara Alvis ""2021-04-26 12:46:07","2021-04-26 12:46:07""1670.00","1670.00""0.00","0.00""1670.00","1670.00""2000.00","2000.00""330.00","330.00""2021-04-26 12:47:53","2021-04-26 12:47:53""1""1"),
("9","9""INV-0009","INV-0009""1","1"" Kalpana Gunawardhana "," Kalpana Gunawardhana ""2021-04-27 07:51:00","2021-04-27 07:51:00""1250.00","1250.00""0.00","0.00""1250.00","1250.00""1000.00","1000.00""-250.00","-250.00""2021-04-27 19:51:37","2021-04-27 19:51:37""1""1"),
("10","10""INV-0010","INV-0010""2","2"" Kumara Alvis "," Kumara Alvis ""2021-04-27 07:59:18","2021-04-27 07:59:18""1250.00","1250.00""0.00","0.00""1250.00","1250.00""2000.00","2000.00""750.00","750.00""2021-04-27 19:59:42","2021-04-27 19:59:42""1""1"),
("11","11""INV-0011","INV-0011""2","2"" Kumara Alvis "," Kumara Alvis ""2021-04-27 08:01:28","2021-04-27 08:01:28""1250.00","1250.00""0.00","0.00""1250.00","1250.00""2000.00","2000.00""750.00","750.00""2021-04-27 20:01:52","2021-04-27 20:01:52""1""1");



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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO sale_item VALUES("1","1""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""4.000","4.000""10.00","10.00""630.00","630.00""2510.00","2510.00""1","1""INV-0001","INV-0001""1""1"),
("2","2""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""2","2""INV-0002","INV-0002""1""1"),
("3","3""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""3","3""INV-0003","INV-0003""1""1"),
("4","4""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""4","4""INV-0004","INV-0004""1""1"),
("5","5""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""5","5""INV-0005","INV-0005""1""1"),
("6","6""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""6","6""INV-0006","INV-0006""1""1"),
("7","7""8","8""Bitter Gourd 1Kg","Bitter Gourd 1Kg""2.000","2.000""0.00","0.00""510.00","510.00""1020.00","1020.00""6","6""INV-0006","INV-0006""1""1"),
("8","8""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""3.000","3.000""10.00","10.00""630.00","630.00""1880.00","1880.00""7","7""INV-0007","INV-0007""1""1"),
("9","9""8","8""Bitter Gourd 1Kg","Bitter Gourd 1Kg""2.000","2.000""0.00","0.00""510.00","510.00""1020.00","1020.00""7","7""INV-0007","INV-0007""1""1"),
("10","10""6","6""Green Cucumber 1Kg","Green Cucumber 1Kg""2.000","2.000""0.00","0.00""210.00","210.00""420.00","420.00""8","8""INV-0008","INV-0008""1""1"),
("11","11""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""9","9""INV-0009","INV-0009""1""1"),
("12","12""12","12""Apple - Red Royal Gala 1Kg","Apple - Red Royal Gala 1Kg""2.000","2.000""10.00","10.00""630.00","630.00""1250.00","1250.00""10","10""INV-0010","INV-0010""1""1");



DROP TABLE IF EXISTS sale_payment;

CREATE TABLE `sale_payment` (
  `spay_id` int(11) NOT NULL AUTO_INCREMENT,
  `netotal` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `due` double(10,2) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `payment_mid` int(11) NOT NULL,
  `card_tid` int(11) NOT NULL,
  `invoice_no` varchar(30) NOT NULL,
  PRIMARY KEY (`spay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




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
  `stock_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO stock VALUES("1","1""4.000","4.000""4.000","4.000""2020-12-26","2020-12-26""2021-01-09","2021-01-09""637.50","637.50""1","1""1","1""1","1""0","0""2021-04-22 09:53:42","2021-04-22 09:53:42""1""1"),
("2","2""6.000","6.000""6.000","6.000""2020-12-26","2020-12-26""2021-01-09","2021-01-09""244.80","244.80""1","1""7","7""1","1""0","0""2021-04-22 09:53:42","2021-04-22 09:53:42""1""1"),
("3","3""0.000","0.000""0.000","0.000""2021-04-25","2021-04-25""0000-00-00","0000-00-00""0.00","0.00""2","2""0","0""44","44""0","0""2021-04-25 16:42:54","2021-04-25 16:42:54""1""1"),
("4","4""2.000","2.000""2.000","2.000""2021-04-25","2021-04-25""2021-04-29","2021-04-29""367.20","367.20""1","1""1","1""2","2""0","0""2021-04-25 20:26:49","2021-04-25 20:26:49""1""1"),
("5","5""3.000","3.000""3.000","3.000""2021-04-25","2021-04-25""2021-03-31","2021-03-31""278.10","278.10""1","1""2","2""2","2""0","0""2021-04-25 20:26:49","2021-04-25 20:26:49""1""1"),
("6","6""2.000","2.000""2.000","2.000""2021-04-27","2021-04-27""2021-05-05","2021-05-05""102.00","102.00""1","1""0","0""1","1""0","0""2021-04-27 18:53:57","2021-04-27 18:53:57""1""1");



DROP TABLE IF EXISTS sub_category;

CREATE TABLE `sub_category` (
  `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_cat_name` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`sub_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO sub_category VALUES("1","1""Aubergine","Aubergine""1","1""1""1"),
("2","2""Beans","Beans""1","1""1""1"),
("3","3""Chilies","Chilies""1","1""1""1"),
("4","4""Cucumber","Cucumber""1","1""1""1"),
("5","5""Gourd","Gourd""1","1""1""1"),
("6","6""Herbs","Herbs""1","1""1""1"),
("7","7""Onions","Onions""1","1""1""1"),
("8","8""Pumpkin","Pumpkin""1","1""1""1"),
("9","9""Imported Fruits","Imported Fruits""2","2""1""1"),
("10","10""Local Fruits","Local Fruits""2","2""1""1"),
("11","11""Roots","Roots""1","1""1""1"),
("12","12""Tomotoes","Tomotoes""1","1""1""1"),
("13","13""Onion","Onion""1","1""1""1"),
("14","14""Unclassified","Unclassified""1","1""1""1"),
("15","15""Yam","Yam""1","1""1""1");



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

INSERT INTO supplier VALUES("1","1""Pushpa Enterprices","Pushpa Enterprices""Pushpa","Pushpa""Gunawardhana","Gunawardhana""hansi3914@gmail.com","hansi3914@gmail.com""893456837V","893456837V""2020-11-18","2020-11-18""1","1""+94774556091","+94774556091""+94912277848","+94912277848""39/5A","39/5A""Negambo Road","Negambo Road""Dambadeniya","Dambadeniya""456789230","456789230""Pushpa Gunawardhana","Pushpa Gunawardhana""Commercial","Commercial""Dambadeniya","Dambadeniya""1""1"),
("2","2""Kandy fruit Pvt  Ltd","Kandy fruit Pvt  Ltd""Rajitha","Rajitha""Laksiri","Laksiri""kandyfruits127kf@gmail.com","kandyfruits127kf@gmail.com""863458837V","863458837V""2020-12-09","2020-12-09""1","1"" +94768208950"," +94768208950""+94815707400","+94815707400""34/9","34/9""Bulumulla Road","Bulumulla Road"" Kandy "," Kandy ""123409867","123409867""Rajitha Laksiri","Rajitha Laksiri""HNB","HNB""Kiribathkumbura","Kiribathkumbura""1""1"),
("3","3""Dilarshad Enterprise  ","Dilarshad Enterprise  ""Anura","Anura""Kariyawasam","Kariyawasam""anuraz2dil@gmail.com","anuraz2dil@gmail.com""863458837V","863458837V""2020-12-23","2020-12-23""0","0""+94714706091","+94714706091""+94112300715","+94112300715""30/1","30/1""Nawam Mawatha","Nawam Mawatha""Galle","Galle""3456879762","3456879762""Anura Kariyawasam","Anura Kariyawasam""Commercial","Commercial""Galle","Galle""1""1"),
("4","4""","""","""","""","""","""0000-00-00","0000-00-00""0","0""","""","""","""","""","""","""","""","""","""1""1");



DROP TABLE IF EXISTS unit;

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(30) NOT NULL,
  `short_name` varchar(30) NOT NULL,
  `allow_decimal` int(11) NOT NULL DEFAULT '1',
  `unit_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO unit VALUES("1","1""Kilogram","Kilogram""Kg","Kg""1","1""1""1"),
("2","2""Gram","Gram""g","g""0","0""1""1"),
("3","3""Liter","Liter""L","L""1","1""1""1"),
("4","4""Packets","Packets""pa","pa""0","0""1""1");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO user VALUES("1","1""Saman","Saman""Kumara","Kumara""1591450482_admin.png","1591450482_admin.png""dickson@gmail.lk","dickson@gmail.lk""208494201V","208494201V""1989-05-10","1989-05-10""2020-06-06 19:04:42","2020-06-06 19:04:42""2021-04-26 14:04:15","2021-04-26 14:04:15""0","0""+94912277658","+94912277658""+94773749886","+94773749886""1","1""1""1"),
("2","2""Ayesha","Ayesha""Gunawardhana","Gunawardhana""1618033085_cashier_1.png","1618033085_cashier_1.png""ayesha@gmail.com","ayesha@gmail.com""967854391V","967854391V""1996-08-12","1996-08-12""2021-04-10 11:08:05","2021-04-10 11:08:05""2021-04-26 14:05:03","2021-04-26 14:05:03""0","0""+94912277786","+94912277786""+94774547886","+94774547886""3","3""1""1"),
("3","3""Josep","Josep""Perara","Perara""1618033945_stock.png","1618033945_stock.png""josep@gmail.com","josep@gmail.com""958494201V","958494201V""1995-10-09","1995-10-09""2021-04-10 11:22:25","2021-04-10 11:22:25""2021-04-25 11:44:42","2021-04-25 11:44:42""0","0""+94912266659","+94912266659""+94783748886","+94783748886""5","5""1""1"),
("4","4""Ben","Ben""Cruso","Cruso""1618034218_cashier.png","1618034218_cashier.png""ben@gmail.com","ben@gmail.com""942311567V","942311567V""1994-09-22","1994-09-22""2021-04-10 11:26:58","2021-04-10 11:26:58""2021-04-26 14:05:24","2021-04-26 14:05:24""0","0""+94913355678","+94913355678""+94723749776","+94723749776""3","3""1""1"),
("5","5""Sujeewa","Sujeewa""Siriwardhana","Siriwardhana""1618034386_stock (2).png","1618034386_stock (2).png""suj123@gmail.com","suj123@gmail.com""986654801V","986654801V""1998-11-12","1998-11-12""2021-04-10 11:29:46","2021-04-10 11:29:46""2021-04-26 13:59:40","2021-04-26 13:59:40""0","0""+94112257658","+94112257658""+94723749776","+94723749776""5","5""1""1");



