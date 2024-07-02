<?php 
$tabela = 'alugueis';
require_once("../../conexao.php");

$id = $_POST['id'];
$query = $pdo->query("SELECT * FROM alugueis where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_imovel = $res[0]['imovel'];

$pdo->query("DELETE FROM $tabela where id = '$id'");

//ATUALIZAR STATUS DO IMÓVEL PARA ALUGUEL
$query = $pdo->query("UPDATE imoveis SET status = 'Para Aluguél' where id = '$id_imovel'");

//EXCLUIR A CONTA A RECEBER GERADA PELA ALUGUEL
$pdo->query("DELETE FROM receber where referencia = 'Aluguél' and id_ref = '$id'");

//EXCLUIR AS CONTA A PAGAR GERADA PELO ALUGUEL
$pdo->query("DELETE FROM pagar where descricao = 'Comissão Aluguél' and id_ref = '$id'");

echo 'Excluído com Sucesso';


?>