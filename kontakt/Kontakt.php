<?php
    session_start();
?>

<html>
    <head>
        <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../NavbarMainStyle.css"  type="text/css"/>
        <link rel="stylesheet" href="../NavbarMainStyleAButton.css"  type="text/css"/>
        <link rel="stylesheet" type="text/css" href="KontaktStyle.css">
        <title>Food Alert</title>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-dark navbar-expand-md">
                <a class="navbar-brand" href="../">Food Alert</a>
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
                        <?php
                            if(isset($_SESSION['zalogowany'])){echo '<li class="nav-item"><a class="nav-link" href="/informacje/konto.php">Konto</a></li>';}
                        ?>

                    </ul>

                </div>
                
            </nav>
        </header>

        <main>
            <div class="glowny">
                <h1>Kontakt</h1>
                    <div class="kontener">
                        <div class="content">
                                <div class="row">
                                <div class="col-md-4 foto"> <img src="https://i.imgur.com/9ZQr08f.png">
                                <p>
                                Project Manager/Map developer<br>
                                Kacper Gregorowicz<br>
                                E-mail:<br> gregorowicz.kacper@gmail.com
                                </p>
                                </div> 
                                <div class="col-md-4 foto"><img src="https://i.imgur.com/bWEdTjw.png%22%3E">
                                <p>
                                Front-end developer<br>
                                Oskar Michta<br>
                                E-mail:<br> 
                                michtabiznes@gmail.com
                                </p>
                                </div> 
                                <div class="col-md-4 foto"><img src="https://i.imgur.com/skLf2jR.jpg">
                                <p>
                                Web Designer/Front-end developer<br>
                                Jakub Wojdak<br>
                                E-mail: <br>
                                jakub.wojdak16@gmail.com
                                </p>
                                </div>
                            </div>

                                    <div class="row">
                                <div class="col-md-4 offset-md-2 foto"><img src="https://i.imgur.com/ypjU0fr.jpg">
                                    <p>
                                    Technology Consultant<br>
                                    Eliasz Nalepka<br>
                                    E-mail:<br> 
                                    e.nalepka01@gmail.com
                                </p>
                                </div> 
                                
                                <div class="col-md-4 foto"><img src="https://i.imgur.com/uAStBO5.png">
                                    <p>
                                    Back-end developer<br>
                                    Dawid Sroka<br>
                                    E-mail:<br> 
                                    dawidfirm1@gmail.com
                                </p>
                                </div> 
                            </div>
                    </div>
                </div>
            </div>   
    
    
        </main>

        <script src="https://kit.fontawesome.com/7dbd9042fb.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="../Button.js"></script>
    </body>
</html>
