<?php
    session_start();
    require_once "../login/connect.php"; 
    $connect = @new mysqli($host,$db_user,$db_password,$db_name);
    $haslo = $_POST['zmianahasla'];
    $haslo1 = $_POST['zmianahasla1'];
    $nick = $_SESSION['yournick'];
    

    if($haslo != $haslo1){$_SESSION['blad3'] = '<span style="color:red">Hasła nie mogą być różne!<br> </span>'; header('Location: konto.php'); exit;}
    if(empty($haslo)){$_SESSION['blad3'] = '<span style="color:red"><br>Musisz wpisać hasło! </span>'; header('Location: konto.php'); exit;}
    $haslo = password_hash($_POST['zmianahasla'] , PASSWORD_BCRYPT );
    $connect->query("UPDATE logowanie SET haslo='$haslo' WHERE nick='$nick'");
    header('Location: konto.php');
    session_unset();

