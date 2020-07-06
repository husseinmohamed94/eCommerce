<?php

  function lang ($phrase){
    static $lang = array(
      // 
      // Deshbord page
        
        //navbar links
         
        'HOME_ADMIN'        =>' Home ',
        'categories'        =>' categories',
        'ITEMS'             =>'items  ',   
        'MENBERS'           =>'members',
        'COMMENTS'          =>'Comments',
        'STATISTICS'        =>'statistics',
        'LOGS'              =>'logs',
        ''                  =>'',
        ''                  =>'',
        ''                  =>'',
        ''                  =>'',
       
        
        
    );
    return $lang[$phrase];
  }
