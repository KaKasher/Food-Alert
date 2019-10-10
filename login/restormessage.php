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
        
        http://localhost/Food-Alert/login/restor/passwords.php?email=".$email."&token=".$token."
        ";
    if(!$mail->Send()) {
echo 'Some error... / Jakiś błąd...';
echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    header('Location: index.php');
}
}
?>