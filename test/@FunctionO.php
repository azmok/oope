<?php


require_once $_SERVER["DOCUMENT_ROOT"]  ."/vendor/autoload.php";


use function Autil\_, Autil\type, Autil\pretty;
use OOPe\Classes\FunctionO;





function add1($x){
   return $x + 1;
}
$add1 = function(){
   return $x + 1;
};

# must pass string of fully qualified name of function, or, simply, $varName
_( (new FunctionO('add1'))->name() ); // 'add1'
_( (new FunctionO( $add1 ))->name() ); // {closure}



# $fn->bind
$fn = new FunctionO(function($arg){
   _( $this->name ); 
   _( $arg); 
});
$obj = new \ArrayObject( [1,2,3,] );
$obj->name = "azu";
_( $obj->name ); // "azu"

$binded = $fn->bind($obj, "arg1");
// [Closure Object]
// [ArrayObject Object]

$binded();
// azu
// arg1



# FunctionO::curry

$add = function($x, $y){
   return $x + $y;
};
$c_add = FunctionO::curry($add);


/**** one stop partical application doesn't work. partically applied fn need to be assigned, then invoked.
//####  doeskn't work well  ######
_( $c_add(1)(2) ); // 3


//####  work  ######*/
$add2 = $c_add(2);
_( $add2(3) ); // 5







## fn: Closure
$fn = new FunctionO( function(){} );
_( $fn ); // [object FunctionO]

_( $fn->valueOf() ); // [object Closure]


## fn: primitive 
$add1 = new FunctionO('add1');
_( $add1 ); // [object FunctionO]
_( $add1->valueOf() ); // 'add1'


//echo gettype( 'OOPe\add1' ); // string
//_( type( 'add1' ) ); // [Function]





$add = function($a, $b){
   return $a + $b;
};
_( $add );
$add = new FunctionO($add);
_( $add );
_( $add(1,2) );

//_( $add(1)(3) ); syntax error:

/**/





















