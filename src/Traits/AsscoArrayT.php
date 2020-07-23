<?php

namespace OOPe\Traits;



use function Autil\_, Autil\isAssoc, Autil\_forEach, Autil\isArray, Autil\head, Autil\append, Autil\prepend,  Autil\merge, Autil\concat, Autil\joinWith, Autil\every;


/*--------------
   <<trait>>
   AssocArrayT
----------------
  
----------------
   
------------------*/
Trait AssocArrayT implements \ArrayAccess, \Iterator {
   
   use ObjectT;
   use ArrayT;
   
   
   
   private $_cursor = 0;
   private $_keysArr = [];
   
   
   
   /*--------------  <<ArrayAccess>>  --------------------
      - <Array> _container
      ----------------------------------------------------
      + offsetExists ( mixed $offset ) : bool
      + offsetGet ( mixed $offset ) : mixed
      + offsetSet ( mixed $offset , mixed $value ) : void
      + offsetUnset ( mixed $offset ) : void
   /*----------------------------------------------------*/
   function offsetExists($offset){
      _("in offsetExists");
   }
   function offsetGet($offset){
      //_( "in offsetGet");
      return $this->_value[$offset];
   }
   function offsetSet($offset ,$value){
      //_( "in offsetSet" );
      $this->_value[$offset] = $value;
   }
   function offsetUnset($offset){
      _( "unset");
   }
   
   
   
   /*******  <<Iterator>>  *****
      current ( void ) : mixed
      key ( void ) : scalar
      next ( void ) : void
      rewind ( void ) : void
      valid ( void ) : bool
   /****************************/
   function current() {
      //_( "in current()" ); 
      $key = $this->_keysArr[$this->_cursor];
      $val = $this->_value[$key];
      
      return $val;
   }
   function key(){
      //_( "in key()" ); 
      $key = $this->_keysArr[$this->_cursor];
      //_("key",  $key );
      return $key;
   }
   function next(){
      //_( "in next()" ); 
      $this->_cursor += 1;
   }
   function rewind(){
      //_( "in rewind()" ); 
      $this->_cursor = 0;
   }
   function valid(){
      //_( "in valid()" ); 
      return $this->_cursor  <  $this->_length;
   }
   
   function  __toString(){
      return object2String($this); // Array, AssocArray, 
      //return (string) $this->valueOf(); // Number, Sting, Regex
      //return type($this); // Function, DOMDoc, DOMElm, 
   }
   
}