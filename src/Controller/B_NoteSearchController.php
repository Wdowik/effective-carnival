<?php

declare(strict_types=1);

namespace App;

__DIR__."../View/view.php";

__DIR__."../Database.php";

class NoteSearchController
{
    private $config  = [
        'host'     => 'localhost',
        'database' => 'testowanie',
        'user'     => 'root',
        'password' => '' 
      ];
  
    private $view;
    private $database;
    private $model;
  
    private function view()
    {
      $this->view = new View();
    }
  
    private function database()
    {
      $this->database = new Database($this->config);
    }
  
    private function model()
    {
      $this->model = new Model();
    }

    public function top5()
    {
        $this->database();
        $this->database->view_notes();
    }

    public function selectNote()
    {
      echo "Znajdujemy się w selectnote.";
      if($_SESSION['commentadded'] == 0) {
        dump($_GET);
        dump($_SESSION);
        echo "<br></br>";
        echo "Commentadded = 0";
      $id            = $_GET['id'];
      $titleGet      = $_GET['title'];
      $titleSession  = $_SESSION[$id]['name'];

      $idNotes       = $_SESSION[$id]['login'];
      } else {

        echo '<br></br>';
        echo "Komentarz dodany";
        echo '<br></br>';
      $id            = $_SESSION['added'];
      $titleGet      = $_GET['noteName'];
      $titleSession  = $_SESSION[$id]['name'];

      $idNotes       = $_SESSION[$id]['login'];
      }


      if($titleGet==$titleSession){

      $name    = $_SESSION[$id]['name'];
      $content = $_SESSION[$id]['content'];
      $pawsup  = $_SESSION[$id]['pawsup'];
      $login   = $_SESSION[$id]['login'];

      $this->database();
      $database = $this->database;
      $database->verificationLike($idNotes, $login);

      $this->view();
      $view = $this->view;
      $view->viewNote($name, $content, $pawsup, $login, $idNotes);
      } else {
        $this->view();
        $view = $this->view;
        $view->list();
      }

      
    }
}