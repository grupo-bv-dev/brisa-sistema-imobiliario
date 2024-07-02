<?php 
$tabela = 'vendas';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$id = $_POST['id-vender'];
$comprador = $_POST['comprador'];
$data_pgto = $_POST['data_pgto'];
$valor = $_POST['valor'];
$comissao_corretor = $_POST['comissao_corretor'];
$comissao_imob = $_POST['comissao_imob'];
$obs = $_POST['obs'];

if($comprador == ''){
	echo 'Selecione um comprador!!';
	exit();
}

$valor = str_replace(',', '.', $valor);
$comissao_corretor = str_replace(',', '.', $comissao_corretor);
$comissao_imob = str_replace(',', '.', $comissao_imob);

$query = $pdo->query("SELECT * FROM imoveis where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$corretor = $res[0]['corretor'];
$vendedor = $res[0]['dono'];

//INSERIR NAS VENDAS
$query = $pdo->prepare("INSERT INTO $tabela SET corretor = '$corretor', comprador = '$comprador', vendedor = '$vendedor', valor_total = :valor_total, comissao_corretor = :comissao_corretor, comissao_imob = :comissao_imob, data = curDate(), data_pgto = '$data_pgto', pago = 'Não', obs = :obs, usuario = '$id_usuario', imovel = '$id'");

$query->bindValue(":valor_total", "$valor");
$query->bindValue(":comissao_imob", "$comissao_imob");
$query->bindValue(":comissao_corretor", "$comissao_corretor");
$query->bindValue(":obs", "$obs");
$query->execute();
$ult_id = $pdo->lastInsertId();


//ATUALIZAR STATUS DO IMÓVEL PARA VENDIDO
$query = $pdo->query("UPDATE imoveis SET status = 'Vendido' where id = '$id'");

//GERAR A CONTA A RECEBER COM A SOMA DAS COMISSÕES
$valor_conta = $comissao_corretor + $comissao_imob;
$query = $pdo->query("INSERT INTO receber SET descricao = 'Venda de Imóvel', proprietario = '$vendedor',  valor = '$valor_conta', data_venc = '$data_pgto', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Venda', id_ref = '$ult_id'");

//GERAR A CONTA A PAGAR COM A COMISSÃO DO CORRETOR CASO EXISTA
if($comissao_corretor > 0){	
	$query = $pdo->query("INSERT INTO pagar SET descricao = 'Comissão Venda', corretor = '$corretor', valor = '$comissao_corretor', data_venc = '$data_pgto', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Comissão', id_ref = '$ult_id'");

}


echo 'Inserido com Sucesso';
?>