<?php
    session_start();
    if(isset($_SESSION['potw'])){
        $haslo = password_hash($_POST['haslo2'] , PASSWORD_BCRYPT );
        require_once "../connect.php"; 
        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
        if($_SESSION['email2'] != $_POST['email2']){echo 'podales zly emial!';exit;}
        $email = $_SESSION['email2'];
        $query = "SELECT id FROM logowanie WHERE email='$email' AND mailconfimed=1";
        $sql = $polaczenie->query($query);
        $sql1 = $sql->fetch_assoc();
        $id = $sql1['id'];
        $sql = $sql->num_rows;
        if($sql > 0){
            $polaczenie->query("UPDATE logowanie SET haslo='$haslo' WHERE id='$id'");
            session_unset();
            header('Location:../');
            exit;

        }else{
            session_unset();
            header('Location:../not-activated.php');
        exit;
    }
}else{
    session_unset();
    header('Location:../');
}
?>