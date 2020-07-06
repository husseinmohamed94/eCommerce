<?php

  function lang ($phrase){
    static $lang = array(
      'MESSAGE' => 'مرحبا ',
      'ADMIN'  => 'مدير التطبيق'
    );
    return $lang[$phrase];
  }
