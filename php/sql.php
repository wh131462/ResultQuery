<?php
$host="localhost";
$sql_username="root";
$sql_password="Qq542624047";
$sql_database="Result";//数据库 包含两个表 User 和 CJ19202 CJ20211 记住成绩表格严格按照此格式来建立 否则会影响应用的实现
// CREATE TABLE User(id INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,XH VARCHAR(24) not null,XM text not null,NJ VARCHAR(10) not null,XYMC text not null,BJ text not null,ZYMC text not null,password VARCHAR(16) not null);
	// CREATE TABLE CJ19202(id INT(12) UNSIGNED AUTO_INCREMENT PRIMARY KEY,xh VARCHAR(24) not null,bj text,xm text,kcmc text,xz text,xs VARCHAR(10),xf VARCHAR(10),kscj VARCHAR(10),qzcj VARCHAR(10),qmcj VARCHAR(10),pscj VARCHAR(10));
	//这里只是建立一个演示的表
	// CREATE TABLE `CJTEST` (
	//   `id` int(12) unsigned NOT NULL AUTO_INCREMENT,//id 相当于序号
	//   `xh` varchar(24) NOT NULL,//学号
	//   `bj` text,//班级
	//   `xm` text,//姓名
	//   `kcmc` text,//课程名称
	//   `xz` text,//课程性质
	//   `xs` varchar(10) DEFAULT NULL,//学时
	//   `xf` varchar(10) DEFAULT NULL,//学分
	//   `kscj` varchar(10) DEFAULT NULL,//考试成绩
	//   `qzcj` varchar(10) DEFAULT NULL,//期中成绩
	//   `qmcj` varchar(10) DEFAULT NULL,//期末成绩
	//   `pscj` varchar(10) DEFAULT NULL,//平时成绩
	//   PRIMARY KEY (`id`)
	// ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
?>