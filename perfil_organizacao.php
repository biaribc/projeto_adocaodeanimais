<?php 
session_start();
include_once("conecta.php");
if ($_GET['id_organizacao'])
    $id_organizacao=$_GET['id_organizacao'];
    else
    die("BUSCA INVALIDA");

$sql =$conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao= $id_organizacao");
$sql->execute();
$result_org = $sql->fetch(PDO::FETCH_ASSOC);

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
    <script src="script/vanilla-tilt.js"></script>
    <title>Meu Perfil</title>
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
            <h3>Informações da Organização</h3>
            <div class="d-flex w-100 text-justify">
                <div class="w-50 text-center" id="imagem_perfil">
                    <div id="img_perfil">
                        <img src="imagens/gato.jpg" alt=""></div>
                </div>
                <div class="w-50 d-flex" id="info_perfil">
                <div>
                <h4 class="p-2  text-center">
                        <?php echo ($result_org['nome_organizacao']); ?>
                    </h4>
                    <p><strong>Cidade:</strong> 
                        <?php echo$result_org['cidade_organizacao'];?>
                    </p>
                    <p><strong>CEP:</strong> 
                        <?php echo$result_org['cep_organizacao'];?>
                    </p>
                    <p><strong> Email:</strong>
                        <?php echo$result_org['email_organizacao'];?>
                    </p>
                    <p>
                       <strong> Telefone para Contato: </strong>
                        <?php echo $result_org['telefone_organizacao'];?>
                    </p>
                    <button class="mt-3 text-center bg_laranja btn rounded"><a href="">ENVIAR MENSAGEM</a> </button>

                </div>   
                </div>
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