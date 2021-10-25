<?php

declare(strict_types=1);

namespace App;

require_once("./src/utils/debug.php");
require_once("./src/Controller/AbstractController.php");
require_once("./src/View/view.php");
require_once("./src/Controller/D_UserController.php");

class Model 
{   

  public function changePassword(): void
  {
        $changepassword['change_password1']     = $_POST['change_password1'] ?? [];
        $changepassword['change_password2']     = $_POST['change_password2'] ?? [];
        $changepassword['new_change_password1'] = $_POST['new_change_password1'] ?? [];
        $changepassword['new_change_password2'] = $_POST['new_change_password2'] ?? [];

        dump($changepassword);

    if (empty($changepassword['change_password1'] 
                    & $changepassword['change_password2']
                    & $changepassword['new_change_password1']
                    & $changepassword['new_change_password2'])) {
                      $view = new View();
                      $view->user();
                      $id   = 2;
                    }
             else {       

             if($changepassword['change_password1'] == $changepassword['change_password2'])
             {
               if($changepassword['new_change_password1'] == $changepassword['new_change_password2']) {
                 $D_UserController = new UserController();
                 $D_UserController->changePasswordDatabase($changepassword);
               }
               else {
                 echo "Nowe hasła nie są takie same";
                 $view = new View();
                 $view->passwordChange();
               }
             }
             else {
               echo "Twoje drugie hasło się różni od pierwszego";
               $view = new View();
               $view->passwordChange();
             }
             $page = 'changePassword';
             $id   = 4;
            }
  }

  public function createUser(): void
  {
    $user["login"]          = $_POST["createLogin"];
    $user["password"]       = $_POST["createPassword"];
    $user["repeatPassword"] = $_POST["repeatPassword"];

    if ($user["password"] == $_POST["repeatPassword"])
    {

      $request['get']['action'] = 'b';
      $data = new Controller($request);
      $data ->createUserDatabase($user);
    }
    else 
    {
      $request['get']['action'] = 'badRepeatPassword';
      $data = new Controller($request);
    }
  }

  public function checkID(): void
  {
        $userData['id']   = $_GET['id'];
        $userData['name'] = $_GET['name'];
        $note['login']    = $_SESSION['user'];
        $id_save          = $_SESSION['id_save'];

        $data                     = new UserController();
        $data                     -> checkID();
        $data                     -> checkData($userData);

        unset($data);
        
        $login1 = $_SESSION['user2'];
        $login2 = $_SESSION['user'];

        if($_SESSION['checkData'] == true) {
        if($login1 == $login2)
        {         
        $_SESSION['id']    = $userData['id'];
        $request['get']['action'] = "CeditionView";
        }
        else {
          $request['get']['action'] = "Cedit";
        }
      } else {
        $request['get']['action'] = "Cedit";
      }



        $data                     = new Controller($request);
        $data                     -> run();
  }
   
}