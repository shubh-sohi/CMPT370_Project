<?php
 
 setcookie("id", NULL, time() + 3600 , "/");
 setcookie("id2", NULL, time() + 3600 , "/");
 header("Location: ../index/index.php");

?>