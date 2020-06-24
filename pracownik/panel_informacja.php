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
    <link rel="stylesheet" href="style_informacja.css">
</head>
<body>
   
<div class="wrapper">
   <main>
    <?php
    echo '<button class = "logout"><a href = "logout.php">Wyloguj się</a></button>';
    echo "<p>ID: ".$_SESSION['id']."</p>";
    echo "<p>Imię: ".$_SESSION['imie']."</p>";
    echo "<p>Nazwisko: ".$_SESSION['nazwisko']."</p>";
   
    ?>
    </main>
  
    <aside>
    <h1>Pasażerowie którzy niedlugo odbędą podróże</h1>

    <?php
 $con= mysqli_connect ("localhost","root","","lotnisko");
  
// Czas pracy
echo '<h3>Czas pracy:</h3>'; 
$czas_pracy  = mysqli_query($con, 'SELECT czas_pracy_od, czas_pracy_do FROM obslugainformacyjna WHERE id = '.$_SESSION['id'].'' );

 if($czas_pracy->num_rows > 0)
 {

     while($row = $czas_pracy->fetch_assoc())
     {
         echo "<div class = 'container'><p>Czas pracy od : ".$row['czas_pracy_od']."</p>"."<p>Czas pracy do: </b>".$row['czas_pracy_do']."<br></br></div>";   
     }
 }else {
     echo "<h4 id = bilet-info>Nie ma nic do wyświetlenia. Wolne? <h4>";
 } 

                            
 
            // Lista pasażerów
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

    <aside>
    <h1>Statystyki lotniska</h1>
    <?php
 $con= mysqli_connect("localhost","root","","lotnisko");


//   Widok
$liczba_biletów = mysqli_query($con, 'SELECT * FROM statystyka');
         
    while($row = mysqli_fetch_array($liczba_biletów))
         {
             echo '<h4 class= "bilet-info">'."Łączna liczba sprzedanych biletów: ".$row['ile'];
             echo '<h4 class= "bilet-info">'."Łączna zarobiona kwota: ".$row['suma'];
         }
 

 $con-> close();
 ?>

 
    </aside>

    <aside class = "edycja">
    <h1>Edycja cen biletów</h1>
    <form action="panel_informacja.php" method = "POST">
 <label for=""><p>Inflacjonowanie: wpisz o ile procent podnosisz cene biletów:</p> <input type="number" name = "liczba">  </label> <input type = "submit" name="submit" value="Podnieś cenę" class="przycisk"/>
 </form>


 <form action="panel_informacja.php" method = "POST">
 <label for=""><p>Deflacjonowanie: wpisz o ile procent zmnieszasz cene biletów:</p> <input type="number" name = "liczba2">  </label> <input type = "submit" name="submit2" value="Zmniejsz cenę" class="przycisk"/>
 </form>




 <?php
//  Zwiększanie ceny za pomocą procedury

  $con= mysqli_connect("localhost","root","","lotnisko");
if(isset($_POST['submit']))
{
    $procencik = $_POST['liczba'];
   $procedura = mysqli_query($con, "CALL zwieksz_cene('".$procencik."')");
}



//  Zmniejszanie ceny za pomocą procedury

if(isset($_POST['submit2']))
{
    $procencik2 = $_POST['liczba2'];
   $procedura2 = mysqli_query($con, "CALL zmniejsz_cene('".$procencik2."')");
}
$con-> close();
 ?>
    </aside>

    <aside>
    <main>
    
            <!-- <p>Dodaj klienta</p> -->
            <h1 class="warning">Dodaj klienta</h1>


            <?php
            if(isset($_SESSION['error']))
            {
                echo '<p class = "warning">'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
            }
            ?>

            
            <form method="POST">
                <label id="imie" for="imie"><input type="text" value = "<?php if(isset($_SESSION['fr_imie'])) { echo $_SESSION['fr_imie']; unset($_SESSION['fr_imie']);  }?>" name="imie" placeholder="Imię"></label>
                <label id="nazwisko" for="nazwisko"><input type="text" value = "<?php if(isset($_SESSION['fr_nazwisko'])) { echo $_SESSION['fr_nazwisko']; unset($_SESSION['fr_nazwisko']);  }?>" name="nazwisko" placeholder="Nazwisko"></label>
                <label id="kraj" for="kraj"><input type="text" value = "<?php if(isset($_SESSION['fr_kraj'])) { echo $_SESSION['fr_kraj']; unset($_SESSION['fr_kraj']);  }?>" name="kraj" placeholder="Kraj pochodzenia"></label>

                <label id="paszport" for="paszport"><input type="text" value = "<?php if(isset($_SESSION['fr_paszport'])) { echo $_SESSION['fr_paszport']; unset($_SESSION['fr_paszport']);  }?>" name="paszport"
                        placeholder="Paszport - wpisz 15 cyfr"></label>
                <label id="dowod" for="dowod"><input type="text" value = "<?php if(isset($_SESSION['fr_dowod'])) { echo $_SESSION['fr_dowod']; unset($_SESSION['fr_dowod']);  }?>" name="dowod"
                        placeholder="Dowod - wpisz 9 cyfr"></label>

                <label id="email" for="email"><input type="text" value = "<?php if(isset($_SESSION['fr_email'])) { echo $_SESSION['fr_email']; unset($_SESSION['fr_email']);  }?>" name="email" placeholder="Email"></label>
                <label id="login" for="login"><input type="text" value = "<?php if(isset($_SESSION['fr_login'])) { echo $_SESSION['fr_login']; unset($_SESSION['fr_login']);  }?>" name="login" placeholder="Login"></label>
                <label id="haslo" for="haslo"><input type="password"  name="haslo" placeholder="Hasło"></label>
                <label id="haslo_2" for="haslo"><input type="password" name="haslo2" placeholder="Powtórz hasło"></label>
                <div id="accept">
                   <input type="checkbox" name="checkbox" value = "">Akceptuję
                        <a href="../regulamin/regulamin.html">regulamin</a>
                </div>

                <button>Zarejestruj się</button>
            </form>
         
        </main></aside>
</body>
</html>