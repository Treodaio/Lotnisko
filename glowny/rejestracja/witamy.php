<?php
session_start();

if((isset($_SESSION['udane'])))
{
header('Location: ../index.php');
exit();
}

else {
    unset($_SESSION['udane']);
}

//USUWANIE ZMIENNYCH pamietajacych wartosci wpisane do formularza

if(isset($_SESSION['fr_imie'])) unset($_SESSION['fr_imie']);
if(isset($_SESSION['fr_nazwisko'])) unset($_SESSION['fr_nazwisko']);
if(isset($_SESSION['fr_kraj'])) unset($_SESSION['fr_kraj']);
if(isset($_SESSION['fr_paszport'])) unset($_SESSION['fr_paszport']);
if(isset($_SESSION['fr_dowod'])) unset($_SESSION['fr_dowod']);
if(isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
if(isset($_SESSION['fr_login'])) unset($_SESSION['fr_login']);

//Usuwanie bledow rejestracji 
if(isset($_SESSION['error'])) unset($_SESSION['error']);


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotnisko - witamy!</title>
</head>
<body>
    <h1>Dziękujemy za zarejestrowanie się! Teraz kiedy posiadasz konto <a href="rejestracja.php">możesz się  zalogować</a> wybierając opcje zaloguj powyżej formularza rejstracji.</h1>
</body>
</html>