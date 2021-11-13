<?php
session_start();
include("conecta.php");
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
        <div class="container rounded p-3 d-flex text-justify" height="80" id="container_doacao">
            
            <form action="" class="d-block w-75 mx-auto">
            <h3 class="laranja coiny text-center">Formulário de Doação</h3>
             <p>Protocolo de Requisição: <strong class="text-uppercase"><?php echo uniqid();?></strong></p>
             <p class="text-muted">
                Sua doação está em processo de confirmação. Para que o processo seja concluído é necessário que ambos
                os envolvidos (doador e adotante) assinem o documento disponibilizado abaixo. Se achar necessário, entre em contato com
                <a href="" class="laranja">a organização </a> ou com o <a href="" class="laranja">administrador</a>.
             </p>
                <p class="d-flex ml-2 mr-2"><button class="btn w-50 bg_azulclaro text-white rounded"><a href="gerar_pdf.php" target="_blank" rel="noopener noreferrer">BAIXAR CONTRATO</a></button>
                <button class="bg_laranja ml-2 mr-2 text-white w-75 rounded btn" value=""><a href=""> FAÇA UPLOAD DE CONTRATO ASSINADO</a></button></p>
            </form>
        </div>
    </div>
</body>
</html>