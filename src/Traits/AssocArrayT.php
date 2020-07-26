<?php

namespace OOPe\Traits;



use function Autil\_;
use OOPe\Traits\ArrayT;


/*--------------
   <<trait>>
   AssocArrayT
----------------
  
----------------
   
------------------*/
trait AssocArrayT {
   
   use ArrayT{
      //self::contain insteadof ArrayT; //### doen't work
      ArrayT::contain as _contain;
   }
   
   /** 
    * predicateFn whether specified property($str) is exists
    * 
    * @return boolean
    * @param string $str 
    *        assocarray $asoc 
    **/
   function contain($str){
      $assoc = $this->_value;
      
      if( empty($assoc) ){
         return;
      } else {
         $res = null;
         
         foreach($assoc as $key=>$val){
            if( strpos($str, $key) !== false || strpos($str, $val) !== false ){
               $res = true;
            }
         }
         return $res;
      }
   }
}












