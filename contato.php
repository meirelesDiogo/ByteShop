<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | ByteShop</title>
</head>
<body>
    <nav class="navbar">
    <a href=""><img src="logo.png" alt="ByteShop"></a>
    <a href="#catalogo">Catálogo</a>
    <a href="#sobre">Sobre Nós</a>
    <a href="contato.php">Contato</a>
    <a href="carrinho.html">
        <img src="carrinho.png" alt="Carrinho" style="height:30px;">
    </a>
</nav>

<h2>Contato</h2>

<form method="post">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Mensagem: <textarea name="mensagem"></textarea><br>
    <input type="submit" value="Enviar">

</form>
    


<?php
require 'config/mail.php';

if($_POST){
    $nome=$_POST['nome'];
    $email=$_POST['email'];
    $mensagem=$_POST['mensagem'];

    try{
        $mail = require 'config/mail.php';

        $mail = require 'config/mail.php';
        // ==========================
        // EMAIL PARA O CLIENTE
        // ==========================

        $mail->clearAddresses();

        $mail->addAddress($email, $nome);

        $mail->Subject = "Recebemos seu contato";

        $mail->Body = "

        <div style='font-family:Arial;max-width:600px;margin:auto;padding:20px;border:1px solid #eee;border-radius:10px;'>

            <h2 style='color:#1e66ff'>
                Olá, {$nome}!
            </h2>

            <p>
                Recebemos sua mensagem com sucesso.
            </p>

            <p>
                Nossa equipe já foi notificada e responderá o mais rápido possível.
            </p>

            <hr>

            <h3>Sua mensagem</h3>

            <p>{$mensagem}</p>

            <br>

            <b>ByteShop</b>

        </div>

        ";

        $mail->send();

        $sucesso = true;

    } catch (Exception $e) {

        $erro = $e->getMessage();

    }
    }
        

?>
</body>
</html>