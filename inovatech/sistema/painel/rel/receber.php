<?php 
require_once("../../conexao.php");
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$tipo = $_GET['tipo'];
$pago = $_GET['pago'];


$total_pagas = 0;
$total_pagasF = 0;

$total_pendentes = 0;
$total_pendentesF = 0;


$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));


if($dataInicial == $dataFinal){
	$texto_apuracao = 'APURADO EM '.$dataInicialF;
}else if($dataInicial == '1980-01-01'){
	$texto_apuracao = 'APURADO EM TODO O PERÍODO';
}else{
	$texto_apuracao = 'APURAÇÃO DE '.$dataInicialF. ' ATÉ '.$dataFinalF;
}



if($tipo == ''){
	$tipo_rel = '';
}else{
	$tipo_rel = ' - '.$tipo;
}


if($pago == ''){
	$acao_rel = '';
}else{
	$acao_rel = ' - Pagas: '.$pago;
}

$pago = '%'.$pago.'%';
$tipo = '%'.$tipo.'%';

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>




<!DOCTYPE html>
<html>
<head>
	<title>Relatório Contas à Receber</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="image/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 0px;

		}

		body{
			margin-top:0px;
			font-family:Times, "Times New Roman", Georgia, serif;
		}


		<?php if($relatorio_pdf == 'pdf'){ ?>

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		<?php }else{ ?>
			.footer {
				margin-top:20px;
				width:100%;
				background-color: #ebebeb;
				padding:5px;

			}

		<?php } ?>

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;
		}

		.titulo_cab{
			color:#0340a3;
			font-size:17px;
		}

		
		
		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;
		}



		hr{
			margin:8px;
			padding:0px;
		}


		
		.area-cab{
			
			display:block;
			width:100%;
			height:10px;

		}

		
		.coluna{
			margin: 0px;
			float:left;
			height:30px;
		}

		.area-tab{
			
			display:block;
			width:100%;
			height:30px;

		}


		.imagem {
			width: 200px;
			position:absolute;
			right:20px;
			top:10px;
		}

		.titulo_img {
			position: absolute;
			margin-top: 10px;
			margin-left: 10px;

		}

		.data_img {
			position: absolute;
			margin-top: 40px;
			margin-left: 10px;
			border-bottom:1px solid #000;
			font-size: 10px;
		}

		.endereco {
			position: absolute;
			margin-top: 50px;
			margin-left: 10px;
			border-bottom:1px solid #000;
			font-size: 10px;
		}

		.verde{
			color:green;
		}
		

	</style>


</head>
<body>	


	<div class="titulo_cab titulo_img"><u>Relatório Contas à Receber  <?php echo $tipo_rel ?> <?php echo $acao_rel ?> </u></div>	
	<div class="data_img"><?php echo mb_strtoupper($data_hoje) ?></div>

	<?php 
	if($logo_rel != ''){
		?>
		<img class="imagem" src="<?php echo $url_sistema ?>/sistema/imagens/<?php echo $logo_rel ?>" width="200px" height="60">

	<?php } ?>
	

	<br><br><br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>

	<div class="mx-2" style="padding-top:10px ">

		<section class="area-cab">
			
			<div class="coluna" style="width:50%">
				<small><small><small><u><?php echo $texto_apuracao ?></u></small></small></small>
			</div>



		</section>

		<br>

		<?php 
		$query = $pdo->query("SELECT * from receber where (data_venc >= '$dataInicial' and data_venc <= '$dataFinal') and pago LIKE '$pago' and referencia LIKE '$tipo' order by data_venc asc ");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($res);
		if($total_reg > 0){
			?>



			<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:15%">VALOR</div>
						<div class="coluna" style="width:30%">DESCRIÇÃO</div>
						<div class="coluna" style="width:15%">VENCIMENTO</div>
						<div class="coluna" style="width:20%">SAÍDA</div>
						<div class="coluna" style="width:20%">TIPO</div>
						

					</div>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

				<?php

				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){}
						$id = $res[$i]['id'];
		$valor = $res[$i]['valor'];
		$descricao = $res[$i]['descricao'];
		$vencimento = $res[$i]['data_venc'];
		$saida = $res[$i]['saida'];
		$referencia = $res[$i]['referencia'];
		$pago = $res[$i]['pago'];	 
		
		
//retirar quebra de texto do obs		
		$vencimentoF = implode('/', array_reverse(explode('-', $vencimento)));
		
		$valorF = number_format($valor, 2, ',', '.');
		
		
		if($pago == 'Sim'){
			$classe_pago = 'text-success';
			$total_pagas += $valor;
			$total_pagasF = number_format($total_pagas, 2, ',', '.');
			
		}else{
			$classe_pago = 'text-danger';
			$total_pendentes += $valor;
			$total_pendentesF = number_format($total_pendentes, 2, ',', '.');
		}
		
					
					?>

					<section class="area-tab" style="padding-top:5px">					
						<div class="linha-cab">				
							<div class="coluna <?php echo $classe_pago ?>" style="width:15%">R$<?php echo $valorF ?></div>

							<div class="coluna" style="width:30%"><?php echo $descricao ?></div>

							<div class="coluna" style="width:15%"><?php echo $vencimentoF ?></div>

							<div class="coluna" style="width:20%"><?php echo $saida ?></div>

							<div class="coluna" style="width:20%"><?php echo $referencia ?></div>	
														

						</div>
					</section>
					<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
					</div>

				<?php } ?>

			</small>



		</div>


		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3">
		</div>


	<?php }else{
		echo '<div style="margin:8px"><small><small>Sem Registros no banco de dados!</small></small></div>';
	} ?>



	<div class="col-md-12 p-2">
		<div class="" align="right">

		<span class="text-danger"> <small><small><small><small>CONTAS À RECEBER</small> : R$ <?php echo $total_pendentesF ?></small></small></small>  </span>			

			<span class="text-success"> <small><small><small><small>CONTAS RECEBIDAS</small> : R$ <?php echo $total_pagasF ?></small></small></small>  </span>
		</div>
	</div>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>




	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $end_sistema ?> Tel: <?php echo $tel_sistema ?></span> 
	</div>



</body>
</html>