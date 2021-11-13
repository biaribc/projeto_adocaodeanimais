<?php 
session_start();
include_once("conecta.php");
if(!isset($_SESSION['id_usuario']) && !isset($_SESSION['id_organizacao'])){
    header("location:login.php");
}else{
if(isset($_SESSION['id_usuario'])){
$count=$_SESSION["id_usuario"];
$sql =$conexao->prepare("SELECT * FROM usuario WHERE id_usuario= $count");

}else{
$count=$_SESSION["id_organizacao"];
$sql =$conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao= $count");
}
$sql->execute();
$result_usuario = $sql->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="script/jquery-3.6.0.js"></script>

    <title>Perfil</title>
</head>

<body>
    <script>
        var i = setInterval(function() {

            clearInterval(i);

            document.getElementById("loading").style.display = "none";
            document.getElementById("corpo").style.display = "flex";

        }, 2000);
    </script>

    <?php include_once "menu.php";?>
    <?php require "conecta.php"?>
    <div id="loading" style="display: flex">
        <img class="mx-auto" src="imagens/loading.gif" style="width:150px;height:150px;" />
    </div>
    <div id="corpo" style="display: none">
        <div id="corpo_perfil" class="mx-auto text-center w-50 rounded">
            <?php if (isset ($_SESSION['id_usuario'])){?>
            <h3>Ficha do Adotante</h3>
            <div class="d-flex w-100 text-justify">
                <div class="w-50 text-center">

                    <div id="img_perfil">
                        <img src="imagens/gato.jpg" alt=""></div>
                    <h4 class="p-2">
                        <?php echo ($result_usuario['nome']); ?>
                    </h4>
                    <button class="btn"> Editar Informações</button>

                </div>
                <div class="w-50">

                    <p>Cidade:
                        <?php echo$result_usuario['cidade'];?>
                    </p>
                    <p>
                        Comprovação de Endereço:
                        <span class="text-success">
                        <?php if($result_usuario['comp_residencia']!=NULL){echo"OK";}; ?></span>
                    </p>
                    <p>
                        Comprovação de Identidade:
                        <span class="text-success">   <?php if($result_usuario['comp_rg']!=NULL && $result_usuario['comp_cpf']!=NULL){echo"OK";}; ?></span>
                    </p>

                    <p>

                    </p>
                    <p>Sexo:
                        <?php echo$result_usuario['sexo'];?>
                    </p>
                    <p>Descrição:
                        <?php echo$result_usuario['desc_adotante'];?>
                    </p>
                </div>
                <?php }else{?>
                <h3>Ficha do Doador</h3>
                <div class="d-flex w-100 text-justify">
                    <div class="w-50 text-center">

                        <div id="img_perfil">
                            <img src="imagens/gato.jpg" alt=""></div>
                        <h4 class="p-2">
                            <?php echo ($result_usuario['nome_organizacao']); ?>
                        </h4>
                        <button class="btn"> Editar Informações</button>

                    </div>
                    <div class="w-50">

                        <p>Cidade:
                            <?php echo$result_usuario['cidade_organizacao'];?>
                        </p>

                        <p>CEP:
                            <?php echo$result_usuario['cep_organizacao'];?>
                        </p>
                        <p>Telefone para contato:
                            <?php echo$result_usuario['telefone_organizacao'];?>
                        </p>
                        <p>Telefone para contato:
                            <?php echo$result_usuario['email_organizacao'];?>
                        </p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </div>
    </div>
</body>

</html>