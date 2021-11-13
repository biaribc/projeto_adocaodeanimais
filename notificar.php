<?php
   include("conecta.php");
    $cont_notificacao=$_GET['notificacao'];
    $user=$_GET['id_usuario'];
    $estado=1;
    $redirecionar=$_GET['redireciona'];
    $link_not=$_GET['link'];
    $requisicao=$conexao->prepare("INSERT INTO notificacao (cont_notificacao,id_usuario,link_notificacao,status_notificacao) VALUES(:cn,:iu,:li,:st)");
    $requisicao->bindValue(":cn", $cont_notificacao);
    $requisicao->bindValue(":li", $link_not);
    $requisicao->bindValue(":iu", $user);
    $requisicao->bindValue(":st", $estado);
    $requisicao->execute();
    $_SESSION['candidatura_finalizada!']="Candidatura Finalizada";
    header("location: $redirecionar");
?>