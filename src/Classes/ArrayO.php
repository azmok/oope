<?php

namespace OOPe\Classes;



//require_once $_SERVER['DOCUMENT_ROOT']  ."/__init__.php";

use OOPe\Traits\ObjectT, OOPe\Traits\ArrayT;

use function Autil\_, Autil\pretty, Autil\isArray, Autil\object2String;

/*--------------
   ArrayO
----------------
   - <Array> value
   - <Integer> length
   - <Integer> cursor
----------------
   <<ArrayT>>
   
   + append() : <Obj>
   + prepend() : <Obj>
   + length() : <Int>
   
   + concat() : <Array>
   + indexOf() : <Int>
   
   + map() : <Array>
   + filter() : <Array>
   + reduce() : <Array>
   

   + inspect() : Void
   + extract() : <Mixed>

   <<Arrayiterator>>
   + current
   + key
   + next
   + rewind
   + valid
------------------*/


class ArrayO extends \ArrayIterator{
   
   use ObjectT;
   use ArrayT;
   
   private $_value = [];
   private $_length = 0;
   #####  readOnly prop #####
   # public **$length;
   
   function __construct($val=[], $flags=0){
      # type check of $val
      if( isArray($val) ){
         parent::__construct($val, $flags);
         
         $this->_value = $val;
         $this->_length = count($val);
         
         # setting object prop
         $this->length = $this->_length;
         
         
      } else {
         throw new \Exception("Invalid type of arguments in ArrayO");
      }
   }
   

   function  __toString(){
      return object2String($this); // Array, AssocArray, 
      //return (string) $this->valueOf(); // Number, Sting, Regex
      //return type($this); // Function, DOMDoc, DOMElm, 
   }
   
   
   
}


















