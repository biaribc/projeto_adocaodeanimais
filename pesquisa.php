<?php session_start();
require("conecta.php");
if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $usuario = $conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario");
    $usuario->execute();
    $result_usuario = $usuario->fetch(PDO::FETCH_ASSOC);
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

    <title>Pesquisa</title>
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
        <div class="container text-center" id="container_pesquisa">
            <form method="POST" action="">
                <input type="text" name="pesquisar_bd" id="pesquisar_bd" placeholder="O que você está procurando?">
                <input type="submit" name="pesquisar" value="Pesquisar">
            </form>
        </div>
        <?php
        $pesquisar = filter_input(INPUT_POST, 'pesquisar', FILTER_SANITIZE_STRING);
        if (!isset($pesquisar) && !isset($_SESSION['gatos']) && !isset($_SESSION['cachorro']) && !isset($_SESSION['organizacoes'])) { ?>
            <div class="d-flex container p-3 text-center mx-auto opcoes_pesquisa" id="">
                <div class="d-block">
                    <img src="imagens/gato_pesquisa.png" alt="">
                    
                    <p><a href="pesq_gatos.php">Gatos</a></p>
                </div>
                <div class="d-block">
                    <img src="imagens/cachorro_pesquisa.png" alt="">
                    <p><a href="pesq_cachorros.php">Cachorros</a></p>
                </div>
                <div class="d-block">
                    <img src="imagens/organizacao_pesquisa.png" alt="">
                    <p><a href="">Organizações</a></p>
                </div>
            </div><?php }else{?>
                <div class="d-flex container p-3 text-center mx-auto opcoes_pesquisa1" id="">
                <div class="d-block">
                    <img src="imagens/gato_pesquisa.png" alt="">
                    
                    <p><a href="pesq_gatos.php">Gatos</a></p>
                </div>
                <div class="d-block">
                    <img src="imagens/cachorro_pesquisa.png" alt="">
                    <p><a href="pesq_cachorros.php">Cachorros</a></p>
                </div>
                <div class="d-block">
                    <img src="imagens/organizacao_pesquisa.png" alt="">
                    <p><a href="">Organizações</a></p>
                </div>
            </div><?php
            } ?>
        <?php
        if ($pesquisar || isset($_SESSION['gatos']) ||isset($_SESSION['cachorro'])  ) {
            if($pesquisar)
            $resultado_pesquisa = filter_input(INPUT_POST, 'pesquisar_bd', FILTER_SANITIZE_STRING);
            if(isset($_SESSION['gatos'])){
            $resultado_pesquisa= "gato";
            unset($_SESSION['gatos']);}
            if(isset($_SESSION['cachorro'])){
            $resultado_pesquisa= "cachorro";
            unset($_SESSION['cachorro']);}
            $result_msg_cont = "SELECT * FROM animal WHERE especie_animal LIKE '%$resultado_pesquisa%' OR nome_animal LIKE '%$resultado_pesquisa%' ORDER BY nome_animal ASC LIMIT 7";
            $resultado = $conexao->prepare($result_msg_cont);
            $resultado->execute(); ?>
            <h4 class="bg-transparent text-center text-secondary mt-5">Exibindo Resultados da Pesquisa por "<?php echo ($resultado_pesquisa); ?>"</h4>

            <?php while ($row_msg_cont = $resultado->fetch(PDO::FETCH_ASSOC)) {
                 $id_organizacao = $row_msg_cont['id_usuario'];
                 $requisicao = $conexao->prepare("SELECT * FROM organizacao WHERE id_organizacao=$id_organizacao");
                 $requisicao->execute();
                 $organizacao = $requisicao->fetch(PDO::FETCH_ASSOC);
            ?>
                <div id="" class="resultados_pesquisa container">
                    <div class="container rounded p-4" id="container_animal_pesquisa">
                        <div class="d-flex">
                            <div id="img_animal" class="d-flex bg-success">
                                <img src="<?php echo($row_msg_cont['caminho_imagem']);?>">
                            </div>
                            <div id="info_animal" class=" p-3 text-left">
                                <div id="nome_animal-pesquisa">
                                    <h3 class="p-2 display-4"><?php echo ($row_msg_cont['nome_animal']); ?></h3>
                                </div>
                                <p>Sexo: <?php echo ($row_msg_cont['sexo_animal']); ?></p>
                                <p>Idade: <?php 
                                                        if($row_msg_cont['idade_animal']<1){
                                                        $row_msg_cont['idade_animal']=$row_msg_cont['idade_animal']*12;
                                                        echo ($row_msg_cont['idade_animal']." meses");
                                                    }
                                                        else
                                                        echo ($row_msg_cont['idade_animal']." anos");
                                                        ?> </p>
                            </div>

                            <div id="acoes_pesquisa_animal">
                                <button id="botao_ver_perfil" type="button" data-toggle="modal" data-target="#modal_perfil_animal<?php echo ($row_msg_cont['id_animal']); ?>">Ver Perfil Completo</button>
                                <div id="modal_perfil_animal<?php echo ($row_msg_cont['id_animal']); ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title coiny">Perfil: <?php echo ($row_msg_cont['nome_animal']); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body text-center">
                                            <img src="<?php echo($row_msg_cont['caminho_imagem']);?>">
                                                <div class="info_modal d-flex">
                                                    <hr>
                                                    <div class="w-50 p-2">
                                                        <p><strong>Espécie:</strong> <?php echo ($row_msg_cont['especie_animal']); ?></p>
                                                        <p><strong>Sexo:</strong> <?php echo ($row_msg_cont['sexo_animal']); ?></p>
                                                        <p><strong>Idade:</strong> <?php 
                                                        if($item['idade_animal']<1){
                                                        $item['idade_animal']=$item['idade_animal']*12;
                                                        echo ($item['idade_animal']." meses");
                                                    }
                                                        else
                                                        echo ($item['idade_animal']." anos");
                                                        ?> </p>
                                                    </div>
                                                    <div class="w-50 p-2">
                                                        <p><strong>Responsável:</strong> <?php echo ($organizacao['nome_organizacao']); ?></p>
                                                        <p><strong>Localização:</strong> <?php echo ($row_msg_cont['cidade_animal']); ?></p>
                                                    </div>
                                                    </hr>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="btn_salvar_modal" type="button" class="btn text-white bg_laranja" data-dismiss="modal">Fechar</button>
                                                <button type="button" class="btn bg_azulclaro"><a class="text-wwhite" href="candidatura.php?animal=<?php echo $row_msg_cont['id_animal'];?>"> Quero Adotar</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="botao_adotar" type="button" data-toggle="modal" data-target=""><a class="text-white" href="candidatura.php?animal=<?php echo $row_msg_cont['id_animal'];?>"> Quero Adotar</a></button>
                             
                            </div>
                        </div>
                    </div>
                </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
            }
        }

?>
    <?php include_once "contato.php"?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="script/jquery-3.6.0.js"></script>
<script src="script/vanilla-tilt.js"></script>
<script>
    $(function() {
        $("#pesquisar_bd").autocomplete({
            source: 'pesquisar.php'
        });
    });
</script>
</body>

</html>