<?php  
include "connect_to_mysql.php"; 
$dynamicList = "";
$sql = mysql_query("SELECT * FROM Products ORDER BY date_added DESC LIMIT 3");
$productCount = mysql_num_rows($sql);
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["Pid"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          
          <td width="83%" valign="top">' . $product_name . '<br />
            $' . $price . '<br />
            <a href="products.php?id=' . $id . '">View Product Details</a></td>
        </tr>
      </table>';
    }
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>
<html>
<head>
<title>CS 405 Web Store</title>
<link href="index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<img src="UK-logo-letterpressed.jpg" />
<div id="heading">
<h1> Welcome to our store!</h1>
</div>
<div id="tab1">
</div>
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
<div id="lastest">
<h2>Our Newest Items!</h2>
<?php echo($dynamicList) ?>
</div>
</body>
</html>