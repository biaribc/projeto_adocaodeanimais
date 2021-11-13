<?php
require_once("logar_organizacao.php");
if (isset($_SESSION['id_usuario']) || isset($_SESSION['id_organizacao'])) {
    header("location: meuperfil.php");
    exit;
}
?>
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
    <title>Login</title>
</head>

<body class="d-flex">
    <div id="img_login" class="d-flex">
        <a href="index.php"><img id="seta_voltar" src="imagens/seta_voltar.png" class="position-absolute" alt=""></a>
        <div class="rounded mx-auto" id="container_login">
            <form class="mx-auto p-2 text-center" method="POST" action="logar_organizacao.php">
                <ul class="ml-auto mr-auto">
                    <li><img src="imagens/instituto1.png" alt=""></li>
                    <h4 class='text-white '><strong>Acesse sua conta!</strong></h4>
                    <li>
                        <p class="text-white">Para adotar ou doar um animalzinho você precisa de um cadastro!</p>
                    </li>
                    <li><input type="email" class="form-control" name="email" id="email" placeholder="E-mail"></li>
                    <li> <input type="password" class="form-control" name="senha_cadastro" id="senha_cadastro" placeholder="Senha"></li>
                    <li><input type="submit" class="btn" value="ACESSAR"></li>
                    <p class="text-center text-white"> Ainda não é cadastrado? <a href="cadastro_organizacao.php">Cadastre-se!</a></p>
                    <p class="text-center"><a href="">Preciso de Ajuda</a></p>
                </ul>
            </form>
            <?php if (isset($_SESSION['erro_login'])) { ?>
                <div class="bg-alert text-white">
                    <p>Usuário ou Senha Inválidos!</p>
                </div><?php
                        unset($_SESSION['erro_login']);
                    } ?>
        </div>
    </div>
</body>

</html>