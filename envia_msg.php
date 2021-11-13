<?php
include("conecta.php");
if(isset($_POST['conteudo_msg'])){
    $id_envio=addslashes($_POST['id_envio']);
    $id_recebido=addslashes($_POST['id_recebido']);
    $data_msg=date('d/m/Y H:i');
    $conteudo=addslashes($_POST['conteudo_msg']);


$requisicao=$conexao->prepare("INSERT INTO mensagem (id_usuario_envio,id_usuario_recebido,conteudo_mensagem,data_mensagem) VALUES(:ie,:ir,:cm,:dt)");
$requisicao->bindValue(":ie",$id_envio);
$requisicao->bindValue(":ir",$id_recebido);
$requisicao->bindValue(":cm",$conteudo);
$requisicao->bindValue(":dt",$data_msg);
$requisicao->execute();
header("location:mensagens.php?envio=$id_recebido");
}?>