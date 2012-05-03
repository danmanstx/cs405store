<?php 
session_start();
if (isset($_SESSION["manager"])) {
    header("location: login.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  
    include "connect_to_mysql.php"; 
    $sql = mysql_query("SELECT Uid FROM Users WHERE user_name='$manager' AND password='$password' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["Uid"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 header("location: login.php");
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="login.php">Click Here</a>';
		exit();
	}
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Log In </title>
<link rel="stylesheet" href="default.css" type="text/css" media="screen" />
</head>

<body>
<div id="topnav">
<ul id="navlist">
<li><a href="index.php">Home</a></li>
<li><a href="login.php">login</a></li>
<li><a href="logout.php">logout</a></li>
<li><a href="cart.php">cart</a></li>
<li><a href="product_list.php">products</a></li>
</ul>
</div>
<div align="center" id="mainWrapper">
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2>Please Log In</h2>
      <form id="form1" name="form1" method="post" action="admin_login.php">
        User Name:<br />
          <input name="username" type="text" id="username" size="40" />
        <br /><br />
        Password:<br />
       <input name="password" type="password" id="password" size="40" />
       <br />
       <br />
       <br />
       
         <input type="submit" name="button" id="button" value="Log In" />
       
      </form>
      <p>&nbsp; </p>
      <a href="newuser.php"> Register a New Customer </a>
      
    </div>
    <br />
  <br />
  <br />
  </div>
  </div>
</body>
</html>