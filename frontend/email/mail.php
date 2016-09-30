<?php
require("../../backend/procesos/database.php");
require_once 'PHPMailerAutoload.php';

session_start();

if(isset($_SESSION['correo_cliente'])){
$correo_cliente = $_SESSION['correo_cliente'];



$asunto = $_POST['asuntotxt'];
$mensaje = $_POST['mensajetxt'];



    $mail = new PHPMailer;
    $mail->SMTPDebug = 0;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'atencionclientelcsv@gmail.com';                 // SMTP username
    $mail->Password = 'lcsv2016';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('atencion_clienteLCSV@gmail.com', "Cliente --  ".$correo_cliente." --tiene una consulta");
    $mail->addAddress("lacarpinteriasv@gmail.com","");     // Add a recipient
    $mail->Subject = $asunto;
    $mail->Body = $mensaje;
    $mail->send();

        header("location: ../index.php");


   }

?>