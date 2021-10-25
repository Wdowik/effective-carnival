<?php

declare(strict_types=1);

namespace App;

__DIR__."../View/view.php";

__DIR__."../Database.php";

class NoteCreateController
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

    private function database_view($data): void
    {
       $this->database();
       $database = $this->database;
       $database->$data();
    }

    public function creation(): void
    {
      // $this->database();
      // $this->database->view_notes();
  
      $this->view();
      $view = $this->view;
      if(empty($_SESSION['user'])) {
        $view->list();
      } else {
        $this->view_picture();  
      $view->create();
      }
    }

    public function badCreation(): void
    {
      $this->view();
      $view = $this->view;
      $view->badCreation();
    }

    public function create(): void
    {
      $this->database();
      $this->database->createNote();
    }

    public function note_created(): void
    {
            $this->view();
            $this->view->note_created();
    }

    public function view_picture()
    {
      $data = "view_picture";
      $this->view();
      $this->database_view($data);
      $view     = $this->view;   

      $view->view_picture();
    }
}