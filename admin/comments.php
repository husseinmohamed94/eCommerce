<?php

/*
==================================
== Manage comment page
== You can edit | detele }Approve comments  from herr
==================================
*/

session_start();
$pageTitle = 'comments';


if (isset($_SESSION['Username'])) {

                include 'init.php';
                $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
                    //start comment page
                if($action == 'Manage'){ //Manage MuMbers page
                   
                  
                    //selcte all uers expcet admin 
                    $stmt = $con->prepare("SELECT 
                    comments.*, items.Name AS itemName , users.Username 
                    FROM
                    comments
                    INNER JOIN 
                    items
                    ON
                    items.item_ID = comments.item_ID
                    INNER JOIN
                    users
                    ON 
                    users.UserID = comments.UserID
                    ORDER BY 
                    c_id DESC");
                // execute the statemnt 
                $stmt->execute();
                //assign to varible
                $comments = $stmt->fetchAll();
                if(!empty($comments)){        
  ?>

    <h1 class="text-center">Manage commemts</h1>
    <div class="container">
            <div class="table-responsive">
                <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>     
                   <td>comment</td>     
                   <td>Item Name</td>     
                   <td>user Name</td>     
                   <td>added Date</td>   
                   <td>control</td>       
                      </tr>
                      <?php 
                        foreach($comments as $comment){
                                 echo "<tr>";
                                 echo "<td>" . $comment['c_id'] . "</td>";
                                 echo "<td>" . $comment['comment'] . "</td>";
                                echo "<td>" . $comment['itemName'] . "</td>";
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
     </div>
     <?php     }else{
                 echo '<div class="container">';
                      echo '<div class ="nic-message "> There\'s comments To show </div>';
                  '</div>';
               } ?>

     <?php   }elseif($action == 'Edit'){//edit page 

                $comid = isset($_GET['comid'])&& is_numeric($_GET['comid'])? intval($_GET['comid']) :   0 ;
                $stmt = $con->prepare(" SELECT * FROM  comments WHERE c_id = ?  ");
                $stmt->execute(array($comid));
                $comment = $stmt->fetch();
                $count = $stmt->rowcount();

                    if($count > 0){ ?>
                                <h1 class="text-center">Edit commentr</h1>
                            <div class="container">
                            <form class="form-horizontal" action ="?action=Update" method ="POST">
                                <input type="hidden" name="comid" value ="<?php echo $comid ?> " />
                                    <!--start comment filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">comment</label>
                                                <div class="col-sm-10 col-md-6">
                                                    <textarea
                                                    
                                                      name ="comment"
                                                      class ="form-control" 
                                                      required ="required" >
                                                      <?php echo $comment['comment']?>

                                                    </textarea>
                                            </div>
                                        </div>
                                                <!--end username filed -->
                

                                                    <!--start submit filed -->
                                    <div class="form-group form-group-lg">
                                                <div class="col-sm-offset-2 col-sm-10  ">
                                                    <input type ="submit" value ="comment" class ="btn btn-primary btn-lg" />
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
    echo" <h1 class='text-center'>update comment</h1>";
    echo "<div class='container'> ";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Get varibles form the form
            $id             = $_POST['comid']; 
            $comment        = $_POST['comment'];
    
            //  update the datebase with this info
          $stmt = $con->prepare(" UPDATE  comments SET comment = ?  WHERE c_id = ? ");
          $stmt->execute(array($comment ,$id));
          //echo success message
          $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record update </div>';
          redirectHome($theMsg,'back');
        

        
   }else { 
    echo "<div class= 'container'> ";
    $theMsg = ' <div class="alert alert-danger" >sorry You Cant Browse this  page Dirctly </div>';
    redirectHome($theMsg);
    echo "</div>";

   }
   echo "</div>";

}elseif($action == 'Delete'){
    //delete comment  maner
              echo"<h1 class='text-center'> Delete comment </h1>";
              echo "<div class='container'>";
        $comid = isset($_GET['comid'])&& is_numeric($_GET['comid'])? intval($_GET['comid']) :   0 ;
     

         $check = checkItem('c_id' ,'comments',$comid);

            if($check > 0){

            $stmt =$con->prepare("DELETE FROM comments WHERE c_id = :zcid");
            $stmt->bindparam(":zcid",$comid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Delete </div>';
            redirectHome($theMsg,'back ');


            }else{

                $theMsg = '<div class="alert alert-danger" >This ID Is Not Exist </div>';
                redirectHome($theMsg);
       
            }
            

     echo "</div>";

}elseif($action = 'Approve'){
 //Activate meber  maner
 echo"<h1 class='text-center'> Approve comment </h1>";
 echo "<div class='container'>";
$comid = isset($_GET['comid'])&& is_numeric($_GET['comid'])? intval($_GET['comid']) :   0 ;


$check = checkItem('c_id' ,'comments',$comid);

if($check > 0){

$stmt =$con->prepare("UPDATE comments SET  status = 1 WHERE c_id = ? ");
$stmt->execute(array($comid));
$theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Approve </div>';
redirectHome($theMsg,'back');


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

