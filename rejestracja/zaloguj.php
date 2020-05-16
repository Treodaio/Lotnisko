<?php 
session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: rejestracja.php');
    exit();
}

require_once "connect.php";
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
{
    echo "Blad: ".$polaczenie->connect_errno."Opis: ".$polaczenie->connect_error;
}
else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    // $zahaszowane = password_hash($haslo, PASSWORD_DEFAULT);
    

$sql = "SELECT * FROM pasazerowie WHERE login = '$login' AND haslo = '$haslo'";

    //zapytanie zostało poprawnie wykonane. Łapiemy zwrócone z bazy rekordy
    if ($rezultat = $polaczenie->query($sql))
    {
        $ilu_userow = $rezultat->num_rows;
        if($ilu_userow >0)
        {
            $wiersz = $rezultat->fetch_assoc();
         
            //sprawdzanie zahaszowanego hasla
       
            
                $_SESSION['zalogowany'] = true;
                //wiersz to nazwa tablicy. login to index wiersza.
            
                $_SESSION['id'] = $wiersz['id'];
                $_SESSION['imie']= $wiersz['imie'];
                $_SESSION['nazwisko']= $wiersz['nazwisko'];
                $_SESSION['kraj']= $wiersz['kraj_pochodzenia'];
                $_SESSION['paszport']= $wiersz['nr_paszportu'];
                $_SESSION['dowod']= $wiersz['nr_dowodu'];
                $_SESSION['login']= $wiersz['login'];
                $_SESSION['email']= $wiersz['email'];

                unset($_SESSION['blad']);

                $rezultat->free_result();

                header('Location: oferta.php');
            
        }else {
            //login jest nieprawidlowy
          $_SESSION['blad'] = '<span style = "color:red"> Nieprawidłowy login lub hasło </span>';

          header("Location: rejestracja.php");
        }


    }


    $polaczenie -> close();
}

?> 
