<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
include("conecta.php");
if (isset($_GET['envio'])) {
  $usuario_envio = $_GET['envio'];
  if (isset($_SESSION['id_usuario']))
    $usuario_recebido = $_SESSION['id_usuario'];
else if (isset($_SESSION['id_organizacao']))
    $usuario_recebido = $_SESSION['id_organizacao'];
} else {
  die("CHAT INVALIDO!!!");
}

$requisicao_msg = $conexao->prepare("SELECT * FROM mensagem WHERE id_usuario_envio=$usuario_envio AND id_usuario_recebido=$usuario_recebido OR id_usuario_recebido=$usuario_envio AND id_usuario_envio=$usuario_recebido");
$requisicao_msg->execute();
$chat = $requisicao_msg->fetchAll();
if(isset($_SESSION['id_organizacao'])){
$requisicao_usuario = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$usuario_envio");
$requisicao_usuario->execute();
$user = $requisicao_usuario->fetch(PDO::FETCH_ASSOC);
}
if (isset($_SESSION['id_usuario'])){
  $requisicao_usuario = $conexao->prepare("SELECT * FROM organizacao WHERE id_usuario=$usuario_envio");
  $requisicao_usuario->execute();
  $user = $requisicao_usuario->fetch(PDO::FETCH_ASSOC);

}
?>

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
  <title>Mensagens</title>
</head>

<body> <?php include_once 'menu.php' ?>
  <div id="chat" class="rounded">

    <div id="container_chat" class="container rounded p-4">
   
      <h3 class="text-center">Sua conversa com <a href="#"> <?php
      if(isset($_SESSION['id_organizacao']))
      echo $user['nome'];
      if(isset($_SESSION['id_usuario']))
      echo $user['nome_organizacao'];
      ?></a></h3> 
      <div id="mensagens" class="p-2">
        <?php

        foreach ($chat as $mensagem) {
          if ($mensagem['id_usuario_envio'] == $usuario_recebido) { ?>
            <div class="rounded p-3 w-50 ml-auto" id="balao_msg_usuario2">
              <p class=" ml-auto">
                <?php echo ($mensagem['conteudo_mensagem']); ?>
              </p>
              <label class="text-center w-75">
                <?php echo ($mensagem['data_mensagem']); ?>
              </label>
            </div>
          <?php
          } else { ?>
            <div class="rounded p-3 w-50" id="balao_msg_usuario1">
              <p class="w-75 ml-5">
                <?php echo ($mensagem['conteudo_mensagem']); ?>
              </p>
              <label class="text-center w-100">
                <?php echo ($mensagem['data_mensagem']); ?>
              </label>
            </div>
           
        <?php
          }
        
        } ?>
      </div>

      <div id="form_envio_msg" class="mb-2 ml-auto">
        <form action="envia_msg.php" method="POST" class="d-flex ml-auto">
          <input type="hidden" name="id_envio" id="id_envio" value="<?php echo $usuario_recebido; ?>">
          <input type="hidden" name="id_recebido" id="id_recebido" value="<?php echo $usuario_envio; ?>">
          <input class="p-2 w-100 rounded" type="text" name="conteudo_msg" id="conteudo_msg" placeholder="Escreva uma mensagem...">
          <button class="p-2 rounded-circle" id="botao_enviar_msg" type="submit">
            <img src="imagens/send.png" alt="">
          </button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="script/javascript.js"></script>
</body>


</html>