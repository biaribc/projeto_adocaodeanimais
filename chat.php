<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
if (isset($_SESSION['id_usuario']))
    $usuario_recebido = $_SESSION['id_usuario'];
else if (isset($_SESSION['id_organizacao']))
    $usuario_recebido = $_SESSION['id_organizacao'];
else{
    $_SESSION['redireciona']=basename( __FILE__ );
    header("location:login_index.php");}
include("conecta.php");
$requisicao_msg = $conexao->prepare("SELECT DISTINCT id_usuario_envio  FROM mensagem WHERE id_usuario_recebido=$usuario_recebido OR id_usuario_envio=$usuario_recebido");
$requisicao_msg->execute();
$chat = $requisicao_msg->fetchAll(); 
?>

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
        <title>Mensagens</title>
    </head>

    <body>
        <?php include 'menu.php' ?>
        <div id="chat" class="rounded">
            <div id="container_chat" class="p-3 container rounded">
                <h3 class="text-center mb-5">Histórico de Mensagens</h3>
                <?php
            foreach ($chat as $mensagem) {
                $id_usuario_envio = $mensagem['id_usuario_envio'];
                if (isset($_SESSION['id_organizacao']))
                    $requisicao_usuario = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario_envio");
                else
                    $requisicao_usuario = $conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_usuario_envio");
                $requisicao_usuario->execute();
                $usuario = $requisicao_usuario->fetchAll();
                foreach ($usuario as $usuario_msg) {
                    if(isset($_SESSION['id_usuario'])){
                        if ($usuario_msg['id_organizacao'] != $_SESSION['id_usuario']) {
            ?>
                        <div class=" p-2 d-flex" id="container_msg">
                            <label class="w-50"> <a href="#">
                                        <?php if (isset($_SESSION['id_usuario'])) {
                                            echo ($usuario_msg['nome_organizacao']);
                                        } else {
                                            echo ($usuario_msg['nome']);
                                        } ?></a></label>
                            <p class="w-50 text-right"> <button class="btn rounded"><a href="mensagens.php?envio=<?php echo ($usuario_msg['id_organizacao']); ?>">Ver Conversa</a></button></p>
                        </div>
                    <?php
                    }}else{
                        ?>
                        <div class=" p-2 d-flex" id="container_msg">
                            <label class="w-50"> <a href="#">
                                        <?php if (isset($_SESSION['id_organizacao'])) {
                                            echo ($usuario_msg['nome']);
                                        }?></a></label>
                            <p class="w-50 text-right"> <button class="btn rounded"><a href="mensagens.php?envio=<?php echo ($usuario_msg['id_usuario']); ?>">Ver Conversa</a></button></p>
                        </div>
                    <?php
                    }
                }
            } ?>
            </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="script/javascript.js"></script>

</html>