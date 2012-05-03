<?php 

include "connect_to_mysql.php"; 
// This block grabs the whole list for viewing


if($_POST['id']){
    
    $Pid = $_POST['id'];
    $Promo = $_POST['promo'];

    $sql = mysql_query("SELECT price FROM Products WHERE Pid='$Pid'");
    $row = mysql_fetch_array($sql);
    $price = $row['price']; 

    
    $newPromo = (.01*$Promo) * $price;
    $price = $price - $newPromo;
    
    $price = round($price,2);
    mysql_query("UPDATE Products SET promo='$Promo', price='$price' WHERE Pid='$Pid'") or die(mysql_error());
}


$product_list = "";
$sql = mysql_query("SELECT * FROM Products ORDER BY date_added DESC");
$productCount = mysql_num_rows($sql); // count the output amount

if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["Pid"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $quan = $row["quantity"];
			 $promo = $row['promo'];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "Product ID: $id - <strong>$product_name</strong> - $$price - current promo rate $promo% <form method=\"post\">Update Promo Rate<input type=\"text\" name=\"promo\" value=\"$promo\" size=\"2\"><input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"submit\" value=\"update\" /></form>";
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CS 405 Store - Promo</title>
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
    <div align="right" style="margin-right:32px;"></div>
<div align="left" style="margin-left:24px;">
      <h2>Promotions!</h2>
      <?php echo $product_list; ?>
    </div>
    <hr />
      </div>
</div>
</body>
</html>