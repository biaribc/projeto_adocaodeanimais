<?php
session_start();
include_once("conecta.php");
if (isset($_POST['email'])) {
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha_cadastro']);
    //verfificar se está preenchido
    if (!empty($email) && !empty($senha)) {
        $sql = $conexao->prepare("SELECT * FROM organizacao WHERE email_organizacao = :e AND senha_organizacao=:s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch();
            $_SESSION["id_organizacao"] = $dado['id_organizacao'];
            header("location:index.php");
        } else {
            $_SESSION["erro_login"] = "Usuário ou senha inválidos!";
            header("location:login_organizacao.php");
        }
    }
}
