<?php
ob_start();
session_start();
$pageTitle = 'Shoe Items';
include "init.php";

                $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid'])? intval($_GET['itemid']) : 0;
                $stmt = $con->prepare("SELECT
                                    items.*,
                                    categories.Name AS category_name,
                                    users.Username 
                                    FROM
                                    items
                                    INNER JOIN  
                                    categories
                                    ON
                                    categories.ID = items.cat_ID 
                                    INNER JOIN
                                    users
                                    ON 
                                    users.UserID = items.Member_ID
                                      
                                    WHERE item_ID= ?
                                    AND Approve = 1 ");
             
                $stmt->execute(array($itemid));
                $count = $stmt->rowCount();
                if($count >0 ){



                $item = $stmt->fetch();
                ?>
                <h1 class="text-center"> <?php echo $item['Name']; ?></h1>
                           <div class="container">
                                <div class="row">
                                <div class="col-md-3">
                         <!-- <img class="card-img-top img-responsive img-thumbnail center-block"  src="img.png" alt=""/> --> 
                            <?php    if(empty($item['image'])){
                  echo '<img class="card-img-top img-responsive"  src="img.png" alt=""/> ';
                }else{
                  echo " <img  class='card-img-top img-responsive'  src='uploads/avatars/" . $item['image'] ."' alt ='' /> ";}
                        ?>
                              </div>                                        
                                <div class="col-md-9 itme-info">
                                      <h2><?php echo $item['Name'] ?> </h2>
                                      <p><?php echo $item['Descrption'] ?> </p>
                                      <ul class="list-unstyled" >
                                      <li>
                                      <i class="fa fa-calendar fa-fw"></i>  
                                      <span>Added Date</span> : <?php echo $item['Add_date'] ?> </li>
                                      <li>
                                      <i class="fa fa-money fa-fw"></i>          
                                      <span>price</span> : $<?php echo $item['price'] ?> </li>
                                      <li>
                                      <i class="fa fa-building fa-fw"></i>          
                                      <span>made In </span> : <?php echo $item['country_made'] ?> </li>
                                      <li>
                                      <i class="fa fa-tag fa-fw"></i>          
                                      <span>category</span> :<a href="categories.php?pageid=<?php echo $item['cat_ID'] ?>" >   <?php echo $item['category_name'] ?></a> </li>
                                      <li>
                                      <i class="fa fa-user fa-fw"></i>          
                                      <span>Added By</span> : <a href="#">  <?php echo $item['Username'] ?> </a> </li>

                                      <li class="tags-items">
                                      <i class="fa fa-user fa-fw"></i>          
                                      <span> Tags</span> :
                                      <?php
                                       $allTags = explode(",",$item['tags']);
                                        foreach($allTags as $tag){
                                            $tag = str_replace(' ','',$tag);
                                            $lowertag = strtolower($tag);
                                            if(! empty ($tag)){
                                            echo "<a href='tags.php?name={$lowertag}'>"  . $tag . '</a> |';
                                      }
                                    }
                                      ?>
                                      </li>
                                     </ul>
                                </div>
                                </div>
                                <hr class="custom-hr">
                                <!-- start Add comment -->
                                <?php  if(isset($_SESSION['user'])){ ?>
                      
                                <div class="row">
                                   <div class="col-md-offset-3">
                                         <div class="add-comment">
                                                      <h3>Add You Comment</h3>
                                                <form action="<?php echo $_SERVER['PHP_SELF'] .'?itemid=' . $item['item_ID'] ?>" method="POST">
                                                    <textarea name="comment" class="form-control" required = "reguired"></textarea>
                                                     <input class="btn btn-primary" type="submit" value="Add coment" />
                                                   </form>
                                                   <?php 
                                                   if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                                        $comment    = filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
                                                        $itemid     = $item['item_ID'];
                                                        $userid     = $_SESSION['uid'];
                                                  //     echo $comment;
                                                     if(! empty($comment)){
                                                            $stmt = $con->prepare(" INSERT INTO 
                                                               comments (comment,status,comment_date,item_ID,userID)
                                                              VALUES(:zcomment,0,NOW(),:zitemid,:zuserid)");
                                                              $stmt->execute(array(
                                                                    'zcomment' => $comment,
                                                                    'zitemid'  => $itemid,
                                                                    'zuserid'  => $userid ));
                                                              if($stmt){
                                                 echo '<div class="alert alert-success"> Comment Added </div>';
                                                              }
                                                        }else{
                                                            echo '<div class="alert alert-danger"> Not Comment empty </div>';
                                                        }
                                                   }
                                                   ?>
                                                  </div>
                                              </div>
                                          </div>
                                           <!-- end Add comment -->
                                <?php }else{ echo '<a href ="login.php"> Login</a> or <a href ="login.php"> Register </a> to Add Comment';} ?>
                                <hr class="custom-hr">
                                <?php
                              $stmt = $con->prepare("SELECT 
                              comments.*, users.Username 
                              FROM
                              comments
                              INNER JOIN
                              users
                              ON 
                              users.UserID = comments.UserID
                              WHERE 
                              item_ID = ?
                              AND
                              status = 1
                              ORDER BY 
                              c_id DESC");
                $stmt->execute(array($item['item_ID']));
                $comments = $stmt->fetchAll();
                              ?>  
                             <?php foreach($comments as $comment){ ?>
                              <div class="comment-box">
                                <div class="row">
                                    <div class="col-sm-2 text-center">
                                    <img class="card-img img-responsive img-thumbnail img-circle center-block"  src="img.png" alt=""/>
                                    <?php echo $comment['Username'] ?>
                                    
                                    </div>
                                    <div class="col-sm-10">
                                    <p  class="lead">   <?php echo $comment['comment'] ?></p></div>
                                    </div>
                              </div>
                              <hr class="custom-hr">
                         <?php    } ?>
               
                           </div>     
                
                <?php

                /* end if $count >0  */       }else{

                        echo '<div class="alert alert-danger text-center">   There\'s No such ID Or This Item Is Wating Approve</di>';
                }
                include $tpl . 'footer.php' ; 
                ob_end_flush();
                ?>
