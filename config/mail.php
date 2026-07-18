<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = $_ENV['MAIL_HOST'];
$mail->SMTPAuth = true;
$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];
$mail->SMTPSecure = $_ENV['MAIL_ENCRYPTION'];
$mail->Port = $_ENV['MAIL_PORT'];

$mail->CharSet = 'UTF-8';

$mail->setFrom(
    $_ENV['MAIL_FROM'],
    $_ENV['MAIL_FROM_NAME']
);

return $mail;