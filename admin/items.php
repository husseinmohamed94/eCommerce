<?php
ob_start();
session_start();
$pageTitle = 'Items';


if (isset($_SESSION['Username'])) {

                include 'init.php';
                $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
                 if($action == 'Manage'){
                
                
                    //selcte all uers expcet admin 
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
                ORDER BY 
                item_ID DESC");
                // execute the statemnt 
                $stmt->execute();
                //assign to varible
                $items = $stmt->fetchAll();
                    if(!empty($items)){  
       ?>

    <h1 class="text-center">Manage items</h1>
    <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                <tr>
                   <td>#ID</td>     
                   <td>Name</td>     
                   <td>Descrption</td>     
                   <td>price</td>     
                   <td>Adding Date</td>
                   <td>categery</td>
                   <td>username/td>

                   <td>control</td>       
                      </tr>
                      <?php 
                        foreach($items as $item){
                                 echo "<tr>";
                                 echo "<td>" . $item['item_ID'] . "</td>";
                                 echo "<td>" . $item['Name'] . "</td>";
                                echo "<td>" .  $item['Descrption'] . "</td>";
                                echo "<td>" .  $item['price'] . "</td>";
                                echo "<td>" .  $item['Add_date'] . "</td>";
                                echo "<td>" .  $item['category_name'] . "</td>";
                                echo "<td>" .  $item['Username'] . "</td>";
                                echo "
                                <td>
                                <a href ='items.php?action=Edit&itemid=" .$item['item_ID'] ."' class='btn btn-success'><i class ='fa fa-edit'></i>Edit</a>  
                                <a href ='items.php?action=Delete&itemid=" .$item['item_ID'] ."' class='btn btn-danger confirm'><i class ='fa fa-close'></i>Delete</a>"; 
                                if($item['Approve'] == 0){
                                  echo " <a href ='items.php?action=Approve&itemid=".$item['item_ID'] ."' class='btn btn-info '><i class ='fa fa-check'></i>Approve</a>"; 
                                }
                                echo " </td>";
                            echo "</tr>";

                        }
                      ?>
                     
                </table>
                </div> 
            <a href="items.php?action=Add" class="btn btn-primary"><i class= "fa fa-plus"></i>  New item</a>

    </div>

    <?php     }else{
                 echo '<div class="container">';
                      echo '<div class ="nic-message "> There\'s item To show </div>';
                    echo ' <a href="items.php?action=Add" class="btn btn-primary"><i class= "fa fa-plus"></i>  New item</a>';
                  '</div>';
               } ?>
     <?php 

                 }elseif($action == 'Add' ){?>
                            
                          <h1 class="text-center">Add New Item</h1>
                          <div class="container">
                               <form class="form-horizontal" action ="?action=Insert" method ="POST">
                            
                                     <!--start Name filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">Name</label>
                                                          <div class="col-sm-10 col-md-6">
                                                             <input
                                                                    type ="text"
                                                                    name ="Name"
                                                                    class ="form-control"
                                                                  require ="require"
                                                                    placeholder = "Name  of the Item  " />
                                                            </div>
                                        </div>
                                            <!--end Name filed -->
                                             <!--start Descrption filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">Descrption</label>
                                                          <div class="col-sm-10 col-md-6">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="Descrption" 
                                                                    class ="form-control" 
                                                                    placeholder = "Descrption  of the Item  " />
                                                                  </div>
                                                        </div>
                                            <!--end Descrption filed -->
                                              <!--start price filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">price</label>
                                                          <div class="col-sm-10 col-md-6">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="price" 
                                                                    class ="form-control" 
                                                                    placeholder = "price  of the Item  " />
                                                                  </div>
                                                        </div>
                                            <!--end price filed -->
                                         <!--start country_made filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-2 control-label">country</label>
                                              <div class="col-sm-10 col-md-6">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="country" 
                                                                    class ="form-control" 
                                                                    placeholder = "country of made  of the Item  " />
                                                                  </div>
                                                        </div>
                                            <!--end country_made filed -->
                                                   <!--start status filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-2 control-label">status</label>
                                              <div class="col-sm-10 col-md-6">
                                             <select name="status">
                                                    <option value="0">...</option>
                                                    <option value="1">New</option>
                                                    <option value="2">Link New</option>
                                                    <option value="3">used</option>
                                                    <option value="4"> very Old</option>
                                            </select>            
                                                   </div>
                                                        </div>
                                            <!--end status filed -->
                                            <!--start members filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-2 control-label">Member</label>
                                              <div class="col-sm-10 col-md-6">
                                             <select name="member">
                                                    <option value="0">...</option>
                                                   <?php
                                                   $allmembers = getAllFrom("*","users","","","UserID");
                                                   foreach($allmembers  as $user){
                                                    echo "<option value='".$user['UserID']."'>".$user['Username']."</option>";  
                                                   }
                                                   
                                                   ?>
                                            </select>            
                                                   </div>
                                                        </div>
                                            <!--end members filed -->
                                             <!--start categroy filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-2 control-label">categroy</label>
                                              <div class="col-sm-10 col-md-6">
                                             <select name="categroy">
                                                    <option value="0">...</option>
                                                   <?php
                                                   $allcats = getAllFrom("*","categories","where parent = 0","","ID");
                                                   
                                                   foreach($allcats as $cat){
                                                    echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";  
                                                    $childcats = getAllFrom("*","categories","where parent = {$cat['ID']}","","ID");
                                                      foreach($childcats as $child){
                                                        echo "<option value='".$child['ID']."'>--- ".$child['Name']."</option>"; 
                                                      }
                                                   }
                                                   
                                                   ?>
                                            </select>            
                                                   </div>
                                                        </div>
                                            <!--end categroy  filed -->
                                             <!--start tags filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-2 control-label">Tags</label>
                                              <div class="col-sm-10 col-md-6">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="tags" 
                                                                    class ="form-control" 
                                                                    placeholder = "separate Tags with comma (,)  "  />
                                                                  </div>
                                                        </div>
                                            <!--end tags filed -->
                                                <!--start submit filed -->
                                              <div class="form-group form-group-lg">
                                                                    <div class="col-sm-offset-2 col-sm-10  ">
                                                                        <input type ="submit"
                                                                        value ="Add Category" 
                                                                        class ="btn btn-primary btn-sm" />
                                                                          </div>
                                                            </div>
                                             <!--end submit filed -->
                                                   </form>
                                              </div>
            <?php     }elseif($action == 'Insert' ){
     
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        echo" <h1 class='text-center'>INsert Item</h1>";
        echo "<div class='container'> ";

            //Get varibles form the form
            $name            =  $_POST['Name'];
            $desc            = $_POST['Descrption'];
            $price           =  $_POST['price'];
            $country         =  $_POST['country'];
            $status          =  $_POST['status'];
            $member          =  $_POST['member'];
            $cat             =  $_POST['categroy'];
            $tags             =  $_POST['tags'];
        //validate the form
        $formErrors = array();
        if(empty($name) ){
            $formErrors[] = 'Name cant\'t by <strong> empty</strong> ';
 
        }
        
        if(empty($desc)){
            $formErrors [] = 'Descrption can\'t be <strong>empty</strong>';
        
        }
        if(empty($price)){
            $formErrors [] = 'price can\'t be <strong>empty</strong>';
        }
        if(empty($country)){
            $formErrors [] = 'country can\'t be <strong>empty</strong>';
        }
        if($status == 0 ){
            $formErrors [] = 'status can\'t be <strong>empty</strong>';
        }
        if($member == 0 ){
            $formErrors [] = 'Member can\'t be <strong>empty</strong>';
        }
        if($cat == 0 ){
            $formErrors [] = 'categorys can\'t be <strong>empty</strong>';
        }
        //loop info Errors Array and echo it
        foreach($formErrors as $error){
            echo "<div class='alert alert-danger text-center'>" . $error . '</div>';
        }
        //check if there's no error proceed the update operation
        if(empty($formErrors)){
           
        
            //  insert useru=info datebase w
     $stmt = $con->prepare(" INSERT INTO 
                      items(Name,Descrption,price,country_made, status,Add_date,Member_ID,cat_ID,tags) 
                      VALUES(:zname,:zdesc,:zprice,:zcounty,:zststus,now(),:zmember,:zcat,:ztags)");
       $stmt->execute(array(
           'zname'       => $name, 
           'zdesc'       => $desc,
            'zprice'     => $price,
            'zcounty'    => $country,
            'zststus'    => $status,
            'zmember'    => $member,
            'zcat'       => $cat,
            'ztags'      => $tags
            
        ));

          //echo success message
          $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Inserted </div>';
          redirectHome($theMsg,'back');

           
         }
   }else { 
       echo "<div class= 'container'> ";
       $theMsg = '<div class="alert alert-danger "> sorry You Cant Browse this  page Dirctly</div>';
       redirectHome($theMsg,);

       echo "</div>";
   }
   echo "</div>";


                }elseif($action == 'Edit' ){

                    $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid'])? intval($_GET['itemid']) : 0;
                    $stmt = $con->prepare("SELECT * FROM  items WHERE item_ID= ? ");
                    $stmt->execute(array($itemid));
                    $item = $stmt->fetch();
                    $count = $stmt->rowcount();
    
                        if($count > 0){ ?>
                            
                            <h1 class="text-center">Edit Item</h1>
                            <div class="container">
                                 <form class="form-horizontal" action ="?action=Update" method ="POST">
                              <input type ="hidden" name="itemid" value="<?php echo $itemid ?>"
                                       <!--start Name filed -->
                                      <div class="form-group form-group-lg">
                                              <label class="col-sm-2 control-label">Name</label>
                                                            <div class="col-sm-10 col-md-6">
                                                               <input
                                                                      type ="text"
                                                                      name ="Name"
                                                                      class ="form-control"
                                                                    require ="require"
                                                                      placeholder = "Name  of the Item  "
                                                                      value ="<?php echo $item['Name']?>" />
                                                              </div>
                                          </div>
                                              <!--end Name filed -->
                                               <!--start Descrption filed -->
                                      <div class="form-group form-group-lg">
                                              <label class="col-sm-2 control-label">Descrption</label>
                                                            <div class="col-sm-10 col-md-6">
                                                                    <input 
                                                                      type ="text" 
                                                                      name ="Descrption" 
                                                                      class ="form-control" 
                                                                      placeholder = "Descrption  of the Item  "
                                                                      value ="<?php echo $item['Descrption']?>" />
                                                                    </div>
                                                          </div>
                                              <!--end Descrption filed -->
                                                <!--start price filed -->
                                      <div class="form-group form-group-lg">
                                              <label class="col-sm-2 control-label">price</label>
                                                            <div class="col-sm-10 col-md-6">
                                                                    <input 
                                                                      type ="text" 
                                                                      name ="price" 
                                                                      class ="form-control" 
                                                                      placeholder = "price  of the Item  "
                                                                      value ="<?php echo $item['price']?>" />
                                                                    </div>
                                                          </div>
                                              <!--end price filed -->
                                           <!--start country_made filed -->
                                      <div class="form-group form-group-lg">
                                         <label class="col-sm-2 control-label">country</label>
                                                <div class="col-sm-10 col-md-6">
                                                                    <input 
                                                                      type ="text" 
                                                                      name ="country" 
                                                                      class ="form-control" 
                                                                      placeholder = "country of made  of the Item  "
                                                                      value ="<?php echo $item['country_made']?>" />
                                                                    </div>
                                                          </div>
                                              <!--end country_made filed -->
                                                     <!--start status filed -->
                                      <div class="form-group form-group-lg">
                                         <label class="col-sm-2 control-label">status</label>
                                                <div class="col-sm-10 col-md-6">
                                               <select name="status">
                                                  
                                                      <option value="1"<?php if($item['status'] ==  1 ){echo 'selected';} ?> >New</option>
                                                      <option value="2"<?php if($item['status'] ==  2 ){echo 'selected';} ?>>Link New</option>
                                                      <option value="3" <?php if($item['status'] == 3){echo 'selected';} ?>>used</option>
                                                      <option value="4" <?php if($item['status'] == 4){echo 'selected';} ?>> very Old</option>
                                              </select>            
                                                     </div>
                                                          </div>
                                              <!--end status filed -->
                                              <!--start members filed -->
                                      <div class="form-group form-group-lg">
                                         <label class="col-sm-2 control-label">Member</label>
                                                <div class="col-sm-10 col-md-6">
                                               <select name="member">
                                                
                                                     <?php
                                                     $stmt= $con->prepare("SELECT * FROM users");
                                                     $stmt->execute();
                                                     $users = $stmt->fetchAll();
                                                     foreach($users as $user){
                                                      echo "<option value='".$user['UserID']."'";
                                                       if($item['Member_ID'] == $user['UserID']){echo 'selected';}
                                                        echo" >".$user['Username']."</option>";  
                                                     }
                                                     
                                                     ?>
                                              </select>            
                                                     </div>
                                                          </div>
                                              <!--end members filed -->
                                               <!--start categroy filed -->
                                      <div class="form-group form-group-lg">
                                         <label class="col-sm-2 control-label">categroy</label>
                                                <div class="col-sm-10 col-md-6">
                                               <select name="categroy">
                                                     
                                                     <?php
                                                     $stmt2= $con->prepare("SELECT * FROM categories");
                                                     $stmt2->execute();
                                                     $cats = $stmt2->fetchAll();
                                                     foreach($cats as $cat){
                                                      echo "<option value='".$cat['ID']."'";
                                                      if($item['cat_ID'] == $cat['ID']){echo 'selected';}

                                                      echo ">".$cat['Name']."</option>";  
                                                     }
                                                     
                                                     ?>
                                              </select>            
                                                     </div>
                                                          </div>
                                              <!--end categroy  filed -->
                                                     <!--start tags filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-2 control-label">Tags</label>
                                              <div class="col-sm-10 col-md-6">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="tags" 
                                                                    class ="form-control" 
                                                                    placeholder = "separate Tags with comma (,)  " 
                                                                    value ="<?php echo $item['tags']?>" />
                                                                  </div>
                                                        </div>
                                            <!--end tags filed -->
                                                  <!--start submit filed -->
                                                <div class="form-group form-group-lg">
                                                                      <div class="col-sm-offset-2 col-sm-10  ">
                                                                          <input type ="submit"
                                                                          value ="save item" 
                                                                          class ="btn btn-primary btn-sm" />
                                                                            </div>
                                                              </div>
                                               <!--end submit filed -->
                                                     </form>
                                                      
                  <?php
                              //selcte all uers expcet admin 
                              $stmt = $con->prepare("SELECT 
                              comments.*, users.Username 
                              FROM
                              comments   
                              INNER JOIN
                              users
                              ON 
                              users.UserID = comments.UserID 
                            WHERE item_Id = ?  ");
                          // execute the statemnt 
                          $stmt->execute(array($itemid));
                          //assign to varible
                          $comments = $stmt->fetchAll();
                  if(!empty($comments)){

                             
            ?>
          <h1 class="text-center">Manage [<?php echo $item['Name']?>] commemts</h1>
                  <div class="table-responsive">
                        <table class="main-table text-center table table-bordered">
                            <tr>
                              <td>comment</td>                  
                              <td>user Name</td>     
                              <td>added Date</td>   
                              <td>control</td>       
                                  </tr>
                               <?php 
                                 foreach($comments as $comment){
                                      echo "<tr>";
                                      
                                      echo "<td>" . $comment['comment'] . "</td>";
                                      echo "<td>" . $comment['Username'] . "</td>";
                                      echo "<td>" . $comment['comment_date'] . "</td>";
                                      echo "
                                      <td>
                                      <a href ='comments.php?action=Edit&comid=" .$comment['c_id'] ."' class='btn btn-success'><i class ='fa fa-edit'></i>Edit</a>  
                                      <a href ='comments.php?action=Delete&comid=" .$comment['c_id'] ."' class='btn btn-danger confirm'><i class ='fa fa-close'></i>Delete</a>"; 
                                      if($comment['status'] == 0){
                                        echo " <a href ='comments.php?action=Activate&comid=" .$comment['c_id'] ."' class='btn btn-info '><i class ='fa fa-check'></i>Approve</a>"; 
                                      }
                                      echo " </td>";
                                  echo "</tr>";

                              }
                            ?>
                           </table>
                      </div> 
                            <?php } ?>
               </div>
            <?php
              }else{
                  echo "<div class= 'container'> ";
                  $theMsg = ' <div class="alert alert-danger" > thers NO Such ID </div>';
                  redirectHome($theMsg);
                  echo "</div>";
          
              }
                }elseif($action == 'Update' ){

                    echo" <h1 class='text-center'>update item</h1>";
                    echo "<div class='container'> ";
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            //Get varibles form the form
                            $id           =$_POST['itemid']; 
                            $name         =$_POST['Name'];
                            $desc         =$_POST['Descrption'];
                            $price        =$_POST['price'];
                            $country      =$_POST['country'];
                            $status       =$_POST['status'];
                            $member       =$_POST['member'];
                            $cat          =$_POST['categroy'];
                            $tags          =$_POST['tags'];
                        //validate the form
                        $formErrors = array();
                        if(empty($name) ){
                            $formErrors[] = 'Name cant\'t by <strong> empty</strong> ';
                 
                        }
                        
                        if(empty($desc)){
                            $formErrors [] = 'Descrption can\'t be <strong>empty</strong>';
                        
                        }
                        if(empty($price)){
                            $formErrors [] = 'price can\'t be <strong>empty</strong>';
                        }
                        if(empty($country)){
                            $formErrors [] = 'country can\'t be <strong>empty</strong>';
                        }
                        if($status == 0 ){
                            $formErrors [] = 'status can\'t be <strong>empty</strong>';
                        }
                        if($member == 0 ){
                            $formErrors [] = 'Member can\'t be <strong>empty</strong>';
                        }
                        if($cat == 0 ){
                            $formErrors [] = 'categorys can\'t be <strong>empty</strong>';
                        }
                        foreach($formErrors as $error){
                            echo "<div class='alert alert-danger text-center'>" . $error . '</div>';
                        }
                        //check if there's no error proceed the update operation
                        if(empty($formErrors)){
                
                            //  update the datebase with this info
                          $stmt = $con->prepare(" UPDATE  items SET Name = ? , Descrption = ? , price = ? ,
                           country_made = ? ,status = ? , Member_ID  = ? , cat_ID = ? , tags = ? WHERE item_ID = ? ");
                          $stmt->execute(array($name , $desc ,$price,$country,$status,$member,$cat,$tags,$id));
                          //echo success message
                          $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record update </div>';
                          redirectHome($theMsg,'back');
                        }
                
                        
                   }else { 
                    echo "<div class= 'container'> ";
                    $theMsg = ' <div class="alert alert-danger" >sorry You Cant Browse this  page Dirctly </div>';
                    redirectHome($theMsg);
                    echo "</div>";
                
                   }
                   echo "</div>";
                }elseif($action == 'Delete' ){
            //delete item  maner
            echo"<h1 class='text-center'> Delete item </h1>";
            echo "<div class='container'>";
            $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid'])? intval($_GET['itemid']) : 0;


            $check = checkItem('item_ID' ,'items',$itemid);

            if($check > 0){

            $stmt =$con->prepare("DELETE FROM items WHERE item_ID=:zid");
            $stmt->bindparam(":zid",$itemid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Delete </div>';
            redirectHome($theMsg,'back');
            }else{

                $theMsg = '<div class="alert alert-danger" >This ID Is Not Exist </div>';
                redirectHome($theMsg);
       
            }
            

     echo "</div>";
                }elseif($action == 'Approve' ){
          //Approve item  maner
          echo"<h1 class='text-center'> Approve item </h1>";
          echo "<div class='container'>";
          $itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid'])? intval($_GET['itemid']) : 0;


          $check = checkItem('item_ID' ,'items',$itemid);

          if($check > 0){

          $stmt =$con->prepare("UPDATE items SET Approve = 1 WHERE item_ID = ?");
        
          $stmt->execute(array($itemid));
          $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Delete </div>';
          redirectHome($theMsg,'back');
          }else{

              $theMsg = '<div class="alert alert-danger" >This ID Is Not Exist </div>';
              redirectHome($theMsg, 'back');

          }


      echo "</div>";
                }

       include $tpl . 'footer.php' ; 
}else {


  header('location: index.php');
  exit();
}
ob_end_flush();
?>