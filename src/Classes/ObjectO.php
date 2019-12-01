<?php

namespace OOPe\Classes;


use function Autil\isAssoc, Autil\object2String;

use OOPe\Traits\ObjectT;





class ObjectO{

   use ObjectT;
   
   
   
   function __construct($assoc=Null){
      if( is_null($assoc) ){
         $this->_value = Null;
         
      # argument is supplied 
      } elseif( isAssoc($assoc) ){
         foreach($assoc as $key=>$val){
         
            if( isAssoc($val) ){
               $this->{$key} = new self($val);
               
            # assing value
            } else {
               $this->{$key} = $val;
            }
         }
      } else {
         throw new \Exception("Invalid type of argument in __construct()".  __CLASS__);
      }
   }
   

   

   
   function  __toString(){
      return object2String($this); // Array, AssocArray, ObjectO
      //return (string) $this->valueOf(); // Number, Sting, Regex
      //return type($this); // Function, DOMDoc, DOMElm, 
   }
   
}
















