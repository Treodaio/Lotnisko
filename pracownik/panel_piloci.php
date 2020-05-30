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
    <title>Piloci</title>
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
    ?>
    </main>
    <aside>
   
    <?php 

$con= mysqli_connect ("localhost","root","","lotnisko");
        

//czas pracy 
  
echo '<h3>Czas pracy:</h3>'; 
$czas_pracy  = mysqli_query($con, 'SELECT czas_pracy_od, czas_pracy_do FROM piloci WHERE id = '.$_SESSION['id'].'' );

if($czas_pracy->num_rows > 0)
{
    while($row = $czas_pracy->fetch_assoc())
    {
        echo "<div class = 'container'><p>Czas pracy od : ".$row['czas_pracy_od']."</p>"."<p>Czas pracy do: </b>".$row['czas_pracy_do']."<br></br></div>";   
    }
}else {
    echo "<h4 id = bilet-info>Nie ma nic do wyświetlenia. Wolne? <h4>";
} 


// Czy są jakieś loty? 

echo '<h3>Nadchodzące podróże:</h3>'; 

        $historia_lotow = mysqli_query($con, 'SELECT loty_id,czas_wylotu, czas_dotarcia FROM loty_has_piloci INNER JOIN loty ON loty.id = loty_has_piloci.loty_id WHERE loty_has_piloci.piloci_id = '.$_SESSION['id'].'' );

        if($historia_lotow->num_rows > 0)
        {
            while($row = $historia_lotow->fetch_assoc())
            {
                echo "<div class = 'container'><p>Id podróży: ".$row['loty_id']."</p>"."<p>Czas wylotu: </b>".$row['czas_wylotu']."<p>Czas dotarcia: </b>".$row['czas_dotarcia']."<br></br></div>";
                
            }
        }else {
            echo "<h4 id = bilet-info>Aktualnie nie czekają Cię żadne loty<h4>";
        }   
?>
    </aside>
    </main>
</body>
</html>