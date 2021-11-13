<?php 
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
    <link rel="shortcut icon" href="imagens/logo1.png" type="image/x-icon">

    <title>Página Inicial</title>
</head>
<body>
        <header class="text-center">
        <nav class="navbar navbar-expand-sm navbar-dark" id="menu_principal">
            <div  class="collapse navbar-collapse col" id="nav-target">
                
                <div class="ml-auto col"> <ul class="d-flex">
                    <li class="nav-item " ><img src="imagens/outline_search_white_24dp.png" alt=""><a class="nav-link"href="pesquisa.php">Buscar</a></li>           
          
            <div id="logo" class="navbar-brand col ">
                <img src="imagens/instituto1.png" title="logo" alt="imagem logo">
            </div>
            <?php
            if(isset($_SESSION['id_usuario'])){
            $usuario_menu=$_SESSION['id_usuario'];}
            else if(isset($_SESSION['id_organizacao'])){
                $usuario_menu=$_SESSION['id_organizacao'];}
            else{
                $usuario_menu=0;
            }
            $notificacoes=$conexao->prepare("SELECT * FROM notificacao WHERE status_notificacao=1 AND id_usuario=$usuario_menu LIMIT 5");
            $notificacoes->execute();
            $notificacao=$notificacoes->fetchAll();
            ?>
                
                    <li class="nav-item col"><a class="nav-link " href="index.php">HOME</a></li>
                    <li id="quero_adotar" class="nav-item col d-flex "><?php if(isset($_SESSION['id_organizacao'])){?><a class="nav-link border rounded bg-white"href="cadastro_animal.php">Doar</a><?php } else {?><a class="nav-link border rounded bg-white"href="catalogo.php"> quero adotar</a><?php } ?></li> 
                    <li class="nav-item col dropdown show"><a class=" text-white  nav-link" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notificações</a>
                    <div class="dropdown-menu"  aria-labelledby="dropdownMenuLink">
                        <?php foreach($notificacao as $not){?>
                            <P class="dropdown-item text-capitalize">
                            <a class="dropdown-item" href="<?php echo $not['link_notificacao'];?>"><?php echo($not['cont_notificacao']);?></a></P>
                           <?php }?>
                          </div>
                        </li>
                    <li class="nav-item col d-flex"><a class="nav-link"href="chat.php"> mensagens</a></li>
                    <?php if(!isset($_SESSION["id_usuario"])&&!isset($_SESSION["id_organizacao"])){?>
                    <li class="nav-item col"><img src="imagens/outline_person_white_24dp.png" alt=""><a class="nav-link"href="login_index.php">acessar</a></li>
                    <?php }else{ ?>
                        
                         <li class="nav-item col dropdown show"><img src="imagens/outline_person_white_24dp.png" alt=""><a class="text-white nav-link dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Perfil</a>
                         <div class="dropdown-menu text-capitalize"  aria-labelledby="dropdownMenuLink">
                            <p class="dropdown-item text-capitalize">
                            <a class="dropdown-item" href="meuperfil.php">Meu Perfil</a></p>
                            <?php if (isset($_SESSION['id_usuario'])){?>
                            <p class="dropdown-item text-capitalize">
                            <a class="dropdown-item" href="minhas_candidaturas.php">Minhas Candidaturas</a></p>
                            <?php }else{ ?>
                            <p class="dropdown-item text-capitalize">
                            <a class="dropdown-item" href="postagens.php">Minhas Publicações</a></p>
                            <?php }?>
                            <p class="dropdown-item text-capitalize">
                            <a class="dropdown-item" href="logout.php">Sair</a></p>
                          </div>
                        </li>

                    <?php
                    }
                    ?>
                </ul>
             </div>    
            </div> 
        </nav>
        </header>   
<script>
         $(document).ready(function() {
            $(document).scroll(function() {
                if ($(this).scrollTop() > 350 ){
                    $("#menu_principal").css("animation-name","surgirMenu");
                    $("#menu_principal").css("position","fixed");
                    $("#menu_principal").css("border-radius","0");
                }else{
                    $("#menu_principal").css("position","relative");
                    $("#menu_principal").css("border-bottom-left-radius","50%");
                    $("#menu_principal").css("border-bottom-right-radius","50%");
                }} 
  )});
</script>
</body>
</html>