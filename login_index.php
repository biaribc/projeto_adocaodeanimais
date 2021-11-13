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
        <form class="mx-auto p-2 text-center w-100" class="" action="cadastrar.php">
            <ul class="ml-auto mr-auto " id="ul_cadastro">
                <li><img src="imagens/instituto1.png" alt=""></li>
                <h4 class='text-white '><strong>Como você gostaria de acessar?</strong></h4>
                <li id="cadastro_pf" class="text_center rounded mt-5"><a href="login.php">Sou uma Pessoa</a></li>
                <li id="cadastro_pj" class="text_center rounded"><a href="login_organizacao.php">Sou uma Organização</a></li>
            </ul>  
        </form>
    </div>
    </div>
</body>
</html>