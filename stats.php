<?php 

session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

?><html>
<head>
<title>CS 405 Web Store - Stats</title>
<link href="orders.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="topnav">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="login.php">login</a></li>
<li><a href="logout.php">logout</a></li>
<li><a href="cart.php">cart</a></li>
<li><a href="product_list.php">products</a></li>
</ul>
</div>
<div id="heading">
<h1> Store Stats</h1>
</div>
<div id="orderTable">
    <table id="orders"><thead id="thead"><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity Left</th><th>Total From Sales</th><th>Sales This Week</th><th>Sales This Month</th><th>Sales This Year</th></thead><tbody>
    <?php   
    // variable decs
    $weekSales = 0; 
    // Connect to the MySQL database  
    include "connect_to_mysql.php"; 
    // sql for getting the orders 
    $sql = mysql_query("SELECT * FROM Products");
    $OrderCount = mysql_num_rows($sql); // count the output amount
    if ($OrderCount > 0) {
        // get the basic data
    	while($row = mysql_fetch_array($sql)){ 
            $Pid =$row['Pid'];
            $product_name =$row['product_name'];
            $price = $row['price'];
            $quantity = $row['quantity'];

            // output to a table
            echo("<tr><td> $Pid</td><td> $product_name</td><td>$$price</td><td> $quantity</td>");
            
            // get the total number of sales
            $sql2 = mysql_query("SELECT * FROM Order_Line WHERE Pid='$Pid'") or die(mysql_error());
                $sales=0;
                while($row2= mysql_fetch_array($sql2)){
                    $pCount = $row2['pCount'];
                    $sales = $sales + $pCount;
                    
                 }
                 echo("<td>$sales</td>");
            
            // get the number sold this week
            $sql3 = mysql_query("SELECT OrderID FROM Orders WHERE DATE_SUB(CURDATE(),INTERVAL 7 DAY) <= order_date") or die(mysql_error());
            $weekSales=0;
            while($row3 = mysql_fetch_array($sql3)){
                $orderWeek = $row3['OrderID'];
                $sql4 =   mysql_query("SELECT * FROM Order_Line WHERE OrderId='$orderWeek' AND Pid='$Pid'") or die(mysql_error());
                while($row4 = mysql_fetch_array($sql4)){
                    $weekSales = $weekSales + $row4['pCount'];
                } 
               
            }
            echo("<td>$weekSales</td>");                
            
            $monthSales=0;
            // get the number for the month
             $sql5 = mysql_query("SELECT OrderID FROM Orders WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= order_date") or die(mysql_error());
            while($row5 = mysql_fetch_array($sql5)){
                $orderWeek = $row5['OrderID'];
                $sql6 =   mysql_query("SELECT * FROM Order_Line WHERE OrderId='$orderWeek' AND Pid='$Pid'") or die(mysql_error());
                while($row6 = mysql_fetch_array($sql6)){
                    $monthSales = $monthSales + $row6['pCount'];
                } 
               
            }
            echo("<td>$monthSales</td>"); 
           
            $yearSales=0;
            // get the number for the month
             $sql7 = mysql_query("SELECT OrderID FROM Orders WHERE DATE_SUB(CURDATE(),INTERVAL 365 DAY) <= order_date") or die(mysql_error());
            while($row7 = mysql_fetch_array($sql7)){
                $orderWeek = $row7['OrderID'];
                $sql8 =   mysql_query("SELECT * FROM Order_Line WHERE OrderId='$orderWeek' AND Pid='$Pid'") or die(mysql_error());
                while($row8 = mysql_fetch_array($sql8)){
                    $yearSales = $yearSales + $row8['pCount'];
                } 
               
            }
            echo("<td>$yearSales</td>"); 
        
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