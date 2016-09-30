<?php
$correo=$_POST['email'];
require("../../backend/procesos/database.php");
require_once 'PHPMailerAutoload.php';

function randomPassword() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
    	$n = rand(0, $alphaLength);
    	$pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string

}


$pass = randomPassword();
$passHash = password_hash($pass, PASSWORD_BCRYPT);
$sql='update clientes set contraCliente=? where correo_cliente=?';
Database::executeRow($sql,array($passHash,$correo));

$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';

    $mail->SMTPDebug = 0;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'atencionclientelcsv@gmail.com';                 // SMTP username
    $mail->Password = 'lcsv2016';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('atencion_clienteLCSV@gmail.com', 'La carpinteria SV');
    $mail->addAddress($correo,'');     // Add a recipient
    $mail->Subject = 'Recuperar Clave';
    $mail->Body    = 'Tu nueva contraseña es '.$pass;
    $mail->AltBody = 'prueba';

    $mail->send()

    header("location: ../index.php");

    ?>