<?php



# set GLOBAL
define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('VENDOR_ROOT', DOC_ROOT  .'/vendor');

/**  for dev  ****/
require VENDOR_ROOT  ."/azmok/autil/src/core.php";
use function Autil\_, Autil\type, Autil\concat, Autil\inject;
/**/


//define('VENDOR_DIR', __DIR__);
define('PROJECT_ROOT', dirname(__DIR__) );


function getJsonObject($path){
   $jsonStr = file_get_contents($path);
   $jsonObj = json_decode($jsonStr);
   
   return $jsonObj;
}



$pending = [];
function loadingFunctionFiles($pending){
/*
   _( ">> files(loading)" );
   _( '$pending :: in loadingFunc...() :: ', $pending );
/**/   
   foreach($pending as $composerJsonObj){
      $packageName = $composerJsonObj->name;
      $files = $composerJsonObj->autoload->files;
      $path = VENDOR_ROOT  ."/". $packageName ."/src";
   
      foreach( $files as $file ){
         $filePath = $path ."/". $file;
//         _( '$filePath', $filePath );
         require_once($filePath);
      }
   }
}

#####  (2) Set autoload(class, files)  ######
function setAutoload($composerJsonObj){
   global $pending;
   
   if( $composerJsonObj->autoload ){
   
      ##  class(autoloader)
      if( empty($composerJsonObj->autoload->files) ){
         
         ##  class loader
         spl_autoload_register(function($className) use($composerJsonObj){
         
/*
            _( ">>> ${className}'s Autoloader Fired <<<" );
            _( "${className}" );
            
/**/
            ##1. get( namespace, path ) 
            $packageName = $composerJsonObj->name;
            $psr4 = $composerJsonObj->autoload->{'psr-4'};
            $ns_path_assoc = get_object_vars( $psr4 );
            
            foreach( $ns_path_assoc as $key=>$val){
               $namespace = $key;
               $realPath = $val . "/";
            }
            ##2. convert( namespace -> path )
            $classFilePath = str_replace($namespace, $realPath, $className);
            $classFilePath = preg_replace('~\\\~', '/', $classFilePath);
            $classFilePath = VENDOR_ROOT  ."/". $packageName ."/". $classFilePath .".php";
            
            ##3. requiring files
            if( file_exists( $classFilePath ) ){
               require $classFilePath;
            }
         });
         
/*
            inject( ">> class autoloader registered! <<", "h1" );
            
/**/
         
            
      # files(loading files)
      } elseif( $composerJsonObj->autoload->files ){
      
/*
         _( "!!PENDING Files Loading!!");
         _( $composerJsonObj );
         
/**/
         $pending[] = $composerJsonObj;
      }
   }
}


function contain($str, $assoc){
   if( empty($assoc) ){
      return;
   } else {
      foreach($assoc as $key=>$val){
         if( strpos($str, $key) !== false || strpos($str, $val) !== false ){
            return true;
         }
      }
   }
}

$cache = [];


#####  (1) dependancy check & load  #####
function resolveDependancies($composerJsonObj, $depth=0){
   global $cache;
   
//   _( $composerJsonObj->name, "'s dependancy resoving process"  );
   $dependancies = $composerJsonObj->require;
   $props = get_object_vars($dependancies);
   
   ## each package
   foreach($props as $packageName=>$version){
      
/*
         inject( ">>> pkg :: {$packageName}", "h2");
      _( "");
      _( 'cache::' );
      _( $cache );
      _("");
/**/
      
      # return if alredy required
      if( contain($packageName, $cache) ){
      
/*
            inject("ALREADY cached!", "h3");
            
/**/
         continue;
         
      } else {
      
         # chche required package name
         $cache[$packageName] = $version;
     
         # get 'composer.json'
         $pathOfCompJson = VENDOR_ROOT ."/". $packageName ."/composer.json";
         $compJsonObj = getJsonObject($pathOfCompJson);
      
         ## (1) the project's dependancies
//         _( ">>> (1) {$packageName}'s dependancies" );
         resolveDependancies($compJsonObj, $depth+1);
         ## (2) a packages's autoload
//         _( ">>> (2) {$packageName}'s autoload" );
         setAutoload($compJsonObj);
      }
      
   }
}

function init(){
   global $pending;
   
   $mainProjectCompJson = PROJECT_ROOT ."/composer.json";
   $json = getJsonObject($mainProjectCompJson);
   
   ## (1) the project's dependancies
   
/*
      inject( "(1) the project's dependancies", "h1" );
      
/**/
   resolveDependancies($json);
   
   
   ## At last, loading function files
/*
   _( '$pending' );
   _( $pending );
   _("");
   inject( "loadingFunctionFiles()", "h1" );
   
/**/

   loadingFunctionFiles($pending);
}

init();


/**/



























