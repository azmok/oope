<?php

namespace OOPe\Classes;



use OOPe\Traits\ObjectT, OOPe\Traits\ArrayT;
use OOPe\Classes\NullO;


use function Autil\_, Autil\type, Autil\prettify, Autil\pretty, Autil\isAssoc, Autil\isArray, Autil\length,
Autil\loadCss, Autil\loadJs, Autil\escape,

Autil\contain, Autil\concat, Autil\prependTab, 
Autil\head, Autil\indexOf, Autil\_forEach, Autil\append, Autil\merge, Autil\some, Autil\every, Autil\isOneDimensional, 
Autil\object2String, 
Autil\inject, Autil\render;



/*-------------------------
    assocArrayO
---------------------------
   - <Arr> _value = [];
   - <Num> _length = 0;
   - <Num>_cursor = 0;
   - <Arr> _keysArr = []
   - <Arr> _container = []
----------------------------
   <<ObjectT>>
   <<ArrayT>>
   
   value()
   length()
   
   concat()
   indexOf()
   map()
   filter()
   reduce()
/*-------------------------*/



class AssocArrayO {
   
   use AssocArrayT;
   
   
   
   function __construct($assoc, $flags=0){
      # 
      if( $assoc === null || empty($assoc) ){
         return;
      }
      
      ### set $_length, 
      $this->_length = count($this->_keysArr);
      ### set readOnky prop
      $this->length = $this->_length;

      
      ## if $val is AsscoArr, recursively set $val as 'AssocArrayO'
      if( isOneDimensional($assoc) ){
         ### assing key to object' prop
         foreach($assoc as $key=>$val){
            
            ## for <<iterator>> initialize
            $this->_keysArr[] = $key;
            
            ## initializing for <<ArrayAccess>>
            $this->_value[$key] = $val;
            
            # iniitlizeing object key-val
            $this->$key = $val;
            //_( $key, $this->$key );
         }
         
        
      ### multi dimensional assoc
      } else {
      
         foreach($assoc as $key=>$val){
            //_( $key, $val );
            
            ## for <<iterator>> initialize
            $this->_keysArr[] = $key;
            
            ### $val: isAssoc
            if( isAssoc($val) ){
               # initializing for <<ArrayAccess>>
               $this->_value[$key] = new AssocArrayO($val);
               
               # initlizeing object key-val
               $this->$key = new self($val);
         
            ### $val: no Assoc
            } else {
               ## initializing for <<ArrayAccess>>
               $this->_value[$key] = $val;
               
               ## # initlizeing object key
               $this->$key = $val;
            }
         }
      }
   }
   
}



























