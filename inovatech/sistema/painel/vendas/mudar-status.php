<?php 
$tabela = 'vendas';
require_once("../../conexao.php");

$id = $_POST['id'];
$acao = $_POST['acao'];
$nome = $_POST['nome'];

$pdo->query("UPDATE $tabela SET pago = '$acao' where id = '$id'");

echo 'Alterado com Sucesso';

?>