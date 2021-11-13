<!DOCTYPE html>
<?php  
    Include("conecta.php");
?>
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
    <title>Página Inicial</title>
</head>
<body>
<?php include("menu.php");?>

<div id="catalogo" class="container">
    
<h3 class="d-block text-center laranja coiny">Gatos</h3>
            <div id="container_catalogo" class="d-flex">
                <?php 
                $item_catalogo = $conexao->prepare("SELECT * FROM animal WHERE especie_animal LIKE 'gato' ORDER BY nome_animal ASC LIMIT 3");
                $item_catalogo->execute();
                $catalogo = $item_catalogo->fetchAll();
                foreach ($catalogo as $item) {
                    $id_organizacao = $item['id_usuario'];
                    $requisicao = $conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_organizacao");
                    $requisicao->execute();
                    $organizacao = $requisicao->fetch(PDO::FETCH_ASSOC); ?>
                    <div class="item_animal_catalogo ">
                        <div id="imagem_animal_catalogo">
                            <img class="mx-auto" src="<?php echo ($item['caminho_imagem']); ?>">
                        </div>
                        <div>
                            <h3>
                                <?php echo ($item['nome_animal']); ?>
                            </h3>
                            <p>
                                <?php echo ($item['cidade_animal']); ?>
                            </p>
                            <button id="botao_ver_perfil" class="w-75" type="button" data-toggle="modal" data-target="#modal_perfil_animal<?php echo ($item['id_animal']); ?>">
                                Perfil Completo
                            </button>
                            <div id="modal_perfil_animal<?php echo ($item['id_animal']); ?>" class="modal fade bd-example-modal-lg modal_perfil_animal" role="dialog" ria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Perfil:
                                                <?php echo ($item['nome_animal']); ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <img class="mx-auto" src="<?php echo ($item['caminho_imagem']); ?>">
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
                                                    <?php 
                                                        if($item['idade_animal']<1){
                                                        $item['idade_animal']=$item['idade_animal']*12;
                                                        echo ($item['idade_animal']." meses");
                                                    }
                                                        else
                                                        echo ($item['idade_animal']." anos");
                                                        ?> 
                                                    </p>
                                                </div>
                                                <div class="w-50 p-2">
                                                    <p>
                                                        <strong>
                                                            Responsável:
                                                        </strong>
                                                        <a href="perfil_organizacao.php?id_organizacao=<?php echo($organizacao['id_organizacao']); ?>"><?php echo ($organizacao['nome_organizacao']); ?></a>
                                                    </p>
                                                    <p><strong>Localização:</strong>
                                                        <?php echo ($item['cidade_animal']); ?>
                                                    </p>
                                                </div>
                                                </hr>
                                            </div>
                                                  </div>
                                        <div class="modal-footer">
                                            <button id="btn_salvar_modal" type="button" class="btn" data-dismiss="modal">Fechar</button>
                                            <button type="button" class="btn"><a href="candidatura.php?animal=<?php echo ($item['id_animal']) ?>">Quero
                                                    Adotar</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                         

                        </div>
                    </div>
                <?php  } ?>
            </div>
            <div id="vermais" class="text-center"> <a class="text-decoration-none" href="catalogo_gatos.php">Ver Mais</a></div>

            <hr>
          <h3 class="d-block text-center laranja coiny">Cachorros</h3>
                <div id="container_catalogo_cachorro" class="d-flex">
                    
                <?php 
            
                $item_catalogo_cachorro = $conexao->prepare("SELECT * FROM animal WHERE especie_animal LIKE 'cachorro' ORDER BY nome_animal ASC LIMIT 3");
                $item_catalogo_cachorro->execute();
                $cachorro = $item_catalogo_cachorro->fetchAll();
                foreach ($cachorro as $item_cachorro) {
                    $id_organizacao = $item_cachorro['id_usuario'];
                    $requisicao = $conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_organizacao");
                    $requisicao->execute();
                    $organizacao = $requisicao->fetch(PDO::FETCH_ASSOC); ?>
                    <div class="item_animal_catalogo ">
                        <div id="imagem_animal_catalogo_cachorro">
                            <img class="mx-auto" src="<?php echo ($item_cachorro['caminho_imagem']); ?>">
                        </div>
                        <div>
                            <h3>
                                <?php echo ($item_cachorro['nome_animal']); ?>
                            </h3>
                            <p>
                                <?php echo ($item_cachorro['cidade_animal']); ?>
                            </p>
                            <button id="botao_ver_perfil" class="w-75" type="button" data-toggle="modal" data-target="#modal_perfil_animal<?php echo ($item_cachorro['id_animal']); ?>">
                                Perfil Completo
                            </button>
                            <div id="modal_perfil_animal<?php echo ($item_cachorro['id_animal']); ?>" class="modal fade bd-example-modal-lg modal_perfil_animal" role="dialog" ria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Perfil:
                                                <?php echo ($item_cachorro['nome_animal']); ?>
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <img class="mx-auto" src="<?php echo ($item_cachorro['caminho_imagem']); ?>">
                                            <div class="info_modal d-flex">
                                                <hr>
                                                <div class="w-50 p-2">
                                                    <p><strong>Espécie:</strong>
                                                        <?php echo ($item_cachorro['especie_animal']); ?>
                                                    </p>
                                                    <p><strong>Sexo:</strong>
                                                        <?php echo ($item_cachorro['sexo_animal']); ?>
                                                    </p>
                                                    <p><strong>Idade:</strong>
                                                    <?php 
                                                        if($item['idade_animal']<1){
                                                        $item['idade_animal']=$item['idade_animal']*12;
                                                        echo ($item['idade_animal']." meses");
                                                    }
                                                        else
                                                        echo ($item['idade_animal']." anos");
                                                        ?> 
                                                    </p>
                                                </div>
                                                <div class="w-50 p-2">
                                                    <p>
                                                        <strong>
                                                            Responsável:
                                                        </strong>
                                                        <a href="perfil_organizacao.php?id_organizacao=<?php echo($organizacao['id_organizacao']); ?>"><?php echo ($organizacao['nome_organizacao']); ?></a>
                                                    </p>
                                                    <p><strong>Localização:</strong>
                                                        <?php echo ($item_cachorro['cidade_animal']); ?>
                                                    </p>
                                                </div>
                                                </hr>
                                            </div>
                                                  </div>
                                        <div class="modal-footer">
                                            <button id="btn_salvar_modal" type="button" class="btn" data-dismiss="modal">Fechar</button>
                                            <button type="button" class="btn"><a href="candidatura.php?animal=<?php echo ($item_cachorro['id_animal']) ?>">Quero
                                                    Adotar</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                         

                        </div>
                    </div>
                <?php  } ?>
            </div>
            <div id="vermais" class="text-center"> <a class="text-decoration-none" href="catalogo_cachorros.php">Ver Mais</a></div>

            
                            </div>     
                </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="script/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="script/vanilla-tilt.js"></script>
</html>