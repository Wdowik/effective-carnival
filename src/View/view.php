<?php

declare(strict_types=1);

namespace App;

require_once("./src/utils/debug.php");

class View
{
    // public function render($params, $id): void
    // {
    //     if ($id==1) {
    //         require_once("templates/layout.php"); }

    //     if ($id==2) {
    //         require_once("templates/pages/layout_user.php");
            
    //     }    

    //     if ($id==3) {
           
    //     }

    //     if ($id==4) {
    //         require_once("templates/pages/settings.php");
    //     }
    // }

    public function render_two($page, $params): void
    {
        require_once("templates/layout.php");
    }

    public function login(): void
    {
        echo "<div>
         <h3> Logowanie </h3>
         <div>
           <form class='note-form' action='/?action=Dchecking_login' method='post'>
             <ul>
               
                 Login: <div id='login'>
                  <input type=text name='login'/><br/>
                 </div>
                 Hasło: <div id='password'>
                  <input type=password name='register'/><br/>
                 </div>
                 <div id='user_data'>
                  <a href='Dchecking_login.php'><input type=submit value='Zaloguj'/></a>
                 </div>
             </ul>
           </form>
           <a href='/'>Powrót</a>
       
         </div>
       </div>";
    }

    public function user(): void
    {
      // if(empty($_SESSION['user'])) {
      //   $list = "list";
      //   $request = [ 
      //     'get'  => $_GET,
      //     'post' => $_POST
      // ];
      //   $controller = new Controller($request);
      //   $controller->view($list);
      //  } else {
        // $this->view_picture();  
      $this->view_picture();          
      echo " </div>

      <div class='container'>
       <div class='menu'>
        <ul>
         <li><a href='/?action=Acreation'>Nowa notatka</a></li>
         <li><a href='/?action=Cedit'  >Edytuj notatkę</a></li>
         <li><a href='/?action=Cdelete'>Usuń notatkę</a></li>
         <li><a href='/?action=Dsettings'>Ustawienia konta</a></li>
         <li><a href='/?action=Dlogout'>Wyloguj</a></li>

         "; $this->top_5(); echo "
         <br></br>
         (ABCDEFGHIJKLMNO... WYSZUKIWARKA PORADNIKA WEDŁUG WYBRANIA PIERWSZEJ LITERY)
         <br></br>
         (wYSZUKIWARKA POPRZEZ WPISANIE FRAZY)
        </ul>
        </ul>
        
        </div>
      
     
       <div class='footer'>
       <p>Poradniki.pl - by WDK</p>   
     </body>";
      //  }
    }
    public function list(): void
    {
      if(!empty($_SESSION['user'])) {
        
        $this->user();

       } else {
        echo "<html lang='pl'>

        <head>
         <title>Notatnik</title>
         <meta charset='utf-8'>
         <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
         <link href='/public/style.css' rel='stylesheet'>
        </head>
        
        <body class='body'>
         <div class='wrapper'>
         <div class='header'>
          <h1><i class='far fa-clipboard'></i>Poradniki
          </h1>
         </div>
        
         <div class='container'>
          <div class='menu'>
           <ul>
            <li><a href='/?action=Dlogin'>Logowanie</a></li>
            <li><a href='/?action=Dregister'>Rejestracja</a></li>
            (Top 5 poradników)";
            $this->top_5();
            echo "
            <br></br>
            <form class='note-form' action='/?action=search_ABC' method='post'>
            </form>
            
            <br></br>
            
        
            <form class='note-form' action='/?action=search' method='post'>
            <div id='search'>
              Wyszukaj: <input type=text name='search'></br> 
            </div>
            <div id='send_button'>
                        <a href='search.php'><input type=submit value='Szukaj'/></a>
            </div>
            </form>
           </ul>
           
          
        
          <div class='footer'>
          <p>Poradniki.pl - by WDK</p>
          </div>   
        </body>
        </html>";
        
      }
      
    }

