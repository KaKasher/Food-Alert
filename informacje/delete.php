<?php
    session_start();
    require_once "../login/connect.php";
    if((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == false))
    {
    header('Location:../index.php');
    exit();
    }
    $nick = $_SESSION['yournick'];
    $email = $_SESSION['emailzbazy'];
    $connect = @new mysqli($host,$db_user,$db_password,$db_name);
    if($connect->query("DELETE FROM logowanie WHERE nick='$nick'"))
    {
	$connect->query("DELETE FROM markers WHERE nick='$nick'");
    session_unset();
    header('Location: ../');
    }
?>
