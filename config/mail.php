<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// CORREÇÃO: Aponta para a raiz do projeto (um nível acima da pasta config)
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$mail = new PHPMailer(true);

// Ativa o modo de debug para você ver o erro exato no terminal/navegador se ainda falhar
$mail->SMTPDebug = 0; // Mude para 2 se quiser ver o histórico completo da comunicação

$mail->isSMTP();
$mail->Host = $_ENV['MAIL_HOST'];
$mail->SMTPAuth = true;
$mail->Username = $_ENV['MAIL_USERNAME'];
$mail->Password = $_ENV['MAIL_PASSWORD'];

// CORREÇÃO: Garante o formato correto da criptografia do PHPMailer
$mail->SMTPSecure = ($_ENV['MAIL_ENCRYPTION'] === 'tls') ? PHPMailer::ENCRYPTION_STARTTLS : $_ENV['MAIL_ENCRYPTION'];
$mail->Port = (int)$_ENV['MAIL_PORT']; // Converte para número inteiro

$mail->CharSet = 'UTF-8';

$mail->setFrom(
    $_ENV['MAIL_FROM'],
    $_ENV['MAIL_FROM_NAME']
);

return $mail;
