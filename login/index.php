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
        <title>FoodAlert - Logowanie</title>
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
                            <form class="box" action="zaloguj.php" method="post">
                                <input type="text" name="nick" placeholder="Nazwa użytkownika/E-mail">
                                <input type="password" name="haslo" placeholder="Hasło">
                                <input type="submit" name="" value="Zaloguj">
                                <a href="register.php">Zarejestruj się</a><br>
                                <?php
                                
                                if(isset($_SESSION['blad'])){
                                echo $_SESSION['blad'];
                                unset($_SESSION['blad']);}
  
                                if(isset($_SESSION['zleznakilog'])){
                                echo $_SESSION['zleznakilog'];
                                unset($_SESSION['zleznakilog']);}  

                                ?>
				                <a href="restor/email.php" class="zmiana-hasla"><br>Zresetuj swoje hasło</a>
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
