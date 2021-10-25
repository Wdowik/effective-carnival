<?php

declare(strict_types=1);

namespace App;
use mysqli;
use mysqli_sql_exception;

define("MYSQL_CONN_ERROR", "Unable to connect to database.");
require_once("Controller/AbstractController.php");
require_once("session.php");
// require_once("View/view.php");

__DIR__."../View/view.php";


class Database
{
    private $dsn;
    private $controller;
    public $login;   

    public function __construct(array $config)
    {
        $this->validateConfig($config);
        $this->createConnection($config);
        
    }

    public function createNote(): void
    {
       
        $login   = $_SESSION['user'];
        $name    = $_POST['name'];
        $content = $_POST['content'];

       $verification_notes = mysqli_query($this->dsn, "SELECT * FROM notes WHERE name = '$name' and login = '$login'");
       $resultVer_notes    = mysqli_fetch_assoc($verification_notes);

       dump($resultVer_notes);

       if(!empty($resultVer_notes)) {
          $request['get']['action'] = "AbadCreation";

          $user = new Controller($request);
          $user->run($request);
       } else {

       $query = mysqli_query($this->dsn, "INSERT INTO notes (login, name, content) VALUES ('$login', '$name', '$content')");
      
       $result = mysqli_query($this->dsn, 'SELECT * FROM notes');
       $row    = mysqli_fetch_assoc($result);
       
       $request['get']['action'] = "Anote_created";
       
       $user = new Controller($request);
       $user->run($request);
       }

    }

