<?php
session_start();
unset($_SESSION["customer"],$customer);
unset($_SESSION["manager"],$manager);
unset($_SESSION["password"],$password);
echo 'You have logged out. Return <a href="index.php">home</a>';
?>