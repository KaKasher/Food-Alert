<?php
    session_start();
    if(!isset($_GET['email']) || !isset($_GET['token'])){
    header('Location: index.php');
    exit;
    }else{
        require_once "connect.php"; 
        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        $email = mysqli_real_escape_string($polaczenie, $_GET['email']);
        $token = mysqli_real_escape_string($polaczenie, $_GET['token']);

        $query = "SELECT id FROM logowanie WHERE email='$email' AND token='$token' AND mailconfimed=0";
        $sql = $polaczenie->query($query);
        $sql = $sql->num_rows;
        if($sql > 0){
            $polaczenie->query("UPDATE logowanie SET mailconfimed=1 WHERE email='$email'");
            header('Location: index.php');
            exit;

        }else{
        header('Location: index.php');
        exit;
    }
}
?>
