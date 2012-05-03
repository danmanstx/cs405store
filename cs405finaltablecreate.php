<?php


$link = mysql_connect('mysql.cs.uky.edu', 'drpete2', 'u0177269');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully\n';
mysql_select_db('drpete2',$link);

$sql = "CREATE TABLE Products
(
Pid 			int AUTO_INCREMENT, 	
product_name	varchar(25),
price			int,
details			varchar(50),
cat				varchar(8),
date_added		varchar(10),
quantity		int,
PRIMARY KEY (Pid)
)" or die(mysql_error());

mysql_query($sql,$link);
mysql_query("INSERT INTO Products (Pid, product_name, price, details, cat, date_added, quantity) VALUES (1, 'Jenga',3,'Classic Jenga Puzzle Game','Game','2008-03-28',4)");
mysql_query("INSERT INTO Products (Pid, product_name, price, details, cat, date_added, quantity) VALUES (2, 'Bible',5,'King James Edition','Book','2010-03-28',99)");
mysql_query("INSERT INTO Products (Pid, product_name, price, details, cat, date_added, quantity) VALUES (3, 'Halo',60,'First Person Shooter for the XBOX','Game','2012-03-24',2)");
mysql_query("INSERT INTO Products (Pid, product_name, price, details, cat, date_added, quantity) VALUES (4, 'The Hunger Games',5,'Paperback of the hit book that is now a movie','Book','2012-03-23',3)");
mysql_query("INSERT INTO Products (Pid, product_name, price, details, cat, date_added, quantity) VALUES (5, 'Harry Potter 1',5,'Harry Potter and the Sorcerers Stone','Book','2012-03-29',1)");
mysql_query("INSERT INTO Products (Pid, product_name, price, details, cat, date_added, quantity) VALUES (6, 'Angry Birds Download',6,'Smash hit game where you shoot birds at pigs','Game','2012-04-20',99)");

$sql= "CREATE TABLE Users
(
Uid	    		int AUTO_INCREMENT,
user_name		varchar(15),
password		varchar(15),
type			varchar(15),
last_log_date 	varchar(10),
PRIMARY KEY(Uid)
)" or die(mysql_error());
mysql_query($sql,$link);
mysql_query("INSERT INTO Users (Uid, user_name, password, type, last_log_date) VALUES (1,'danny', 'peters','admin','2012-04-23')");
mysql_query("INSERT INTO Users (Uid, user_name, password, type, last_log_date) VALUES (2,'james', 'cornett','admin','2012-04-23')");
mysql_query("INSERT INTO Users (Uid, user_name, password, type, last_log_date) VALUES (3,'test', 'test','cust','2012-04-23')");
mysql_query("INSERT INTO Users (Uid, user_name, password, type, last_log_date) VALUES (4,'testStaff', 'test','staff','2012-04-23')");

$sql="CREATE TABLE Orders
(
OrderId			int AUTO_INCREMENT,
)" or die(mysql_error());

//Uid				int,
//order_date    	varchar(10),
//total_cost 		float,
//promotion 		float,
//status			varchar(15)
mysql_query($sql,$link);
//mysql_query("INSERT INTO Orders(OrderId, Uid, order_date, total_cost, promotion, status) VALUES (1,1,now(),50.00, 00.00, 'ordered')");
mysql_query("INSERT INTO Orders(OrderId,) VALUES(1)");

$sql="CREATE TABLE Orders(
OrderID		int,
Uid			int,
order_date	varchar(10),
total_cost	int,
promotion	int,
status		varchar(15)
)";
mysql_query($sql,$link) or die(mysql_error());
mysql_query("INSERT INTO Orders(OrderId, Uid, order_date, total_cost, promotion, status) VALUES (2,1,now(),50, 0, 'ordered')") or die(mysql_error());

$sql="CREATE TABLE Order_Line
(
OrderId	int,
Pid		int,
pCount	int
)" or die(mysql_error());
mysql_query($sql,$link);
mysql_query("INSERT INTO Order_Line(OrderId, Pid, pCount) VALUES (1,1,1)");
mysql_query("INSERT INTO Order_Line(OrderId, Pid, pCount) VALUES (1,2,1)");
mysql_query("INSERT INTO Order_Line(OrderId, Pid, pCount) VALUES (1,3,4)");



mysql_close($link);
?>
