<?php

declare(strict_types=1);

namespace App;

require_once("./src/utils/debug.php");
require_once("./src/View/view.php");
require_once("./src/Database.php");
require_once("./src/Model/Model.php");
require_once("A_NoteCreateController.php");
require_once("B_NoteSearchController.php");
require_once("C_NoteEditController.php");
require_once("D_UserController.php");
require_once("calculation.php");

__DIR__."../View/view.php";

abstract class AbstractController
{
    private static $configuration = [];

    protected $database;
    protected $model;
    protected $request;
    protected $view;
    protected $logged;
    public $login;

    private $config  = [
        'host'     => 'localhost',
        'database' => 'testowanie',
        'user'     => 'root',
        'password' => '' 
      ];
    

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;

    }

    public function __construct(array $request)
    {
        $this->database = new Database(self::$configuration['db']);
        $database = $this->database;
        $database->view_notes();

        $this->request  = $request;
        $this->view     = new View();
        $this->model    = new Model();
      
    }

    private function database()
  {
    $this->database = new Database($this->config);
  }

    // public function run(): void
    // { 

    //     $viewParams = []; 
        
    //     $test = false;

    //     $a = $this->action();
        
    //     dump($a);
    //     if($a) {
    //       $this->$a();
    //     }        
    // }

    public function runz($data)
    {
        $letter = $data[0]; // writing a letter
        
        if(empty($data)){
            $data = "test";
        }

        $d  = strlen($data);
        echo "<br></br>";
        
        $d -= 1;

        
        $intA = "";
        $a   = 0;
        $suma = "";
        for($int=1; $int<=$d; $int++) {
            $test[$int] = $data[$int];
        }

        $t1 = $test[1];
        
        $t2 = $test[2];
        
        $t3 = $test[1] . $test[2];
        

        $calculation = new calculation();
        $calculation->calculation($d, $test);

        $action     = $_SESSION['action'];
        
        if($letter == "A") {
           $select_controller = new NoteCreateController($action);
           $select_controller->$action();
        }
        if($letter == "B") {
           $select_controller = new NoteSearchController($action);
           $select_controller->$action();
        }
        if($letter == "C") { 
           $select_controller = new NoteEditController($action);
           $select_controller->$action();
        }
        if($letter == "D") { 
           $select_controller = new UserController();
           $select_controller->$action();
        }
        
        // for ($int=1; $int<=$d; $int++) {
        //     $save = $tescior[$a] . $tescior[$b];

        //     dump($save);
        //     $a++;
        //     $b + 2;
        // }
        // echo "Zapis 'save':" . $save;
        // echo "test: " . $tescior['1'];
        // $test = $tescior['0'] . $tescior['1'];
        // // $test = $tescior['1'] + $tescior['2'];
        // dump($test);
        // dump($tescior);
        // echo $tescior;
        // $da['a'] = "test";
        // $test = new UserController($da);
        // $test->login();

        
    }

    private function action()
    { 
        $this->database();
        $database = $this->database;
        $database->view_notes();

        $a = "getRequestGet";
        $data = $this->$a();

        return $data['action'] ?? $this->view->list();
    }

    protected function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }

    public function view_picture()
    {
      $this->database->view_picture();
      $this->view->view_picture();
    }
}