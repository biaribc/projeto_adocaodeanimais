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
    <title>Página Inicial</title>
</head>
<body>
    <script>
        var i = setInterval(function() {
            clearInterval(i);
            document.getElementById("loading").style.display = "none";
            document.getElementById("pesquisa").style.display = "inline";

        }, 2000);
    </script>
    <?php include_once "menu.php"; 
    ?>
    <div id="loading" style="display: flex">
        <img class="mx-auto" src="imagens/loading.gif" style="width:150px;height:150px;" />
    </div>
    <div id="pesquisa" style="display:none">
        <div id="slide" class="carousel slide carousel-fade" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#slide" data-slide-to="0" class="active"></li>
                <li data-target="#slide" data-slide-to="1"></li>
                <li data-target="#slide" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner ">
                <div class="carousel-item active">
                    <div id="carousel-item1">
                    </div>
                    <div id="carousel-caption" class="carousel-caption">
                        <h1>Adote! </h1>
                        <p>Realize uma Adoção responsável</p>
                        <p><a href="">Adote agora</a></p>
                    </div>
                </div>

                <div class="carousel-item">

                    <div id="carousel-item2">

                    </div>
                    <div id="carousel-caption" class="carousel-caption">
                        <h1>Adote! </h1>
                        <p>mais de 2 mil adoções realizadas</p>
                        <p><a href="">Saiba Mais</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <div id="carousel-item3">

                    </div>
                    <div id="carousel-caption" class="carousel-caption">
                        <h1>Adote! </h1>
                        <p>jinefsnfs aiusfnifn siufnsinufds</p>
                        <p><a href="">Saiba Mais</a></p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#slide" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slide" role="button" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div id="video_apresentacao" class=" text-center">
            <h1>Conheça Nosso Projeto</h1>
            <iframe src="https://drive.google.com/file/d/1rZ7FYZwMiZMs_u03PC5UA6AIQmqE4sZH/preview" width="700" height="400" allow="autoplay"></iframe>
            <div id="card_animado" class="p-4">
                <div class="card bg-transparent rounded">
                    <div class="content_inicial">
                        <h2>Missão</h2>
                        <img src="imagens/missao1.png" class="w-50" alt="">
                    </div>
                    <div class="content">
                        <h2>
                            Nossa Missão
                        </h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis inventore magnam fugit suscipit, libero dolor quia, error sunt odit odio officia exercitationem labore esse ab est et neque molestias eos!</p>
                    </div>
                </div>
                <div class="card bg-transparent rounded">
                    <div class="content_inicial">
                        <h2>Visão</h2>
                        <img src="imagens/visao.png" class="w-50" alt="">
                    </div>
                    <div class="content">
                        <h2>
                            Nossa Visão
                        </h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis inventore magnam fugit suscipit, libero dolor quia, error sunt odit odio officia exercitationem labore esse ab est et neque molestias eos!</p>
                    </div>
                </div>
                <div class="card bg-transparent rounded">

                    <div class="content_inicial">
                        <h2>Valores</h2>
                        <img src="imagens/valores.png" class="w-50" alt="">

                    </div>
                    <div class="content">
                        <h2>
                            Nossos Valores
                        </h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis inventore magnam fugit suscipit, libero dolor quia, error sunt odit odio officia exercitationem labore esse ab est et neque molestias eos!</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="catalogo" class="container">
            <h3 class="text-center">Conheça alguns dos nossos amiguinhos disponíveis...</h3>
            <div id="container_catalogo" class="d-flex">
                <?php
               
                 $item_catalogo = $conexao->prepare("SELECT * FROM animal ORDER BY nome_animal ASC LIMIT 6");
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
                                                        <a href="perfil_organizacao?id_organizacao=<?php echo $organizacao['id_organizacao'];?>"><?php echo ($organizacao['nome_organizacao']); ?></a>
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
        </div>
        <div id="vermais" class="text-center"> <a class="text-decoration-none" href="catalogo.php">Ver Mais</a></div>
        <div id="slide-dep" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active w-100" id="">
                    <div class="float-left w-50 foto-slide" id="foto-slide-1">
                    </div>
                    <div class="float-left w-50 texto-slide p-5">
                        <h2>Depoimento</h2>
                        <p>Lorem ipsum dolor sit, amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Id possimus voluptas voluptatem! Perspiciatis ducimus placeat at non ea. Omnis accusantium magnam quas? Soluta nulla pariatur dolore, cupiditate
                            quod commodi facere?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, totam voluptatibus illum consequuntur doloribus quaerat placeat. Nemo officiis harum perferendis non ducimus autem culpa fugit, praesentium
                            explicabo accusamus rerum vel. consectetur adipisicing elit.<br> Corporis, nulla laborum nisi illum voluptatibus aliquid<br earum commodi et, dolorum incidunt eum? Placeat velit amet sapiente eveniet. Et nulla voluptatum iusto?</p>
                    </div>
                </div>
                <div class="carousel-item w-100" id="">
                    <div class="float-left w-50 foto-slide" id="foto-slide-2">
                    </div>
                    <div class="float-left w-50 texto-slide p-5">
                        <h2>Depoimento</h2>
                        <p>Lorem ipsum dolor sit, amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Id possimus voluptas voluptatem! Perspiciatis ducimus placeat at non ea. Omnis accusantium magnam quas? Soluta nulla pariatur dolore, cupiditate
                            quod commodi facere?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, totam voluptatibus illum consequuntur doloribus quaerat placeat. Nemo officiis harum perferendis non ducimus autem culpa fugit, praesentium
                            explicabo accusamus rerum vel. consectetur adipisicing elit.<br> Corporis, nulla laborum nisi illum voluptatibus aliquid<br earum commodi et, dolorum incidunt eum? Placeat velit amet sapiente eveniet. Et nulla voluptatum iusto?</p>
                    </div>
                </div>
                <div class="carousel-item w-100">
                    <div class="float-left w-50 foto-slide" id="foto-slide-3">
                    </div>
                    <div class="float-left w-50 texto-slide p-5">
                        <h2>Depoimento</h2>
                        <p>Lorem ipsum dolor sit, amet Lorem ipsum dolor sit amet consectetur adipisicing elit. Id possimus voluptas voluptatem! Perspiciatis ducimus placeat at non ea. Omnis accusantium magnam quas? Soluta nulla pariatur dolore, cupiditate
                            quod commodi facere?Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, totam voluptatibus illum consequuntur doloribus quaerat placeat. Nemo officiis harum perferendis non ducimus autem culpa fugit, praesentium
                            explicabo accusamus rerum vel. consectetur adipisicing elit.<br> Corporis, nulla laborum nisi illum voluptatibus aliquid<br earum commodi et, dolorum incidunt eum? Placeat velit amet sapiente eveniet. Et nulla voluptatum iusto?</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#slide-dep" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slide-dep" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="display-2 container text-center" id="frase_index">
            <h1>"Para Adotar um Animal é Preciso Apenas um Bom Coração."</h1>
        </div>
        <footer class="p-5">
            <div id="social_rodape" class="w-100">
                <ul class="d-flex mx-auto col-3">
                    <li class=""><a href=""><img src="imagens/facebook.png" alt=""></a> </li>
                    <li class=""><a href=""><img src="imagens/instagram.png" alt=""></a></li>
                    <li class=""><a href=""><img src="imagens/tiktok.png" alt=""></a></li>
                </ul>
            </div>
            <div id="newsletter_rodape" class="container text-center">
                <form action="" class=" d-flex">
                    <p>Se inscreva para receber atualizações: </p>
                    <input class="rounded p-2 w-50 bg-transparent text-white" type="email" name="" id="" placeholder="Insira seu email">
                    <button type="submit" class="btn bg-transparent rounded text-white border border-white ml-2 ">ME INSCREVER</button>
                </form>
            </div>
            <div class="d-flex container pt-3" id="info_rodape">
                <div class="col">
                    <ul>
                        <p>Contato</p>
                        <li><strong> Telefone:</strong> (61) 3629 - 9999</li>
                        <li><strong> WhatsApp: </strong>(61) 9999 - 9999</li>
                        <li><strong> Email:</strong><i> contato@4patasadocao.com</i></li>
                        <li><strong> Contato para publicidade: </strong><i> publicidade@4patasadocao.com</i></li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <p>Nosso Projeto</p>
                        <li class=""><a href="#" class="text-white text-right">O que é o 4 Patas?</a> </li>
                        <li class=""><a href="#" class="text-white">Termos de Uso e Privacidade</a></li>
                    </ul>
                </div>
                <div class="col">
                    <ul>
                        <p>Sobre Adoções</p>
                        <li class=""><a href="#" class="text-white text-right">Dados sobre Adoções no Brasil</a> </li>
                        <li class=""><a href="#" class="text-white">Direito dos Animais</a></li>
                    </ul>
                </div>
            </div>
        </footer>
      
    <?php include_once "contato.php"?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="script/javascript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="script/vanilla-tilt.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".card"), {
        max: 25,
        speed: 300,
        perspective: 1000,
        glare: true,
        "max-glare": 0.5
    });
    $(document).ready(function() {
        $(document).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $("#menu_principal").css("animation-name", "surgirMenu", "position", "fixed", "border-radius", "0");
            } else {
                $("#menu_principal").css("position", "relative", "border-bottom-left-radius", "50%", "border-bottom-right-radius", "50%");
            }
        })
        $('#texto1').css("animation-name", "surgirTexto1");
        $('#botao_texto1').css("animation-name", "surgirTextoDireita");
    });
</script>

</html>