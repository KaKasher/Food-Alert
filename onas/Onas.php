<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../NavbarMainStyle.css"  type="text/css"/>
        <link rel="stylesheet" href="../NavbarMainStyleAButton.css"  type="text/css"/>
        <link rel="stylesheet" type="text/css" href="OnasStyle.css">
        <title>Food Alert</title>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark navbar-expand-md">
                <a class="navbar-brand" href="../strona-glowna">Food Alert</a>
                <button class="navbar-toggler animated-button-js" type="button" data-toggle="collapse" data-target="#menu">
                    <div class="animated-button"><span></span><span></span><span></span><span></span></div>
                </button>
                
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        <?php
                        if(isset($_SESSION['zalogowany']))
                        echo '<a class="nav-link" href="../login/logout.php"> Wyloguj</a>';
                        else
                        echo '<a class="nav-link" href="../login">Zaloguj</a>';
                    ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../onas/Onas.php">O nas</a>
                        </li>	
                        <li class="nav-item">
                            <a class="nav-link" href="../kontakt/Kontakt.php">Kontakt</a>
                        </li>		
                    </ul>

                </div>
                
            </nav>
        </header>

        <main>
            <div class="glowny">
                <h1>O Nas</h1>
                    <div class="kontener">
                        <div class="tekst">
                            Wszystko zaczeło się od pewnego dnia kiedy to dwóch założycieli wracając ze szkoły spotkało menela Mariana poprosił on o pieniądze na alkohol jednak my wiedzieliśmy że tak naprawdę chciał je wydać na jedzenie, niestety nie mieliśmy przy sobie ani grosza. Fakt ten zezłościł pana Mariana do tego stopnia że groził powiadomieniem policji że nie posiadamy pieniędzy. Zaszokowani zaistniałą sytuacją wróciliśmy do domu i zaczęliśmy myśleć nad rozwiązaniem aby już nigdy nie spotkała nas taka sytuacja. Tak o to powstało Food Alert dzięki któremu nawet Pan Marian już nigdy nie będzie głodny.
                        </div>  
                    </div>
            </div>   
    
    
        </main>

       
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../Button.js"></script>
    </body>
</html>
