<?php
ob_start();
session_start();
$pageTitle = 'categories';


if (isset($_SESSION['Username'])) {

                include 'init.php';
                $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';
                 if($action == 'Manage'){
                    $sort = 'ASC';
                    $sort_array = array('ASC0','DESC');
                    if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){
                        $sort = $_GET['sort'];
                    }
                    $stmt2 =$con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY  Ordering $sort");
                    $stmt2->execute();
                    $cats = $stmt2->fetchAll();
                    if(! empty($cats)){  
                    ?>
                        <h1 class="text-center" > Manage categories</h1>
                        <div class="container categories">
                        <div class="card">
                            <div class="card-header"> <i class="fa fa-edit"></i>Mange Categoris
                            
                        <div class="option pull-right">
                        <i class="fa fa-sort"></i>  ordering:[
                            <a class='<?php if($sort == 'ASC'){ echo 'active';} ?>' href="?sort=ASC">Asc</a> |
                            <a class='<?php if($sort == 'DESC'){ echo 'active';} ?>' href="?sort=DESC">Desc</a>
                            ]
                            <i class="fa fa-eye"></i> View:[ 
                         <span class="active" data-view="full">Full </span> |
                         <span data-view="classic">Classic</span>
                         ]
                        </div>
                            </div>
                            <div class="card-body">
                                  <?php
                                  foreach($cats as $cat){
                                        echo "<div class='cat'>"; 
                                        echo "<div class='hidden-buttons'>";
                                            echo"<a href='categories.php?action=Edit&catid=".$cat['ID']."' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i>Edit</a> ";
                                            echo"<a href='categories.php?action=Delete&catid=".$cat['ID']."'  class='confirm btn btn-xs btn-danger'><i class='fa fa-close'></i>Delete</a> ";
                                        echo"</div>";
                                        echo '<h3>' . $cat['Name'] .'</h3>';
                                        echo "<div class='full-view'>";
                                                    echo "<p>"; if($cat['Descrption']==''){echo 'This categore has no descrption ';}else{echo $cat['Descrption'];}  echo "</p>";
                                                if($cat['Visibilty'] == 1){ echo '<span class="visibility vspan"><i class="fa fa-eye"></i> Hidden</span>';}
                                                if($cat['Allow_Comment'] == 1){ echo '<span class="commenting vspan"><i class="fa fa-close"></i>comment Disabled</span>';}
                                                if($cat['Allow_Ads'] == 1){  echo '<span class="advertieses vspan"><i class="fa fa-close"></i>Asd Disabled </span>';}
                                      
                                                   /* Get child Categories */
                                                  $childcats= getAllFrom("*","categories","where parent ={$cat['ID']}","","ID", "ASC");
                                                  if(! empty($childcats)){
                                                    echo "<h4 class ='child-head'> Child Categores </h4>";
                                                    echo "<ul class='list-unstyled child-cats'>";
                                                    foreach($childcats as $child){
                                                    echo "<li class='child-link'> 
                                                    <a href='categories.php?action=Edit&catid=".$child['ID']."'>" . $child['Name'] . "</a>
                                                    <a href='categories.php?action=Delete&catid=".$child['ID']."'  class='show-delete confirm'></i>Delete</a>
                                                    </li>";
                                                        
                                               }     
                                               echo "</ul>";
                                            }

                                                echo "</div>";
                                               
                                        echo "</div>";
                                    echo "<hr>";
                                  }
                                  ?>
                            </div>
                          </div>
                        <a class="add-catgory btn btn-primary" href="categories.php?action=Add"><i class="fa fa-plus"></i>Add New Category</a>
                        </div>
                        <?php     }else{
                 echo '<div class="container">';
                      echo '<div class ="nic-message "> There\'s catgory To show </div>';
          echo ' <a class="add-catgory btn btn-primary" href="categories.php?action=Add"><i class="fa fa-plus"></i>Add New Category</a> ';
                  '</div>';
               } ?>

                    <?php
                 }elseif($action == 'Add' ){?>

                          <h1 class="text-center">Add New Categoris</h1>
                          <div class="container">
                               <form class="form-horizontal" action ="?action=Insert" method ="POST">
                            
                                     <!--start Name filed -->
                                    <div class="form-group form-group-lg">
                                            <label class="col-sm-2 control-label">Name</label>
                                                        <div class="col-sm-10 col-md-6">
                                                            <input type ="text" name ="Name" class ="form-control" required ="required"    placeholder = "Name  of the categories  " />
                                                    </div>
                                        </div>
                                            <!--end Name filed -->
                                            <!--start Descrption filed -->
                                       <div class="form-group form-group-lg">
                                                    <label class="col-sm-2 control-label">Descrption</label>
                                                        <div class="col-sm-10 col-md-6">
                                        <input type ="text" name ="Descrption" class =" form-control"   placeholder = "Describe the categeoris  " />
                                                    
                                                        </div>
                                          </div>
                                            <!--end Descrption filed -->
                                             <!--start Ordering filed -->
                                          <div class="form-group form-group-lg">
                                                        <label class="col-sm-2 control-label">ordering</label>
                                                            <div class="col-sm-10 col-md-6">
                                                                <input type ="text" name ="Ordering" class ="form-control"  placeholder = "number to arrange the categories "  />
                                                        </div>
                                                  </div>
                                            <!--end Ordering filed -->
                                            <!--start category type -->
                                            <div class="form-group form-group-lg">
                                                        <label class="col-sm-2 control-label">parent?</label>
                                                            <div class="col-sm-10 col-md-6">
                                                             <select name="parent">
                                                            <option value="0">None</option>
                                                            <?php
                                                        $allCats =getAllFrom("*","categories","where parent = 0","","ID",  "ASC");
                                                        foreach($allCats as $cat){
                                                            echo "<option value='".$cat['ID']."'>".$cat['Name']."</option>";
                                                        }
                                                            ?>
                                                             </select>
                                                        </div>
                                                  </div>
                                               <!--end category type -->
                                             <!--start Visibilty filed -->
                                            <div class="form-group form-group-lg">
                                                    <label class="col-sm-2 control-label">Visible</label>
                                                    <div class="col-sm-10 col-md-6">
                                                            <div> 
                                                            <input id="vis-yes" type="radio" name="Visibilty" value="0" checked />
                                                            <label for="vis-yes">Yes</lable>  
                                                             </div>
                                                             <div> 
                                                            <input id="vis-no" type="radio" name="Visibilty" value="1" />
                                                            <label for="vis-no">No</lable>  
                                                             </div>
                                                    </div>
                                                </div>
                                               <!--end Visibilty filed -->
                                                 <!--start commenting filed -->
                                            <div class="form-group form-group-lg">
                                                    <label class="col-sm-2 control-label">Allow Comment</label>
                                                    <div class="col-sm-10 col-md-6">
                                                            <div> 
                                                            <input id="com-yes" type="radio" name="commenting" value="0" checked />
                                                            <label for="com-yes">Yes</lable>  
                                                             </div>
                                                             <div> 
                                                            <input id="com-no" type="radio" name="commenting" value="1" />
                                                            <label for="com-no">No</lable>  
                                                             </div>
                                                    </div>
                                                </div>
                                               <!--end commenting filed -->

                                                 <!--start Allow Ads filed -->
                                            <div class="form-group form-group-lg">
                                                    <label class="col-sm-2 control-label">Allow Ads</label>
                                                    <div class="col-sm-10 col-md-6">
                                                            <div> 
                                                            <input id="ads-yes" type="radio" name="ads" value="0" checked />
                                                            <label for="ads-yes">Yes</lable>  
                                                             </div>
                                                             <div> 
                                                            <input id="ads-no" type="radio" name="ads" value="1" />
                                                            <label for="ads-no">No</lable>  
                                                             </div>
                                                    </div>
                                                </div>
                                               <!--end Allow Ads filed -->
                                                <!--start submit filed -->
                                              <div class="form-group form-group-lg">
                                                            <div class="col-sm-offset-2 col-sm-10  ">
                                                                <input type ="submit" value ="Add Category" class ="btn btn-primary btn-lg" />
                                                        </div>
                                                    </div>
                                             <!--end submit filed -->
                                                   </form>
                                              </div>

                <?php
                 }elseif($action == 'Insert' ){
           
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                echo" <h1 class='text-center'>INsert categroies</h1>";
                                echo "<div class='container'> ";
                                    //Get varibles form the form
                                    $name                =  $_POST['Name'];
                                    $desc                =  $_POST['Descrption'];
                                    $parent              =  $_POST['parent'];
                                    $order               =  $_POST['Ordering'];
                                    $visible             =  $_POST['Visibilty'];
                                    $comment             =  $_POST['commenting'];
                                    $ads                 =  $_POST['ads'];
                                   
                               
                                //check if categories exite in Databases 
                                    $check = checkItem("Name","categories","$name");
                                    if($check == 1){
                                        
                                        $theMsg = '<div class="alert alert-danger" >Sorry This Category Exist </div>';
                                         redirectHome($theMsg,'back');
                                    }else{

                                    //  insert Categoryinfo datebase 
                            $stmt = $con->prepare("INSERT INTO 
                                                    categories(Name,Descrption,parent,Ordering,Visibilty, Allow_Comment,Allow_Ads) 
                                                    VALUES(:zname,:zdesc,:zparent,:zorder,:zvisble,:zcomment,:zads)");
                            $stmt->execute(array(
                                    'zname'      => $name, 
                                    'zdesc'      => $desc,
                                    'zparent'    => $parent,
                                    'zorder'     => $order,
                                    'zvisble'    => $visible,
                                    'zcomment'   => $comment,
                                    'zads'       => $ads
                                    
                                 ));

                                //echo success message
                                $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Inserted </div>';
                                redirectHome($theMsg,'back');

                                }
                                 
                        }else { 
                            echo "<div class= 'container'> ";
                            $theMsg = '<div class="alert alert-danger "> sorry You Cant Browse this  page Dirctly</div>';
                            redirectHome($theMsg,'back');

                            echo "</div>";
                        }
                        echo "</div>";

                }elseif($action == 'Edit' ){
                    //check if request catid is numbric &get its integer value
                    $catid = isset($_GET['catid'])&& is_numeric($_GET['catid'])? intval($_GET['catid']) :   0 ;
                    //select all data depend on this id
                    $stmt = $con->prepare(" SELECT * FROM  categories WHERE ID = ?   ");
                    //Exeuect query
                    $stmt->execute(array($catid));
                    //fetch the cdate
                    $cat = $stmt->fetch();
                    //the row count
                    $count = $stmt->rowcount();
                    // if there's no such Id show the form
                        if($count > 0){ ?>
                                
                                <h1 class="text-center">Edit New Categoris</h1>
                                <div class="container">
                                    <form class="form-horizontal" action ="?action=Update" method ="POST">
                                    <input type="hidden" name="catid" value ="<?php echo $catid ?> " />

                                            <!--start Name filed -->
                                            <div class="form-group form-group-lg">
                                                    <label class="col-sm-2 control-label">Name</label>
                                                                <div class="col-sm-10 col-md-6">
                                                                    <input type ="text" name ="Name" class ="form-control" required ="required" value="<?Php echo $cat['Name']; ?>"   placeholder = "Name  of the categories  " />
                                                            </div>
                                                </div>
                                                    <!--end Name filed -->
                                                    <!--start Descrption filed -->
                                            <div class="form-group form-group-lg">
                                                            <label class="col-sm-2 control-label">Descrption</label>
                                                                <div class="col-sm-10 col-md-6">
                                                <input type ="text" name ="Descrption" class =" form-control"  value="<?Php echo $cat['Descrption']; ?>"  placeholder = "Describe the categeoris  " />
                                                            
                                                                </div>
                                                </div>
                                                    <!--end Descrption filed -->
                                                    <!--start Ordering filed -->
                                                <div class="form-group form-group-lg">
                                                                <label class="col-sm-2 control-label">order</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <input type ="text" name ="Ordering" class ="form-control" value="<?Php echo $cat['Ordering']; ?>"   placeholder = "number to arrange the categories "  />
                                                                </div>
                                                        </div>
                                                    <!--end Ordering filed -->
                                                    <!--start category type -->
                                            <div class="form-group form-group-lg">
                                                        <label class="col-sm-2 control-label">parent? </label>
                                                            <div class="col-sm-10 col-md-6">
                                                             <select name="parent">
                                                            <option value="0">None</option>
                                                            <?php
                                                        $allCats =getAllFrom("*","categories","where parent = 0","","ID",  "ASC");
                                                        foreach($allCats as $childc){
                                                            echo "<option value='".$childc['ID']."'";
                                                            if($cat['parent'] ==$childc['ID'] ){ echo 'selected'; }
                                                           echo" >".$childc['Name']."</option>";
                                                        }
                                                            ?>
                                                             </select>
                                                        </div>
                                                  </div>
                                               <!--end category type -->
                                                    <!--start Visibilty filed -->
                                                    <div class="form-group form-group-lg">
                                                            <label class="col-sm-2 control-label">Visible</label>
                                                            <div class="col-sm-10 col-md-6">
                                                                    <div> 
                                                                    <input id="vis-yes" type="radio" name="Visibilty" value="0" <?php if($cat['Visibilty'] == 0){echo 'checked';} ?>  />
                                                                    <label for="vis-yes">Yes</lable>  
                                                                    </div>
                                                                    <div> 
                                                                    <input id="vis-no" type="radio" name="Visibilty" value="1" <?php if($cat['Visibilty'] == 1){echo 'checked';} ?> />
                                                                    <label for="vis-no">No</lable>  
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    <!--end Visibilty filed -->
                                                        <!--start commenting filed -->
                                                    <div class="form-group form-group-lg">
                                                            <label class="col-sm-2 control-label">Allow Comment</label>
                                                            <div class="col-sm-10 col-md-6">
                                                                    <div> 
                                                                    <input id="com-yes" type="radio" name="commenting" value="0" <?php if($cat['Allow_Comment'] == 0){echo 'checked';} ?>  />
                                                                    <label for="com-yes">Yes</lable>  
                                                                    </div>
                                                                    <div> 
                                                                    <input id="com-no" type="radio" name="commenting" value="1"   <?php if($cat['Allow_Comment'] == 1){echo 'checked';} ?>/>
                                                                    <label for="com-no">No</lable>  
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    <!--end commenting filed -->

                                                        <!--start Allow Ads filed -->
                                                    <div class="form-group form-group-lg">
                                                            <label class="col-sm-2 control-label">Allow Ads</label>
                                                            <div class="col-sm-10 col-md-6">
                                                                    <div> 
                                                                    <input id="ads-yes" type="radio" name="ads" value="0"  <?php if($cat['Allow_Ads'] == 0){echo 'checked';} ?> />
                                                                    <label for="ads-yes">Yes</lable>  
                                                                    </div>
                                                                    <div> 
                                                                    <input id="ads-no" type="radio" name="ads" value="1"  <?php if($cat['Allow_Ads'] == 1){echo 'checked';} ?>/>
                                                                    <label for="ads-no">No</lable>  
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    <!--end Allow Ads filed -->
                                                        <!--start submit filed -->
                                                    <div class="form-group form-group-lg">
                                                                    <div class="col-sm-offset-2 col-sm-10  ">
                                                                        <input type ="submit" value ="save" class ="btn btn-primary btn-lg" />
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

                }elseif($action == 'Update' ){

                    echo" <h1 class='text-center'>update category</h1>";
                    echo "<div class='container'> ";
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            //Get varibles form the form
                            $id            =$_POST['catid']; 
                            $name          =$_POST['Name'];
                            $desc          =$_POST['Descrption'];
                            $order         =$_POST['Ordering'];
                            $parent         =$_POST['parent'];
                            $visible       =$_POST['Visibilty'];
                            $comment       =$_POST['commenting'];
                            $ads           =$_POST['ads'];
                            //  update the datebase with this info
                          $stmt = $con->prepare(" UPDATE  categories SET Name = ? , Descrption = ? , Ordering = ? ,parent = ?, Visibilty = ? , Allow_Comment = ? ,Allow_Ads = ?  WHERE ID = ? ");
                          $stmt->execute(array($name , $desc ,$order,$parent,$visible,$comment,$ads ,$id));
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

                }elseif($action == 'Delete' ){
            //delete catagroy  maner
            echo"<h1 class='text-center'> Delete category </h1>";
            echo "<div class='container'>";
             //check if request catid is numbric &get its integer value
            $catid = isset($_GET['catid'])&& is_numeric($_GET['catid'])? intval($_GET['catid']) :   0 ;


            $check = checkItem('ID' ,'categories',$catid);

            if($check > 0){

            $stmt =$con->prepare("DELETE FROM categories WHERE ID = :zid");
            $stmt->bindparam(":zid",$catid);
            $stmt->execute();
            $theMsg = "<div class='alert alert-success text-center' >" . $stmt->rowcount()  . ' Record Delete </div>';
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
ob_end_flush();
?>