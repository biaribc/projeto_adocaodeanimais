<!DOCTYPE html>
<html lang="pt-br">
<?php
 include_once("conecta.php");
if(isset($_GET['id_animal']))
$id_animal=$_GET['id_animal'];

?>
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
        <title>Candidatura</title>
    </head>

    <body>
        <?php session_start(); include("menu.php");?>  
        <?php 
               
                $requisicaoanimal=$conexao->prepare("SELECT * FROM animal WHERE id_animal=$id_animal");
                $requisicaoanimal->execute();
                $animal=$requisicaoanimal->fetch(PDO::FETCH_ASSOC);
                ?> 
        <div id="postagem" class="container p-5">

            <div id="container_postagem" class="p-3 sombra_azul rounded overflow">
            <h3 class="text-center coiny laranja">Candidatos para adotar <?php echo $animal['nome_animal'];?></h3>
                <?php
                $item_catalogo = $conexao->prepare("SELECT * FROM candidatura WHERE id_animal=$id_animal");
                $item_catalogo->execute();
                if($item_catalogo->rowCount()<1){
                    ?> <p class="text-secondary media p-5 mt-5 text-center w-75 mx-auto"><?php  echo $animal['nome_animal'];?> ainda não recebeu candidaturas... Quando pessoas se candidatarem para adotá-lo, as candidaturas aparecerão aqui!</p><?php
                }
                $catalogo = $item_catalogo->fetchAll();
                
                foreach ($catalogo as $item) {
                    $id_usuario=$item['id_usuario'];
                    $requisicao=$conexao->prepare("SELECT * FROM usuario WHERE id_usuario=$id_usuario");
                    $requisicao->execute();
                    $usuario=$requisicao->fetchAll();
                    foreach($usuario as $result_usuario){?>
                <div class="container-fluid  mx-auto p-4 m-2 d-flex container_postagens border rounded" id="candidaturas">
                    <div class="w-50" >
                        <h4>
                            <?php echo($result_usuario['nome']);?>
                        </h4>
                    </div>
                    <div class="text-center w-50">
                        <button type="button" data-toggle="modal" data-target="#candidatura<?php echo $result_usuario['id_usuario'];?>" class=" btn rounded mb-2 w-75 bg_azulclaro text-white">Ver Detalhes</button>

                        <button type="button" data-toggle="modal" data-target="#modal_cancelar" class=" btn rounded  bg_laranja text-white w-75" class="btn rounded">Selecionar Candidatura</button></div>
                    <div class="modal fade" id="modal_cancelar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Seleção de candidato para adoção</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button></div>
                                        <div class="modal-body">
                                            <div class="container-fluid border contrato">
                                                <p class="font-weight-bold">PRÉVIA DE CONTRATO DE ADOÇÃO</p>
                                                <p class="text-justify p-2 font-weight-light text-muted">
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi soluta dolorem, harum nihil error eius unde exercitationem deserunt numquam facere totam aliquid amet illum repudiandae ea. Soluta quas repellat autem?
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi blanditiis odit nostrum suscipit exercitationem dignissimos quasi, dolorem minima molestias libero nesciunt quis fugit, ea, illo et corporis necessitatibus ratione! Vitae!
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, pariatur qui nostrum eligendi autem distinctio magni ut unde, quo, consequatur deserunt! Mollitia nisi doloribus consectetur at tenetur aut quod optio?
                                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi explicabo nostrum deserunt odit autem eum repellendus voluptas eaque error dicta, obcaecati necessitatibus qui harum aspernatur alias sint, delectus eligendi quos!
                                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe quidem animi, laborum voluptates praesentium, porro repellendus repudiandae reiciendis sapiente ipsa, perspiciatis eveniet omnis vitae? Totam qui voluptatem iusto consequatur ipsum!
                                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam iusto dolorum modi, voluptas id ipsam culpa aperiam dignissimos mollitia sed earum fuga sequi? Optio, autem doloribus praesentium ex deserunt fugiat.
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe reiciendis quo vitae vel soluta hic! Dolor ab quasi minus necessitatibus. Vero, minus. Possimus laboriosam voluptates ipsa, veritatis harum unde explicabo.
                                                </p>
                                            </div>
                                            <form action="" class="form-group p-4">
                                            <input type="checkbox" name="" id="" class="form-check-input p-1"><label for="">Declaro que li e estou de acordo com os <a class="laranja" href="">Termos de uso e privacidade</a></label> </form>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn bg_azul" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn bg_laranja"><a href="finalizar_doacao1.php?id_candidatura=<?php echo ($item['id_candidatura']);?>"> Continuar com Doação</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="candidatura<?php echo $result_usuario['id_usuario'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <p><span class="font-weight-bold mr-2"> Idade: </span> <?php
                                    $dataNascimento = $result_usuario['nascimento'];
                                    $data = new DateTime($dataNascimento );
                                    $resultado = $data->diff( new DateTime( date('Y-m-d') ) );
                                    echo $resultado->format( '%Y' );
                                    
                                    ?> anos</p>
                                    <p>
                                    <p><span class="font-weight-bold mr-2">Profissão: </span><span><?php echo $result_usuario['profissao'];?></span></p>
                                    <span class="font-weight-bold mr-2"> Data da Candidatura: </span><span> <?php echo $item['data_candidatura'];?></span>
                                    </p> </td></tr>
                                    <tr>
                                    <td>
                                    <p class="text-center font-weight-bold">Por que quero adotar o <?php echo $animal['nome_animal'];?>? </p>
                                    <p class="text-muted">
                                        <?php echo $item['desc_adocao'];?>
                                    </p></td></tr>
                   </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn bg_azulclaro text-white">Conversar</button>
                                    <button type="button" class="btn bg_laranja text-white">Ver Perfil</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <?php }} ?>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="script/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="script/vanilla-tilt.js"></script>

</html>