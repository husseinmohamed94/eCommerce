<?php
session_start();
$pageTitle = 'Catgorise';

include "init.php"; ?>

        <div class="container">
       
          
          <div class="row"> 
                <?php 
                 // $category = isset($_GET['pageid'])&& is_numeric($_GET['pageid'])? intval($_GET['pageid']) : 0;
                if(isset($_GET['name'])){
                    $tag= $_GET['name']; 
                    echo "<h1 class='text-center'>". $tag ." </h1>";
                 $tagitems = getAllFrom("*","items","where tags LIKE '%$tag%' " ,"AND Approve =1 ","item_ID"); 
                foreach( $tagitems as $item){
                echo '<div class ="col-sm-6 col-md-3"> ';
                     echo '<div class="card item-box">';      
                            echo ' <span class="price-tag">'.$item['price'] . '</span>';           
                            echo '<img class="card-img-top img-responsive"  src="img.png" alt=""/> ';
                        echo '<div class="card-body">';  
                            echo '<h3  class="card-title"><a href="items.php?itemid='.$item['item_ID'].'">'.$item['Name'].'</a></h3>';
                            echo'<p class="card-text">'.$item['Descrption'].'</p>'; 
                            echo'<div class="date">'.$item['Add_date'].'</div>'; 
                        echo'</div>';
                      echo '</div>';
                echo'</div>';

                    }
                }else{
                        echo 'You Must Enter Tag  Name';
                }
                   
                     ?>
            </div>
            
        </div>
   
      
 <?php include $tpl . 'footer.php';?>
 