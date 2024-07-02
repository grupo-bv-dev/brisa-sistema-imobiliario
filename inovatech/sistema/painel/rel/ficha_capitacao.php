<?php 
require_once("../../conexao.php");
$id = $_GET['id'];

$query = $pdo->query("SELECT * from tipos where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$foto_ficha = $res[0]['foto_ficha'];
}else{
	$foto_ficha = 'Nenhuma Ficha Relacionada';
}

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

$total_comissao_venda = $comissao_venda_imob + $comissao_venda_corretor;
$total_comissao_aluguel = $comissao_aluguel_imob * 1;
?>




<!DOCTYPE html>
<html>
<head>
	<title>Ficha de Imóvel</title>

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


		hr{
			margin:8px;
			padding:0px;
		}


		
		
		.imagem {
			width: 200px;
			position:absolute;
			left:5px;
			top:10px;
			height:60px;
		}

		.linha {			
			position:absolute;
			left:210px;
			top:0px;
			height:95px;
		}

		.texto-cab {			
			position:absolute;
			left:220px;
			top:10px;
		}

					

	</style>


</head>
<body>	


	<div class="row">
		<div class="col-md-4">
			<?php 
			if($logo_rel != ''){
				?>
				<img class="imagem" src="<?php echo $url_sistema ?>/sistema/imagens/<?php echo $logo_rel ?>" width="200px" height="60px">

				<img class="linha" src="<?php echo $url_sistema ?>/sistema/imagens/linha-cabecalho.jpg" height="60px">

			<?php } ?>


		</div>

		<div class="texto-cab">
			<span><small><?php echo mb_strtoupper($nome_sistema) ?></small></span><br>
			<span><small><small><small><?php echo $end_sistema ?></small></small></small></span> <br>
			<span><small><small><small>TEL: <?php echo $tel_sistema ?></small></small></small></span>
			<span style="margin-left:20px"><small><small><small>CRECI: <?php echo $creci_imob ?></small></small></small></span>

			<span style="margin-left:20px"><small><small><small>CNPJ: <?php echo $cnpj_imob ?></small></small></small></span>

		</div>
	</div>			
	
	

	<br><br>
	<div class="cabecalho" style="border-bottom: solid 1px #0340a3">
	</div>

	<div class="mx-2" style="padding-top:10px ">

	<br>
	<div align="center">
	<b>AUTORIZAÇÃO DE COMERCIALIZAÇAO DO IMÓVEL</b>
	<br><br>
Fica a <?php echo $nome_sistema ?> autorizada a colocação de placas, anunciar, promover e intermediar a venda e/ou locação do imóvel acima descrito,
reservando-nos o direito de intermediação em caso de venda, comissão de <?php echo $total_comissao_venda ?>% sobre o valor das transações, ou comissão  de <?php echo $total_comissao_aluguel ?>% no caso de locação a qual será paga no ato da assinatura do contrato. Os proprietários reservam o direito de promover,
também, a venda do imóvel sem que haja obrigação em pagar a <?php echo $nome_sistema ?> comissões, desde que o cliente não tenha sido por ela
apresentado.

<br><br><br>

____________________________________________________ <br>
(Nome por Extenso
<br><br><br>

_______________________________________ <br>
(CPF ou CNPJ)
<br><br><br>

_______________________________________ <br>
(RG)
<br><br><br>


____________________________________________________ <br>
(Assinatura do Proprietário)
<br><br><br>

	</div>	




	<div>

		<?php 
			if($foto_ficha != ''){
				?>
				<img src="<?php echo $url_sistema ?>/sistema/painel/images/tipos/<?php echo $foto_ficha ?>" width="100%">

				
			<?php } ?>

	</div>




</body>
</html>