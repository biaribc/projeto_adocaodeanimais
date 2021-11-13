<?php
session_start();
include_once("conecta.php");
if (isset($_POST['email'])) {
    $nome = addslashes($_POST['nome']);
    $cep = addslashes($_POST['cep']);
    $email = addslashes($_POST['email']);
    $foto = addslashes($_POST['foto']);
    $telefone  = addslashes($_POST['telefone']);
    $endereco = addslashes($_POST['cidade']);
    $cnpj = addslashes($_POST['cnpj']);
    $senha = addslashes($_POST['senha']);
    $senha_conf = addslashes($_POST['senha_conf']);

    //verfificar se está preenchido
    if (!empty($nome) && !empty($email) && !empty($cep) && !empty($endereco && !empty($cnpj)) && !empty($telefone) && !empty($senha) && !empty($senha_conf)) {
        if ($senha == $senha_conf) {
            $sql = $conexao->prepare("SELECT id_organizacao FROM organizacao WHERE email_organizacao= :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $_SESSION['usuario_existe'] = "Email Já Cadastrado!";
                header("location:cadastro_usuario.php");
            } else {
                $sql = $conexao->prepare("INSERT INTO organizacao (nome_organizacao,email_organizacao,cep_organizacao,logo_organizacao,cidade_organizacao,telefone_organizacao,senha_organizacao,cnpj_organizacao)VALUES (:n,:e,:cep,:ft,:en,:t,:s,:cn)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":cn", $cnpj);
                $sql->bindValue(":cep", $cep);
                $sql->bindValue(":en", $endereco);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":ft", $foto);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                $_SESSION['cadastrado'] = "Usuário Cadastrado com Sucesso!!";
            }
        }
    } else {
        $_SESSION['campo_vazio'] = "preencha os campos obrigatórios!";
        header("location:cadastro_organizacao.php");
    }
}