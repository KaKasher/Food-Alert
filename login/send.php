<?php
    session_start();
    echo !extension_loaded('openssl')?"Not Available":"Available";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
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
    $mail->addAddress($_SESSION['ema']);
    $mail->Subject = 'E-Mail Verification';
    $mail->Body = "
        Dziekujemy za utworzenie konta w serwisie Food Alert. Klikinj w poniższy link by zakończyć rejestrację::<br></br>
        <a href='https://foodalert.brzesko.edu.pl/login/confirm.php?email=".$_SESSION['ema']."&token=".$_SESSION['token']."'>Kliknij tutaj</a><br></br>
	W przypadku problemów lub dalszych pytań prosimy wysłać wiadomość na poniższy adres:<br></br>
foodalert.helpdesk@gmail.com
        ";
    if(!$mail->Send()) {
echo 'Some error... / Jakiś błąd...';
echo 'Mailer Error: ' . $mail->ErrorInfo;
session_unset();
}else{
    header('Location: login-done.php');
    session_unset();
}

?>
