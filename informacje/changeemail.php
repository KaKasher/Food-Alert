<?php
    session_start();
    require_once "../login/connect.php"; 
    $connect = @new mysqli($host,$db_user,$db_password,$db_name);
    $email = $_POST['email-input'];
    $nick = $_SESSION['yournick'];
    $ema = $connect->query("SELECT email FROM logowanie WHERE email='$email'");
    $eml = $ema->num_rows;

    if($eml == 1){$_SESSION['emi'] = '<span style="color:red">Taki e-mail już istnieje!<br> </span>'; header('Location: konto.php'); exit;}
    if(empty($_POST["email-input"])){$_SESSION['erno'] = '<p style="color:red">Uzupełnij pole!</p>'; header('Location: konto.php'); exit;}
    $connect->query("UPDATE logowanie SET mailconfimed=0 , email='$email' WHERE nick='$nick'");
    $_SESSION['ema'] =  $_POST['email-input'];
    $token = $connect->query("SELECT token FROM logowanie WHERE nick='$nick'");
    $token = $token->fetch_assoc();
    $_SESSION['token'] = $token['token'];
    header('Location: send.php'); 
