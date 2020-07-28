<?php


require_once dirname( dirname( dirname(__DIR__))) ."/autoload.php";
require "beautify.php";


use function Autil\_, Autil\type, Autil\pretty;
use OOPe\Classes\ArrayO;




$arr = new ArrayO( [1,2,3] );

//_( $arr );

$ref = new ReflectionClass("OOPe\Classes\ArrayO");

ob_start();

$ref::export($ref);


$contents = ob_get_contents();

// #clear output buffer
ob_end_clean();


//_( $contents );

$res = strtr($contents, [
   "\n" => ""
]);
_( $res );
_( Helper\toBlock($res) );








