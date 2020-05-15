<?php
session_start();
error_reporting(0);

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
{
header('Location: oferta.php');
exit();
}

if ((isset($_POST['imie'])))
{

    $wszystko_ok = true;
    
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $kraj = $_POST['kraj'];
    $paszport = $_POST['paszport'];
    $dowod = $_POST['dowod'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];
    $haslo2 = $_POST['haslo2'];
    $regulamin = $_POST['checkbox'];
    
    
    $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);


    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB!= $email))
    {
        $wszystko_ok = false;
        $_SESSION['error'] = "Podaj poprawny adres email";
    }


    if ( (strlen($imie)<1) || (strlen($nazwisko)<1) || (strlen($kraj)<1) || (strlen($paszport)<1)|| (strlen($dowod)<1)|| (strlen($login)<1) || (strlen($email)<1) || (strlen($haslo)<1) || (strlen($haslo2)<1))  {
        $wszystko_ok = false;
        $_SESSION['error'] = "Nie wszystkie pola zostały wypełnione!";
    }

    if (!isset($regulamin))
		{
			$wszystko_ok=false;
			$_SESSION['error'] = "Regulamin nie został zaakceptowany !";
        }
        

        $haslo_hash = password_hash($haslo2, PASSWORD_DEFAULT);



        //ZAPAMIETANIE WPROWADZONYCH DANYCH
        $_SESSION['fr_imie'] = $imie;
        $_SESSION['fr_nazwisko'] = $nazwisko;
        $_SESSION['fr_kraj'] = $kraj;
        $_SESSION['fr_paszport'] = $paszport;
        $_SESSION['fr_dowod'] = $dowod;
        $_SESSION['fr_email'] = $email;
        $_SESSION['fr_login'] = $login;

        if(isset($_POST['checkbox'])) $_SESSION['fr_regulamin'] = true;


        require_once "connect.php";
         mysqli_report(MYSQLI_REPORT_STRICT);


        try {
            $polaczenie = new mysqli($host, $db_user, $db_password , $db_name);
            
            if($polaczenie->connect_errno!=0)
                {
                    throw new Exception(mysqli_connect_errno());
                } 
                
                //udalo sie polaczyc
                else {


                    //Czy email juz istneieje?
                    $rezultat = $polaczenie->query("SELECT id FROM pasazerowie WHERE email = '$email'");

                    if(!$rezultat) throw new Exception($polaczenie->error);

                    $ile_takich_maili = $rezultat->num_rows;
                    
                    if($ile_takich_maili>0)
                    {
                        $wszystko_ok = false;
                        $_SESSION['error'] = "<span style='color:red;'> Email $email jest już zajęty!</span>";
                    }



                    // Czy login jest już zajęty? 
                    $rezultat = $polaczenie->query("SELECT id FROM pasazerowie WHERE login = '$login'");

                    if(!$rezultat) throw new Exception($polaczenie->error);

                    $ile_takich_loginow = $rezultat->num_rows;
                    
                    if($ile_takich_loginow>0)
                    {
                        $wszystko_ok = false;
                        $_SESSION['error'] = "<span style='color:red;'>Login $login jest już zajęty!</span>";
                    }




                     // Czy dowod jest taki sam? 
                     $rezultat = $polaczenie->query("SELECT id FROM pasazerowie WHERE nr_dowodu = '$dowod'");

                     if(!$rezultat) throw new Exception($polaczenie->error);
 
                     $ile_takich_dowodow = $rezultat->num_rows;
                     
                     if($ile_takich_dowodow>0)
                     {
                         $wszystko_ok = false;
                         $_SESSION['error'] = "<span style='color:red;'> Na ten numer dowodu zostało już zarejestrowane konto!</span>";
                     }

                     // Czy paszport jest taki sam? 
                     $rezultat = $polaczenie->query("SELECT id FROM pasazerowie WHERE nr_paszportu = '$paszport'");

                     if(!$rezultat) throw new Exception($polaczenie->error);
 
                     $ile_takich_paszportow = $rezultat->num_rows;
                     
                     if($ile_takich_paszportow>0)
                     {
                         $wszystko_ok = false;
                         $_SESSION['error'] = "<span style='color:red;'>Na ten numer paszportu zostało już zarejestrowane konto!<span>";
                     }

                     //DODANIE UZYTKOWNIKA DO BAZY
                     if($wszystko_ok == true)
                      {
                        if($polaczenie->query("INSERT INTO pasazerowie VALUES(NULL, '$imie', '$nazwisko', '$kraj','$paszport','$dowod','$login','$haslo_hash','$email')")) 
                        {
                            $_SESSION['udane'] = true;
                            header('Location: witamy.php');
                        }
                        else {
                            throw new Exception($polaczenie->error);
                        }
                          
                          
                        }


                    $polaczenie->close();
                }



        }
        catch(Exception $e)
        {
            // echo '<h1 id = "uniqie">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</h1>';
            // echo '<p>Informacja deweloperska</p>'.$e;
        }

}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotnisko - rejestracja</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap&subset=latin-ext" rel="stylesheet">
    <script src="https://kit.fontawesome.com/005dd1e3a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="rejestracja.css">
    <link rel="stylesheet" href="../naglowek.css">

