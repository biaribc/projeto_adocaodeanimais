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
    <a href="index.php"><img id="seta_voltar" src="imagens/seta_voltar.png" class="position-absolute " alt=""></a>
    <div class="rounded mx-auto" id="container_login">
        <form class="mx-auto p-2" method="POST" action="cadastrar_usuario.php">
            <ul class="ml-auto mr-auto" id="ul_cadastro">
                <h4 class='text-white '><strong>Cadastro</strong></h4>
                <li><input type="text" name="nome" id="nome" placeholder="Nome Completo"></li>
                <li><span class="text-right text-white mb-0">Carregar Foto de Perfil: 
                <input type="file" name="foto" id="foto" placeholder="Foto de perfil"></span></li>
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="text" name="cep" id="cep" placeholder="CEP">
                <input type="text" name="cidade" id="cidade" placeholder="Cidade">
                <p class="text-right text-white mb-0 w-100 ">Data de Nascimento:
                <input type="date" name="data_nasc" id="data_nasc" placeholder="Data de Nascimento"></p>
                <input type="password" placeholder="Senha" name="senha" id="senha">
                <input type="password" placeholder="Confirme a Senha" name="senha_conf" id="senha_conf">

                <input type="submit" value="Cadastrar">
                <p class="text-center text-white"> Já é cadastrado? <a href="login_index.php">Faça Login!</a></p>
                <p class="text-center"><a href="ajuda.php">Preciso de Ajuda</a></p>
            </ul>  
        </form>      
    </div>
    </div>
</body>
</html>