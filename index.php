<?php
    session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="NavbarMainStyle.css"  type="text/css"/>
        <link rel="stylesheet" href="NavbarMainStyleAButton.css"  type="text/css"/>
        <link href="mapa/map.css" rel="stylesheet" />
        <title>FoodAlert</title>
    </head>

    <body>
        <header>
            <nav class="navbar fixed-top navbar-dark navbar-expand-md">
                <a class="navbar-brand" href="strona-glowna">Food Alert</a>
                <button class="navbar-toggler animated-button-js" type="button" data-toggle="collapse" data-target="#menu">
                    <div class="animated-button"><span></span><span></span><span></span><span></span></div>
                </button>
                
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                        <?php
                        if(isset($_SESSION['zalogowany']))
                        echo '<a class="nav-link" href="login/logout.php"> Wyloguj</a>';
                        else
                        echo '<a class="nav-link" href="login">Zaloguj</a>';
                    ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../onas/Onas.php">O nas</a>
                        </li>	
                        <li class="nav-item">
                            <a class="nav-link" href="../kontakt/Kontakt.php">Kontakt</a>
                        </li>		
			            <li class="nav-item">
                            <input class="form-control"  id="nav-search" type="text" placeholder="Wyszukaj"></i>
                        </li>

                    </ul>

                </div>
                
            </nav>
        </header>


        <div id="map"></div>
        <?php
 	if(isset($_SESSION['zalogowany'])){
       	echo '<div class="add"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#popup">Dodaj</button></div>';}
       ?> 
            <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Dodaj jedzenie</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            
                        </div>
                        <div class="modal-body">
                                <form class="box" action="#" method="POST">
                                    <input class="popup-form-control" id="popup-search" type="text" placeholder="Podaj adres" aria-label="Wyszukaj">  
                                    <input class="Adding" id="popup-item" type="text" name="" placeholder="Co chcesz dodać ?">
                                    <input class="comment" id="popup-comment" type="text" name="" placeholder="Komentarz">
                                    
                                </form>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button> <button type="submit" class="btn btn-default" id="add-marker-btn">Dodaj</button>
                        </div>
                    </div>
                </div>

        </div>

        <script src="mapa/map.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFOAkwJSGb774hBD0EWai5BCKcQvdqXAU&libraries=places&language=pl&region=PL&callback=initMap"
        async defer></script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="Button.js"></script>
    </body>
</html>
