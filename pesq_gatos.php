<?php
session_start();
$_SESSION['gatos']="1";
header("location:pesquisa.php");