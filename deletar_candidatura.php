<?php
include("conecta.php");
if($_GET['id_candidatura']){
    $id_candidatura=$_GET['id_candidatura'];
    $requisicao=$conexao->prepare("DELETE FROM candidatura WHERE id_candidatura=$id_candidatura");
    $requisicao->execute();
    header("location: minhas_candidaturas.php");
}