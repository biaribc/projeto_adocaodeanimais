
<?php session_start();
include("conecta.php");?>
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
        <div id="adocao" class=" mx-auto d-flex">
            <div class="rounded container d-block bg-white" id="container_adocao">
                <form class=" d-block p-2" method="POST" enctype="multipart/form-data" action="cadastrar_animal.php">
                    <h4 class=' '><strong>Cadastro de Doação</strong></h4>
                    <p>Preencha as informações sobre o animal que deseja doar</p>
                    <input type="text" name="nome" id="nome" placeholder="Nome">
                    <p class="d-flex text-justify">
                        <label class="w-50">Carregar Foto:</label>
                        <input class="w-50" type="file" name="foto" id="foto" placeholder="">
                    </p>
                    <select name="especie" id="especie">
                        <option disabled selected value="">Espécie</option>
                        <option value="gato">Gato</option>
                        <option value="cachorro">Cachorro</option>
                    </select>
                    <p class="d-flex mb-0">
                        <input type="number" class="" name="idade" id="idade" placeholder="idade">
                        <select name="medida_idade" id="medida_idade">
                            <option value="meses">meses</option>
                            <option value="anos">anos</option>
                        </select>
                    </p>
                    <select name="sexo" id="sexo">
                        <option disabled selected value="">Sexo</option>
                        <option value="macho">Macho</option>
                        <option value="fêmea">Fêmea</option>
                    </select>
                    <select name="porte" id="porte">
                        <option disabled selected value="">Porte</option>
                        <option value="pequeno">Pequeno</option>
                        <option value="médio">Médio</option>
                        <option value="grande">Grande</option>
                    </select>
                    <p class="d-flex text-justify">
                        <label class="m-0 w-50" for="deficiencia">Possui Deficiência?</label>
                        <select class="w-50" name="deficiencia" id="deficiencia">
                            <option value="nao">Não</option>
                            <option value="sim">Sim</option>
                        </select>
                    </p>
                    <textarea name="descricao" id="descricao" placeholder="Fale um pouco sobre o pet que está doando..."></textarea>

                    <input type="hidden" name="org" id="org" value="<?php ?>">
                    <input class="" type="submit" value="Cadastrar">
                    <p class="text-center"><a href="ajuda.php">Preciso de Ajuda</a></p>
                </form>
            </div>
        </div>
        <?php
        if(isset($_SESSION['cadastrado'])){?>
        <p class="w-100 text-center mx-auto aviso"><?php
            echo($_SESSION['cadastrado']);
            unset($_SESSION['cadastrado']);
            ?></p>
      <?php  }?>
    </div>
</body>

</html>