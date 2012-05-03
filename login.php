<?php 
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "connect_to_mysql.php"; 
$sql = mysql_query("SELECT * FROM Users WHERE (type='admin' OR type='staff')  AND user_name='$manager' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysql_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
    $sql = mysql_query("SELECT * FROM Users WHERE type='cust' AND user_name='$manager' AND password='$password' LIMIT 1"); // query the person
    $existCount = mysql_num_rows($sql); // count the row nums
    if($existCount != 0){
        echo"welcome customer $manager <a href=\"index.php\"> return home</a>";
        exit();
    }	 
	else{
	 echo "Your login session data is not on record in the database.";
     exit();
    }
}
?>


<head>
<title>Store Admin Area</title>
<link rel="stylesheet" href="default.css" type="text/css" media="screen" />
</head>

<body>
<div id="topnav">
<ul id="navlist">
<li><a href="index.php">Home</a></li>
<li><a href="login.php">login</a></li>
<li><a href="logout.php">logout</a></li>
<li><a href="cart.php">cart</a></li>
<li><a href="custorder.php">Your Orders</a></li>
<li><a href="product_list.php">products</a></li>
</ul>
</div>
<div align="center" id="mainWrapper">
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2>Hello store Admin, what would you like to do today?</h2>
      <p><a href="inventory_list.php">Manage Inventory</a><br />
      <a href="orders.php">View/Ship Orders </a><br />
      <?php 
          $sql = mysql_query("SELECT * FROM Users WHERE type='admin' AND user_name='$manager' AND password='$password' LIMIT 1");
          if(mysql_num_rows($sql) != 0){
              echo("<a href=\"adduser.php\">Add User</a><br />");
              echo("<a href=\"stats.php\">View Stats</a><br />");
              echo("<a href=\"promo.php\">Sales Promotion</a><br />");
          }
       ?>
    </div>
    <br />
  <br />
  <br />
  </div>
</div>
</body>
</html>