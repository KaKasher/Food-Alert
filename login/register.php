<?php
    session_start();
    if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true))
  {
    header('Location:../index.php');
    exit();
  }
?>
<!DOCTYPE HTML>
<html>
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../favicon.ico?v=<?php echo time() ?>" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"  type="text/css"/>
        <title>FoodAlert - Rejestracja</title>
    </head>

    <body>
        <header>
            <nav class="navbar fixed-top navbar-dark navbar-expand-md">
                <a class="navbar-brand mx-auto" href="../">Food Alert</a>
            </nav>
        </header>

        <main>
            <section class="contentbox">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="box" action="rejestr.php" method="POST">
                            <?php
                                if(isset($_SESSION['lg']))
                                echo $_SESSION['lg'];
                                unset($_SESSION['lg']);
                                ?>
                                <input type="text" name="login1" placeholder="Nazwa użytkownika" maxlength="25">
                                <input type="password" name="haslo" placeholder="Hasło" minlength="5">
                                <?php
                                if(isset($_SESSION['bl']))
                                echo $_SESSION['bl'];
                                unset($_SESSION['bl']);
                                ?>
                                <input type="password" name="haslo1" placeholder="Powtórz hasło">
                                <?php
                                if(isset($_SESSION['em']))
                                echo $_SESSION['em'];
                                unset($_SESSION['em']);
                                ?>
                                <input type="email" name="email" placeholder="E-Mail">
                                <input type="checkbox" name="kwadrat">    Wyrażam zgodę na przetwarzanie moich danych osobowych
                                <input type="submit" name="" value="Zarejestruj">
                                <?php 
                                if(isset($_SESSION['error'])){
                                    echo $_SESSION['error'];
                                    unset($_SESSION['error']);}

                                if(isset($_SESSION['zleznaki'])){
                                echo $_SESSION['zleznaki'];
                                unset($_SESSION['zleznaki']);}
                                ?>
                                
                            </form>    
                                                
                        </div>
                    </div>      
                </div>
            </section>
        </main>

           
        

        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

</html>
