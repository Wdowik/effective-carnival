<?php

declare(strict_types=1);

namespace App;

__DIR__."../View/view.php";

__DIR__."../Database.php";

__DIR__."..//Model/Model.php";

class NoteEditController
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

    public function edit(): void                          
    {
        $this->view();
        $view = $this->view;
        if(empty($_SESSION['user'])){
          $view->list();
        } else {
        $view->view_picture();  
        $page      = 'edit';

        $user["login"] = $_SESSION['user'];

        $data = "editNote";
        $this->database();
        $database = $this->database;
        $database->editNote($user);
    }
    }

    public function edition_title(): void
    {
        // $user['user'] = $_SESSION['user'];

        $this->database();
        $this->database->editTitle();
    }

    public function action_view_edit_title(): void
    {
      $this->view();
      $this->view->view_editTitle();
    }

    public function ready_edition_title(): void
    {
        // $title['title'] = $_POST['title'];
        $this->database();
        $this->database->editionTitle();
    }

    public function edition_content(): void
    {
        $this->database();
        $this->database->editContent();
    }

    public function action_view_edit_content(): void
    {
      $this->view();
      $this->view->view_editContent();
    }

    public function ready_edition_content(): void
    {
        $this->database();
        $this->database->editionContent();
    }

    public function delete(): void
    {
        $this->database();
        $database = $this->database;

        $this->view_picture();
        $database->delete();
    }

    public function view_picture()
    {
      $this->database();
      $this->view();

      
      $database = $this->database;
      $view     = $this->view;   

      $database->view_picture();
      $view->view_picture();
    }

    public function delete_note(): void
    {        
        $data           = $_GET;
        $note['id']     = $data['id'];

        $this->database();
        $this->database->checkID($note);
       
         $login1 = $_SESSION['user2'];
         $login2 = $_SESSION['user'];
        
        if ($login1 == $login2) {
         $_SESSION['id'] = $data['id'];
        $this->database->deleteNote();
        }
        else 
        {
          $this->view();
          $view = $this->view;
          $view->error();
        }
    }

    public function edition(): void
    {
        $_SESSION['id_save'] = $_GET['id'];
        $this->model();
        $model = $this->model;
        $model->checkID(); 
    }

    public function editionView(): void
    {  
      $this->view();  
      $this->view->editionView();
    }

    public function finishedEdition(): void
    {
      $this->view();
      $this->view->finishedEdition();
    }

}