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
$id_organizacao=$result_animal[0]['id_usuario'];
echo 
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
        <div id="adocao" class=" mx-auto d-flex w-50">
            <div class="rounded container d-block bg-white container-adocao" id="container_adocao">
                <form class=" p-2 text-center" method="POST" enctype="multipart/form-data" action="finalizarcandidatura.php?id_organizacao=<?php echo $id_organizacao;?>">
                    <h4 class=' '><strong>Cadastro de Adoção - <?php echo ($result_animal[0]['nome_animal']); ?></strong></h4>
                    <p>Preencha com suas informações</p>
                        <div class="p-2 text-left w-75 mx-auto">
                            <p class="text-left mb-0">Incluindo você, quantas pessoas moram na sua residência?</p>
                            <select name="pessoas" id="pessoas">
                                <option disabled selected value="">--</option>
                                <option value="1">1</option>
                                <option value="2">de 1 a 3</option>
                                <option value="4">4 ou mais</option>

                            </select>
                            <p class="text-left mb-0">Quantas horas do seu dia estão destinadas ao lazer e família?</p>
                            <select name="horas" id="horas">
                                <option disabled selected value="">--</option>
                                <option value="I">Até 2 horas</option>
                                <option value="II">Entre 2 e 4 horas</option>
                                <option value="III">Mais de 4 horas</option>
                            </select>
                            <input type="hidden" name="animal" id="animal" value="<?php echo ($result_animal[0]['id_animal']);?>">
                            <textarea name="descricao_adocao" id="descricao_doacao" placeholder="Fale em poucas palavras o motivo pelo qual você deseja fazer essa adoção..."></textarea>
                            <textarea name="descricao_adotante" id="descricao_adotante" placeholder="Fale um pouco sobre você..."></textarea>
                        </div>   
                    <?php
                        if (isset($_SESSION['campo_vazio'])) {?>
                            <div class="warning bg-danger"><?php
                            echo ($_SESSION['campo_vazio']);?></div><?php
                            unset($_SESSION['campo_vazio']);
                        }?>
                       
                    <div class="text-right">
                        <input type="hidden" name="animal" id="animal" value="<?php echo ($result_animal[0]['id_animal']); ?>">
                        <input class="w-50 ml-auto" type="submit" value="ENVIAR CANDIDATURA">
                        <p class="text-center link-ajuda"><a href="ajuda.php">Preciso de Ajuda</a></p>
                    </div>
                </form>
            </div>
        </div>
     
    </div>
</body>
</html>