<?php
ob_start();
session_start();
$pageTitle = 'profile';

include "init.php";
 
if(isset($_SESSION['user'])){

        $getUser = $con->prepare("SELECT * FROM users WHERE Username = ? ");
        $getUser->execute(array($sessionUser));
        $info = $getUser->fetch();
        $userid = $info['UserID'];
?>

<h1 class="text-center">My profile</h1>
    <div class="information block">
         <div class="container">
                <div class="card">
                        <div class="card-header bg-primary"> Main   Information</div>
                        <div class="card-body">
                            <ul class="list-unstyled">

                             <li> <i class="fa fa-envelope-o fa-fw"></i>
                                 <span>login Name</span>:  <?php echo $info['Username'] ?></li>
                             <li> <i class="fa fa-unlock-alt fa-fw"></i>
                                 <span> Email</span>:  <?php echo $info['Email'] ?></li>
                             <li> <i class="fa fa-user fa-fw"></i>
                                 <span> FullName</span>:  <?php echo $info['FullName'] ?></li>
                             <li> <i class="fa fa-calendar fa-fw"></i>
                                 <span> Ragiester Date</span>:  <?php echo $info['Date'] ?></li>
                             <li> <i class="fa fa-tag fa-fw"></i>
                                  <span> Favourite Category</span>:</li>
                          </ul>
                            <a href="#" class="btn btn-primary">Edit Informtion</a>
                       </div>
                    </div>
               </div>
         </div>

    <div id="my-ads" class="my-ads block">
         <div class="container">
                <div class="card">
                        <div class="card-header bg-primary">My  Items </div>
                        <div class="card-body">
                        <div class="row"> 
                <?php 
                  $myItems =   getAllFrom("*","items","where Member_ID = $userid", "","item_ID");

                //$items = getItems('Member_ID',$info['UserID'],1); 
                if(!empty($myItems)){

                foreach( $myItems as $item){
                   echo '<div class ="col-sm-6 col-md-3"> ';
                     echo '<div class="card item-box">';      
                        if($item['Approve'] == 0){echo '<span class="approve-status"> Waiting Approval </span>';}
                            echo ' <span class="price-tag">$'.$item['price'] . '</span>';           
                          //  echo '<img class="card-img-top img-responsive"  src="img.png" alt=""/> ';
                          if(empty($item['image'])){
                            echo '<img class="card-img-top img-responsive"  src="img.png" alt=""/> ';
                          }else{
                            echo " <img  class='card-img-top img-responsive'  src='uploads/avatars/" . $item['image'] ."' alt ='' /> ";}
                                  
                          echo '<div class="card-body">';  
                            echo '<h3  class="card-title"><a href="items.php?itemid='.$item['item_ID'].'">'.$item['Name'].'</a></h3>';
                            echo'<p class="card-text">'.$item['Descrption'].'</p>'; 
                            echo'<div class="date">'.$item['Add_date'].'</div>'; 
                           echo'</div>';
                      echo '</div>';
                   echo'</div>';
                }
             }else{
                 echo 'sorray There\' No ads To Show Create  <a href ="newad.php"> New Add</a> ';
             }
             ?>
            </div>
                      </div>
                 </div>
            </div>
         </div>

    <div class="my-comments block">
         <div class="container">
                <div class="card">
                        <div class="card-header bg-primary">latst comments</div>
                        <div class="card-body">
                               <?php

                               $mycomments = getAllFrom("comment","comments","where userID = $userid", "","c_id");
                         
                            if(!empty($mycomments)){
                                foreach ($mycomments as $comment) {
                                    echo '<p>' . $comment['comment'] . '</p>';
                                }
                            }else{
                                echo 'Ther\'s comments to show';
                            }
                               ?>
                        </div>
                     </div>
                </div>
          </div>


<?php
}else{
            header('location:login.php');
            exit();
}
 include $tpl . 'footer.php' ; 
 ob_end_flush();
 ?>
