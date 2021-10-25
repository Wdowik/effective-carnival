<?php

declare(strict_types=1);

namespace App;

__DIR__."../View/view.php";

__DIR__."../Database.php";

class UserController
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
   
    public function test()
    {
      echo "testowanko";
    }

    public function login(): void
    {
      $this->view();
      $view = $this->view;
      echo "Welcome to function login";
      if(!empty($_SESSION['user']))
            {
              $view->user();
              $id      = 2;
            }
            else {
            $view->login();
            $id        = 1;
            }
    }

    public function badRepeatPassword(): void
    {
      $this->view();
      $this->view->badRepeatPassword();
    }

    public function passwordChange(): void
    {
      $this->view();
      $view = $this->view;
      if(empty($_SESSION['user'])) {
        $view->list();
        $id   = 1;
      } else {
        $view->passwordChange();
        $id   = 4;
      }
    }

    public function changePasswordDatabase(array $data): void
    {
    $this->database();  
    $this->database->changePassword($data);
    }

    public function passwordChanged(): void
    {
      $this->database();
      $this->model->changePassword();
    }

    public function logout(): void
    {
        session_destroy();
        // $data = false;
        // $data = $this->logged;
        $this->view();
        $view = $this->view;
        $view->list_logout();
        

    }

    public function checking_login(): void
    {
      $this->database();
      $database = $this->database;
      $database->ver_user();
    }

    public function register(): void
    {
      echo "Witamy w funkcji register";
      $this->view();
      $view = $this->view;
      if(!empty($_SESSION['user']))
            {
              $view->list();
              
            } else {
              $view->register();
               
            }    
    }

    public function createUser(): void
    {
            echo "CreateUser";
            echo "<br></br>";
            $this->model();
            $model = $this->model;
            $model->createUser();
    }

    public function settings()
    {
        $this->view();
        $view = $this->view;
        $view->settings();
    }

    public function logged($data)
    {
      $data = $this->logged;
    }

    public function registrationCompleted()
    {
      $this->view();
      $view = $this->view;
      $view->list();
    }

    public function save_login($data)
    {
      $this->login = $data;
     
    }

    public function view_user()
    {
      $this->view();
      $view_user = $this->view;
      $view_user->user();
    }

    public function addProfilePicture()
   {    
        $this->view();
        $this->view->addProfilePicture();
    }

    public function addlike()
    {
      $this->database();
      $database = $this->database;
      $database->addlike();

      $bang = "zero";
      return $bang;
    }

    public function addComment()
    {
      dump($_POST);

      if(empty($_POST['addComment'])){
        echo "<br></br>";
        echo "Pusty komentarz.";
        echo "<br></br>";
      }
      else{
      $this->database();
      $database = $this->database;
      $database->addComment();
      // Bselectnote


      }

          $_SESSION['commentadded'] = 1;
          $request['get']['action'] = "Bselectnote";
          $user = new Controller($request);
          $user->run($request);

    }

    public function checkID(): array
    {
      $this->database();
      $database = $this->database;
      $database->checkID();

      $bang['test'] = "test"; // Randomowy zapis w celu cofnięcia się do wcześniejszej metody.
      return $bang;
    }

    public function checkData(array $data): array
    {

      $this->database();
      $database = $this->database;
      $database->checkData($data);

      $bang['test'] = "test"; // Random w celu cofnięcia do funkcji.
      return $bang;
    }

    public function chal(string $noteName, $login): void
    {
      $this->database();
      $database = $this->database;
      $database->chal($noteName, $login);
    }

    public function deletelike(): void
    {
      $notename = $_GET['noteName'];
      $login    = $_GET['login'];
      

      $this->database();
      $database = $this->database;
      $database->deletelike($notename);

      $id          = $_GET['id'];
      $login       = $_GET['login'];
      $noteName    = $_GET['noteName'];
      $noteContent = $_SESSION[$id]['content'];
      $pawsup      = $_SESSION[$id]['pawsup'];

      $this->view();
      $view = $this->view;
      $view->viewNote($noteName, $noteContent, $pawsup, $login);
    }

    public function view_afterlike(): void
    {
      $this->view();
      $view = $this->view;

      $id          = $_GET['id'];
      $login       = $_GET['login'];
      $noteName    = $_GET['noteName'];
      $noteContent = $_SESSION[$id]['content'];
      $pawsup      = $_SESSION[$id]['pawsup'];

      $view->viewNote($noteName, $noteContent, $pawsup, $login);
    }

    public function display_comments($login, $noteName): void
    {
        echo "<br></br>";
        echo $login;
        echo "<br></br>";
        echo $noteName;

        $this->database();
        $database = $this->database;
        $database->display_comments($login, $noteName);
    }
    
    public function morecomments(): void
    {
      $this->database();
      $database = $this->database;
      $database->morecomments();
    }

    public function morecommentstwo(): void
    {
      $this->database();
      $database = $this->database;
      $database->morecommentstwo();
    }


}