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
    <title>Twój panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="oferta.css">
</head>
<body>
   
<div class="wrapper">
    <aside class = "main_information">
    <h1>Twoje dane: </h1> 
    <?php
    echo '<button class = "logout"><a href = "logout.php">Wyloguj się</a></button>';
    echo '<p class = "info">Imię: '.$_SESSION["imie"].'</p>';
    echo "<p>ID: ".$_SESSION['id']."</p>";
    echo '<p class = "info">Nazwisko: '.$_SESSION['nazwisko'].'</p>';
    echo "<p>Kraj: ".$_SESSION['kraj']."</p>";
    echo '<p class = "info">Nr paszportu : '.$_SESSION['paszport'].'</p>';
    echo "<p>Nr dowodu: ".$_SESSION['dowod']."</p>";
    echo '<p class = "info">Login: '.$_SESSION['login'].'</p>';
    echo "<p>E-mail: ".$_SESSION['email']."</p>";
    ?>
    </aside>
<aside class = "search">
<h1>Tutaj wyszukasz interesującą Cię destynacje</h1>

<?php
$con= mysqli_connect ("localhost","root","","lotnisko");

$max_words = 1; 
$max_length = 20; 

// PHP - Wyszukiwarka.

if ( !isset($_POST['submit']) )
{
	$body = '
	<form action="oferta.php" method="post">
	Wpisz nazwę Państwa do którego chcesz lecieć: <span font-color: Black"></span>
	<input type="post" name="fraza" class="form-control" maxlength="'.$max_length.'"><br>
	<input type = "submit" name="submit" value="Szukaj połączeń" class="przycisklotu"/>
	</form><br><br>';
	
	
	echo $body;
}
else
{
	$search_words = trim($_POST['fraza']);
	$search_words = mysqli_real_escape_string($con,$search_words);
	$count_words = substr_count($search_words, ' ');
	
	if ( ($count_words + 1) > ($max_words) )
	{
		echo "Użyłeś za wiele słów";
		exit;
	}
	
	$search_words = str_replace("*", "%", $search_words);
	echo '<h4 id = "bilet-info">Szukana fraza: '.$search_words.'<br>';
    



	$result = mysqli_query($con,"SELECT * FROM `miejsce` WHERE panstwo LIKE '".$search_words."'")
        or die('Błąd w wyszukiwaniu! Prosimy spróbuj później');
        
    //  $result2 = mysqli_query($con, "SELECT * FROM `podroze` WHERE nazwa_podrozy LIKE '%".$search_words."%'");



    $result2 = mysqli_query($con, "SELECT podroze.id, nazwa_podrozy, cena, klasa, panstwo, lotnisko, miasto FROM podroze INNER JOIN podroze_has_bilety ON podroze_has_bilety.podroze_id = podroze.id INNER JOIN bilety ON bilety.id = podroze_has_bilety.bilety_id INNER JOIN miejsce ON miejsce.id = bilety.miejsce_przylotu WHERE nazwa_podrozy LIKE '%".$search_words."%'");
    



    //  $kup1 = '<a href="oferta.php?nr_lotu=';
	$num = mysqli_num_rows($result);
	if ($num == 0)
	{
		echo "Nie znaleziono pasujących.";
		exit;
	}
	else
	{
 //Tu był komentarz 1
if ($result->num_rows > 0) {

    while( $row = $result->fetch_assoc())
    {
  echo '<h4 class = "bilet-info"><b>Miejsce docelowe</b>: '.$row["panstwo"]."<br>"."<b>Miasto</b>: ".$row["miasto"]."<br>"."<b>Państwo</b>: ".$row["lotnisko"]."<br>"."<b>Lotnisko - kod IATA</b>: ".$row["IATA"].'<br></br><br></br></h4>';
    }
    
//     while($row2 = $result2->fetch_assoc()) {
//             echo '<div id = "kontener">'."<b>ID: </b>".$row2['id']."<b> Nazwa: </b>".$row2['nazwa_podrozy'].'<form action="oferta.php" method="post">
//                 <button type="submit" name="kupiony" value='.$row2["id"].' class="kup">Kup</button></form>'."<br></br>".'</div>';
//    }
    

while($row2 = $result2->fetch_assoc()) {
    echo '<div id = "kontener">'."<b>Nazwa podróży: </b>".$row2['nazwa_podrozy']."<b> Cena: </b>".$row2['cena']."<b> Klasa: </b>".$row2['klasa']."<b>Miasto docelowe: </b>".$row2['miasto'].'<form action="oferta.php" method="post">
    <button type="submit" name="kupiony" value='.$row2["id"].' class="kup">Kup</button></form>'."<br></br>".'</div>';
}


} else {
    echo "0 results";
}

    mysqli_close($con);
	}
}

