<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <title><?php getTitle() ?> </title>
           <link rel="stylesheet"   href="<?php echo $css; ?>bootstrap.min.css" />
           <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
           <link rel="stylesheet" href="<?php echo $css; ?>jquery-ui.css" />
           <link rel="stylesheet" href="<?php echo $css; ?>jquery.selectBoxIt.css" />
           <link rel="stylesheet"   href="<?php echo $css; ?>main.css" />


    </head>
    <body>
      <div class="upper-bar">
        <div class="container">
        <?php
             if(isset($_SESSION['user'])){
              
              /*$stmt = $con->prepare("SELECT * FROM users  ORDER BY UserID");
              // execute the statemnt 
              $stmt->execute();
              //assign to varible
              $rows = $stmt->fetchAll();
              foreach( $rows as $row){}

              <?php
              if(empty($row['avatar'])){
                  echo '<img class="card-img-top img-responsive"  src="img.png" alt=""/> ';
                }else{
                  echo " <img  class='card-img-top img-responsive'  src='uploads/avatars/" . $row['avatar'] ."' alt ='' /> ";}
               
                ?>
              */
                ?>
           
           <!--
           <div class="btn-group my-info text-right">
              
           
                
                  <span  class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                 
                  <span class="caret"></span>
                </span>
                  <ul class="dropdown-menu">
                    <li><a href ="profile.php">My Profile</a></li>
                    <li><a href="newad.php"> New Item</a></li>
                    <li><a href=profile.php#my-ads"> New Item</a></li>
                    <li><a href="logout.php"> logout</a></li>
                </ul>
            </div>
                  -->
            
      <?php
            echo '<div class="header-ul">';  
           echo '<h5> welcome ' . $sessionUser . ' </h5>';

            echo '<ul class="list-unstyled">';
            echo '  <li><a href="profile.php"> My Profile </a></li>';
            echo '  <li><a href="newad.php"> New Item </a></li>';
            echo '  <li><a href="profile.php#my-ads"> My Items </a></li>';
            echo '  <li><a href="logout.php"> logout</a></li>';
            echo '</ul>';
           echo '</div>';
            $userstatus = checkUserStatus($sessionUser);
              if( $userstatus == 1){
                // user is not active
            
             }

                }else{ 
                   ?>
              <a href="login.php">
                  <span class="pull-right">login/signup</span>
              </a>
           <?php  } ?>
        </div> 
      </div> 
      <nav class="navbar navbar-expand-lg navbar-light  navbar-dark bg-dark">
              <div class="container">
                  <a class="navbar-brand" href="index.php">Home Page</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainnav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                   </button>
              <div class="collapse navbar-collapse" id="mainnav">
               <ul class="nav navbar-nav  ml-auto">
                         <?php 
                      $categories= getAllFrom("*","categories","where parent=0","","ID", "ASC");
                              
                                foreach($categories as $cat){
                                  echo
                                      '<li><a href="categories.php?pageid='.$cat['ID'].'" >
                                      '. $cat['Name']. '
                                        </a></li>';
                               }  ?>
              
                </ul>
          </div>
          </div>
        </nav>
        