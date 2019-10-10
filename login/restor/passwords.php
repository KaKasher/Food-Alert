<?php
    session_start();
    if(!isset($_GET['email'])){
    header('Location: ../index.php');
    exit;}
    else{
        $_SESSION['potw'] = true;
        require_once "../connect.php"; 
        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        $_SESSION['email2'] = mysqli_real_escape_string($polaczenie, $_GET['email']);
    }
    ?>
<!DOCTYPE HTML>
<html>
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css"  type="text/css"/>
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
                            <form class="box" action="restor.php" method="POST">
                    
                                <input type="password" name="haslo2" placeholder="Hasło" minlength="5">
                                <input type="email" name="email2" placeholder="Podaj E-Mail">
                               
                                <input type="submit" name="" value="Zrestartuj">
                               
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