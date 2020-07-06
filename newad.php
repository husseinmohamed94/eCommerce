<?php
session_start();
$pageTitle = 'create New Item';

include "init.php";

if(isset($_SESSION['user'])){


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
      $avatarName =  $_FILES['image']['name'];
      $avatarsize =  $_FILES['image']['size'];
      $avatarTmp  =  $_FILES['image']['tmp_name'];
      $avatarType =  $_FILES['image']['type'];
      //list of Allowed File type to Upload
      $avatarAllowedExtension = array("jpeg","jpg","png","gif");
      // get avater Extension 
  
      $avatarExtensionna = explode('.',$avatarName);

      $avatarExtension = strtolower(end($avatarExtensionna));
  //Get varibles form the form
        $formErrors = array();
        $name        = filter_var($_POST['Name'],FILTER_SANITIZE_STRING);
        $desc         = filter_var($_POST['Descrption'],FILTER_SANITIZE_STRING); 
        $pric         = filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
        $country      = filter_var($_POST['country'],FILTER_SANITIZE_STRING);
        $status       = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT); 
        $category     = filter_var($_POST['categroy'],FILTER_SANITIZE_NUMBER_INT);
        $tags        = filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
        
        
        if(strlen($name) < 4 ){
            $formErrors[] = 'Item Title Must Be At Least 4 Character ';
            }
        if(strlen($desc) < 10 ){
            $formErrors[] = 'Item decstion Must Be At Least 10 Character ';
            }
        if(strlen($country) < 2 ){
            $formErrors[] = 'Item country Must Be At Least 2 Character ';
            }
        if(empty($pric)){
            $formErrors[] = 'Item price Must Be Not Empty ';
            }
        if(empty($status)){
            $formErrors[] = 'Item status Must Be Not Empty ';
            }
            if(empty($category)){
            $formErrors[] = 'Item catogory Must Be Not Empty ';
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


            if(empty($formErrors)){
                
            $avatar = rand(0,100000000) . '_' . $avatarName ;
            move_uploaded_file($avatarTmp,"uploads\avatars\\". $avatar);
                //  insert useru=info datebase w
            $stmt = $con->prepare(" INSERT INTO 
                          items(Name,Descrption,price,country_made,image, status,Add_date,Member_ID,cat_ID,tags) 
                          VALUES(:zname,:zdesc,:zprice,:zcounty,:zimage,:zststus,now(),:zmember,:zcat,:ztags)");
           $stmt->execute(array(
               'zname'       => $name, 
               'zdesc'       => $desc,
                'zprice'     => $pric,
                'zcounty'    => $country,
                'zststus'    => $status,
                'zcat'       => $category,
                'zmember'    => $_SESSION['uid'],
                'ztags'      => $tags,
                'zimage'     => $avatar
                
            ));
    
              //echo success message
              if($stmt){

                $succesMsg = 'Item Has Been Added ';
              }
             
        
             }
            
/* end if is set _SERVER  */ }
?>

<h1 class="text-center"><?php echo $pageTitle;  ?></h1>
    <div class="create-ad block">
         <div class="container">
                <div class="card">
                        <div class="card-header bg-primary"><?php echo $pageTitle;  ?></div>
                        <div class="card-body">
                          <div class="row">
                                <div class="col-md-8">
                                <form class="form-horizontal main-form" action ="<?php echo $_SERVER['PHP_SELF']  ?>" method ="POST" enctype="multipart/form-data">
                            
                                     <!--start Name filed -->
                                    <div class="form-group form-group-lg">
                                        
                                            <label class="col-sm-3 control-label">Name</label>
                                                          <div class="col-sm-10 col-md-9">
                                                             <input
                                                                   pattern=".{4,}"
                                                                   title="This filed Require At Least 4 chracters"
                                                                    type ="text"
                                                                    name ="Name"
                                                                    class ="form-control live"
                                                                    required ="required"
                                                                    placeholder = "Name  of the Item" 
                                                                    data-class =".live-title"  />
                                                            </div>
                                        </div>
                                            <!--end Name filed -->
                                             <!--start Descrption filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-3 control-label">Descrption</label>
                                                          <div class="col-sm-10 col-md-9">
                                                                  <input 
                                                                  pattern=".{10,}"
                                                                  title="This filed Require At Least 10 chracters"
                                                                    type ="text" 
                                                                    name ="Descrption" 
                                                                    class ="form-control live" 
                                                                    placeholder = "Descrption  of the Item "
                                                                    data-class =".live-desc"  />
                                                                  </div>
                                                        </div>
                                            <!--end Descrption filed -->
                                              <!--start price filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-3 control-label">price</label>
                                                          <div class="col-sm-10 col-md-9">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="price" 
                                                                    class ="form-control live" 
                                                                    placeholder = "price  of the Item "
                                                                    data-class =".live-price" 
                                                                    required ="required" />
                                                                  </div>
                                                        </div>
                                            <!--end price filed -->
                                         <!--start country_made filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-3 control-label">country</label>
                                              <div class="col-sm-10 col-md-9">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="country" 
                                                                    class ="form-control" 
                                                                    required ="required"
                                                                    placeholder = "country of made  of the Item  " />
                                                                  </div>
                                                        </div>
                                            <!--end country_made filed -->
                                                   <!--start status filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-3 control-label">status</label>
                                              <div class="col-sm-10 col-md-9">
                                             <select name="status"  required >
                                                    <option value="0">...</option>
                                                    <option value="1">New</option>
                                                    <option value="2">Link New</option>
                                                    <option value="3">used</option>
                                                    <option value="4"> very Old</option>
                                            </select>            
                                                   </div>
                                                        </div>
                                            <!--end status filed -->
                                           
                                             <!--start categroy filed -->
                                    <div class="form-group form-group-lg">
                                       <label class="col-sm-3 control-label">categroy</label>
                                              <div class="col-sm-10 col-md-9">
                                             <select name="categroy"  required >
                                                    <option value="0">...</option>
                                                   <?php
                                                 $cats= getAllFrom('*','categories','','','ID');
                                                 
                                                   foreach($cats as $cat){
                                                    echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";  
                                                   }
                                                   
                                                   ?>
                                            </select>            
                                                   </div>
                                                        </div>
                                            <!--end categroy  filed -->
                                            <!--start tags filed -->
                                         <div class="form-group form-group-lg">
                                           <label class="col-sm-3 control-label">Tags</label>
                                                <div class="col-sm-10 col-md-9">
                                                                  <input 
                                                                    type ="text" 
                                                                    name ="tags" 
                                                                    class ="form-control" 
                                                                    placeholder = "separate Tags with comma (,)  " 
                                                                    value ="" />
                                                             </div>
                                                        </div>
                                            <!--end tags filed -->
                                            <div class="form-group form-group-lg">
                                                  <label class="col-sm-2 control-label">img  item</label>
                                                     <div class="col-sm-10 col-md-6">
                                                         <input type ="file"
                                                           name ="image" 
                                                           class ="form-control live"
                                                          data-class =".live-img" 
                                                         required ="required"  />
                                                  </div>
                                              </div>
                                                <!--start submit filed -->
                                              <div class="form-group form-group-lg">
                                                                    <div class="col-sm-offset-3 col-sm-9  ">
                                                                        <input type ="submit"
                                                                        value ="Add Category" 
                                                                        class ="btn btn-primary btn-sm" />
                                                                          </div>
                                                            </div>
                                             <!--end submit filed -->
                                                   </form>
                                </div>
                                <div class="col-md-4">
                               <div class="card item-box live-preview">  
                                   <span class="price-tag ">$<span class="live-price">0</span></span>;           
                                  <img class="card-img-top img-responsive live-img"  src="img.png" alt=""/> 
                                <div class="card-body">
                                  <h3  class="card-title live-title">Titel</h3>
                                  <p class="card-text live-desc">Descriptuin</p>
                                      </div>
                                    </div>
                                 </div>
                           </div>
                            <!-- start looping Through Errors -->                            
                                <?php
                                if(! empty ($formErrors)){
                                    foreach($formErrors as $error){
                                        echo '<div class="alert alert-danger" >' . $error . '</div>';
                                    }
                                }
                                if(isset($succesMsg)){
                                  echo '<div class="alert alert-success">'. $succesMsg .  '</div>';
  
                              }
                                ?>
                              <!-- end looping Through Errors -->    
                       </div>
                    </div>
               </div>
         </div>


<?php
}else{
            header('location:login.php');
            exit();
}
 include $tpl . 'footer.php'; 
 ?>