<?php 
require_once("../../conexao.php");
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$corretor = $_GET['corretor'];

$total_comissao_imob = 0;
$total_comissao_imobF = 0;

$total_comissao_cor = 0;
$total_comissao_corF = 0;


$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));


if($dataInicial == $dataFinal){
	$texto_apuracao = 'APURADO EM '.$dataInicialF;
}else if($dataInicial == '1980-01-01'){
	$texto_apuracao = 'APURADO EM TODO O PERÍODO';
}else{
	$texto_apuracao = 'APURAÇÃO DE '.$dataInicialF. ' ATÉ '.$dataFinalF;
}


$query = $pdo->query("SELECT * from usuarios where id = '$corretor' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_corretor = $res[0]['nome'];
}else{
	$nome_corretor = '';
}

if($corretor == ''){
	$tipo_rel = '';
}else{
	$tipo_rel = ' - Corretor: '.$nome_corretor;
}


$corretor = '%'.$corretor.'%';

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>




<!DOCTYPE html>
<html>
<head>
	<title>Relatório Aluguél</title>

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


	<div class="titulo_cab titulo_img"><u>Relatório de Aluguéis  <?php echo $tipo_rel ?> </u></div>	
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
		$query = $pdo->query("SELECT * from alugueis where (data >= '$dataInicial' and data <= '$dataFinal') and corretor LIKE '$corretor' order by id desc ");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = count($res);
		if($total_reg > 0){
			?>



			<small><small>
				<section class="area-tab" style="background-color: #f5f5f5;">
					
					<div class="linha-cab" style="padding-top: 5px;">
						<div class="coluna" style="width:14%">VALOR</div>
						<div class="coluna" style="width:20%">CORRETOR</div>
						<div class="coluna" style="width:20%">INQUILINO</div>
						<div class="coluna" style="width:20%">PROPRIETÁRIO</div>
						<div class="coluna" style="width:13%">R$ CORRETOR</div>
						<div class="coluna" style="width:13%">R$ IMOBILIÁRIA</div>				

					</div>
					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

				<?php

				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){}
						$id = $res[$i]['id'];
		$valor = $res[$i]['valor_total'];
		$vendedor = $res[$i]['proprietario'];
		$comprador = $res[$i]['inquilino'];
		$comissao_corretor = $res[$i]['comissao_corretor'];
		$comissao_imob = $res[$i]['comissao_imob'];
		$corretor = $res[$i]['corretor'];
		$data = $res[$i]['data'];
		$data_pgto = $res[$i]['data_pgto'];
		$obs = $res[$i]['obs'];
		$data_inicio = $res[$i]['data_inicio'];
		$data_final = $res[$i]['data_final'];
		$usuario = $res[$i]['usuario'];
		$imovel = $res[$i]['imovel'];
		
		
//retirar quebra de texto do obs		
		$dataF = implode('/', array_reverse(explode('-', $data)));
		$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));

		$valorF = number_format($valor, 2, ',', '.');
		$comissao_corretorF = number_format($comissao_corretor, 2, ',', '.');
		$comissao_imobF = number_format($comissao_imob, 2, ',', '.');

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_corretor = $res2[0]['nome'];
		}else{
			$nome_corretor = 'Sem Registro';
		}


		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_usuario = $res2[0]['nome'];
		}else{
			$nome_usuario = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM locatarios where id = '$comprador'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_comprador = $res2[0]['nome'];
		}else{
			$nome_comprador = 'Sem Registro';
		}


		$query2 = $pdo->query("SELECT * FROM vendedores where id = '$vendedor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_vendedor = $res2[0]['nome'];
		}else{
			$nome_vendedor = 'Sem Registro';
		}



		$query2 = $pdo->query("SELECT * FROM imoveis where id = '$imovel'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$titulo = $res2[0]['titulo'];
			$img_principal = $res2[0]['img_principal'];
		}


		//VERIFICAR SE JÁ POSSUI PARCELA PAGA PARA NÃO PERMITIR EXCLUSÃO
		$query2 = $pdo->query("SELECT * FROM receber where referencia = 'Aluguél' and id_ref = '$id' and pago = 'Sim' ");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$ocultar = 'ocultar';			
		}else{
			$ocultar = '';
		}


		//VERIFICAR SE POSSUI PARCELA EM ATRASO
		$query2 = $pdo->query("SELECT * FROM receber where referencia = 'Aluguél' and id_ref = '$id' and pago = 'Não' and data_venc < curDate()");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$classe_linha = 'text-danger';			
		}else{
			$classe_linha = '';
		}

		$total_comissao_imob += $comissao_imob;
		$total_comissao_imobF = number_format($total_comissao_imob, 2, ',', '.');

		$total_comissao_cor += $comissao_corretor;
		$total_comissao_corF = number_format($total_comissao_cor, 2, ',', '.');

					
					?>

					<section class="area-tab" style="padding-top:5px">					
						<div class="linha-cab">				
							<div class="coluna <?php echo $classe_pago ?>" style="width:14%">R$<?php echo $valorF ?></div>

							<div class="coluna" style="width:20%"><?php echo $nome_corretor ?></div>

							<div class="coluna" style="width:20%"><?php echo $nome_comprador ?></div>

							<div class="coluna" style="width:20%"><?php echo $nome_vendedor ?></div>

							<div class="coluna" style="width:13%"><?php echo $comissao_corretorF ?></div>	
							<div class="coluna" style="width:13%"><?php echo $comissao_imobF ?></div>	
						

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

		<span class="text-success"> <small><small><small><small>COMISSÃO IMOBILIÁRIA</small> : R$ <?php echo $total_comissao_imobF ?></small></small></small>  </span>			

			<span class="text-success"> <small><small><small><small>COMISSÃO CORRETOR</small> : R$ <?php echo $total_comissao_corF ?></small></small></small>  </span>
		</div>
	</div>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>




	<div class="footer"  align="center">
		<span style="font-size:10px"><?php echo $end_sistema ?> Tel: <?php echo $tel_sistema ?></span> 
	</div>



</body>
</html>