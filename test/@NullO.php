<?php


require_once dirname( dirname( dirname(__DIR__))) ."/autoload.php";



use function Autil\_, Autil\type, Autil\pretty;
use OOPe\Classes\NullO;


$obj = new NullO();
_( $obj->getProps() );
_( $obj->getMethods() );