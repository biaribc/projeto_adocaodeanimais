<?php
session_start();
include_once("conecta.php");
if (isset($_POST['email'])) {
    echo 'aqui foi';
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $foto = addslashes($_POST['foto']);
    $cep  = addslashes($_POST['cep']);
    $endereco = addslashes($_POST['cidade']);
    $data = addslashes($_POST['data_nasc']);
    $senha = addslashes($_POST['senha']);
    $senha_conf = addslashes($_POST['senha_conf']);

    //verfificar se está preenchido
    if (!empty($nome) && !empty($email) && !empty($cep) && !empty($endereco) && !empty($data) && !empty($senha) && !empty($senha_conf)) {
        if ($senha == $senha_conf) {
            $sql = $conexao->prepare("SELECT id_usuario FROM usuario WHERE email= :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $_SESSION['usuario_existe'] = "Email Já Cadastrado!";
                header("location:cadastro_usuario.php");
            } else {
                $sql = $conexao->prepare("INSERT INTO usuario (nome,email,senha,cep,cidade,nascimento,foto)VALUES (:n,:e,:s,:cep,:en,:d,:ft)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":cep", $cep);
                $sql->bindValue(":en", $endereco);
                $sql->bindValue(":d", $data);
                $sql->bindValue(":ft", $foto);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                $_SESSION['cadastrado'] = "Usuário Cadastrado com Sucesso!!";
            }
        }
    } else {
        $_SESSION['campo_vazio'] = "preencha os campos obrigatótios!";
        header("location:cadastro_usuario.php");
    }
}
