<?php
 /*
    ** Get All function  v2.0
    ** function to  Get  All Records from sny database table
    ** 
    */
    function getAllFrom($field,$table,$where = NULL,$and = NULL,$orderfiled,$ordering = "DESC"){
        global $con;
   
        $getAll = $con->prepare("SELECT $field FROM $table $where $and ORDER BY $orderfiled $ordering");
        $getAll->execute();
        $All = $getAll->fetchAll();
        return $All;
    }



/*
*title vergin 1
**title function that echo the page title in case the pages
**has the varibles $pageTitle and echo defiult title othe pages


*/


    function getTitle(){
        global  $pageTitle ;
        if(isset($pageTitle)){
            echo $pageTitle;
        }else{
            echo 'Default';
            }
            }

    /*
    ** Home redirect function v2.0 بترجعك للصفحه معينه
    ** redierct function  ths function accept prarmaters]
    ** $theMsg = echo the theMsg message [error |success|warning]
    **$url = the link you want to Redirect to 
    ***$seconds = Seconds beforw redirction
    */
    function redirectHome ($theMsg ,$url = null , $seconds = 3 ){

        if($url == null){
            $url = 'index.php';
            $link = 'Homepage';
        }else{
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'previous page';
            
            }else{
                $url='index.php';
                $link = 'Homepage';
            }
        }
        echo $theMsg;


        echo "<div class='alert alert-info'>you will be Redirted to $link after $seconds seconds.</idv>";
        header("refresh:$seconds;url=$url");
        exit();
    }

    /* 
    ** check Itme function v1.0
    ** Function to check Item In Datebase [function accept prarmaters]
    ** select = the item to select [exaple :user ,item,catagories]
    ** $from = the table to select from [example :users,item ,catagories]
    ** $value =the value of select [example:name , box,electronics]
    */

    function checkItem($select ,$from,$value){
        global $con;

        $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statement->execute(array($value));
        $count = $statement->rowCount();
        return $count;
    }


    /* حساب عدد الاعضاء
    ** count number of Items function <v1 class="0"></v1>    **
    ** function to count number of items rows
    **$item = the is item
    **$tabel = the table  chooes from
    */

    function countItems($item , $tabel,$where){
        global $con;
        $stmt2 = $con->prepare("SELECT COUNT($item) FROM $tabel $where");
        $stmt2->execute();
      
      return $stmt2->fetchcolumn();

    }

    /*
    ** Get latest Records function تسخدم في ععرض البيابات اخر الممستخدمين
    ** function to get lstest items from datebases [users,Items ,comments]
    ** $select = fied to select
    ** $tabel = the table to choose from
    ** $limit = Number of records to get
    ** $order = the order of number 
    */
    function getlatest($select,$tabel ,$order ,$limit = 5 ){
        global $con;
        $getstmt =$con->prepare("SELECT $select FROM $tabel ORDER BY $order DESC LIMIT $limit");
        $getstmt->execute();
        $rows = $getstmt->fetchAll();
        return $rows;

    }

    