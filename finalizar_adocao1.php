<?php session_start();
include_once("conecta.php");
if(isset($_GET['id_candidatura'])){
    $id_candidatura=$_GET['id_candidatura'];
    $item = $conexao -> prepare("SELECT * FROM candidatura WHERE id_candidatura=$id_candidatura");
    $item -> execute();
    $candidatura = $item -> fetch(PDO::FETCH_ASSOC);
    $id_animal = $candidatura['id_animal'];
    $usuario = $_SESSION['id_usuario'];
    
    $candidato=$conexao -> prepare ("SELECT * FROM usuario WHERE id_usuario = $usuario");
    $candidato -> execute();
    $info_candidato = $candidato -> fetch(PDO::FETCH_ASSOC);
    $animal=$conexao -> prepare ("SELECT * FROM animal WHERE id_animal = $id_animal");
    $animal -> execute();
    $info_animal = $animal -> fetch(PDO::FETCH_ASSOC);
    $id_org=$info_animal['id_usuario'];
    $org=$conexao -> prepare ("SELECT * FROM organizacao WHERE id_organizacao = $id_org");
    $org -> execute();
    $info_organizacao = $org -> fetch(PDO::FETCH_ASSOC);
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
    <script src="script/jquery-3.6.0.js"></script>
    <script src="script/vanilla-tilt.js"></script>
    <script src="script/javascript.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imagens/logo1.png" type="image/x-icon">
    <title>Doação</title>
</head>
<body>
    <?php include "menu.php"?>
        <div id="contato" class="d-flex">
        <div class="container rounded p-3 d-flex text-justify" height="80" id="container_doacao">
            
            <form action="finalizar_adocao2.php" class="d-block w-75 mx-auto text-capitalize">
            <h3 class="laranja coiny text-center">Formulário de Adoção</h3>
                <p><strong>Nome do Doador:</strong> <?php echo $info_organizacao['nome_organizacao']; ?></p>
                <p><strong>Nome do Adotante:</strong> <?php echo $info_candidato['nome']; ?></p>
                <fieldset class="border border-dark rounded p-3">
                    <legend class="ml-2 laranja">Características do animal doado </legend>
                    <p><strong>Nome: </strong> <?php echo $info_animal['nome_animal']; ?> </p>
                    <p><strong>Especie: </strong> <?php echo $info_animal['especie_animal']; ?></p>
                    <p><strong>Idade: </strong><?php echo $info_animal['idade_animal']; ?> </p>
                    <p><strong>Possui Deficiencia? </strong> <?php echo $info_animal['deficiencia_animal']; ?></p>
                    <p><strong>Descrição fornecida pelo doador: </strong><?php echo $info_animal['descricao_animal']; ?> </p>
                </fieldset>
                <p><strong>Data da candidatura: </strong> <?php echo $candidatura['data_candidatura']; ?></p>
                <p class="d-flex"><button class=" w-50 bg_azulclaro text-white rounded"><a href="gerar_pdf.php" target="_blank" rel="noopener noreferrer">PRÉVIA DE CONTRATO</a></button>
                <input class="bg_laranja text-white w-50 rounded" type="submit" value="CONTINUAR DOAÇÂO"></p>
            </form>
        </div>
    </div>
</body>
</html>