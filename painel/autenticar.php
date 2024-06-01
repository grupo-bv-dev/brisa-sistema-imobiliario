<?php 
require_once ("conexao.php");
$usuario=$_POST['usuario'];
$senha =$_POST['senha'];
$senha_crip=md5($_POST['senha']);


?>