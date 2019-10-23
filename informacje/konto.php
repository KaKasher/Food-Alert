<?php
    session_start();

    if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == false))
    {
    header('Location:../index.php');
    exit();
    }
?>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../NavbarMainStyle.css"  type="text/css"/>
        <link rel="stylesheet" href="../NavbarMainStyleAButton.css"  type="text/css"/>
        <link rel="stylesheet" type="text/css" href="KontoStyle.css">
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
                            if(isset($_SESSION['zalogowany'])){echo '<li class="nav-item"><a class="nav-link" href="konto.php">Konto</a></li>';}
                        ?>
                    </ul>

                </div>
                
            </nav>
        </header>

        <main>
            <div class="glowny">
                <h1>Konto</h1>
                    <div class="kontener">
                        <div class="content">
                            <h3>Witaj <?php echo $_SESSION['yournick']; ?>!</h3>
                            <h6><i class="fas fa-envelope"></i>Aktualny E-mail:</h6>
                            <p> <?php echo $_SESSION['emailzbazy']; ?></p>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#email">Zmień E-mail</button>


                            <h6><i class="fas fa-lock"></i>Zapomniałeś hasła?</h6>
                            <p>Kliknij w przycisk poniżej</p>
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#haslo">Zmień Hasło</button>


                            <h6><i class="fas fa-user-minus"></i>Usunięcie konta</h6>
                            <button class="btn btn-secondary" type="button" data-toggle="modal" data-target="#usun">Usuń konto</button>
                        </div>
                    </div>
            </div>   
    <!------------------------------------------------------------------------------------------------------------------POPUP ZMIANY EMAIL------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="email-content">
                        <div class="modal-header">
                            <h3>Wprowadź nowy E-mail!</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                        </div>
                        <div class="modal-body">
                            <form class="box" action="changeemail.php" method="POST">
                                <input type="email" name="email-input" class="email-input" placeholder="Podaj nowy E-mail">
                                <button type="submit" class="btn btn-primary" id="zmienEmail">Zapisz</button>
			    <?php 
                                
                                if(isset($_SESSION['emi'])){
                                echo $_SESSION['emi'];
                                unset($_SESSION['emi']);}
                                if(isset($_SESSION['erno'])){
                                echo $_SESSION['erno'];
                                unset($_SESSION['erno']);}
                                
                                ?>
			    </form>
                        </div>
                        
                    </div>
                </div>

        </div>

<!------------------------------------------------------------------------------------------------------------------POPUP ZMIANY HASŁA------------------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="modal fade" id="haslo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="haslo-content">
                        <div class="modal-header">
                            <h3>Wprowadź nowe hasło!</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                        </div>
                        <div class="modal-body">
                            <form class="box" action="changepassword.php" method="POST">
                                <input type="password" name="zmianahasla" class="haslo-input" placeholder="Podaj hasło" minlength="5">
                                <input type="password" name="zmianahasla1" class="haslo-input" placeholder="Powtórz hasło">
                                <button type="submit" class="btn btn-primary" id="zmienhaslo">Zapisz</button>
			       <?php
                                if(isset($_SESSION['blad3'])){
                                echo $_SESSION['blad3'];
                                unset($_SESSION['blad3']);}
                                ?>
			    </form>	
                        	
                        </div>
                        
                    </div>
                </div>

        </div>
    <!------------------------------------------------------------------------------------------------------------------POPUP USUWANIA KONTA------------------------------------------------------------------------------------------------------------------------------------------------------->
              <div class="modal fade" id="usun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="usuwanie-content">
                        <div class="modal-header">
                            <h3>Jesteś tego pewien ?</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                        </div>
                        <div class="modal-body">
                         <a class="btn btn-secondary " href="delete.php" role="button">Usuń konto</a>
			    </form>	
                        	
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
