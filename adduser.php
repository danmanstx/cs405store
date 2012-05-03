<?php 
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

    $type = $_POST["type"];
    echo($type);
	$username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  
    include "connect_to_mysql.php"; 
    
    // get the new user id
    $sql = mysql_query("SELECT MAX(Uid) as Uid FROM Users");
    $row = mysql_fetch_array($sql);
    $Uid = $row["Uid"];
    $Uid++;
    $query = "INSERT INTO Users VALUES ($Uid, '$username', '$password', '$type', now())";
    $sql = mysql_query($query) or die(mysql_error()); // query the person
    header("location: login.php"); 
    echo("account created, you can now log in!");
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration </title>
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
      <h2>Please Fill Out the Following Information</h2>
      <form id="form1" name="form1" method="post" action="adduser.php">
        User Name:<br />
          <input name="username" type="text" id="username" size="40" />
        <br /><br />
        Password:<br />
       <input name="password" type="password" id="password" size="40" />
       <br />
       <br />
          <label>
        <select name="type" id="type">
        <option value="admin">admin</option><option value="staff">staff</option>
        </select>
      </label> <br />
       
         <input type="submit" name="button" id="button" value="Register" />
       
      </form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
  <br />
  </div>
  </div>
</body>
</html>