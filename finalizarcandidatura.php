<?php
session_start();
include_once("conecta.php");
$id_organizacao=$_GET['id_organizacao'];
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $usuario = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario");
    $usuario->execute();
    $result_usuario = $usuario->fetch(PDO::FETCH_ASSOC);

$id_animal = addslashes($_POST['animal']);
$pessoas=$_POST['pessoas'];
$horas=$_POST['horas'];
$desc_adocao=$_POST['descricao_adocao'];
$data=date('d/m/Y');
if(!empty($id_animal) && !empty($pessoas) && !empty($horas) && !empty($desc_adocao)){
$requisicao=$conexao->prepare("INSERT INTO candidatura (id_usuario,id_animal,data_candidatura,desc_adocao) VALUES (:id,:ia,:dc,:da)");
$requisicao->bindValue(":id", $_SESSION['id_usuario']);
$requisicao->bindValue(":ia", $id_animal);
$requisicao->bindValue(":dc", $data);
$requisicao->bindValue(":da", $desc_adocao);

$requisicao->execute();
$redireciona="minhas_candidaturas.php";
$conteudo="Nova Candidatura";
$link="candidaturas.php?id_animal=<?php echo $id_animal?>";
header("location: notificar.php?notificacao=$conteudo&id_usuario=$id_organizacao&redireciona=$redireciona&link=$link");
}else{
    $_SESSION['campo_vazio']="PREENCHA TODOS OS CAMPOS";
}}
else{
    die;
}
