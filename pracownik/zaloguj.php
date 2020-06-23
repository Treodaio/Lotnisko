<!-- 1 - pilot,  2 -- obsluga sprzatajaca, 3-- obsluga informacyjna, 4 to ochrona -->
<?php
session_start();
require_once "connect.php";

if(!isset($_POST['login']) || (!isset($_POST['haslo'])))
{
    header('Location: pracownik.php');
}

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if ($polaczenie ->connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno."Opis błedu: ".$polaczenie->connect_error;


    //jezeli udalo sie nawiazac polaczenie
} else {

    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    $wybor = $_POST['praca'];



    //sprawdzenie poprawności logowania się na poszczególne konta
    // echo "Działa";
    // echo $wybor;

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
    
    //PILOT //
    if($wybor == '1'){
        if ($rezultat = $polaczenie->query(sprintf("SELECT * FROM piloci WHERE login = '%s' AND haslo = '%s'", mysqli_real_escape_string($polaczenie, $login),
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
               $_SESSION['czas_pracy'] = $wiersz['czas_pracy'];
       
               $rezultat->close();
               header('Location: panel_piloci.php');
           }else {
       
               header('Location: pracownik.php');
           }
        }
    }

    //OBSLUGA SPRZATAJACA 
    if($wybor == '2'){

        if ($rezultat = $polaczenie->query(sprintf("SELECT * FROM obslugasprzatajaca WHERE login = '%s' AND haslo = '%s'", mysqli_real_escape_string($polaczenie, $login),
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
                   $_SESSION['czas_pracy'] = $wiersz['czas_pracy'];
                   
                
           
                   $rezultat->close();
                   header('Location: panel_sprzatajaca.php');
               }else {
                   header('Location: pracownik.php');
               }
            }

    }


        //OBSLUGA INFORMACYJNA 
   if($wybor == '3')
   {
    if ($rezultat = $polaczenie->query(sprintf("SELECT * FROM obslugainformacyjna WHERE login = '%s' AND haslo = '%s'", mysqli_real_escape_string($polaczenie, $login),
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
               $_SESSION['czas_pracy'] = $wiersz['czas_pracy'];

       
               $rezultat->close();
               header('Location: panel_informacja.php');
           }else {

               header('Location: pracownik.php');
           }
        }
        }
        //OCHRONA 
        
    if($wybor == 4){
        if ($rezultat = $polaczenie->query(sprintf("SELECT * FROM ochrona WHERE login = '%s' AND haslo = '%s'", mysqli_real_escape_string($polaczenie, $login),
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
               $_SESSION['czas_pracy'] = $wiersz['czas_pracy'];
               
              
       
               $rezultat->close();
               header('Location: panel_ochrona.php');
           }else {
    
               header('Location: pracownik.php');
           }
        }
    }
  


    $polaczenie->close();



}



?>

