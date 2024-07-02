<?php 
$tabela = 'vendas';
require_once("../../conexao.php");

$id = $_POST['id'];
$query = $pdo->query("SELECT * FROM vendas where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_imovel = $res[0]['imovel'];

$pdo->query("DELETE FROM $tabela where id = '$id'");

//ATUALIZAR STATUS DO IMÓVEL PARA VENDA
$query = $pdo->query("UPDATE imoveis SET status = 'Para Venda' where id = '$id_imovel'");

//EXCLUIR A CONTA A RECEBER GERADA PELA VENDA
$pdo->query("DELETE FROM receber where referencia = 'Venda' and id_ref = '$id'");

//EXCLUIR A CONTA A PAGAR GERADA PELA VENDA
$pdo->query("DELETE FROM pagar where descricao = 'Comissão Venda' and id_ref = '$id'");

echo 'Excluído com Sucesso';


?>