<?php session_start();
if(!isset($_SESSION['animal'])){
    $_SESSION['id_animal']=array();
}
if(isset($_GET['add']) && $_GET['add']=="perfil"){
    $id_animal= $_GET['id_animal'];
}
?> <?php require "conecta.php"?>
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
        var i = setInterval(function () {
    
    clearInterval(i);
  
    // O código desejado é apenas isto:
    document.getElementById("loading").style.display = "none";
    document.getElementById("pesquisa").style.display = "inline";

}, 2000);

    </script>

   <?php include_once "menu.php";?>
  
    <div id="loading" style="display: flex">
        <img class="mx-auto"src="imagens/SoupyLazyGnatcatcher-size_restricted.gif" style="width:150px;height:150px;" />
    </div>
    <div id="pesquisa" style="display: none">
    <?php 
    $animal=$conexao->prepare("SELECT * FROM animal WHERE id_animal=?");
    $resultado_animal=$animal->execute();


    ?>
        <div>
            <div>
                <div>
                    <img src="imagens/" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
 <?php
    ?>
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="script/jquery-3.6.0.js"></script>
   <script src="script/vanilla-tilt.js"></script>
  
</body>

</html>