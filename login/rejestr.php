<?php
 session_start();
 require_once "connect.php";
	 $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
  
  
  $logins = trim($_POST['login1']);
  $lg = $polaczenie->query("SELECT nick FROM logowanie WHERE nick='$logins'");    
  $lgi = $lg->num_rows;
  $_SESSION['ema'] = $_POST['email'];
  $email = trim($_POST['email']);
  $em = $polaczenie->query("SELECT email FROM logowanie WHERE email='$email'");
  $eml = $em->num_rows;


    if($lgi == 1){$_SESSION['lg'] = '<span style="color:red">Taki login już istnieje! </span>'; header('Location: register.php'); exit;}
    if($eml == 1){$_SESSION['em'] = '<span style="color:red">Taki e-mail już istnieje!<br> </span>'; header('Location: register.php'); exit;}
    if (empty($_POST["login1"]) || empty($_POST["haslo"]) || empty($_POST["haslo1"]) || empty($_POST["email"]) || empty($_POST["kwadrat"])){$_SESSION['error'] = '<p style="color:red">Musisz wypełnić wszystkie pola i wyrazić zgodę!</p>'; header('Location: register.php'); exit;}
    if(ctype_alnum($logins) == false){$_SESSION['zleznaki'] = '<span style="color:red">Możesz używać tylko liczb i liter! </span>'; header('Location: register.php'); exit;}
    if(($_POST['haslo']) != ($_POST['haslo1'])){$_SESSION['bl'] = '<span style="color:red">Złe hasło ! </span>'; header('Location: register.php'); exit;}


else{
  
  $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM123456789';
	$token = str_shuffle($token);
  $_SESSION['token'] = substr($token,16,16);

  $passwordhash = password_hash($_POST['haslo'] , PASSWORD_BCRYPT );
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $dod='insert into logowanie(haslo,nick,email,mailconfimed,token) values("'.$passwordhash.'","'.$_POST["login1"].'","'.$_POST["email"].'","0","'.$_SESSION['token'].'")';}
  if (mysqli_query($polaczenie, $dod)) {
	header('Location: send.php');
} else {
    echo "Error: " . $dod . "<br>" . mysqli_error($polaczenie);
}}
?>