    public function list_logout(): void
    {
      // if(!empty($_SESSION['user'])) {
        
      //   $this->user();

      //  } else {
        echo "<html lang='pl'>

        <head>
         <title>Notatnik</title>
         <meta charset='utf-8'>
         <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
         <link href='/public/style.css' rel='stylesheet'>
        </head>
        
        <body class='body'>
         <div class='wrapper'>
         <div class='header'>
          <h1><i class='far fa-clipboard'></i>Poradniki
          </h1>
         </div>
        
         <div class='container'>
          <div class='menu'>
           <ul>
            <li><a href='/?action=Dlogin'>Logowanie</a></li>
            <li><a href='/?action=Dregister'>Rejestracja</a></li>
            (Top 5 poradników)";
            $this->top_5();
            echo "
            <br></br>
            <form class='note-form' action='/?action=search_ABC' method='post'>
            </form>
            
            <br></br>
            
        
            <form class='note-form' action='/?action=search' method='post'>
            <div id='search'>
              Wyszukaj: <input type=text name='search'></br> 
            </div>
            <div id='send_button'>
                        <a href='search.php'><input type=submit value='Szukaj'/></a>
            </div>
            </form>
           </ul>
           
          
        
          <div class='footer'>
          <p>Poradniki.pl - by WDK</p>
          </div>   
        </body>
        </html>";
      //  }
      
    }

    public function create(): void
    {
      // $this->view_picture();  

        echo "<div>
        <h3> Dodaj poradnik </h3>
        <div>
        Tworzenie notatki
         <form class='note-form' action='/?action=Acreate' method='post'>
                <div id='name'>
                 Tytuł: <input type=text name='name'/><br/>
                </div>
                <div id='content'>
                 Treść: <input type=text name='content' size='20'/><br/>
                </div>
                <div id='user_data'>
                 <a href='note_created.php'><input type=submit value='Stwórz'/></a>
                </div>
        </form>
       </div>
       <div class='container'>
        <div class='menu'>
         <ul>
          <li><a href='/?action=Cedit'  >Edytuj notatkę</a></li>
          <li><a href='/?action=Cdelete'>Usuń notatkę</a></li>
          <li><a href='/?action=Dsettings'>Ustawienia konta</a></li>
          <li><a href='/?action=Dlogout'>Wyloguj</a></li>  
          
         </ul>
         </div>
      </div>";
    }

    public function badRepeatPassword(): void
    {
        echo "<div>
        <h3> Logowanie </h3>
        <div>
          <form class='note-form' action='/?action=Dchecking_login' method='post'>
            <ul>
                Login:
                <div id='login'>
                 <input type=text name='login'/><br/>
                </div>
                Hasło:
                <div id='password'>
                 <input type=password name='register'/><br/>
                </div>
                <div id='user_data'>
                 <a href='checking_login.php'><input type=submit value='Zaloguj'/></a>
                </div>
              
                Niepoprawny login lub hasło, spróbuj ponownie.
              
            </ul>
          </form>
          <a href='/'>Powrót</a>
      
        </div>
      </div>";
    }

    public function passwordChange(): void
    {
      $this->view_picture();  

      echo "<br>";
echo "<div>
<div>
  <form class='note-form' action='/?action=passwordChanged' method='post'>
    <ul>

    Twoje hasło: <div id='change_password1'>
    <input type=password name='change_password1'/><br/>
   </div>
    Powtórz hasło: <div id='change_password2'>
    <input type=password name='change_password2'/><br/>
   </div>
     Nowe hasło: <div id='new_change_password1'>
    <input type=password name='new_change_password1'/><br/>
   </div>
    Powtórz nowe hasło: <div id='new_change_password2'>
    <input type=password name='new_change_password2'/><br/>
   </div>
   <div id='password_change'>
    <a href='/?action=d_passwordChanged'><input type=submit value='Zaloguj'/></a>
   </div>
  </ul>
  </form>

  <a href='/?action=Dsettings'>Powrót</a> 
        </div>

        
   
</div>

";
    }

    public function note_created(): void
    {
      // $this->view_picture();  
      echo "<br></br>";
      echo "Notatka stworzona";
      echo "<br></br>";
      $this->user();
    }

    public function register(): void
    {
      echo "<div>
      <h3> Rejestracja </h3>
      <div>
        <form class='note-form' action='/?action=DcreateUser' method='post'>
          <ul>
            
              Login:          <div id='createLogin'>
              <input type=text name='createLogin'/><br/>
              </div>
              Hasło:          <div id='createPassword'>
              <input type=password name='createPassword'/><br/>
              </div>
              Powtórz hasło:  <div id='repeatPassword'>
              <input type=password name='repeatPassword'/><br/>
              </div>
              <div id='create'>
                <a href='...'><input type=submit value='Stwórz konto'/></a>
              </div> 
            
          </ul>
        </form>
        <a href='/'>Powrót</a>
      </div>
    </div>
    ";
    }

