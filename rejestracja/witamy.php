<?php
session_start();

if(!(isset($_SESSION['udane'])))
{
header('Location: rejestracja.php');
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            height: 100vh;
            width: 100vw;
            background-image: url('img/compas.jpg');
            background-position: center;
            background-size: cover;
            position: relative;
        }

        h1 {
            text-align: center;
            color: white;
            width: 90%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            position: absolute;
        }

        h1 a {
            color: black;
        }
    </style>
</head>

<body>
    <h1>Dziękujemy za zarejestrowanie się! Teraz kiedy posiadasz konto
        <a href="rejestracja.php">możesz się  zalogować</a> wybierając opcje zaloguj powyżej formularza rejstracji.</h1>
</body>

</html>