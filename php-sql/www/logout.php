<?php
 
 setcookie("id", NULL, time() + 3600 , "/");
 header("Location: index.php");

?>