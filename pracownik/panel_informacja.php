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
    <aside>
    <h1>Pasażerowie którzy niedlugo odbędą podróże</h1>

    <?php
 $con= mysqli_connect ("localhost","root","","lotnisko");
  

         $lista = mysqli_query($con, 'SELECT imie, nazwisko, kraj_pochodzenia, nr_paszportu FROM `pasazerowie`');

         if($lista->num_rows > 0)
         {
             echo '<h3>Lista pasażerów:</h3>'; 
             while($row = $lista->fetch_assoc())
             {
                 echo '<h4 class= "bilet-info">'."Imie:".$row['imie'].'<span></span>'."Nazwisko: ".$row['nazwisko'].'<span></span>'."Kraj pochodzenia:".$row['kraj_pochodzenia'].'<span></span>'.'<span></span>'."Nr paszportu: ".$row['nr_paszportu'].'</h4>';
             }
         }else {
             echo "<h4 id = bilet-info>Żaden pasażer nie jest zarejestrowany<h4>";
         }   
         $con->close();
     
    ?>
    </aside>
    </aside>
</body>
</html>