<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contato | ByteShop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="contato.css">

</head>

<body>

<nav class="navbar">

    <a href="index.html">
        <img src="logo.png" alt="ByteShop">
    </a>

    <a href="index.html#catalogo">Catálogo</a>

    <a href="index.html#sobre">Sobre Nós</a>

    <a href="contato.php">Contato</a>

    <a href="carrinho.html">
        <img src="carrinho.png" alt="Carrinho" style="height:30px;">
    </a>

</nav>

<section class="contato">

    <h1>Entre em Contato</h1>

    <p>
    Tem alguma dúvida sobre nossos produtos, pedidos ou precisa de suporte?
    Nossa equipe está pronta para ajudar. Preencha o formulário abaixo e retornaremos o mais breve possível.
</p>

    <form method="POST">

        <label>Nome</label>

        <input
            type="text"
            name="nome"
            required
            placeholder="Digite seu nome">

        <label>Email</label>

        <input
            type="email"
            name="email"
            required
            placeholder="Digite seu e-mail">

        <label>Mensagem</label>

        <textarea
            name="mensagem"
            rows="6"
            placeholder="Digite sua mensagem..."
            required></textarea>

        <button type="submit">

            Enviar Mensagem

        </button>

<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $nome=$_POST["nome"];
    $email=$_POST["email"];
    $mensagem=$_POST["mensagem"];

    try{

        $mail=require 'config/mail.php';

        $mail->clearAddresses();

        $mail->addAddress($email,$nome);

        $mail->Subject="Recebemos seu contato - ByteShop";

        $mail->isHTML(true);

        $mail->Body="

        <div style='font-family:Arial;padding:30px;'>

        <h2>Olá, {$nome}!</h2>

        <p>

        Recebemos sua mensagem com sucesso.

        </p>

        <hr>

        <h3>Sua mensagem</h3>

        <p>{$mensagem}</p>

        <br>

        <strong>Equipe ByteShop</strong>

        </div>

        ";

        $mail->send();

        echo "<p style='color:lime;font-weight:bold;'>Mensagem enviada com sucesso!</p>";
            }catch(Exception $e){

        echo "<p style='color:red;font-weight:bold;'>
                Erro ao enviar a mensagem.
              </p>";

    }

}

?>

    </form>

</section>

<br><br>

<section>

    <h2>Atendimento</h2>

    <fieldset>

       <p>
    Nosso atendimento funciona de segunda a sexta-feira,
    das <strong>08:00 às 18:00</strong>.

    <br><br>

    Respondemos a maioria das solicitações em até
    <strong>24 horas úteis</strong>.
</p>
    </fieldset>

</section>

<br><br>

<section>

    <h2>Localização</h2>

    <fieldset>

        <p>

            ByteShop

            <br>

            Belo Horizonte - MG

            <br>

            Brasil

        </p>

    </fieldset>

</section>

<br><br>

<section>

    

</section>

<br><br><br>

<footer style="text-align:center;padding:25px;">

    <p>

        © <?php echo date("Y"); ?>

        ByteShop.

        Todos os direitos reservados.

    </p>

    <p>

        Desenvolvido por <strong>Diogo Alexandre</strong>

    </p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>