?>



</aside>
<section class = "bilet">
        <h1>Moje ekscytujące podróże</h1>

        <?php
  $con= mysqli_connect ("localhost","root","","lotnisko");
        


  
  
    //Jeżeli ktoś nie zakupił jeszcze biletu. TO miejsce na historie
        if ((!isset($_POST['kupiony']))) {

            $historia = mysqli_query($con, 'SELECT `podroze`.`nazwa_podrozy` FROM `podroze` INNER JOIN `podroze_has_pasazerowie` ON `podroze_has_pasazerowie`.`podroze_id` = podroze.id AND podroze_has_pasazerowie.pasazerowie_id = '.$_SESSION['id'].'' );

            if($historia->num_rows > 0)
            {
                echo '<h4 class= "bilet-info">Posiadasz już :'; 
                while($row4 = $historia->fetch_assoc())
                {
                    echo '<h4 class= "bilet-info">'.$row4['nazwa_podrozy'].'</h4>';
                }
            }else {
                echo "<h4 id = bilet-info>Jeszcze nie posiadasz żadnego biletu. Zapraszamy do zakupu<h4>";
            }   


           //OBSŁUGA ZAKUPU BILETU
        } else {
            $id_pasazera = $_SESSION['id'];
            $kupiony_bilet = $_POST['kupiony'];
            // $id_pasazera = $_SESSION['id'];

            // Posiadasz już ten bilet? 
            $masz = mysqli_query($con,'SELECT * FROM `podroze_has_pasazerowie` WHERE podroze_id = '.$kupiony_bilet.' AND pasazerowie_id = '.$id_pasazera.'');
            
            if($masz->num_rows > 0)
            {
                while($sprawdzam = $masz->fetch_assoc()) {
                    if (($sprawdzam['podroze_id'] == $kupiony_bilet) && $id_pasazera == $sprawdzam['pasazerowie_id'])
                    {
                      echo "<h4 id = bilet-info>Posiadasz już ten bilet!<h4>";
                      exit();
                    }
                }
            }
          
            
            echo '<h4 id = bilet-info>Posiadasz bilet o id równym: '.$kupiony_bilet.'<h4>';
            echo '<h4 id = bilet-info>Twoje id: '.$id_pasazera.'<h4>';

            if (!$con) {
                die("Oops! Houston jest problem!: " . mysqli_connect_error());
              } 
               else {

                $sql = 'INSERT INTO `podroze_has_pasazerowie`(`podroze_id`, `pasazerowie_id`) VALUES ('.$kupiony_bilet.','.$id_pasazera.')';
                
                  if (mysqli_query($con, $sql)) {
                  echo "Dziękujemy za zakup i życzymy udanej podróży :)";
                  } else {
                  echo "Błąd połączenia: " . $sql . "<br>" . mysqli_error($con);
                  }
  
              }
           


                mysqli_close($con);
        }
     
        ?> 
        <!-- M O J E K O N T O    -->