    public function view_editTitle(): void
    {
       $title = $_SESSION['title'];
       $this->view_picture();  

      echo "<div> 
    <h3>Zmiana tytułu notatki:</h3>
    <div>
    <form class='note-form' action='/?action=Cready_edition_title' method='post'>
    <ul>
    
    Treść: <div id='content'>
    <input type=text name='title' value='$title'>
    </div>
    <div id='content_edit_submit'>
    <a href='Cready_edition_title.php'><input type=submit value='Edytuj'>
    </ul>
    </form>
    <a href='/?action=Cedition'>Powrót</a> 
    </div>";
    }

    public function view_editContent(): void
    {
      $content = $_SESSION['content'];
      $this->view_picture();

  
      echo "<div> 
      <h3>Zmiana treści notatki:</h3>
      <div>
      <form class='note-form' action='/?action=Cready_edition_content' method='post'>
      <ul>
      
      Treść: <div id='content'>
      <input type=text name='content' value='$content'>
      </div>
      <div id='content_edit_submit'>
      <a href='Cready_edition_content.php'><input type=submit value='Edytuj'>
      </ul>
      </form>
      <a href='/'>Powrót</a> 
      </div>";
    }
    
     public function editionView(): void
     {
      $this->view_picture();  
      echo "<br>";
      echo "<div>
      <div>
        <form class='note-form' action='/?action=Cedition_title' method='post'>
          <ul>
      
              <div id='edition_title'>
               <a href='edition_title.php'><input type=submit value='Zmień tytuł'/></a>
              </div>
              </ul>
              </form>
              </div>
        <div>    
        <div>
        <form class='note-form' action='/?action=Cedition_content' method='post'>
          <ul>
      
              <div id='edition_content'>
               <a href='edition_content.php'><input type=submit value='Edytuj treść'/></a>
              </div>
              </ul>
              </form>
              </div>
        <div>
        <a href='/?action=Cedit'>Powrót</a>    
      </div>
      
      ";
     }

     public function finishedEdition(): void
     {
      $this->view_picture();  
      echo "<br>";
      echo "<div>
      <div>

        <span style='color: green'>Edycja przeszła pomyślnie</span>
        <form class='note-form' action='/?action=Cedition_title' method='post'>
          <ul>
      
              <div id='edition_title'>
               <a href='edition_title.php'><input type=submit value='Zmień tytuł'/></a>
              </div>
              </ul>
              </form>
              </div>
        <div>    
        <div>
        <form class='note-form' action='/?action=Cedition_content' method='post'>
          <ul>
      
              <div id='edition_content'>
               <a href='edition_content.php'><input type=submit value='Edytuj treść'/></a>
              </div>
              </ul>
              </form>
              </div>
        <div>
        <a href='/?action=Cedit'>Powrót</a>    
      </div>
      
      ";
     }

     public function settings()
     {
      $this->view_picture();  
      echo "<div class='menu'>
      <ul>
       <li><a href='/?action=DaddProfilePicture'  >Dodaj zdjęcie profilowe</a></li>
       <li><a href='/?action=DaddBackgroundPhoto'>Zdjęcie w tle</a></li>
       <li><a href='/?action=DpasswordChange'>Zmiana hasła</a></li>
       <li><a href='/?action=Dlogout'>Wyloguj</a></li>  
       <br></br>
       <a href='/?action=Dview_user'><---Powrót na konto użytkownika</a>
      
             
      
      ";
     }

     public function settings_after_add_photo()
     {
      echo "<div class='menu'>
      <ul>
       <li><a href='/?action=DaddProfilePicture'  >Dodaj zdjęcie profilowe</a></li>
       <li><a href='/?action=DaddBackgroundPhoto'>Zdjęcie w tle</a></li>
       <li><a href='/?action=DpasswordChange'>Zmiana hasła</a></li>
       <li><a href='/?action=Dlogout'>Wyloguj</a></li>  
       <br></br>
       <a href='/?action=Dview_user'><---Powrót na konto użytkownika</a>
      
             
      
      ";
     }

