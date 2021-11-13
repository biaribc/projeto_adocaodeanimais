<?php
session_start();
$_SESSION['cachorro']="1";
header("location:pesquisa.php");