</section>
    <section class = "oferta">
    <main>
            <div class="wstep">
                <h1>Nasza oferta pozwala na dostanie się do 5 miejsc które zachwycają. Przekonaj się sam o ich
                    wyjątkowości.</h1>

                <p>Oto co mamy do zaoferowania. Niezależnie od tego czy lecisz w celach
                    wypoczynkowych,
                    naukowych, czy biznesowych na pewno znajdziesz coś dla siebie.</p>
            </div>
            <div class="usa">
                <h1>#1.USA - Nowy Jork</h1>
                <section><img src="img/usa.jpg" alt="United States Of America"></section>
                <p>Turystycznie jest warte odwiedzenia z wielu powodów. Nadal uważane za „światową stolicę”, i nie da
                    się ukryć, że właśnie to miasto jest jednym z głównych źródeł amerykańskiej kultury.

                    Miasto składa się z pięciu dzielnic, przy czym najbardziej atrakcyjną jest oczywiście słynny
                    Manhattan. Poza tym Nowy Jork to również Brooklyn, Queens, Bronx, oraz wyspa Staten Island</p>
            </div>

            <div class="włochy">
                <h1>#2.Włochy - Bergamo</h1>
                <section><img src="img/wlochy.jpg" alt="włochy"></section>
                <p>LTo 120-tysięczne miasto położone w Lombardii, na północy Włoch. Stanowi ono idealne miejsce, aby
                    poczuć klimat włoskich miasteczek, nasycić oczy pięknymi zabytkami i krajobrazami, posmakować kuchni
                    włoskiej, a przy tym nie zbankrutować.W Bergamo człowiek zwalnia, gdyż nie czuć tutaj upływu czasu.
                    Piękne stare kamienice, wąskie brukowane uliczki, romantyczne restauracje, kawiarenki i sklepiki
                    zachęcające do wejścia. </p>
            </div>

            <div class="australia">
                <h1>#3.Australia - Sydney</h1>
                <section><img src="img/australia.jpg" alt="Australia"> </section>

                <p>Sydney to jedno z najbardziej atrakcyjnych pod względem turystycznym miast świata oraz największe
                    miasto Australii. Nie brakuje tu atrakcji turystycznych, zarówno tych związanych z naturą, jak i
                    będących wytworem rąk i umysłów ludzkich. Każdy znajdzie tu coś dla siebie, począwszy od
                    amatorów
                    kosmopolitycznego, miejskiego stylu życia po zawołanych miłośników słonecznych plaż. Bogactwa
                    oferty
                    turystycznej i charakteru temu miastu może pozazdrościć niejedna metropolia. </p>
            </div>

            <div class="japonia">
                <h1>#4.Japonia - Tokio</h1>
                <section><img src="img/japonia.jpg" alt="Japonia"> </section>
                <p>Tokio to jedno z większych miast świata rocznie przyciągające około 7 mln turystów. Położone jest na
                    największej wyspie Japonii Honsiu nad Zatoką Tokijską i skupia ponad 8 milionów mieszkańców w samym
                    mieście a aglomeracja Tokio liczy ich ponad 12 milionów.
                    Wyjątkowo dynamiczny rozwój Tokio wpłynął na powstanie wyjątkowo zróżnicowanego miasta, które
                    posiada dzielnice o wielowiekowej historii oraz dzielnice z wieżowcami, których nie powstydziłaby
                    się żadna metropolia na świecie. </p>
            </div>
            <div class="szwajcaria">
                <h1>#5.Szwajcaria - Genewa</h1>
                <section><img src="img/szwajcaria.jpg" alt="genewa"> </section>
                <p>Genewa (Geneva) to drugie co do wielkości miasto Szwajcarii i jedno z najbogatszych na świecie.
                    Malowniczo usytuowane nad brzegiem Jeziora Genewskiego u podnóża Alp, zaskakuje turystów swoim
                    pięknem, bogactwem ciekawych miejsc oraz przyjaznymi ludźmi. Genewa oprócz jeziora kojarzy się z
                    zegarkami, bankami oraz międzynarodowymi instytucjami, które tutaj mają swoje siedziby. To miasto
                    idealne na weekend, a dodatkowo bardzo romantyczne.</p>
            </div>
        </main>
    </section>
</div>
</body>
</html>


<!-- 
    WYciągnij bilety do podróży
SELECT * FROM bilety INNER JOIN podroze_has_bilety ON bilety.id = podroze_has_bilety.bilety_id AND podroze_has_bilety.podroze_id = 1


-->
