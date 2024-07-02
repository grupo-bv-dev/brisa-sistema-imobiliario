<?php 

//SCRIPT PARA VARRER OS IMÓVEIS QUE ESTÃO COM A VALIDADE DO ANUNCIO VENCIDAS
$query = $pdo->query("SELECT * FROM imoveis where (status = 'Para Venda' or status = 'Para Aluguél') and validade_anuncio = 'Sim' and data_final < curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];

	$query = $pdo->query("UPDATE imoveis SET status = 'Inativo' where id = '$id'");	
}



//VARRER AS CONTAS A RECEBER E VERIFICAR QUAIS DESSAS CONTAS JÁ ESTÃO COM O BOLETO PAGO PARA DAR BAIXA AUTOMATICAMENTE
$query = $pdo->query("SELECT * FROM receber where pago = 'Não' and (boleto != null or boleto != '') ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		    $boleto = $res[$i]['boleto'];
		    $descricao = $res[$i]['descricao'];
		    $valor = $res[$i]['valor'];

		    require("boletos/notificacoes.php");

		    if($status == 'paid'){
		    	$pdo->query("UPDATE receber set pago = 'Sim', data_pgto = 'curDate()', saida = 'Boleto' where id = '$id'");

		    	//LANÇAR NAS MOVIMENTAÇÕES
				$pdo->query("INSERT INTO movimentacoes set tipo = 'Entrada', movimento = 'Conta à Receber', descricao = '$descricao', valor = '$valor', data = curDate(), lancamento = 'Boleto', id_mov = '$id'");
		    }   

	
}


$query = $pdo->query("UPDATE config SET data_verificacao = curDate()");
 ?>