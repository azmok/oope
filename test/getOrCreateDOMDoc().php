<?php


require_once __DIR__  ."/autoload_test.php";

use function Autil\_, Autil\type, Autil\getOrCreateDOMDoc;
use OOPe\Classes\DOMDoc;





$str = <<<'DOC'
require "demo.php";

$heredoc = <<<HEREDOC
this is
multiline
sentence
HEREDOC;

echo "hi";
$a = "Woo!";
DOC;


$doc = new DOMDoc();

# create code block
$pre = (getOrCreateDOMDoc())
   ->create("pre")
   ->appendTo('body');

$code = (getOrCreateDOMDoc())
   ->create("code")
   ->text($str)
   ->attr("class", "language-php")
   ->appendTo($pre);
   
$doc->render();
   








/**/









   
















