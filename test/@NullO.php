<?php


require_once $_SERVER['DOCUMENT_ROOT']  ."/vendor/autoload.php";

use function Autil\_, Autil\type, Autil\pretty;
use OOPe\Classes\NullO;


$obj = new NullO();
_( $obj->getProps() );
_( $obj->getMethods() );