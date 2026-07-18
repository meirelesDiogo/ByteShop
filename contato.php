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
 </form><?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];

    try {
        // Carrega o mailer configurado no seu config/mail.php
        $mail = require __DIR__ . '/config/mail.php';

        $mail->clearAddresses();
        $mail->clearReplyTos();

        // O e-mail vai DIRETAMENTE PARA O CLIENTE
        $mail->addAddress($email, $nome);

        // Define o assunto da mensagem que o cliente vai ver
        $mail->Subject = "Recebemos seu contato - ByteShop";

        $mail->isHTML(true);

        // Corpo do e-mail estruturado para o cliente
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; padding: 30px; line-height: 1.6;'>
            <h2 style='color: #333;'>Olá, {$nome}!</h2>
            <p>Agradecemos o seu contato. Recebemos sua mensagem com sucesso em nosso sistema!</p>
            <p>Nossa equipe já está analisando a sua solicitação e entraremos em contato o mais breve possível.</p>
            <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
            <h3 style='color: #666;'>Cópia da sua mensagem:</h3>
            <p style='background: #f9f9f9; padding: 15px; border-left: 4px solid #007bff; color: #555;'>
                " . nl2br(htmlspecialchars($mensagem)) . "
            </p>
            <br>
            <p>Atenciosamente,</p>
            <strong>Equipe ByteShop</strong>
        </div>
        ";

        // Realiza o disparo do e-mail
        $mail->send();

        echo "<p style='color:lime; font-weight:bold; background: rgba(0,0,0,0.8); padding: 10px; border-radius: 5px; text-align: center;'>Mensagem enviada com sucesso!</p>";
        
    } catch (Exception $e) {
               echo "<p style='color:red; font-weight:bold; background: rgba(0,0,0,0.8); padding: 10px; border-radius: 5px; text-align: center;'>
        Erro no envio: {$mail->ErrorInfo}
        </p>";
    }
}

?>


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