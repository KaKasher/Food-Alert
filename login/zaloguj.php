<?php
  session_start();
  require_once "connect.php";

  $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
  
  if($polaczenie->connect_errno!=0){
    echo "Error: ".$polaczenie->connect_errno;
  }
  else{
    $nick = $_POST['nick'];
    $haslo = $_POST['haslo'];
    $hash = "SELECT*FROM logowanie WHERE nick='$nick' OR email='$nick'";
    $hash = $polaczenie->query($hash);
    $hash = $hash->fetch_assoc();  
    $hash = $hash['haslo'];
    if(password_verify($haslo, $hash)){

    $sql = "SELECT*FROM logowanie WHERE nick='$nick' OR email='$nick'";

    if($rezultat = $polaczenie->query($sql)){
      $ilu_userow = $rezultat->num_rows;
      if($ilu_userow>0){
        $sql1 = "SELECT * FROM logowanie WHERE (nick='$nick' OR email='$nick') AND mailconfimed='$value'";
        $sql1 = $polaczenie->query($sql1);
        $sql1 = $sql1->fetch_assoc();
        if($sql1 == 0 ){
	
	 $_SESSION['zalogowany'] = true;
      
        $wiersz= $rezultat->fetch_assoc();
        $_SESSION['yournick'] = $wiersz['nick'];
        $_SESSION['emailzbazy'] = $wiersz['email'];
        
        unset($_SESSION['blad']);
        $rezultat->free_result();
        header('Location: ../index.php');
	}else{
          header('Location: not-activated.php');
          exit;
        }
      
	}
    }}else{
      $_SESSION['blad'] = '<span style="color:red">login or password incorrect </span>';
      header('Location: index.php');
    }

    $polaczenie->close();
    
  }

?>
