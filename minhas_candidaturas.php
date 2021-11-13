<?php                 include_once("conecta.php");?>
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
    <title>Página Inicial</title>
</head>

<body>


    <?php session_start();
     Include_once("conecta.php");
     include("menu.php");?>
    <div id="postagem" class="container p-5">

        <div id="container_candidaturas" class="p-4 overflow bg-white rounded sombra_azul">
            <h3 class="text-center coiny laranja">Suas Candidaturas</h3>
            <?php 
                $id_usuario= $_SESSION["id_usuario"];
                $requisicao=$conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario ");
                $requisicao->execute();
                $result_usuario=$requisicao->fetch(PDO::FETCH_ASSOC);
                $item_catalogo = $conexao->prepare("SELECT * FROM candidatura WHERE id_usuario=$id_usuario ");
                $item_catalogo->execute();
                $catalogo = $item_catalogo->fetchAll();
                foreach ($catalogo as $item) {
                    $id_animal=$item['id_animal'];
                    $requisicaoanimal=$conexao->prepare("SELECT * FROM animal WHERE id_animal=$id_animal ");
                    $requisicaoanimal->execute();
                    $result_animal=$requisicaoanimal->fetch(PDO::FETCH_ASSOC);
                   
                    ?>
            <div class="container-fluid p-4 d-flex border rounded m-2 w-100" id="candidaturas">
                <div class="w-25">
                    <img class="img-fluid" src=" <?php echo ($result_animal[ 'caminho_imagem']);?>" alt="">
                </div>

                <div class="w-25">
                    <h4 class=" coiny text-center">
                        <?php echo($result_animal['nome_animal']);?>
                    </h4>
                </div>
                <div class="text-center w-50 d-block">
                    <button type="button" data-toggle="modal" data-target="#modal_candidatura<?php echo $result_animal['id_animal'];?>" class="btn rounded m-2 bg_azulclaro text-white w-75">Ver Detalhes</button>
                    <button type="button" data-toggle="modal" data-target="#modal_cancelar<?php echo $result_animal['id_animal'];?>" class=" btn rounded bg_laranja text-white w-75">Excluir Candidatura</button></div>
                <div class="modal fade" id="modal_cancelar<?php echo $result_animal['id_animal'];?>" tabindex="-1 " role="dialog " aria-labelledby="exampleModalLabel " aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-white">Tem certeza que quer excluir sua candidatura?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger "><a href="deletar_candidatura.php?id_candidatura=<?php echo ($item[ 'id_candidatura']);?>"> Excluir</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal_candidatura<?php echo $result_animal['id_animal'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detalhes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <p><span class="font-weight-bold mr-2"> Nome:</span><span> <?php echo $result_usuario['nome'];?></span></p>
                                            <p><span class="font-weight-bold mr-2"> Idade: </span>
                                                <?php
                                        $dataNascimento = $result_usuario['nascimento'];
                                        $data = new DateTime($dataNascimento );
                                        $resultado = $data->diff( new DateTime( date('Y-m-d') ) );
                                        echo $resultado->format( '%Y' );
                                        
                                        ?> anos</p>
                                            <p>
                                                <p><span class="font-weight-bold mr-2">Profissão: </span><span><?php echo $result_usuario['profissao'];?></span></p>
                                                <span class="font-weight-bold mr-2"> Data da Candidatura: </span><span> <?php echo $item['data_candidatura'];?></span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-center font-weight-bold">Por que quero adotar o
                                                <?php echo $result_animal['nome_animal'];?>? </p>
                                            <p class="text-muted">
                                                <?php echo $item['desc_adocao'];?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn bg_laranja text-white"><a href="mensagens.php?envio=<?php echo ($result_animal['id_usuario']); ?>"> Conversar com a Organização</a> </button>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <?php } ?>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="script/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="script/vanilla-tilt.js"></script>

</html>