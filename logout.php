<?php
session_start();
unset($_SESSION['id_usuario']);
unset($_SESSION['id_organizacao']);
header("location: index.php");
?>
