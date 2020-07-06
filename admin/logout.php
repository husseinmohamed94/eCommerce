<?php
session_start();   // start the session 

session_unset();   //uset the date
session_destroy();  //Destory the seeion
header('location: index.php');
exit();