    public function editNote(array $data): void
    {
        $login   = $data['login'];
        (int) $id      = 0;
        // $name    = ['name'];
        $content = 
        ['content'];
        $user = $_SESSION['user'];

        for ($int = 1; $int < 1000; $int++) {
            $query  = mysqli_query($this->dsn,
            "SELECT *
             FROM notes
             WHERE id = $int
             ");
        $row    = mysqli_fetch_assoc($query);
        
        
        if($row['login'] == $login)
        {
            $name       = $row['name'];
            $content['content'] = $row['content'];
            (int) $id                 = $row['id'];
            
            echo " </b>";
            echo "<b>Tytuł notatki: </b>";
            echo htmlentities($name);
            echo "<td>
                 <a href='/?action=Cedition&id=$id&name=$name'>Edytuj</a>
            </td>";
            
            echo "<br>";   
        }
        

        }

        echo "<a href='/?action=Dview_user'>Powrót</a>";
    }
    
    public function editContent(): void
    {
      (int) $id                 = $_SESSION['id'];

      $query_content            = mysqli_query($this->dsn, "SELECT * FROM notes WHERE id = '$id' ");
      $result                   = mysqli_fetch_assoc($query_content);
      $_SESSION['content']      = $result['content'];

      $request['get']['action'] = 'Caction_view_edit_content';

      $data                     = new Controller($request);
      $data                     -> run();
   }

public function editionContent(): void
{
    $content  = $_POST['content'];
    (int) $id = $_SESSION['id'];
    
    $query = mysqli_query($this->dsn,
    " UPDATE notes
      SET content = '$content'
      WHERE id    = '$id' 
    
    ");

    $query_content  = mysqli_query($this->dsn, "SELECT * FROM notes WHERE id = '$id' ");
    
    $result = mysqli_fetch_assoc($query_content);

    $request['get']['action'] = 'CfinishedEdition';

    $data                     = new Controller($request);
    $data                     -> run();
}

public function editTitle(): void
{
    (int) $id          = $_SESSION['id'];

    $query_title       = mysqli_query($this->dsn, "SELECT * FROM notes WHERE id = '$id'");
    $result            = mysqli_fetch_assoc($query_title);
    $_SESSION['title'] = $result['name'];

    $request['get']['action'] = "Caction_view_edit_title";
       
       $user = new Controller($request);
       $user->run($request);
}

public function editionTitle(): void
{
    (int) $id    = $_SESSION['id'];
    $title       = $_POST['title'];
    $query = mysqli_query($this->dsn, 
    " UPDATE notes 
      SET    name = '$title'
      WHERE id    = '$id'
    ");


    $query_title = mysqli_query($this->dsn, "SELECT * FROM notes WHERE id = '$id'");
    $result      = mysqli_fetch_assoc($query_title);

    $request['get']['action'] = 'CfinishedEdition';
    $data                     = new Controller($request);
    $data                     -> run();
}


    public function checkID(): array
    {
        $id            = $_GET['id'];
        $note['login'] = $_SESSION['user'];

        $query_check = mysqli_query($this->dsn, "SELECT * FROM notes WHERE id = '$id'");
        $result      = mysqli_fetch_assoc($query_check);
        
        $bang['login']     = $result['login'];
        $_SESSION['user2'] = $bang['login'];
        return $bang;
    }
    
    public function ver_user(): void
    {
         if(empty($_POST)) {
            $request['get']['action'] = 'user';
            $data                     = new Controller($request);
            $data                     -> run();
          } else {
     
       $login    = $_POST["login"];
       $password = $_POST["register"]; 

       $boombap  = $this->dsn->real_escape_string($login);

       $boombap2 = $this->dsn->real_escape_string($password);

       $query_login     = mysqli_query($this->dsn, "SELECT * FROM user WHERE login    ='$boombap'");
 
       $result_login     = mysqli_fetch_assoc($query_login); 
       
       $query_password     = mysqli_query($this->dsn, "SELECT * FROM user WHERE password    ='$boombap2'");
       $result_password = mysqli_fetch_assoc($query_password);

       (int) $id  = mysqli_insert_id($this->dsn);

       if(empty($result_login) || empty($result_password)) {
          
          $request['get']['action'] = "DbadRepeatPassword";
          $request['post']['id']     = 1;

          $user = new Controller($request);
          $user->run($request);
       }
       else {
          
        $request = [ 
            'get'  => $_GET,
            'post' => $_POST
        ];
        $this->login = $login;
       
        $request['get']['action'] = "Dview_user";
        $_SESSION['user'] = $login;
        
        $login2 = $login;
        $user = "user";

        $logged                   = true;
        $user_name                = $login;
        
           $this ->view_picture();
          $user = new Controller($request);
          $user -> run();
       }
    }
 }

    public function createUser(array $data): void
    {
        $login    = $data["login"];
        $password = $data["password"];
        $view = new View();
    
        $query_login     = mysqli_query($this->dsn, "SELECT * FROM user WHERE login    ='$login'");
        $result          = mysqli_fetch_assoc($query_login);


        if (empty($result)) {
        $query = mysqli_query($this->dsn, "INSERT INTO user (login, password) VALUES ('$login', '$password')");
        $this->photo_after_registration($data);
        $view ->completed_registration();
        }
        else {
        $view ->same_username();    
        }
        // $request['get']['action'] = 'registrationCompleted';
        
    }

    public function delete(): void
    {
        $login   = $_SESSION['user'];
        (int) $id      = 0;
        $name    = ['name'];
        
        if(empty($_SESSION['deletedNote'])){

        }
        if($_SESSION['deletedNote'] == 1) {
            echo "<b><span style='color: green'>Notatka została pomyślnie usunięta.</span></b>";
        }

        $_SESSION['deletedNote'] = 0;

        echo "<br></br>";

        for ($int = 1; $int < 1000; $int++) {
            $query  = mysqli_query($this->dsn,
            "SELECT *
             FROM notes
             WHERE id = '$int';
             ");
        $row    = mysqli_fetch_assoc($query);
            
        if($row['login'] == $login)
        {
            $name['name']       = $row['name'];
            $id                 = $row['id'];

            echo " </b>";
            echo "<b>Tytuł notatki: </b>";
            echo htmlentities($name['name']);
            echo "<td>
                 <a href='/?action=Cdelete_note&id=$id'>Usuń</a>
            </td>";
            
            echo "<br>";   
        }

        }
        echo "<a href='/'>Powrót</a>";

    }

    public function deleteNote(): void
    {
        (int) $id = $_SESSION['id'];

        $query = mysqli_query($this->dsn, 
        "DELETE FROM notes
        WHERE id = '$id' 
        ");

       $_SESSION['deletedNote'] = 1;

       $this->delete();
    }

    public function changePassword(array $data): void
    {
        $login       = $_SESSION['user'];
        $password    = $data["change_password1"] ?? []; 
        $newpassword = $data["new_change_password1"];
 
        $boombap  = $this->dsn->real_escape_string($login);
 
        $boombap2 = $this->dsn->real_escape_string($password);
 
        $query_login     = mysqli_query($this->dsn, "SELECT * FROM user WHERE login    ='$boombap'");

        $result_login     = mysqli_fetch_assoc($query_login); 
        
        $query_password     = mysqli_query($this->dsn, "SELECT * FROM user WHERE password    ='$boombap2'");
        $result_password = mysqli_fetch_assoc($query_password);
 
        (int) $id  = mysqli_insert_id($this->dsn);
        

        if(empty($result_login) || empty($result_password)) {
          echo "Złe hasło";
         }
         else {
            echo "Hasło zmienione";
          $query = mysqli_query($this->dsn,
          " UPDATE user 
            SET password = '$newpassword'
            WHERE login = '$boombap'");
        
         }     
   
    }
   
    public function photo_after_registration(array $data): void
    {
        $login = $data['login'];
        $photo = "https://i.pinimg.com/originals/f2/d2/f7/f2d2f7370e0dde93e9b71b7f68561ffa.jpg";

        $query_photo = mysqli_query($this->dsn, "INSERT INTO profilepicture (login, url) VALUES ('$login', '$photo')");
    }

    public function addProfilePicture(array $data): void
    {
        $picture = $data['picture'];
        $login   = $_SESSION['user'];

        $query_picture   = mysqli_query($this->dsn, "UPDATE profilepicture SET url = '$picture' WHERE login = '$login'");
        
        echo "Zdjęcie zostało pomyślnie dodane ;)";

        $request['get']['action'] = 'settings_after_add_photo';
        $data                     = new Controller($request);
        $data                     ->run();       
    }

    public function view_picture()
    {
        echo "<br></br>";
        if(empty($_SESSION['user'])) {
            exit("Wystąpił błąd, proszę skontaktować się z administratorem.");
        } else {
        $login       = $_SESSION['user'];

        $query_view  = mysqli_query($this->dsn, "SELECT * FROM profilepicture WHERE login = '$login' ");
        $result_view = mysqli_fetch_assoc($query_view);

        $_SESSION['picture'] = $result_view['url'];
        }
    }

    public function top_5()
    {
            $id = 0;

            for($i=1; $i <= 5; $i++) {
            $query_top   = mysqli_query($this->dsn, "SELECT content FROM notes LIMIT $id,5");
            $result_view = mysqli_fetch_assoc($query_top);
            $id++;
            };

    }
    
    public function sorting_like()
    {
       $query_sort = mysqli_query(
           $this->dsn, "SELECT like FROM notes ORDER BY like ASC");
       $result_view = mysqli_fetch_assoc($query_sort);
       $id = 0;

       for($i=1; $i <= 5; $i++) {
       $query_top   = mysqli_query($this->dsn, "SELECT content FROM notes LIMIT $id,5");
       $result_view = mysqli_fetch_assoc($query_top);
       $id++;
       };
    }

    public function view_notes() //Top 5 notes.
    {
        $id = 1;
        $number = 10;
        $query_view = mysqli_query(
            $this->dsn, "SELECT COUNT(*) from notes");
            $result_view = mysqli_fetch_assoc($query_view);

        $quantity = $result_view['COUNT(*)'];
        $table[] = [
            'id',
            'login',
            'name',
            'content',
            'views',
            'like'
        ];

        for($int=0; $int<=$quantity; $int++)
        {
           $query_view = mysqli_query(
               $this->dsn, "SELECT * from notes WHERE id = '$id'");
           $query_result = mysqli_fetch_assoc($query_view);     
           
           $table[$int]['id']      = $query_result['id'];
           $table[$int]['login']   = $query_result['login'];
           $table[$int]['name']    = $query_result['name'];
           $table[$int]['content'] = $query_result['content'];
           $table[$int]['views']   = $query_result['views'];
           $table[$int]['like']    = $query_result['pawsup'];

           $id++;

        }

        $like_notes[$quantity] = 0;


        for($i=0; $i<=$quantity; $i++) {
            $like_notes[$i] = $table[$i]['like'];
        }

        rsort($like_notes);
        echo "<br></br>";

        //$query_view  = mysqli_query($this->dsn, "SELECT * FROM profilepicture WHERE login = '$login' ");
        // $result_view = mysqli_fetch_assoc($query_view);


        for($i=0; $i<=4; $i++) {
            // $_SESSION['like'][$i] = $like_notes[$i];
            // $_SESSION[''];

            $test = $like_notes[$i];

            $query_like   = mysqli_query($this->dsn, "SELECT * from notes WHERE pawsup  = '$test' ");
            $query_result = mysqli_fetch_assoc($query_like);

            $_SESSION[$i]['login']   = $query_result['login'];
            $_SESSION[$i]['name']    = $query_result['name'];
            $_SESSION[$i]['content'] = $query_result['content'];
            $_SESSION[$i]['pawsup']  = $query_result['pawsup'];
            $_SESSION[$i]['time']    = $query_result['time'];

        }

        // $view = new View();
        // $view -> top_5();


    }


    // Funkcja dzięki której użytkownik może dodać lajka, po czym przenosi go do widoku dokonanej zmiany. 

    public function addlike()
    {
        $login = $_GET['login'];
        $name  = $_GET['noteName'];

        $loginUser = $_SESSION['user'];


        $query_add    = mysqli_query($this->dsn, "SELECT * from notes WHERE login = '$login' AND name = '$name'");
        $query_result = mysqli_fetch_assoc($query_add);

        $query_user   = mysqli_query($this->dsn, "SELECT * from user WHERE login = '$loginUser'");
        $result_user  = mysqli_fetch_assoc($query_user);

        $pawsup = $query_result['pawsup'];
        $pawsup++;

        $idNotes = $query_result['id'];
        $idUser  = $result_user['id'];
        // $query_picture   = mysqli_query($this->dsn, "UPDATE profilepicture SET url = '$picture' WHERE login = '$login'");

        // $insert_add    = mysqli_query($this->dsn, "INSERT INTO notes (pawsup) VALUES ('$pawsup') WHERE login = '$login'");

        $insert_update = mysqli_query($this->dsn, "UPDATE notes SET pawsup = '$pawsup' WHERE name = '$name'" );



        // $view = new View();
        // $view->likeAdded();


        $this->saveLike($idNotes, $idUser);

       $request['get']['action'] = "Dview_afterlike";
       
       $user = new Controller($request);
       $user->run($request);

        
    }

    public function saveLike($idNotes, $idUser)
    {
       $save_userLike = mysqli_query($this->dsn, "INSERT savelike (idNotes, idUser) VALUES ('$idNotes', '$idUser')");
    }

    public function verificationLike($idNotes, $login)
    {
        // dump($idNotes);
        // dump($login);

        // $query_verification  = mysqli_query($this->dsn, "SELECT * FROM savelike WHERE  = '$idUser'");
        // $result_verification = mysqli_fetch_assoc($query_verification);

        // dump($result_verification);

    }

    public function addComment()
    {
        dump($_GET);
        dump($_POST);

        $date  = date("H:i:sa");
        $notes = $_GET['noteName'];
        $login = $_GET['login'];

        $takeIDnotes   = mysqli_query($this->dsn, "SELECT * FROM notes WHERE name = '$notes'");
        $resultIDnotes = mysqli_fetch_assoc($takeIDnotes);

        $takeIDuser    = mysqli_query($this->dsn, "SELECT * FROM user WHERE login = '$login'");
        $resultIDuser  = mysqli_fetch_assoc($takeIDuser);

        $idnotes       = $resultIDnotes['id'];
        $iduser        = $resultIDuser['id'];
        $contents      = $this->dsn->real_escape_string($_POST['addComment']);

        // $addcomments   = mysqli_query($this->dsn, "")

        echo "<br></br>";
        echo "Sprawdzamy czas: ";
        echo $date;

        $addcomment    = mysqli_query($this->dsn, "INSERT INTO comments (idNotes, idUser, contents, time) VALUES ('$idnotes', '$iduser', '$contents', NOW())");

        echo "<br></br>";
        echo "Sortowanie: ";

        // $sorting     = mysqli_query($this->dsn, "INSERT INTO comments (time) VALUES (NOW())");

        // dump($sorting);

    }

    public function checkData($data)
    {
        $id   = $data['id'];
        $name = $data['name'];
        $test = "name";

        $checkData  = mysqli_query($this->dsn, "SELECT * FROM notes WHERE id = $id");
        $resultData = mysqli_fetch_assoc($checkData);

        $checkDataname = $resultData['name'];

        if($checkDataname == $name) {
            $_SESSION['checkData'] = true;
        } else {
            $_SESSION['checkData'] = false;
        }
    }

    public function deletelike($notename): void
    {
        $login          = $_SESSION['user'];

        $boombap        = $this->dsn->real_escape_string($login);
        $boombap2       = $this->dsn->real_escape_string($notename);

        $checkloginID   = mysqli_query($this->dsn, "SELECT * FROM user WHERE login = '$boombap'");
        $resultloginID  = mysqli_fetch_assoc($checkloginID);

        $checknoteID    = mysqli_query($this->dsn, "SELECT * FROM notes WHERE name = '$boombap2'");
        $resultnoteID   = mysqli_fetch_assoc($checknoteID);

        $loginID        = $resultloginID['id'];
        $noteID         = $resultnoteID['id'];;

        $deletelike     = mysqli_query($this->dsn, "DELETE FROM savelike WHERE idUser = '$loginID' and idNotes = '$noteID'");

    }

    public function chal(string $noteName, $login): void
    {
        dump($_SESSION);
        $a               = "name";
        $loginname       = $login;

        $checkID         = mysqli_query($this->dsn, "SELECT * FROM user WHERE login = '$loginname'");
        $resultCheck     = mysqli_fetch_assoc($checkID);

        $checkidnote     = mysqli_query($this->dsn, "SELECT * FROM notes WHERE name = '$noteName'");
        $resultchecknote = mysqli_fetch_assoc($checkidnote);

        $idUser          = $resultCheck['id'];
        $idNote          = $resultchecknote['id'];

        $chal            = mysqli_query($this->dsn, "SELECT * FROM savelike WHERE idNotes = $idNote and idUser = $idUser");
        $chalresult      = mysqli_fetch_assoc($chal);

        if(empty($chalresult)) {
            $_SESSION['added'] = 1;
        } else {
            $_SESSION['added'] = 0;
        }

    }

    public function display_comments($login, $noteName): void
    {
        $checkIDlogin      = mysqli_query($this->dsn, "SELECT * FROM user WHERE login = '$login'");
        $resultChecklogin  = mysqli_fetch_assoc($checkIDlogin);

        $checkIDnote       = mysqli_query($this->dsn, "SELECT * FROM notes WHERE name = '$noteName'");
        $resultChecknote   = mysqli_fetch_assoc($checkIDnote);

        $idUser            = $resultChecklogin['id'];
        $idNotes           = $resultChecknote['id'];

        $selectcomment   = mysqli_query($this->dsn, "SELECT * FROM comments WHERE idNotes = '$idNotes'");
        $resultselect    = mysqli_fetch_assoc($selectcomment);

        $numbertable     = mysqli_query($this->dsn, "SELECT COUNT(*) FROM comments WHERE idNotes = '$idNotes'");
        $resultnumber    = mysqli_fetch_assoc($numbertable);

        $id_numbertable  = $resultnumber['COUNT(*)'];

        $calculated      = $id_numbertable / 6;
        $nsp             = $calculated; // Number of subpages.

        dump($id_numbertable);
        dump($calculated);

        $lala = $this->dsn;
        $blabla = mysqli_query($this->dsn, "SELECT * FROM comments");
        $resultacja = mysqli_fetch_assoc($blabla);

        $maxid       = mysqli_query($this->dsn, "SELECT max(id) FROM comments");
        $resultmaxid = mysqli_fetch_assoc($maxid);

        $minid      = mysqli_query($this->dsn, "SELECT min(id) FROM comments");
        $resultminid = mysqli_fetch_assoc($minid);

        $idcomment     = $resultmaxid['max(id)'];

        if($id_numbertable > 6) {
        $calculations = $id_numbertable - 6;
        }
        else {
            echo "<br></br>";
            echo "Mniejsza ilość komentarzy";
            echo "<br></br>";
            $calculations = 1;
        }


        
        // if(!empty($calculations)) {

        for($i=$id_numbertable; $i>=$calculations; $i--){

            $pulloutcomment = mysqli_query($this->dsn, "SELECT * FROM comments WHERE id = '$idcomment' and idNotes = '$idNotes'");
            $resultpullout  = mysqli_fetch_assoc($pulloutcomment);


            if(!empty($resultpullout['contents'])) {
            echo "<br></br>";
            echo $resultpullout['contents'] . " " . $resultpullout['time'];
            echo "<br></br>";
            } else {
                 
            }

            $idcomment--;

            $result_idcomment = $idcomment;
         
        }
    // }

        $_SESSION['nov_number'] = 1;
        

        for($i=1; $i<=$nsp; $i++){
            echo "
                 <a href='/?action=Dmorecomments&id="."$i"."&login="."$login"."&notename="."$noteName"."&nov_number="."$i"."&nsp="."$nsp'  >$i</a>
                "; 
        }

        $action_more = $idcomment - 6;

        // if(!empty($result_idcomment)) {
        // echo "<div class='more'>
        // <ul>
        //  <a href='/?action=Dmorecomments&more="."$result_idcomment"."&login="."$login"."&notename="."$noteName"."'  >Więcej</a>
        // </ul>
        // </div>";
        // };

    }

    public function morecomments(): void
    {
        echo "<br></br>";
        echo "Witamy w morecomments";
        echo "<br></br>";

        echo "<br></br>";
        echo "testtt";
        echo "<br></br>";
        echo "<ul class='xxx'>
        <li><i class='circle'>1</i> Trololo</li>
        </ul>";

        dump($_GET);

        $login    = $_GET['login'];
        $notename = $_GET['notename'];

        $more = $_GET['more'];

        $numbertable     = mysqli_query($this->dsn, "SELECT COUNT(*) FROM comments");
        $resultnumber    = mysqli_fetch_assoc($numbertable);

        $id_numbertable  = $resultnumber['COUNT(*)'];
        $calculations    = $more - 6;
        // $difference      = 

        dump($resultnumber);
        dump($calculations);
        dump($more);

        for($i=$more; $i>=$calculations; $i--){

            $pulloutcomment = mysqli_query($this->dsn, "SELECT * FROM comments WHERE id = '$more'");
            $resultpullout  = mysqli_fetch_assoc($pulloutcomment);


            if(!empty($resultpullout['contents'])) {
            echo "<br></br>";
            echo $resultpullout['contents'] . " " . $resultpullout['time'];
            echo "<br></br>";
            } else {
                 
            }

            $more--;
        }

            $pulloutcomment = mysqli_query($this->dsn, "SELECT * FROM comments WHERE id = '$more'");
            $resultpullout  = mysqli_fetch_assoc($pulloutcomment);

            if(!empty($resultpullout['contents'])) {
                echo "<div class='more'>
                <ul>
                 <a href='/?action=Dmorecomments&more="."$more"."&login="."$login"."&notename="."$notename"."'  >Więcej</a>
                </ul>
                </div>"; 
            } 

            dump($_GET);
            dump($_POST);
            $nsp      = $_GET['nsp'];
            $noteName = $_GET['notename'];

            for($i=1; $i<=$nsp; $i++){
                echo "
                     <a href='/?action=Dmorecomments&id="."$i"."&login="."$login"."&notename="."$noteName"."&nov_number="."$i"."&nsp="."$nsp'  >$i</a>
                    "; 
            }



        echo "<div class='returncomment'>
        <ul>
         <a href='/?action=BselectNote&title="."$notename"."&id=0'>Powrót</a>
        </ul>
        </div>";

    }

    public function morecommentstwo()
    {
        echo "<br></br>";
        echo "Witamy w morecomments";
        echo "<br></br>";

        dump($_GET);

        $login    = $_GET['login'];
        $notename = $_GET['notename'];

        $more = $_GET['more'];

        $numbertable     = mysqli_query($this->dsn, "SELECT COUNT(*) FROM comments");
        $resultnumber    = mysqli_fetch_assoc($numbertable);

        $id_numbertable  = $resultnumber['COUNT(*)'];
        $calculations    = $more - 6;


        dump($calculations);
        // $difference      = 

        for($i=$more; $i>=$calculations; $i--){

            $pulloutcomment = mysqli_query($this->dsn, "SELECT * FROM comments WHERE id = '$more'");
            $resultpullout  = mysqli_fetch_assoc($pulloutcomment);


            if(!empty($resultpullout['contents'])) {
            echo "<br></br>";
            echo $resultpullout['contents'] . " " . $resultpullout['time'];
            echo "<br></br>";
            } else {
                 
            }

            $more--;
         
        }

        echo "<br></br>";
        echo "testtt";
        echo "<br></br>";
        echo "<ul class='xxx'>
        <li><i class='circle'>1</i> Trololo</li>
        </ul>";

        echo "<div class='returncomment'>
        <ul>
         <a href='/?action=BselectNote&title="."$notename"."&id=0'>Powrót</a>
        </ul>
        </div>";

    }
    

    private function createConnection(array $config): void
    {
        try {
        mysqli_connect ($config['host'], $config['user'], $config['password'], $config['database']);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        

        $this->dsn = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
        } catch (mysqli_sql_exception $e) {
            dump($e->getMessage());
            exit(0);
        }
    }

    private function validateConfig(array $config): void
    {
        if (
            empty($config['database'])
            || empty($config['host'])
            || empty($config['user'])

        ) {
            echo "error connect to database";
        }
    }

}

 