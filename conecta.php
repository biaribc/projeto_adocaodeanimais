<?php
$servidor='localhost';
$bd='4patas';
$usuario="root";
$senha="";
try {
$conexao = new PDO("mysql:dbname=".$bd.";host=".$servidor,$usuario,$senha);
} catch(PDOException $e) {
    echo "ERRO: " . $e->getMessage();
}
$conexao->exec("SET CHARACTER SET utf8");
?>
