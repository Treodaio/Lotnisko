<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotnisko - pracownik</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap&subset=latin-ext" rel="stylesheet">
    <script src="https://kit.fontawesome.com/005dd1e3a8.js" crossorigin="anonymous"></script>
    <!-- naglowek wymaga podania sciezki -->
    <link rel="stylesheet" href="../naglowek.css">
    <link rel="stylesheet" href="pracownik.css">

</head>

<body>
    <nav>
        <ul>
            <li><i class="far fa-clipboard"></i><a href="../index.html">Strona główna</a></li>
            <li><i class="far fa-clipboard"></i><a href="../rejestracja/rejestracja.php">Rejestracja</a></li>
            <li><i class="far fa-images"></i><a href="../galeria/galeria.html">Galeria</a></li>
            <!-- <li><i class="fas fa-route"></i><a href="#">Podróż</a></li> -->
            <li><i class="fas fa-ticket-alt"></i><a href="../oferta/oferta.html">Oferta</a></li>
            <li><i class="fas fa-user-friends"></i><a href="../pracownik/pracownik.html">Dla pracownika</a></li>
            <li><i class="fas fa-calculator"></i><a href="../kalkulator/kalkulator.html">Kalkulator</a></li>
            <li><i class="far fa-clipboard"></i><a href="../regulamin/regulamin.html">Regulamin</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <main>
            <h1>Zaloguj się na swoje konto</h1>
            <form action="zaloguj.php" method = "POST">
                <select name="praca">
                    <option value = "1">Pilot</option>
                    <option value = "2">Obsługa sprzątająca</option>
                    <option value = "3">Obsługa informacyjna</option>
                    <option value = "4">Ochrona</option>
                </select>
                <label id="username" for="username"><input type="text" name="login" placeholder="Login"></label>
                <label id="password" for="password"><input type="password" name="haslo" placeholder="Hasło"></label>
                <button>Zaloguj się</button>
                <p>Panel ten służy do logowania się naszej załodze. Naszych klientów zapraszamy na
                    <a href="../rejestracja/rejestracja.php">tą stronę</a> w celu
                    zalogowania się.</p>
            </form>
        </main>
    </div>
    <script src="pracownik.js"></script>
</body>

</html>