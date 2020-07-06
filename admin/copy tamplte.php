<?php
ob_start();
session_start();
$pageTitle = 'catories';


if (isset($_SESSION['Username'])) {

                include 'init.php';
                $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
                 if($action == 'Manage'){

                    echo 'wlcome';
                 }elseif($action == 'Add' ){

                 }elseif($action == 'Insert' ){

                }elseif($action == 'Edit' ){

                }elseif($action == 'Update' ){

                }elseif($action == 'Delete' ){

                }elseif($action == 'Activate' ){

                }

       include $tpl . 'footer.php' ; 
}else {


  header('location: index.php');
  exit();
}
ob_end_flush;
?>