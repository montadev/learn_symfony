<?php

namespace App\Service;

use App\Service\MySecondService;

class Myservice{


     public function __construct()
     {
         
        
       // dump("hi");
     }


     public function postFlush(){

         dump('hello word event');
     }
}