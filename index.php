<?php

declare(strict_types=1);

namespace App;
use PDO;
use Exception;
use mysqli;
session_start();


try {
require_once("src/utils/debug.php");
require_once("./src/Controller/AbstractController.php");    
// require_once("./src/Controller/A_NoteCreateController.php");
// require_once("./src/Controller/B_NoteSearchController.php");
// require_once("./src/Controller/C_NoteEditController.php");
// require_once("./src/Controller/D_UserController.php");
require_once("./src/Controller/controller.php");

$configuration = require_once("config/config.php");


$request = [ 
    'get'  => $_GET,
    'post' => $_POST
];

// $test['a'] = $request['get']['action'];
// $abc  = strlen($test['a']);
// dump($test['a']);

// $abc -= 2;

// $intA = 2;
// $a   = 0;
// for($int=1; $int<=$abc; $int++) {
//     $tescior['h'][$a] = $test['a'][$intA];
//     $a++;
//     $intA++;
//     echo $int;
// }

// $table = $request['get']['action'];

// require_once("./src/Model/calculations.php");

// $table = "123456";

// $a = new calculations();
// $a->deleting_two_letters($table);

// $table = $request['get']['action'];

AbstractController::initConfiguration($configuration);
(new controller($request))->run();
// if(empty($table)){
//     dump($table);
//     (new controller($request))->run();
// }
// if($table[0] == "a"){
//     $test['a'] = $request['get']['action'];
// // $abc  = strlen($test['a']);
// // dump($test['a']);

// // $abc -= 2;

// // $intA = 2;
// // $a   = 0;
// // for($int=1; $int<=$abc; $int++) {
// //     $tescior['h'][$a] = $test['a'][$intA];
// //     $a++;
// //     $intA++;
// //     echo $int;
// // }

// $ready = $tescior['h'];
//     (new NoteCreateController($ready))->run();
//     }
// if($table[0] == "b"){
//     $test['a'] = $request['get']['action'];
// $abc  = strlen($test['a']);
// dump($test['a']);

// $abc -= 2;

// $intA = 2;
// $a   = 0;
// for($int=1; $int<=$abc; $int++) {
//     $tescior['h'][$a] = $test['a'][$intA];
//     $a++;
//     $intA++;
//     echo $int;
// }

// $ready = $tescior['h'];
//     (new NoteSearchController($ready))->run();
//     }
// if($table[0] == "c"){
//     $test['a'] = $request['get']['action'];
// $abc  = strlen($test['a']);
// dump($test['a']);

// $abc -= 2;

// $intA = 2;
// $a   = 0;
// for($int=1; $int<=$abc; $int++) {
//     $tescior['h'][$a] = $test['a'][$intA];
//     $a++;
//     $intA++;
//     echo $int;
// }

// $ready = $tescior['h'];
//     (new NoteEditController($ready))->run();
//     }
// if($table[0] == "d"){
//     $test['a'] = $request['get']['action'];
// $abc  = strlen($test['a']);
// dump($test['a']);

// $abc -= 2;

// $intA = 2;
// $a   = 0;
// for($int=1; $int<=$abc; $int++) {
//     $tescior['h'][$a] = $test['a'][$intA];
//     $a++;
//     $intA++;
//     echo $int;
// }

// $ready = $tescior['h'];
//     (new Controller($ready))->run();
//     }
// if($request[0] = "e"){
//     (new Controller($request))->run();
//     }            

// ControllerUser::initConfiguration($configuration);
// (new ControllerUser($request))->run();

} catch (Exception $e) {
    dump($e->getMessage());
    dump($e->getTraceAsString());
    
};