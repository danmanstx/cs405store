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
            <a href="product.php?id=' . $id . '">View Product Details</a></td>
        </tr>
      </table>';
    }
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysql_close();
?>