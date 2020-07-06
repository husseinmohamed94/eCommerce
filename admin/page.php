<?php

/* 

categroies =>[manage |Edit |updata|Add | Insert |delete | stats]

condition ? true :false'

*/


$action = isset($_GET['action']) ? $_GET['action'] : ' Manage ' ;

 //if the page is main page
 
 if($action == 'Manage'){
   echo ' welcome You Are IN Manage category page';
   echo '<a href ="page.php?action=Insert" >Add New Categorry + </a>';
 }elseif($action == 'Add'){
    echo 'You Are In Add category page';
 }elseif ($action == 'Insert') {
    echo 'You Are In Insert category page';

 }else {
     echo 'Error There \'no page with this name';
 }