     public function addProfilePicture()
     {
      if(empty($_SESSION['user'])) {
        $this->list();
      } else {
      $this->view_picture();  
      echo "<div>
      <h4>Dodaj nowe zdjęcie profilowe:</h4>
       <form class='note-form' action='/?action=additionProfilePicture' method='post'>  
          <div id='urlProfilePicture'>
           Wklej link url zdjęcia: <input type='text' name='urlProfilePicture' size='30'/></br>
          </div>
          <div id='additionProfilePicutre>
           <a href='additionProfilePicutre.php'><input type='submit' value='Dodaj'/></a>
           <br></br>
           <a href='/?action=Dsettings'><---Powrót do opcji</a>
      </div>";
    }
     }

     public function view_picture()
     {
       if(empty($_SESSION['picture'])) {
         exit("Wystąpił błąd, proszę skontaktować się z administratorem.A");
       } else {
       $picture = $_SESSION['picture'];
  
       echo "<img src='$picture' width='99' height='99' style='border: 1px black solid;'>";
       echo "<br></br>";
       }
     }

     public function completed_registration()
     {
      echo "<html lang='pl'>

      <head>
       <title>Notatnik</title>
       <meta charset='utf-8'>
       <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
       <link href='/public/style.css' rel='stylesheet'>
      </head>
      
      <body class='body'>
       <div class='wrapper'>
       <div class='header'>
        <h1><i class='far fa-clipboard'></i>Poradniki
        </h1>
       </div>
      
       Rejestracja zakończona pomyślnie!
       <div class='container'>
        <div class='menu'>
         <ul>
          <li><a href='/''>Strona główna</a></li>
          <li><a href='/?action=Dlogin'>Logowanie</a></li>
          <li><a href='/?action=Dregister'>Rejestracja</a></li>
          (Top 5 poradników)
          <br></br>
          <form class='note-form' action='/?action=search_ABC' method='post'>
          </form>
          
          <br></br>
          
      
          <form class='note-form' action='/?action=search' method='post'>
          <div id='search'>
            Wyszukaj: <input type=text name='search'></br> 
          </div>
          <div id='send_button'>
                      <a href='search.php'><input type=submit value='Szukaj'/></a>
          </div>
          </form>
         </ul>
         
        
      
        <div class='footer'>
        <p>Poradniki.pl - by WDK</p>
        </div>   
      </body>
      </html>";
     }

     public function same_username(): void
    {
      echo "<div>
      <h3> Rejestracja </h3>
      <div>
        <form class='note-form' action='/?action=DcreateUser' method='post'>
          <ul>
              Login:          <div id='createLogin'>
              <input type=text name='createLogin'/><br/>
              </div>
              Hasło:          <div id='createPassword'>
              <input type=password name='createPassword'/><br/>
              </div>
              Powtórz hasło:  <div id='repeatPassword'>
              <input type=password name='repeatPassword'/><br/>
              </div>
              <div id='create'>
                <a href='...'><input type=submit value='Stwórz konto'/></a>
              </div>
              
              <span style='color: red'>Podana przez Ciebie nazwa użytkownika już istnieje.</span>
            
          </ul>
        </form>
        <a href='/'>Powrót</a>
      </div>
    </div>
    ";
    }

    public function top_5(): void
    {

      // <a href='/?action=Dlogin'>Logowanie</a>

      $_SESSION['commentadded'] = 0;

      echo "<br></br>";
      echo "TOOOP 5 NOOTES MAAAN!";

      echo "<br></br>";
      echo "Tytuł poradnika: " . "<a href='/?action=BselectNote&title=".$_SESSION[0]['name']."&id=0'>" . $_SESSION[0]['name'] . "</a>" . " Like: " . $_SESSION[0]['pawsup']; 
      
      echo "<br></br>";
      echo "Tytuł poradnika: " . "<a href='/?action=BselectNote&title=".$_SESSION[1]['name']."&id=1'>" . $_SESSION[1]['name'] . "</a>" . " Like: " . $_SESSION[1]['pawsup']; 
      echo "<br></br>";
      echo "Tytuł poradnika: " . "<a href='/?action=BselectNote&title=".$_SESSION[2]['name']."&id=2'>" . $_SESSION[2]['name'] . "</a>" . " Like: " . $_SESSION[2]['pawsup']; 
      echo "<br></br>";
      echo "Tytuł poradnika: " . "<a href='/?action=BselectNote&title=".$_SESSION[3]['name']."&id=3'>" . $_SESSION[3]['name'] . "</a>" . " Like: " . $_SESSION[3]['pawsup']; 
      echo "<br></br>";
      echo "Tytuł poradnika: " . "<a href='/?action=BselectNote&title=".$_SESSION[4]['name']."&id=4'>" . $_SESSION[4]['name'] . "</a>" . " Like: " . $_SESSION[4]['pawsup']; 
      echo "<br></br>";

    echo "test";
    
    }
    
