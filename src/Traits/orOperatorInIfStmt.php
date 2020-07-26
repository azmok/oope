<?php


$val = 6;
$a = 2;
$b = 3;
$c = 4;


if( $val === $a || $b || $c ){
   echo "hi"; // "hi"
}



/*******  mechanism  *****
  | if( $val === $a || $b || $c ){
  | 
   # evaluate with operator precedence
   # comparison operator has higher precedence than logical operator
   #    - https://www.php.net/manual/en/language.operators.precedence.php
  | if( ($val === $a) || $b || $c ){
  |
   # 
  | if( false || $b || $c ){
  | 
  | if( false || true || true ){


/************/