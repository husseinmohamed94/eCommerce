<?php

/*
==================================
== Manage Members page
== You can add | edit | detele Mebbers from herr
==================================
*/

session_start();
$pageTitle = 'Members';


if (isset($_SESSION['Username'])) {

                include 'init.php';
                $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
                    //start Manage page
                if($action == 'Manage'){ //Manage MuMbers page
                   
                    $query='';
                    if(isset($_GET['page'])&& $_GET['page'] =='pending'){
                        $query = 'AND Regstatus = 0';
                    }
                    //selcte all uers expcet admin 
                $stmt = $con->prepare("SELECT * FROM users  WHERE GroupID != 1 $query ORDER BY UserID DESC");
                // execute the statemnt 
                $stmt->execute();
                //assign to varible
                $rows = $stmt->fetchAll();
                    if(! empty($rows)){

                   
                
  ?>

    <h1 class="text-center">Manage Member</h1>
    <div class="container">
            <div class="table-responsive">
                <table class="main-table managr-members text-center table table-bordered">
                <tr>
                   <td>#ID</td>     
                   <td>Avatar</td> 
                   <td>username</td>     
                   <td>Email</td>     
                   <td>FullName</td>     
                   <td>Registerd Date</td>   
                   <td>control</td>       
                      </tr>
                      <?php 
                        foreach($rows as $row){
                                 echo "<tr>";
                                 echo "<td>" . $row['UserID'] . "</td>";
                                 echo "<td>";
                                 if(empty($row['avatar'])){
                                      echo "<img class='card-img-top img-responsive'  src='eCommerce/img.png' alt=''/> ";
                                    }else{
                                     echo " <img src='uploads/avatars/" . $row['avatar'] ."' alt ='' /> ";
                                    }

                                 echo "</td>";
                                 echo "<td>" . $row['Username'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>" . $row['FullName'] . "</td>";
                                echo "<td>" . $row['Date'] . "</td>";
                                echo "
                                <td>
                                <a href ='members.php?action=Edit&UserId=" .$row['UserID'] ."' class='btn btn-success'><i class ='fa fa-edit'></i>Edit</a>  
                                <a href ='members.php?action=Delete&UserId=" .$row['UserID'] ."' class='btn btn-danger confirm'><i class ='fa fa-close'></i>Delete</a>"; 
                                if($row['Regstatus'] == 0){
                                  echo " <a href ='members.php?action=Activate&UserId=" .$row['UserID'] ."' class='btn btn-info '><i class ='fa fa-check'></i>Acivate</a>"; 
                                }
                                echo " </td>";
                            echo "</tr>";

                        }
                      ?>
                    
                </table>
                </div> 
            <a href="members.php?action=Add" class="btn btn-primary"><i class= "fa fa-plus"></i>  New Mumber</a>
              </div>
               <?php     }else{
                 echo '<div class="container">';
                      echo '<div class ="nic-message "> There\'s Rocord To show </div>';
                       echo '<a href="members.php?action=Add" class="btn btn-primary"><i class= "fa fa-plus"></i>  New Mumber</a>';
                  '</div>';
               } ?>

   




     <?php   }elseif($action == 'Add'){   //Add mubmers page
    ?>
  
    <h1 class="text-center">Add member</h1>
    <div class="container">
    <form class="form-horizontal" action ="?action=Insert" method ="POST" enctype="multipart/form-data">
        
            <!--start username filed -->
            <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10 col-md-6">
                            <input type ="text" name ="Username" class ="form-control" required ="required"    placeholder = "username to login into show  " />
                    </div>
                </div>
                        <!--end username filed -->

                <!--start password filed -->
                <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">password</label>
                        <div class="col-sm-10 col-md-6">
           <input type ="password" name ="password" class ="password form-control" required ="required"  placeholder = " password must be hard & complx  " />
             <i class="show-pass fa fa-eye fa-2x"></i>          
        </div>
                </div>
                        <!--end password filed -->
            <!--start Email filed -->
            <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10 col-md-6">
                            <input type ="email" name ="Email" class ="form-control" required ="required"     placeholder = "Email must be vaild "  />
                    </div>
                </div>
                        <!--end Email filed -->

        <!--start fulllname filed -->
            <div class="form-group form-group-lg">
                    <label class="col-sm-2 control-label">fullname</label>
                        <div class="col-sm-10 col-md-6">
                            <input type ="text" name ="fullname" class ="form-control " required ="required"    placeholder = "Full appear IN Your profile page" />
                    </div>
                </div>
                        <!--end fullname filed -->
                <!--start prefile image filed -->
                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">user Avatar</label>
                                        <div class="col-sm-10 col-md-6">
                                            <input type ="file" name ="avatar" class ="form-control" required ="required"  />
                                    </div>
                                </div>
                                        <!--end  prefile image filed -->`

                            <!--start submit filed -->
            <div class="form-group form-group-lg">
                        <div class="col-sm-offset-2 col-sm-10  ">
                            <input type ="submit" value ="AddMumber" class ="btn btn-primary btn-lg" />
                    </div>
                </div>
                        <!--end submit filed -->



</form>
</div>

 <?php
 
}elseif($action == 'Insert'){
    //Insert Mubmer page


   
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        echo" <h1 class='text-center'>INsert member</h1>";
        echo "<div class='container'> ";
              // upload varibles  
            
              $avatarName =  $_FILES['avatar']['name'];
              $avatarsize =  $_FILES['avatar']['size'];
              $avatarTmp  =  $_FILES['avatar']['tmp_name'];
              $avatarType =  $_FILES['avatar']['type'];
              
              //list of Allowed File type to Upload
                $avatarAllowedExtension = array("jpeg","jpg","png","gif");
                // get avater Extension 
            
                $avatarExtensionna = explode('.',$avatarName);

                $avatarExtension = strtolower(end($avatarExtensionna));
            //Get varibles form the form
            $user         =  $_POST['Username'];
            $pass         =  $_POST['password'];
            $email        =  $_POST['Email'];
            $name         =  $_POST['fullname'];
            $hashpass     =  sha1($_POST['password']);
            
        //validate the form
        $formErrors = array();
        if(strlen($user) < 4 ){
            $formErrors[] = 'Username cant be less than<strong> 4 charchat</strong> ';
 
        }
        if(strlen($user)  > 20 ){
            $formErrors[] = 'Username cant be less max than <strong>20 charchat</strong>';
 
        }
        if(empty($user)){
            $formErrors[] = 'Username cant be <strong>empty</strong>';
        
        }
        if(empty($pass)){
            $formErrors[] = 'password cant be <strong>empty</strong>';
        
        }
        if(empty($name)){
            $formErrors [] = 'Fullname cant be <strong>empty</strong>';
        
        }
        if(empty($email)){
            $formErrors [] = 'Email cant be <strong>empty</strong>';
        }
        if(!empty($avatarName) && !in_array($avatarExtension,$avatarAllowedExtension)){
            $formErrors [] = 'This Extension Is Not <strong>Allwode</strong>';
        }
        if(empty($avatarName)){
            $formErrors [] = 'AVatar Is  <strong>Required</strong>';
        }
        if($avatarsize > 4194304){
            $formErrors [] = 'AVatar Cant be Larger than <strong>4MB</strong>';
        }
        foreach($formErrors as $error){
            echo "<div class='alert alert-danger text-center'>" . $error . '</div>';
        }
        //check if there's no error proceed the update operation
        
        if(empty($formErrors)){
            //check if user exist in Databse 

         
         $avatar = rand(0,100000000) . '_' . $avatarName ;
        move_uploaded_file($avatarTmp,"uploads\avatars\\". $avatar);
         
            $check = checkItem("Username","users","$user");
             if($check == 1){
                 
                 $theMsg = '<div class="alert alert-danger" > sorry this user esixt </div>';
                 redirectHome($theMsg,'back');
             }else{

            //  insert useru=info datebase w
     $stmt = $con->prepare("INSERT INTO users(Username,Password,Email,FullName, Regstatus,Date,avatar) 
                                        VALUES(:zuser,:zpass,:zemail,:zname,1,now(),:zavatar)");
       $stmt->execute(array(
           'zuser'       => $user, 
           'zpass'       => $hashpass,
            'zemail'     => $email,
            'zname'      => $name,
            'zavatar'    => $avatar    
        ));

          //echo success message
          $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Inserted </div>';
          redirectHome($theMsg,'back');

           }
         }
         
   }else { 
       echo "<div class= 'container'> ";
       $theMsg = '<div class="alert alert-danger "> sorry You Cant Browse this  page Dirctly</div>';
       redirectHome($theMsg,'back');

       echo "</div>";
   }
   echo "</div>";


  }elseif($action == 'Edit'){//edit page 

                $userId = isset($_GET['UserId'])&& is_numeric($_GET['UserId'])? intval($_GET['UserId']) :   0 ;
                $stmt = $con->prepare(" SELECT * FROM  users WHERE UserID = ?  LIMIT 1 ");
                $stmt->execute(array($userId));
                $row = $stmt->fetch();
                $count = $stmt->rowcount();

                    if($count > 0){ ?>
                                <h1 class="text-center">Edit member</h1>
                            <div class="container">
                            <form class="form-horizontal" action ="?action=Update" method ="POST"  enctype="multipart/form-data">
                                <input type="hidden" name="UserId" value ="<?php echo $userId ?> " />
                                    <!--start username filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">Username</label>
                                                <div class="col-sm-10 col-md-6">
                                                    <input type ="text" name ="Username" class ="form-control" value="<?php echo $row['Username']?>" required ="required" />
                                            </div>
                                        </div>
                                                <!--end username filed -->
                    
                                        <!--start password filed -->
                                        <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">password</label>
                                                <div class="col-sm-10 col-md-6">
                                                    <input type ="hidden" name ="oldPassword" value="<?php echo $row['Password']?>" />
                                                    <input type ="password" name ="newPassword" class ="form-control"  placeholder = "leav lank if you dont want to change" />
                                            </div>
                                        </div>
                                                <!--end password filed -->
                                    <!--start Email filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10 col-md-6">
                                                    <input type ="email" name ="Email" class ="form-control"  value="<?php echo $row['Email']?>"  required ="required"  />
                                            </div>
                                        </div>
                                                <!--end Email filed -->
                    
                                <!--start fulllname filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">fullname</label>
                                                <div class="col-sm-10 col-md-6">
                                                    <input type ="text" name ="fullname" class ="form-control "   value="<?php echo $row['FullName']?>"  required ="required" />
                                            </div>
                                        </div>
                                                <!--end fullname filed -->
                    
                                    <!--start prefile image filed -->
                                    <div class="form-group form-group-lg">
                                                <label class="col-sm-2 control-label">user Avatar</label>
                                                <div class="col-sm-10 col-md-6">
                                                    <input type ="file" name ="avatar" class ="form-control"    />
                                                 <?php echo " <img  class='card-img-top img-responsive updat-imag'  src='uploads/avatars/" . $row['avatar'] . " ' alt =''"; ?> /> 
                                              </div>
                                        </div>
                                  <!--end  prefile image filed -->`

                                                    <!--start submit filed -->
                                    <div class="form-group form-group-lg">
                                                <div class="col-sm-offset-2 col-sm-10  ">
                                                    <input type ="submit" value ="Save" class ="btn btn-primary btn-lg" />
                                            </div>
                                        </div>
                                                <!--end submit filed -->
                    


                        </form>
                    </div>
                    


    <?php
    }else{

      

        echo "<div class= 'container'> ";
        $theMsg = ' <div class="alert alert-danger" > thers NO Such ID </div>';
        redirectHome($theMsg);
        echo "</div>";
        

    }
    }elseif ($action == 'Update') { //update page
    echo" <h1 class='text-center'>update member</h1>";
    echo "<div class='container'> ";

    $avatarName =  $_FILES['avatar']['name'];
    $avatarsize =  $_FILES['avatar']['size'];
    $avatarTmp  =  $_FILES['avatar']['tmp_name'];
    $avatarType =  $_FILES['avatar']['type'];
    
    //list of Allowed File type to Upload
      $avatarAllowedExtension = array("jpeg","jpg","png","gif");
      // get avater Extension 
  
      $avatarExtensionna = explode('.',$avatarName);

      $avatarExtension = strtolower(end($avatarExtensionna));

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Get varibles form the form
            $id          =$_POST['UserId']; 
            $user        =$_POST['Username'];
            $email       =$_POST['Email'];
            $name        =$_POST['fullname'];
            $avatar      =$_FILES['avatar'];
            //passwors trick
        $pass= empty($_POST['newPassword']) ? $_POST['oldPassword'] : sha1($_POST['newPassword']);
        //validate the form
        $formErrors = array();
        if(strlen($user) < 4 ){
            $formErrors[] = 'Username cant be less than<strong> 4 charchat</strong> ';
 
        }
        if(strlen($user)  > 20 ){
            $formErrors[] = 'Username cant be less max than <strong>20 charchat</strong>';
 
        }
        if(empty($user)){
            $formErrors[] = 'Username cant be <strong>empty</strong>';
        
        }
        if(empty($name)){
            $formErrors [] = 'Fullname cant be <strong>empty</strong>';
        
        }
        if(empty($email)){
            $formErrors [] = 'Email cant be <strong>empty</strong>';
        }
        if(!empty($avatarName) && !in_array($avatarExtension,$avatarAllowedExtension)){
            $formErrors [] = 'This Extension Is Not <strong>Allwode</strong>';
        }
       /* if(empty($avatarName)){
            $formErrors [] = 'AVatar Is  <strong>Required</strong>';
        }*/
        if($avatarsize > 4194304){
            $formErrors [] = 'AVatar Cant be Larger than <strong>4MB</strong>';
        }
        foreach($formErrors as $error){
            echo "<div class='alert alert-danger text-center'>" . $error . '</div>';
        }
        //check if there's no error proceed the update operation
        if(empty($formErrors)){
            $avatar = rand(0,100000000) . '_' . $avatarName ;
            move_uploaded_file($avatarTmp,"uploads\avatars\\". $avatar);
   
             
            $stmt2=$con->prepare("SELECT * FROM users  WHERE Username = ?  AND UserID !=?");
            $stmt2->execute(array($user ,$id));
            $count = $stmt2->rowCount();
           if($count == 1){
              
               echo "<div class= 'container'> ";
               $theMsg = ' <div class="alert alert-danger" >sorry This Users Is Exist</div>';
               redirectHome($theMsg,'back');
               echo "</div>";
           }else{
               //  update the datebase with this info
          $stmt = $con->prepare(" UPDATE  users SET Username = ? , Email = ? , FullName = ? , Password = ? , avatar = ?  WHERE UserID = ? ");
          $stmt->execute(array($user , $email ,$name,$pass,$avatar,$id));
          //echo success message
          $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record update </div>';
          redirectHome($theMsg,'back');
           }
           
        }

        
   }else { 
    echo "<div class= 'container'> ";
    $theMsg = ' <div class="alert alert-danger" >sorry You Cant Browse this  page Dirctly </div>';
    redirectHome($theMsg);
    echo "</div>";

   }
   echo "</div>";

}elseif($action == 'Delete'){
    //delete meber  maner
              echo"<h1 class='text-center'> Delete member </h1>";
              echo "<div class='container'>";
        $userId = isset($_GET['UserId'])&& is_numeric($_GET['UserId'])? intval($_GET['UserId']) :   0 ;
     

         $check = checkItem('UserId' ,'users',$userId);

            if($check > 0){

            $stmt =$con->prepare("DELETE FROM users WHERE UserID = :zuser");
            $stmt->bindparam(":zuser",$userId);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Delete </div>';
            redirectHome($theMsg ,'back');


            }else{

                $theMsg = '<div class="alert alert-danger" >This ID Is Not Exist </div>';
                redirectHome($theMsg);
       
            }
            

     echo "</div>";

}elseif($action = 'Activate'){
 //Activate meber  maner
 echo"<h1 class='text-center'> Activate member </h1>";
 echo "<div class='container'>";
$userId = isset($_GET['UserId'])&& is_numeric($_GET['UserId'])? intval($_GET['UserId']) :   0 ;


$check = checkItem('UserId' ,'users',$userId);

if($check > 0){

$stmt =$con->prepare("UPDATE users SET  Regstatus =1 WHERE UserID = ? ");
$stmt->execute(array($userId));
$theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Update </div>';
redirectHome($theMsg);


}else{

  
   $theMsg = '<div class="alert alert-danger" >This ID Is Not Exist </div>';
   redirectHome($theMsg);
 

}


echo "</div>";

}

include $tpl . 'footer.php' ; 
}else {


  header('location: index.php');
  exit();
}

