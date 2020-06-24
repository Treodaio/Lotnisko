<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmiana maila</title>
    <link rel="stylesheet" href="zmiana.css">
</head>
<body>
    <aside class="wrap">
<?php
 echo '<button class = "zmiana"><a href = "oferta.php">Powrót</a></button>';
?>
    <h1>Tutaj zmienimy Twojego maila</h1>
    <p>Podaj nowy e-mail</p>
    <form action="" method = "POST">
    <input type="text" name = "nowy_mail">
   
    <input type = "submit" name="submit" value="Zmień maila" class="przycisklotu"/>
    </form>
</aside>    


<?php

session_start();
$con= mysqli_connect ("localhost","root","","lotnisko");
$id_klienta = $_SESSION['id'];

if(isset($_POST['submit']))
{
    $wartosc = $_POST['nowy_mail'];
    // echo "$wartosc";
    // echo "$id_klienta";

// $sql = mysqli_query($con, "UPDATE pasazerowie SET email  = '.$wartosc.' WHERE pasazerowie.id = '.$id_klienta.'");

$sql =mysqli_query($con, "UPDATE pasazerowie SET email  = '$wartosc' WHERE pasazerowie.id = '$id_klienta'");

// podmien zmienna sesyjna
$_SESSION['email'] = $wartosc;

}
$con ->close();
?>
    
</body>
</html>