<?php
session_start();
$_SESSION['organizacao']="1";
header("location:pesquisa.php");