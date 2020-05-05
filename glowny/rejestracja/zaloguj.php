<?php

session_start();
require_once "connect.php";
if(!isset($_POST['login']) || (!isset($_POST['haslo'])))
{
    header('Location: rejestracja.php');
}
$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie ->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno."Opis błedu: ".$polaczenie->connect_error;
    //jezeli udalo sie nawiazac polaczenie
} else {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    
    //sanityzacja kodu
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");


//  $sql ="SELECT * FROM pasazerowie WHERE login = '$login' AND haslo = '$haslo'" ;

    //jezeli udalo sie wykonac zapytanie do bazy danych
 if ($rezultat = $polaczenie->query(sprintf("SELECT * FROM pasazerowie WHERE login = '%s' AND haslo = '%s'", mysqli_real_escape_string($polaczenie, $login),
 mysqli_real_escape_string($polaczenie, $haslo))))
 {
    $ilu_userow = $rezultat->num_rows;

    if($ilu_userow>0)
    {
        $_SESSION['zalogowany'] = true;

        $wiersz = $rezultat->fetch_assoc();

        $_SESSION['id'] = $wiersz['id'];
        $_SESSION['imie'] = $wiersz['imie'];
        $_SESSION['nazwisko'] = $wiersz['nazwisko'];
        $_SESSION['kraj'] = $wiersz['kraj_pochodzenia'];
        $_SESSION['paszport'] = $wiersz['nr_paszportu'];
        $_SESSION['dowod'] = $wiersz['nr_dowodu'];
        $_SESSION['login'] = $wiersz['login'];
        $_SESSION['email'] = $wiersz['email'];
        
        // unset($_SESSION['blad']);

        $rezultat->close();
        header('Location: oferta.php');
    }else {

        // $_SESSION['blad'] = '<p> Nieprawidłowy login lub haslo</p>';
        // header('Location: rejestracja.php');

        header('Location: rejestracja.php');
    }

 }


$polaczenie->close();
}

?>