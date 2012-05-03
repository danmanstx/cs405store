<?php 
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Run a select query to get my latest 6 items
// Connect to the MySQL database  
include "connect_to_mysql.php"; 
$gameList = "";
$bookList = "";
$sql = mysql_query("SELECT * FROM Products ORDER BY date_added DESC");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["Pid"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $cat = $row["cat"];
			 $quantity = $row["quantity"];
			 
			 if($cat == "Game"){
			 	$gameList .='
			 	<li>
			 	'.$product_name . '
			 	</li>
			 	<li>
			 	$' .$price . '
			 	</li>
			 	<li>
			 	<a href="products.php?id=' . $id . '">View Product Details</a>
			 	</li>
			 	<li>
			 	<br /> ';
			 }
			 else{
			 	$bookList .='
			 	<li>
			 	'.$product_name .'
			 	</li>
			 	<li>
			 	$' .$price .'
			 	</li>
			 	<li>
			 	<a href="products.php?id=' . $id . '">View Product Details</a>
			 	</li>
			 	<li>
			 	<br />';
			 }
    }
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CS 405 Web Store - Product List</title>
<link rel="stylesheet" href="productlist.css" type="text/css" media="screen" />
</head>
<body>
<div id="topnav">
<ul>
<li class="navlist"><a href="index.php">Home</a></li>
<li class="navlist"><a href="login.php">login</a></li>
<li class="navlist"><a href="logout.php">logout</a></li>
<li class="navlist"><a href="cart.php">cart</a></li>
<li class="navlist"><a href="custorder.php">Your Orders</a></li>
<li class="navlist"><a href="product_list.php">products</a></li>
</ul>
</div>
 <div id="pageContent">
  <h1>Products</h1>
  </div>
      <div id="books"><h3> Books</h3><ul class="books"><?php echo $bookList; ?></ul> </div>
      <div id="games"><h3>Games</h3><ul class="games"><?php echo $gameList; ?></ul></div>
</div>
</body>
</html>