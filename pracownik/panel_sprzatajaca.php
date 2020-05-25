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
    <title>Panel Informacyjny</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="panel.css">
</head>
<body>
   
<div class="wrapper">
   <main>
    <?php
    echo '<button class = "logout"><a href = "logout.php">Wyloguj się</a></button>';
    echo "<p>Imię: ".$_SESSION['imie']."</p>";
    echo "<p>ID: ".$_SESSION['id']."</p>";
    echo "<p>Nazwisko: ".$_SESSION['nazwisko']."</p>";
    echo "<p>Czas pracy: ".$_SESSION['czas_pracy']."</p>";
    ?>
    </main>
    <aside>
    <h1>Oczekujące samoloty(do wysprzątania)</h1>
    </aside>
</body>
</html>