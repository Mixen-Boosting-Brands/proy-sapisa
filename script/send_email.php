<?php
if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: ../index.html" );
}

require 'phpmailer/PHPMailer.php';
require 'phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];

if( empty(trim($nombre)) ) $nombre = 'anonimo';

$body = <<<HTML
    <h1>Sapisa Web</h1>
    <p>De: $nombre / $telefono</p>
    <h2>Mensaje</h2>
    $mensaje
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombre" );
$mailer->addAddress('ventas@sapisa.com.mx','Sitio web');
$mailer->Subject = "Sapisa Web: Presupuestos";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';

$rta = $mailer->send( );

//var_dump($rta);
header("Location: ../index.html" );