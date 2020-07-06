<?php
// Error Reporting

ini_set('display_errors','on');
error_reporting(E_ALL);

include 'admin/connect.php';

$sessionUser = '';
if(isset($_SESSION['user'])){
   $sessionUser = $_SESSION['user'];
}




// Routes
$tpl = 'includes/templates/'; // Template Directory
$lang = 'includes/languages/'; //language  Dyrectory
$fun = 'includes/functions/';// function Diyrectory
$css = 'layout/css/';        // css Directory
$js = 'layout/js/' ;        //  js Directory



// include file
include $fun . 'functions.php';
include $lang . 'en.php';
include $tpl . 'header.php';



