<?php

namespace Helper;



require_once dirname( dirname( dirname(__DIR__))) ."/autoload.php";

use function Autil\_, Autil\type, Autil\pretty, Autil\length, Autil\match;
use OOPe\Classes\ArrayO;




const TABCHAR = "&emsp;&emsp;&emsp;";
const SPACES = ' |&emsp;|&ensp;|\t';


function splitSpaces($str){
   global $spaces;
   $pat = "%^(".  SPACES  .")*(.*?)(".  SPACES  .")*$%";
   $replacer = function($matches){
      
      return $matches[2];
   };
   $replaced = preg_replace_callback($pat, $replacer, $str);
   
   return $replaced;
}

function splitSpacesAll($str){
   $pat = "%(".  SPACES  .")*%";
   
   $replacer = function($matches){
      
      return "";
   };
   $replaced = preg_replace_callback($pat, $replacer, $str);
   return $replaced;
}

function repeat($str, $count=1){
   $_str = "";
   for($i = 0; $i < $count; $i++){
      $_str .= $str;
   }
   return $_str;
}

function prependBreak($str){
   return "<br/>".  $str;
}

function appendBreak($str){
   return $str  ."<br/>";
}

function prependTab($str, $count=0){
   return repeat(TABCHAR, $count)  .  $str;
}

function appendTab($str, $count=0){
   return $str  .  repeat(TABCHAR, $count);
}

function deleteSpaces($str, $count=1, $mode='end'){
   global $spaces;
   $beginPat = "%^($spaces){0,$count}(.*?)$%"; 
   $endPat = "%^(.*?)({$spaces}){0,$count}$%"; 
   
   $beginReplacer = function($matches){
      return $matches[2];
   };
   $endReplacer = function($matches){
      return $matches[1];
   };
   
   if( $mode === 'end' ){
      $replaced = preg_replace_callback($endPat, $endReplacer, $str);
      return $replaced;
      
   
   } else {
      $replaced = preg_replace_callback($beginPat, $beginReplacer, $str);
      return $replaced;

   }
}


function toBlock($str){
   $thenBreakThenTabChar = "\{|,|\}";
   $thenSpaceChar = '\:';
   $arr = str_split($str);
   $str = "";
   $depth = 0;
   $prevChar = "";
   
   foreach( $arr as $char){
      if( $char === "{" ){
         
         $depth += 1;
         
         $str .= $char;
      } elseif( $char === "}" ){         
         $depth -= 1;
         
         $char = prependTab($char, $depth);
         $char = prependBreak($char);
         
         $str .= $char;
      } elseif(  $char === "," ){
         $str .= $char;
   
      } else {
         if( preg_match("%{$thenBreakThenTabChar}%", $prevChar) ){
            $char = prependTab($char, $depth);
            $char = prependBreak($char); /**/
         }
         $str .= $char;
      }
      $prevChar = $char;
   }
   return $str;
};













