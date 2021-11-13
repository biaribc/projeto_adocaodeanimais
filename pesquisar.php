<?php
include_once "conecta.php";
$pesquisa =filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING);;
$result_pesquisa="SELECT * FROM animal WHERE * LIKE '%$pesquisa%' ORDER BY especie_animal ASC LIMIT 7";
$resultado_pesquisa = $conexao->prepare($result_pesquisa);
$resultado_pesquisa->execute();
while($row_msg_cont = $resultado_pesquisa->fetch(PDO::FETCH_ASSOC)){
    $data[] = $row_msg_cont['especie_animal'];
}
echo json_encode($data);
