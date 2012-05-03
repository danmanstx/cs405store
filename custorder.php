<?php 
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
 <html>
<head>
<title>CS 405 Web Store - Orders</title>
<link href="orders.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="topnav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="login.php">login</a></li>
<li><a href="logout.php">logout</a></li>
<li><a href="cart.php">cart</a></li>
<li><a href="custorder.php">Your Orders</a></li>
<li><a href="product_list.php">products</a></li>
</ul>
</div>
<div id="heading">
<h1> Order List</h1>
</div>
<div id="orderTable">
    <table id="orders"><thead id="thead"><th>OrderID</th><th>User id/name</th><th>Product List</th><th> Order Date</th><th>Total Cost</th><th>status</th></thead><tbody>
    <?php   
    // Connect to the MySQL database  
    include "connect_to_mysql.php"; 
    
    $user = $_SESSION["manager"];
    
    // sql for getting the orders 
    $sql = mysql_query("SELECT * FROM Orders");
    $OrderCount = mysql_num_rows($sql); // count the output amount
    if ($OrderCount > 0) {
    	while($row = mysql_fetch_array($sql)){ 
                 $OrderID = $row["OrderID"];
                 $Uid     = $row["Uid"];
    			 $order_date = strftime("%b %d, %Y", strtotime($row["order_date"]));
    			 $totalCost = $row["total_cost"];
    			 $status = $row["status"];
                
                 // get user name    			 
    			 $sql3 = mysql_query("SELECT * FROM Users WHERE Uid='$Uid'");
    			 $getName = mysql_fetch_array($sql3);
    			 $username = $getName['user_name'];
    			 
    			 $sql2 = mysql_query("SELECT * FROM Order_Line WHERE OrderID = '$OrderID'");
    			   $list ="";
    			 while($row = mysql_fetch_array($sql2)){
    			     $item = $row['Pid'];
    			     $count = $row['pCount'];
    			     
    			     $sql5 = mysql_query("SELECT * FROM Products WHERE Pid='$item'");
    			     $row5=mysql_fetch_array($sql5);
    			     $product_name = $row5['product_name'];
    			     
    			     $list = $list ."<p>$product_name - $count</p>";
    		     }
    
                if($user == $username){
                echo("<tr><td> $OrderID</td><td> $Uid - $username</td><td>$list</td><td> $order_date</td><td> $totalCost</td><td> $status</td></tr>");
                }
        }
    } 
    else {
        echo("there are no orders!");
    }
    ?>
   </tbody> </table>
</div>
</body>
</html>