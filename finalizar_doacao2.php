<?php session_start();
include_once("conecta.php");
$id_candidatura=$_GET['id_candidatura'];
$conteudo="Você foi selecionado para uma adoção!";
$requisicao_usuario=$conexao->prepare("SELECT  * FROM candidatura WHERE id_candidatura=$id_candidatura");
$requisicao_usuario->execute();
$usuario=$requisicao_usuario->fetch(PDO::FETCH_ASSOC);
$id_usuario=$usuario['id_usuario'];
$redireciona="finalizar_doacao3.php";
$link="finalizar_adocao1.php?id_candidatura= $id_candidatura";
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
    <script src="script/vanilla-tilt.js"></script>
    <script src="script/javascript.js"></script>
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
                <a href="" class="laranja"> adotante </a> ou com o <a href="" class="laranja">administrador</a>.
             </p>
                <p class="d-flex ml-2 mr-2"><button class="btn w-50 bg_azulclaro text-white rounded"><a href="gerar_pdf.php" target="_blank" rel="noopener noreferrer">BAIXAR CONTRATO</a></button>
                <button class="bg_laranja ml-2 mr-2 text-white w-75 btn rounded" ><a href="notificar.php?notificacao=<?php echo $conteudo;?>&id_usuario=<?php echo $id_usuario;?>&redireciona=<?php echo $redireciona;?>&link=<?php echo $link;?>">FAÇA UPLOAD DE CONTRATO ASSINADO</a> </button></p>
            </form>
        </div>
    </div>
</body>
</html>