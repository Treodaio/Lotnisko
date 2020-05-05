<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
    header('Location: rejestracja.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zakup bilet</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="oferta.css">
</head>
<body>
   
<div class="wrapper">
    <aside>
    <h1>Twoje dane: </h1> 
    <?php
    echo '<button class = "logout"><a href = "logout.php">Wyloguj się</a></button>';
    echo "<p>Imię: ".$_SESSION['imie']."</p>";
    echo "<p>ID: ".$_SESSION['id']."</p>";
    echo "<p>Nazwisko: ".$_SESSION['nazwisko']."</p>";
    echo "<p>Kraj: ".$_SESSION['kraj']."</p>";
    echo "<p>Nr paszportu : ".$_SESSION['paszport']."</p>";
    echo "<p>Nr dowodu: ".$_SESSION['dowod']."</p>";
    echo "<p>Login: ".$_SESSION['login']."</p>";
    echo "<p>E-mail: ".$_SESSION['email']."</p>";
    ?>
    </aside>
    <section class = "bilet">
        <h1>Kup bilet</h1>
    </section>
    <section class = "oferta">
        <p>Tutaj pojawi się nasza oferta czyli rodzaje biletów</p>
    </section>
</div>
</body>
</html>