    public function viewNote($noteName, $noteContent, $pawsup, $login): void
    {

      __DIR__."../Controller/D_UserController.php";

      $user = new UserController();
      $user->chal($noteName, $login);    //check adding a like

      $passlogin = $login;
      if($_SESSION['commentadded'] == 0){
      $id = $_GET['id'];
      } else {
      $id = $_SESSION['added'];  
      }

      // if(!empty($_SESSION['user'])){
      echo "<br></br>";
      echo "TEEEEEEEEST";
      echo "<br></br>";
      echo "Użytkownik: " . $login;
      echo "<br></br>";
      echo "noteName: "    . $noteName;
      echo "<br></br>";
      echo "noteContent: " . $noteContent;
      echo "<br></br>";
      echo "pawsup: "      . $pawsup;
      echo "<br></br>";

      if(empty($_SESSION['user'])){
        echo "<br></br>";
        echo "Pusto";
        echo "<br></br>";
      } else {
      
      if($_SESSION['added'] == 1) {
      echo "Doddaj lajka" . "<a href='/?action=Daddlike&noteName=".$noteName."&login=".$login."&id=".$id."'>Like</a>";
      } else {
        echo "" . "<a href='/?action=Ddeletelike&noteName=".$noteName."&login=".$login."&id=".$id."'>Unlike</a>";
      }
    }
      echo "<br></br>";
      echo "<form class='note-form' action='/?action=DaddComment&noteName=".$noteName."&login=".$login."' method='post'>
      <div id='addComment'>
       <input type=text name='addComment' size='40' placeholder='Dodaj komentarz'></br> 
      </div>
      <div id='addComment_button'>
                  <a href='/?action=DaddComment&noteName=".$noteName."&login=".$login."'><input type=submit value='Dodaj'/></a>
      </div>
      </form>";
      echo "Lista komentarzy: ";
      
      $user->display_comments($login, $noteName);
      
      echo "<br></br>";
      echo "<a href='/'>Powrót</a>"; 
    
      // } else {
      //   echo "<br></br>";
      // echo "TEEEEEEEEST";
      // echo "<br></br>";
      // echo "noteName: "    . $noteName;
      // echo "<br></br>";
      // echo "noteContent: " . $noteContent;
      // echo "<br></br>";
      // echo "pawsup: "      . $pawsup;
      // echo "<br></br>";
      // echo "<a href='/'>Powrót</a>"; 

      // }
    }

    public function likeAdded()
    {
      echo "<br></br>";
      echo "Twój kciuk w górę został pomyślnie zaktualizowany przez system, życzymy Ci miłego oraz owocnego dnia. ;)";
      echo "<br></br>";    }

    public function badCreation()
    {
      echo "<div>
        <h3> Dodaj poradnik </h3>
        <div>
        Tworzenie notatki
         <form class='note-form' action='/?action=Acreate' method='post'>
                <div id='name'>
                 Tytuł: <input type=text name='name'/><br/>
                </div>
                <div id='content'>
                 Treść: <input type=text name='content' size='20'/><br/>
                </div>
                <div id='user_data'>
                 <a href='note_created.php'><input type=submit value='Stwórz'/></a>
                </div>
        </form>

        <span style='color: red'> Na twojej liście już istnieje taka nazwa notatki, spróbuj urozmaicić nazwę.</span>
        
       </div>
       <div class='container'>
        <div class='menu'>
         <ul>
          <li><a href='/?action=Cedit'  >Edytuj notatkę</a></li>
          <li><a href='/?action=delete'>Usuń notatkę</a></li>
          <li><a href='/?action=Dsettings'>Ustawienia konta</a></li>
          <li><a href='/?action=Dlogout'>Wyloguj</a></li>  
          
         </ul>
         </div>
      </div>";
    }

    public function error()
    {
       echo "<br></br>";
       echo "<b><span style='color: red'> Wystąpił błąd, proszę spróbować później.</span></b>";
       echo "<br></br>";
       $this->user();
    }
    
    }
