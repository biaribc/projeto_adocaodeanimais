<?php
session_start();
include_once("conecta.php");
if (isset($_SESSION['id_organizacao'])) {
    $id_usuario = $_SESSION['id_organizacao'];
    $usuario = $conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_usuario");
    $usuario->execute();
    $result_usuario = $usuario->fetch(PDO::FETCH_ASSOC);
}
if (isset($_POST['especie'])) {
    $nome = addslashes($_POST['nome']);
    $especie = addslashes($_POST['especie']);
    if ($_POST['medida_idade'] == "meses") {
        $idade  = addslashes($_POST['idade'] / 12);
    } else {
        $idade  = addslashes($_POST['idade']);
    }
    $cidade = $result_usuario['cidade_organizacao'];
    $sexo = addslashes($_POST['sexo']);
    $porte = addslashes($_POST['porte']);
    $deficiencia = addslashes($_POST['deficiencia']);
    $usuario=$result_usuario['nome_organizacao'];
    if (!empty($nome) && !empty($especie) && !empty($idade) && !empty($cidade) && !empty($porte) && !empty($deficiencia) && !empty($usuario)) {
        $sql = $conexao->prepare("INSERT INTO animal (nome_animal,especie_animal,idade_animal,deficiencia_animal,porte_animal,sexo_animal,cidade_animal,id_usuario)VALUES (:n,:es,:id,:df,:p,:s,:cd,:ir)");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":es", $especie);
        $sql->bindValue(":cd", $cidade);
        $sql->bindValue(":id", $idade);
        $sql->bindValue(":p", $porte);
        $sql->bindValue(":df", $deficiencia);
        $sql->bindValue(":s", $sexo);
        $sql->bindValue(":ir", $_SESSION['id_organizacao']);
        $sql->execute();
        $_SESSION['cadastrado'] = "Animal Cadastrado com Sucesso!!";
    }
    if (isset($_FILES['foto'])) {
        $consulta = $conexao->prepare("SELECT id_animal FROM animal WHERE nome_animal LIKE '%$nome%'");
        $consulta->execute();
        $dado = $consulta->fetch();
        if ($consulta->rowCount() > 0) {
            $arquivo = $_FILES['foto'];
            $pasta = "upload/";
            $nome_arquivo = $arquivo['name'];
            $novo_nome_arquivo = uniqid();
            $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            if ($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg")
                die("FORMATO INVALIDO");
            move_uploaded_file($arquivo['tmp_name'], $pasta . $novo_nome_arquivo . "." . $extensao);
            $path = $pasta . $novo_nome_arquivo . "." . $extensao;
            $add_imagem = $conexao->prepare("UPDATE animal SET caminho_imagem = :pa WHERE id_animal LIKE '%$dado[id_animal]%'");
            $add_imagem->bindValue(":pa", $path);
            $add_imagem->execute();
            header("location: cadastro_animal.php");
        }
    }
} else {
    $_SESSION['campo_vazio'] = "preencha os campos obrigatórios!";
}