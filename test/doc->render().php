<?php


require_once __DIR__  ."/autoload_test.php";

use function Autil\_, Autil\type, Autil\getOrCreateDOMDOC;
use OOPe\Classes\DOMDoc, OOPe\Classes\DOMElm;




$str = <<<'DOC'

<?php

require "demo.php";

echo "hi";
$a = "Woo!";
DOC;


# check if '$doc' was previously defined or not 
$doc = getOrCreateDOMDOC();

# create code block
$pre = $doc
   ->create("pre")
   ->appendTo('body');

$code = $doc
   ->create("code")
   ->text($str)
   ->attr("class", "language-php")
   ->appendTo($pre);


$doc->render();









   
















