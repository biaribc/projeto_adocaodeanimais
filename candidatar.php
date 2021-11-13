<?php
session_start();
include_once("conecta.php");
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $usuario = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario");
    $usuario->execute();
    $result_usuario = $usuario->fetch(PDO::FETCH_ASSOC);
}
$id_animal = addslashes($_POST['animal']);
if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $cpf = addslashes($_POST['cpf']);
    if (empty($cpf)) {
        $_SESSION['cpf_invalido'] = "CPF INVÁLIDO!";
        header("location: candidatura.php?animal=" . $_POST['animal'] . "");
    }
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
    if (strlen($cpf) != 11) {
        $_SESSION['cpf_invalido'] = "CPF INVÁLIDO!";
        header("location: candidatura.php?animal=" . $_POST['animal'] . "");
    } else if (
        $cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999'
    ) {
        $_SESSION['cpf_invalido'] = "CPF INVÁLIDO!";
        header("location: candidatura.php?animal=" . $_POST['animal'] . "");
    }
    if (isset($_FILES['foto-res']))
        echo("foi");
    $cidade = addslashes($_POST['cidade']);
    $sexo = addslashes($_POST['sexo']);
    $telefone = addslashes($_POST['telefone']);
    $rg = addslashes($_POST['rg']);
    $arquivo_res = $_FILES['foto-res'];
    $arquivo_rg = $_FILES['foto-rg'];
    $arquivo_cpf = $_FILES['foto-cpf'];
    if (isset($_FILES['foto-res'])) {
       echo"foi";
            $pasta = "upload-res/";
            $nome_arquivo = $arquivo_res['name'];
            $novo_nome_arquivo = uniqid();
            $extensao1 = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            if ($extensao1 != "jpg" && $extensao1 != "png" && $extensao1 != "jpeg" && $extensao1 != "pdf")
            die("FORMATO INVALIDO");
            $mover1 = move_uploaded_file($arquivo_res['tmp_name'], $pasta . $novo_nome_arquivo . "." . $extensao1);
            $path1 = $pasta . $novo_nome_arquivo . "." . $extensao1;
        
    }
    if (isset($_FILES['foto-cpf'])) {
        echo"foi";
            $pasta = "upload-cpf/";
            $nome_arquivo = $arquivo_cpf['name'];
            $novo_nome_arquivo = uniqid();
            $extensao2 = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            if ($extensao2 != "jpg" && $extensao2 != "png" && $extensao2 != "jpeg" && $extensao2 != "pdf")
            die("FORMATO INVALIDO");
            $mover2 = move_uploaded_file($arquivo_cpf['tmp_name'], $pasta . $novo_nome_arquivo . "." . $extensao2);
            $path2 = $pasta . $novo_nome_arquivo . "." . $extensao2;
        
    }
    if (isset($_FILES['foto-rg'])) {
     
            $pasta = "upload-rg/";
            $nome_arquivo = $arquivo_rg['name'];
            $novo_nome_arquivo = uniqid();
            $extensao3 = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
            if ($extensao3 != "jpg" && $extensao3 != "png" && $extensao3 != "jpeg" && $extensao3 != "pdf")
            die("FORMATO INVALIDO");
            $mover3 = move_uploaded_file($arquivo_rg['tmp_name'], $pasta . $novo_nome_arquivo . "." . $extensao3);
            $path3 = $pasta . $novo_nome_arquivo . "." . $extensao3;
        
    }
    $usuario = $result_usuario['id_usuario'];

    //verfificar se está preenchido
    if (!empty($nome) && !empty($cpf) && !empty($cidade) && !empty($sexo) && !empty($telefone) && !empty($rg) && !empty($usuario) && !empty($arquivo_res) && !empty($arquivo_cpf) && !empty($arquivo_rg)) {
        $sql = $conexao->prepare("UPDATE usuario SET cpf='$cpf', RG='$rg',telefone='$telefone',sexo='$sexo',cidade='$cidade', comp_residencia='$path1',comp_cpf='$path2',comp_rg='$path3' WHERE id_usuario=$id_usuario");
        $sql->execute();
        $_SESSION['fase1'] = "Sucesso!!";
        header("location: candidaturap2.php?animal=" . $_POST['animal'] . "");
        }
} else {
    $_SESSION['campo_vazio'] = "PREENCHA TODOS OS CAMPOS!";
}
