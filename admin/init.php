<?php

include 'connect.php';


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

//include navbar on all pages  expect the one with $nonavbar vairble
if (!isset($nonavbar)) {include $tpl . 'navbar.php';}
