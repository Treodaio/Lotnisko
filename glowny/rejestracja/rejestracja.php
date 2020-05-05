<?php
session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
{
header('Location: oferta.php');
exit();
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotnisko - rejestracja</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap&subset=latin-ext" rel="stylesheet">
    <script src="https://kit.fontawesome.com/005dd1e3a8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="rejestracja.css">
    <link rel="stylesheet" href="../naglowek.css">

</head>

<body>
    <nav>
        <ul>
            <li><i class="far fa-clipboard"></i><a href="../index.html">Strona główna</a></li>
            <li><i class="far fa-clipboard"></i><a href="#">Rejestracja</a></li>
            <li><i class="far fa-images"></i><a href="../galeria/galeria.html">Galeria</a></li>
            <li><i class="fas fa-route"></i><a href="../podroz/podroz.html">Podróż</a></li>
            <li><i class="fas fa-ticket-alt"></i><a href="./oferta/oferta.html">Oferta</a></li>
            <li><i class="fas fa-user-friends"></i><a href="../pracownik/pracownik.html">Dla pracownika</a></li>
            <li><i class="fas fa-calculator"></i><a href="../kalkulator/kalkulator.html">Kalkulator</a></li>
            <li><i class="far fa-clipboard"></i><a href="../regulamin/regulamin.html">Regulamin</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <main>
            <h1>Nie posiadasz konta? Zarejestruj się w serwisie</h1>
            <p class="warning">Dziękujemy za rzetelne wypełnienie powyższego formularza.</p>
            <form action="..." method="POST">
                <label id="imie" for="imie"><input type="text" placeholder="Imię"></label>
                <label id="nazwisko" for="nazwisko"><input type="text" placeholder="Nazwisko"></label>
                <label id="kraj" for="kraj"><input type="text" placeholder="Kraj pochodzenia"></label>

                <label id="paszport" for="paszport"><input type="text" placeholder="Paszport - wpisz 15 cyfr"></label>
                <label id="dowod" for="dowod"><input type="text" placeholder="Dowod - wpisz 9 cyfr"></label>

                <label id="email" for="email"><input type="text" placeholder="Email"></label>
                <label id="login" for="login"><input type="text" placeholder="Login"></label>
                <label id="haslo" for="haslo"><input type="text" placeholder="Hasło"></label>
                <label id="haslo_2" for="haslo"><input type="text" placeholder="Powtórz hasło"></label>

                <button>Zarejestruj się</button>
            </form>
            <section class="account">
                <h2>Masz już konto? </h1>
                    <span class="login">Zaloguj się</span>

            </section>
        </main>
    </div>

    <div class="login-modal">
        <aside>
            <h1>Zaloguj się na swoje konto</h1>
            <form action="zaloguj.php" method="POST">
                <label id="username" for="username"><input type="text" name="login" placeholder="Login"></label>
                <label id="password" for="password"><input type="password" name="haslo" placeholder="Hasło"></label>
                <button>Zaloguj się</button>

                <?php
            // if(isset($_SESSION['blad'])) {echo $_SESSION['blad'];}
                ?>

            </form>
            <span class="hide">X</span>
        </aside>
    </div>
    <script src="rejestracja.js"></script>
    <script src="login.js"></script>
</body>

</html>