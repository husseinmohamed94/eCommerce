<?php
ob_start();
session_start();

if (isset($_SESSION['Username'])) {
  $pageTitle = 'Dashbord';

  include 'init.php';
 /* start Dashboard page */
  $numUsers = 5;  // Number of latest users
 $latestUsers = getlatest("*","users","UserID",$numUsers); //latest users array
 $numItes = 6;
 $latestItems = getlatest("*","items","item_ID",$numItes); //latest items array
 $unmcomment = 5; //number of lastest comment
 
 ?>
  <div class="home-stats">
      <div class="container  text-center">
                <h1>Dashbord </h1>
                <div class="row">
                      <div class="col-md-3">
                        <div class="stat st-members">
                        <i class="fa fa-users"></i>
                               <div class="info">
                               Total Members
                               <span><a href ="members.php"><?php echo  countItems('UserID' , 'users','where GroupID = 0') ?></a></span>
                               </div> 
                        </div>
                  </div>

                  <div class="col-md-3">
                        <div class="stat st-pending">
                        <i class="fa fa-user-plus"></i>
                               <div class="info">
                                 Pending Members
                                   <span><a href ="members.php?action=Manage&page=pending">
                                 <?php echo checkItem("Regstatus" ,"users",0) ?>
                        </a></span>
                        </div>
                              </div>
                  </div>

                  <div class="col-md-3">
                        <div class="stat st-item">
                        <i class="fa fa-tag"></i>
                               <div class="info">  
                        Total Item
                        <span><a href ="items.php"><?php echo  countItems('item_ID' , 'items','') ?></a></span>
                        </div>  
                            </div>  
                  </div>

                  <div class="col-md-3">
                        <div class="stat st-comments">
                        <i class="fa fa-comments"></i>
                               <div class="info">
                        Total comments
                        <span><a href ="comments.php"><?php echo  countItems('c_id' , 'comments','') ?></a></span>
                        </div>
                          </div>
                  </div>

                </div>
           </div>
      </div>
      <div class="latest">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" >
                   
                            <div class="card-header">
                              <i class="fa fa-users"></i> latest <?php echo $numUsers ?> Registers Users
                              <span class="toggle-info pull-right">  <i class="fa fa-plus fa-lg"></i></span>
                          </div>    
                              <div class="card-body">
                              <ul class = "list-unstyled latest-users"> 
                                      <?php 
                                      if(! empty($latestUsers)){

                                      foreach($latestUsers as $user){
                                        echo '<li>';
                                            echo $user['Username']; 
                                            echo '<a href="members.php?action=Edit&UserId='. $user['UserID']. '">';
                                            echo '<span class="btn btn-success pull-right">';
                                                echo '<i class="fa fa-edit"></i>Edit';

                                                if($user['Regstatus'] == 0){
                                                  echo " <a href ='members.php?action=Activate&UserId=" .$user['UserID'] ."' class='btn btn-info pull-right activate '><i class ='fa fa-close'></i>Acivate</a>"; 
                
                                                }
                                              echo '</span>';
                                              echo '</a>';
                                       echo '</li>';
                                       }
                                     }else{ echo 'There\'No member show';}
                                    ?>
                             </ul>
                              </div>
                      </div>  
                   </div>

                   <div class="col-sm-6">
                        <div class="card" >
                            <div class="card-header">
                              <i class="fa fa-tag"></i> latest <?php echo $numItes ?> Items
                              <span class="toggle-info pull-right">  <i class="fa fa-plus fa-lg"></i></span>

                          </div>    
                              <div class="card-body">
                              <ul class = "list-unstyled latest-users">
                              <?php 
                             if(! empty($latestItems)){
                                      foreach($latestItems as $itme){
                                        echo '<li>';
                                            echo $itme['Name']; 
                                            echo '<a href="items.php?action=Edit&itemid='. $itme['item_ID']. '">';
                                            echo '<span class="btn btn-success pull-right">';
                                                echo '<i class="fa fa-edit"></i>Edit';

                                                if($itme['Approve'] == 0){
                                                  echo " <a href ='items.php?action=Approve&itemid=" .$itme['item_ID'] ."' class='btn btn-info pull-right activate  '><i class ='fa fa-close'></i>Acivate</a>"; 
                
                                                }
                                              echo '</span>';
                                              echo '</a>';
                                       echo '</li>';
                                      }
                                    }else{ echo 'There\'No items show';}
                                    ?>
                                      </ul>
                               </div>
                         </div>  
                     </div>
                  </div>

               <!-- start latst comments -->
                           <div class="row">
                    <div class="col-sm-6">
                        <div class="card" >
                   
                            <div class="card-header">
                              <i class="fa fa-comments-o"></i> latest <?php echo $unmcomment ?>  comments
                              <span class="toggle-info pull-right">  <i class="fa fa-plus fa-lg"></i></span>
                          </div>    
                              <div class="card-body">
                                      <?php
                                          $stmt = $con->prepare("SELECT 
                                          comments.*, users.Username 
                                          FROM
                                          comments   
                                          INNER JOIN
                                          users
                                          ON 
                                          users.UserID = comments.UserID
                                          ORDER BY c_id DESC
                                          LIMIT $unmcomment ");
                                      // execute the statemnt 
                                      $stmt->execute();
                                      //assign to varible
                                      $comments = $stmt->fetchAll();
                                      if(! empty($comments)){
                                      foreach($comments as $comment){
                                       echo '<div class="comment-box">';
                                      echo '<span class="Member-n">
                                      <a href ="members.php?action=Edit&UserId=' .$comment['userID'] .'">  
                                      ' . $comment['Username'] . '</a></span>';
                                      echo ' <p class="Member-c"> '. $comment['comment'] . '</p>' ;
                                       
                                       echo '</div>';     
                                      }
                                    }else{ echo 'There\'No comments show';}
                                      ?>

                              </div>
                      </div>  
                   </div>
 
                  </div>
 <!-- end latst comments -->
            </div>
    </div>
<?php
    /* end Dashboard page */

include $tpl . 'footer.php' ; 

}else {

  header('location: index.php');
exit();
}

ob_end_flush();

?>