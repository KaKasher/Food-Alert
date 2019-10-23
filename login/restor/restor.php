<?php
    session_start();
    if(isset($_SESSION['potw'])){
        $haslo = password_hash($_POST['haslo2'] , PASSWORD_BCRYPT );
        require_once "../connect.php"; 
        $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);
	$email1 = $_POST['email2'];
          $sql2 = "SELECT*FROM logowanie WHERE email='$email1'";
          $sql2 = $polaczenie->query($sql2);
          $sql2 = $sql2->fetch_assoc();
          $token = $sql2['token'];
        if($_SESSION['email2'] != $_POST['email2']){echo 'Bravo znalazłeś buga :D a tak serio to weź się za robote i zrób strona która się tu wyświetli xD';exit;}
	if($token != $_SESSION['token2']){echo 'Bravo znalazłeś buga :D a tak serio to weź się za robote i zrób strona która się tu wyświetli xD';exit;}
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
