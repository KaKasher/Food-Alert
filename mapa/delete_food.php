<?php
 session_start();
 if(!isset($_GET['id'])){
echo "blad";
 exit;
 }else{
    require_once "../login/connect.php";
    $connect = @new mysqli($host,$db_user,$db_password,$db_name);
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    $connect->query("DELETE FROM markers WHERE id='$id'");
 
    header('Location: ../');
    
 }
?>
