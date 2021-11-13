<?php session_start();
                include_once("conecta.php");
     ?>
<!DOCTYPE html>
<html lang="pt-br">

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
    <link rel="shortcut icon" href="imagens/logo1.png" type="image/x-icon">
    <title>Publicações</title>
</head>

<body>
    <?php include("menu.php");?>
    <div id="postagem" class="w-50 container d-flex">

        <div id="container_postagem" class="p-3 w-100 sombra_azul rounded container" >
            <h3 class="text-center coiny laranja">Suas Publicações...</h3>
            <div id="lista_postagens" class="">
            <?php 
                 $id_organizacao= $_SESSION["id_organizacao"];
                $requisicao=$conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_organizacao");
                $requisicao->execute();
                $organizacao=$requisicao->fetchAll();
                $item_catalogo = $conexao->prepare("SELECT * FROM animal WHERE id_usuario=$id_organizacao");
                $item_catalogo->execute();
                $catalogo = $item_catalogo->fetchAll();
                foreach ($catalogo as $item) {
                    $requisicao = $conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_organizacao");
                    $requisicao->execute();
                    $organizacao = $requisicao->fetch(PDO::FETCH_ASSOC);
                    ?>
            <div class="container  w-100 p-2 d-flex container_postagens rounded mb-3 border" id="postagens">
                <div class="w-25">
                    <img src="<?php echo ($item['caminho_imagem']);?>" alt="">
                </div>
                <div class="w-50">
                    <h4>
                        <?php echo($item['nome_animal']);?>
                    </h4>
                    <p></p>
                </div>
                <div class="w-25">
                    <button class="w-100 mb-2 bg_azulclaro rounded text-white btn" type="button" data-toggle="modal" data-target="#postagem<?php echo $item['id_animal'];?>">
                                Ver Detalhes
                            </button>
                    <button class="w-100 bg_laranja rounded text-white btn" type="button" data-toggle="modal" data-target="#postagem">
                                Excluir Publicação
                            </button>
                         <div class="modal fade" id="postagem<?php echo $item['id_animal'];?>" role="dialog" class="modal fade bd-example-modal-lg modal_perfil_animal" ria-labelledby="myLargeModalLabel" >
                         <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Perfil:
                                                <?php echo ($item['nome_animal']); ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <img class="mx-auto w-100" src="<?php echo ($item['caminho_imagem']); ?>">
                                            <div class="info_modal d-flex">
                                                <hr>
                                                <div class="w-50 p-2">
                                                    <p><strong>Espécie:</strong>
                                                        <?php echo ($item['especie_animal']); ?>
                                                    </p>
                                                    <p><strong>Sexo:</strong>
                                                        <?php echo ($item['sexo_animal']); ?>
                                                    </p>
                                                    <p><strong>Idade:</strong>
                                                        <?php echo ($item['idade_animal']); ?> anos
                                                    </p>
                                                </div>
                                                <div class="w-50 p-2">
                                                    <p>
                                                        <strong>
                                                            Responsável:
                                                        </strong>
                                                        <a href="perfil_organizacao?id_organizacao=<?php echo $organizacao['id_organizacao'];?>"><?php echo ($organizacao['nome_organizacao']); ?></a>
                                                    </p>
                                                    <p><strong>Localização:</strong>
                                                        <?php echo ($item['cidade_animal']); ?>
                                                    </p>
                                                </div>
                                                </hr>
                                            </div>
                                </div>
                                
                                <div class="modal-footer text-white">
                                    <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn bg_azulclaro text-white">Editar Publicação</button>
                                    <button type="button" class="btn bg_laranja "><a class="text-white" href="candidaturas.php?id_animal=<?php echo $item['id_animal'];?>"> Ver Candidaturas</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>



            <?php  } ?></div>

        </div>
    </div>
   
</body>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="script/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="script/vanilla-tilt.js"></script>
</html>