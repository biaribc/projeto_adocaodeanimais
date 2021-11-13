<?php
session_start();
include_once "conecta.php";
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['redireciona'] = $_GET['animal'];
    header("location: login.php");
}
if (isset($_GET['animal']))
$id_animal = $_GET['animal'];
$busca = $conexao->prepare("SELECT * FROM animal WHERE id_animal=$id_animal");
$busca->execute();
$result_animal = $busca->fetchAll();
$id_usuario = $_SESSION['id_usuario'];
$usuario = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario");
$usuario->execute();
$info_usuario = $usuario->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="script/jquery-3.6.0.js"></script>
    <script src="script/vanilla-tilt.js"></script>
    <script src="script/javascript.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <title>Cadastrar Animal</title>
</head>

<body>
    <script>
        var i = setInterval(function() {
            clearInterval(i);
            document.getElementById("loading").style.display = "none";
            document.getElementById("pesquisa").style.display = "inline";
        }, 2000);
    </script>

    <?php include_once "menu.php"; ?>
    <div id="loading" style="display: flex">
        <img class="mx-auto" src="imagens/loading.gif" style="width:150px;height:150px;" />
    </div>
    <div id="pesquisa" style="display:none">
        <div id="adocao" class=" mx-auto d-flex w-75">
            <div class="rounded container d-block bg-white container-adocao" id="container_adocao">
                <form class=" p-2 text-center" method="POST" enctype="multipart/form-data" action="candidatar.php">
                    <h4 class=' '><strong>Cadastro de Adoção - <?php echo ($result_animal[0]['nome_animal']); ?></strong></h4>
                    <p>Preencha com suas informações</p>
                    <div class="d-flex">

                        <div class="p-2 w-50">
                            <input type="text" class="text-black-50" name="nome" id="nome" value="<?php echo ($info_usuario[0]['nome']); ?>" readonly="readonly">
                            <input type="text" class="text-black-50" name="cpf" id="cpf" placeholder="CPF *" value="<?php echo ($info_usuario[0]['cpf']); ?>" <?php if ($info_usuario[0]['cpf'] != NULL) { ?> readonly="reandoly" <?php } ?>>
                            <input type="text" class="text-black-50" name="rg" id="rg" placeholder="RG *" value="<?php echo ($info_usuario[0]['RG']); ?>" <?php if ($info_usuario[0]['RG'] != NULL) { ?> readonly="reandoly" <?php } ?>>
                            <input type="text" class="text-black-50" name="telefone" id="telefone" placeholder="Telefone *" value="<?php echo ($info_usuario[0]['telefone']); ?>" <?php if ($info_usuario[0]['telefone'] != NULL) { ?> readonly="reandoly" <?php } ?>>
                            <input type="text" class="text-black-50" name="profissao" id="profissao" placeholder="Profissao *" value="" <?php if ($info_usuario[0]['profissao'] != NULL) { ?> value="<?php echo ($info_usuario[0]['profissao']) ?>" <?php } ?>>
                            <input type="text" class="text-black-50" name="cidade" id="cidade" placeholder="Cidade *" value="" <?php if ($info_usuario[0]['cidade'] != NULL) { ?> value="<?php echo ($info_usuario[0]['cidade']) ?>" <?php } ?>>
                            <select name="sexo" id="sexo">
                                <option disabled selected value="">Sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                                <option value="outro">Prefiro não declarar</option>
                            </select>
                        </div>
                        <div class="p-2 w-50">
                            <p class="d-flex text-justify">
                                <label class="w-50">Comprovante de Residência:</label>
                                <input class="w-50" type="file" name="foto-res" id="foto-res" placeholder="">
                            </p>
                            <p class="d-flex text-justify">
                                <label class="w-50">RG Digitalizado:</label>
                                <input class="w-50" type="file" name="foto-rg" id="foto-rg" placeholder="">
                            </p>
                            <p class="d-flex text-justify">
                                <label class="w-50">CPF Digitalizado:</label>
                                <input class="w-50" type="file" name="foto-cpf" id="foto-cpf" placeholder="">
                            </p>
                        </div>
                    </div>
                    <?php
                        if (isset($_SESSION['campo_vazio'])) {?>
                            <div class="warning bg-danger"><?php
                            echo ($_SESSION['campo_vazio']);?></div><?php
                            unset($_SESSION['campo_vazio']);
                        }
                        if (isset($_SESSION['cpf_invalido'])) {?>
                            <div class="alert text-danger"><?php
                            echo ($_SESSION['cpf_invalido']);?></div><?php
                            unset($_SESSION['cpf_invalido']);
                        } ?>
                    <div class="text-right">
                        <input type="hidden" name="animal" id="animal" value="<?php echo ($result_animal[0]['id_animal']); ?>">
                        <input class="w-25 ml-auto" type="submit" value="PRÓXIMO">
                        <p class="text-center link-ajuda"><a href="ajuda.php">Preciso de Ajuda</a></p>
                    </div>
                </form>
            </div>
        </div>
     
    </div>
</body>
</html>