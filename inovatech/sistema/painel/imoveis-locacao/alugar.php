<?php 
$tabela = 'alugueis';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$id = $_POST['id-vender'];
$comprador = $_POST['comprador'];
$data_pgto = $_POST['data_pgto'];
$data_inicio = $_POST['data_inicio'];
$data_final = $_POST['data_final'];
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
$query = $pdo->prepare("INSERT INTO $tabela SET corretor = '$corretor', inquilino = '$comprador', proprietario = '$vendedor', valor_total = :valor_total, comissao_corretor = :comissao_corretor, comissao_imob = :comissao_imob, data = curDate(), data_pgto = '$data_pgto', obs = :obs, usuario = '$id_usuario', imovel = '$id', data_inicio = '$data_inicio' , data_final = '$data_final' ");

$query->bindValue(":valor_total", "$valor");
$query->bindValue(":comissao_imob", "$comissao_imob");
$query->bindValue(":comissao_corretor", "$comissao_corretor");
$query->bindValue(":obs", "$obs");
$query->execute();
$ult_id = $pdo->lastInsertId();


//ATUALIZAR STATUS DO IMÓVEL PARA VENDIDO
$query = $pdo->query("UPDATE imoveis SET status = 'Alugado' where id = '$id'");

//GERAR AS CONTA A RECEBER DE CADA MÊS DE ALUGUÉL
$data_ini  = $data_inicio;
$data_end  = $data_final; 
$dif = strtotime($data_end) - strtotime($data_ini); 
$qtd_parcelas = floor($dif / (60 * 60 * 24 * 30)); 

for($i=1; $i <= $qtd_parcelas; $i++){
	$descricao_nova = 'Aluguel Parcela - ('.$i.')';
	if($i == 1){
		$novo_vencimento = $data_pgto;
	}	

	$query = $pdo->query("INSERT INTO receber SET descricao = '$descricao_nova', locatario = '$comprador',  valor = '$valor', data_venc = '$novo_vencimento', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Aluguél', id_ref = '$ult_id'");


	$novo_vencimento = date('Y/m/d', strtotime("+1 month",strtotime($novo_vencimento)));
}



//GERAR A CONTA A PAGAR COM A COMISSÃO DO CORRETOR CASO EXISTA
if($comissao_corretor > 0){	
	$query = $pdo->query("INSERT INTO pagar SET descricao = 'Comissão Aluguél', corretor = '$corretor', valor = '$comissao_corretor', data_venc = '$data_pgto', frequencia = '0', saida = 'Caixa', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Comissão', id_ref = '$ult_id'");

}


echo 'Inserido com Sucesso';
?>