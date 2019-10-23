<?php
    session_start();
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require_once "connect.php";
    $polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
    if($polaczenie->connect_errno!=0){
        echo "Error: ".$polaczenie->connect_errno;
      }
      else{
          $email = $_POST['email1'];
          $sql = "SELECT*FROM logowanie WHERE email='$email'";
          $sql = $polaczenie->query($sql);
          $sql = $sql->fetch_assoc();
          $token = $sql['token'];
          $emaill = $sql['email'];
          if($emaill != $email){$_SESSION['error_restore'] = '<span style="color:red">Nie ma konta o takim adresie email! </span>'; header('Location: restor/email.php'); exit;} 
            
    include_once 'PHPMailer/PHPMailer.php';
    include_once 'PHPMailer/Exception.php';
    include_once 'PHPMailer/SMTP.php';
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->isHTML(true);
    $mail->Username = '';
    $mail->Password = '';
    $mail->From='';
    $mail->FromName='FoodAlert';
    $mail->addAddress($_POST['email1']);
    $mail->Subject = 'E-Mail restore';
    $mail->Body = "
        Oto link który resetuje twoje hasło :<br></br>
        
       <a href='http://83.68.95.60/login/restor/passwords.php?email=".$email."&token=".$token."'>Kliknij tutaj </a>
        ";
    if(!$mail->Send()) {
echo 'Some error... / Jakiś błąd...';
echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    header('Location: index.php');
}
}
?>