</head>

<body>
    <nav>
        <ul>
            <li><i class="far fa-clipboard"></i><a href="../index.html">Strona główna</a></li>
            <li><i class="far fa-clipboard"></i><a href="#">Rejestracja</a></li>
            <li><i class="far fa-images"></i><a href="../galeria/galeria.html">Galeria</a></li>
            <li><i class="fas fa-route"></i><a href="../podroz/podroz.html">Podróż</a></li>
            <li><i class="fas fa-ticket-alt"></i><a href="../oferta/oferta.html">Oferta</a></li>
            <li><i class="fas fa-user-friends"></i><a href="../pracownik/pracownik.html">Dla pracownika</a></li>
            <li><i class="fas fa-calculator"></i><a href="../kalkulator/kalkulator.html">Kalkulator</a></li>
            <li><i class="far fa-clipboard"></i><a href="../regulamin/regulamin.html">Regulamin</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <main>
        <section class="account">
                <h2>Masz już konto? </h1>
                    <span class="login">Zaloguj się</span>

            </section>
            <h1>Nie posiadasz konta? Zarejestruj się w serwisie</h1>
            <p class="warning">Dziękujemy za rzetelne wypełnienie powyższego formularza.</p>


            <?php
            if(isset($_SESSION['error']))
            {
                echo '<p class = "warning">'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
            }
            ?>

            
            <form method="POST">
                <label id="imie" for="imie"><input type="text" value = 
                "<?php if(isset($_SESSION['fr_imie'])) { echo $_SESSION['fr_imie']; unset($_SESSION['fr_imie']);  }?>" name="imie" placeholder="Imię"></label>
                <label id="nazwisko" for="nazwisko"><input type="text" value = "<?php if(isset($_SESSION['fr_nazwisko'])) { echo $_SESSION['fr_nazwisko']; unset($_SESSION['fr_nazwisko']);  }?>" name="nazwisko" placeholder="Nazwisko"></label>
                <label id="kraj" for="kraj"><input type="text" value = "<?php if(isset($_SESSION['fr_kraj'])) { echo $_SESSION['fr_kraj']; unset($_SESSION['fr_kraj']);  }?>" name="kraj" placeholder="Kraj pochodzenia"></label>

                <label id="paszport" for="paszport"><input type="text" value = "<?php if(isset($_SESSION['fr_paszport'])) { echo $_SESSION['fr_paszport']; unset($_SESSION['fr_paszport']);  }?>" name="paszport"
                        placeholder="Paszport - wpisz 15 cyfr"></label>
                <label id="dowod" for="dowod"><input type="text" value = "<?php if(isset($_SESSION['fr_dowod'])) { echo $_SESSION['fr_dowod']; unset($_SESSION['fr_dowod']);  }?>" name="dowod"
                        placeholder="Dowod - wpisz 9 cyfr"></label>

                <label id="email" for="email"><input type="text" value = "<?php if(isset($_SESSION['fr_email'])) { echo $_SESSION['fr_email']; unset($_SESSION['fr_email']);  }?>" name="email" placeholder="Email"></label>
                <label id="login" for="login"><input type="text" value = "<?php if(isset($_SESSION['fr_login'])) { echo $_SESSION['fr_login']; unset($_SESSION['fr_login']);  }?>" name="login" placeholder="Login"></label>
                <label id="haslo" for="haslo"><input type="text"  name="haslo" placeholder="Hasło"></label>
                <label id="haslo_2" for="haslo"><input type="text" name="haslo2" placeholder="Powtórz hasło"></label>
                <div id="accept">
                   <label><h3> <input type="checkbox" name="checkbox" value = "">Akceptuję
                        <a href="../regulamin/regulamin.html">regulamin</a></h3> </label>
                </div>

                <button>Zarejestruj się</button>
            </form>
         
        </main>
    </div>

    <div class="login-modal">
        <aside>
            <h1>Zaloguj się na swoje konto</h1>
            <form action="zaloguj.php" method="POST">
                <label id="username" for="username"><input type="text" name="login" placeholder="Login"></label>
                <label id="password" for="password"><input type="password" name="haslo" placeholder="Hasło"></label>
                <button>Zaloguj się</button>

                <?php
            // if(isset($_SESSION['blad'])) {echo $_SESSION['blad'];}
                ?>

            </form>
            <span class="hide">X</span>
        </aside>
    </div>
    <script src="rejestracja.js"></script>
    <script src="login.js"></script>
</body>

</html>