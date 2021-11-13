<?php
session_start();
include_once("conecta.php");
if (isset($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    //verfificar se está preenchido
    if (!empty($email) && !empty($senha)) {
        $sql = $conexao->prepare("SELECT * FROM usuario WHERE email = :e AND senha=:s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION["id_usuario"] = $dado['id_usuario'];
            if(isset($_SESSION['redireciona'])){
            $redirecionar=$_SESSION['redireciona'];
            unset($_SESSION['redirecionar']);
            header("location:$redirecionar");}
            header("location:index.php");
        } else {
            $_SESSION["erro_login"] = "Usuário ou senha inválidos!";
            header("location:login.php");
        }
    }
}
