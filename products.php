<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
if (isset($_GET['id'])) { 
    include "connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	$sql = mysql_query("SELECT * FROM Products WHERE Pid='$id'");
	$productCount = mysql_num_rows($sql);
    if ($productCount > 0) {
		while($row = mysql_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["cat"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $quantity = $row["quantity"];
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysql_close();
?>
<html>
<head>
<title>CS 405 Web Store -- <?php echo($product_name) ?></title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="topnav">
<ul id="navlist">
<li><a href="index.php">Home</a></li>
<li><a href="login.php">login</a></li>
<li><a href="cart.php">cart</a></li>
<li><a href="custorder.php">Your Orders</a></li>
<li><a href="product_list.php">products</a></li>
</ul>
</div>
  
  <div id="pageContent">
  
  <table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width="81%" valign="top"><h3><?php echo $product_name; ?></h3>
      <p><?php echo "Price: $".$price; ?><br />
         <?php echo "Category: ".$category; ?><br />
         <?php echo $details; ?>		<br />
         <?php echo "Number Available: ".$quantity; ?>
		 <br />
      </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
      </form>
      </td>
    </tr>
</table>
  </div>
</div>
</body>
</html>