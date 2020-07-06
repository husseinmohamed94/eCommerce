<?php
ob_start();
session_start();
$pageTitle = 'Homepage';
include "init.php";
?>

<div class="container">


<div class="row"> 
      <?php  
      $allitems = getAllFrom('*','items',' where Approve = 1','' ,'item_ID');
    
      foreach( $allitems as $item){
      echo '<div class ="col-sm-6 col-md-3"> ';
           echo '<div class="card item-box">';      
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

          }?>
  </div>
  
</div>
        
<?php
 include $tpl . 'footer.php' ; 
 ob_end_flush(); 
 ?>
