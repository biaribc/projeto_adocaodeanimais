<?php session_start();
include_once("conecta.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="script/jquery-3.6.0.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imagens/logo1.png" type="image/x-icon">
    <title>Contato</title>
</head>
<body>
    <?php include "menu.php"?>
        <div id="contato" class="d-flex">
        <div class="container rounded p-3 d-flex" id="container_contato">
            
            <form action="envia_contato.php" class="d-block">
            <h3 class="laranja coiny ">Formulário de Contato</h3>
                <input type="text" name="nome" id="nome"  placeholder="Nome">
                <input type="email" name="email" id="email" placeholder="Email">
                <textarea name="mensagem" id="mensagem" rows="3" placeholder="Mensagem..."></textarea>
                <input class="bg_laranja text-white" type="submit" value="ENVIAR MENSAGEM">
            </form>
        </div>
    </div>
</body>
</html>