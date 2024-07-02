<?php 
include_once("sistema/conexao.php");
include_once("cabecalho.php");

$url = @$_GET['url'];
if($url == ""){
	$id = @$_GET['id'];
}else{
	$res = $pdo->query("SELECT * FROM imoveis where url = '" . $url . "' ");
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	$id = $dados[0]['id'];
}

$id_imovel_get = $id;

?>

<?php 
$res = $pdo->query("SELECT * FROM imoveis where id = '" . $id . "' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) == 0){
	echo 'Nenhum Imóvel com esse ID';
	exit();
}
$i = 0;
$id = $dados[$i]['id']; 
$status = $dados[$i]['status']; 
$imagem = $dados[$i]['img_principal']; 
$valor = $dados[$i]['valor']; 
$titulo = $dados[$i]['titulo']; 
$bairro = $dados[$i]['bairro']; 
$area = $dados[$i]['area_total']; 
$area_construida = $dados[$i]['area_construida']; 
$quartos = $dados[$i]['quartos']; 
$banheiros = $dados[$i]['banheiros']; 
$garagens = $dados[$i]['garagens']; 
$corretor = $dados[$i]['corretor'];

$status = $dados[$i]['status'];

$imagemPlanta = $dados[$i]['img_planta'];

$tipo = $dados[$i]['tipo'];
$descricao = $dados[$i]['descricao'];
$suites = $dados[$i]['suites'];
$piscinas = $dados[$i]['piscinas'];
$ano = $dados[$i]['ano'];
$condicao = $dados[$i]['condicao'];
$video = $dados[$i]['video'];
$iptu = $dados[$i]['iptu'];
$condominio = $dados[$i]['condominio'];
$visitas = $dados[$i]['visitas'];

if($visitas == 0){
	$visitas = 20;
}

$valorF = number_format($valor, 2, ',', '.');
$iptu = number_format($iptu, 2, ',', '.');
$condominio = number_format($condominio, 2, ',', '.');


$res_2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
$dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);            
$nomeCorretor = $dados_2[0]['nome'];
$id_func = $dados_2[0]['id_func'];
$imgCorretor = $dados_2[0]['foto'];

$res_2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
$dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados_2)> 0) {
	$telefoneCorretor = $dados_2[0]['telefone']; 
}else{
	$telefoneCorretor = $tel_sistema; 
}           


$res_2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
$dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);            
$nomeBairro = $dados_2[0]['nome'];


$res_3 = $pdo->query("SELECT * FROM tipos where id = '$tipo'");
$dados_3 = $res_3->fetchAll(PDO::FETCH_ASSOC);            
$nomeTipo = $dados_3[0]['nome'];

if ($status == "Para Venda") {
	$classe = "c-red";
} else {
	$classe = "";
}

?>



<!-- Property Details Section Begin -->
<section class="property-details-section mt-4">


	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="pd-text">
					<div class="row">
						<div class="col-lg-12">
							<div class="pd-title">

								<div class="label <?php echo $classe ?>"><?php echo $status ?></div>
								<div class="pt-price">R$ <?php echo $valorF ?>
								<?php if ($status == "Para Aluguel") {
									echo"<span>/mes</span>";
								} ?>

							</div>
							<h3><small><b><?php echo $titulo ?></b></small></h3>
							<p><span class="icon_pin_alt"></span> <?php echo $nomeBairro ?></p>
						</div>
					</div>

				</div>
				<div class="pd-board">
					<div class="tab-board">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Detalhes</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Descrição</a>
							</li>

							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Imagens</a>
							</li>

							<?php if($video != "" || $video != null){ ?>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Vídeo</a>
							</li>
							<?php } ?>

						</ul><!-- Tab panes -->
						<div class="tab-content">
							<div class="tab-pane active" id="tabs-1" role="tabpanel">
								<div class="tab-details">
									<ul class="left-table">
										<li>
											<span class="type-name">Tipo Imóvel</span>
											<span class="type-value"><?php echo $nomeTipo ?></span>
										</li>
										<li>
											<span class="type-name">Código Imóvel</span>
											<span class="type-value"><?php echo $id ?></span>
										</li>
										<li>
											<span class="type-name">Valor</span>
											<span class="type-value">R$ <?php echo number_format($valor, 2, ',', '.'); ?>

											<?php if ($status=="Para Aluguel") {
												echo "<span>/mes</span>";
											} ?></span>
										</li>
										<li>
											<span class="type-name">Ano Construção</span>
											<span class="type-value"><?php echo $ano ?> - Imóvel <?php echo $condicao ?></span>
										</li>
										<li>
											<span class="type-name">IPTU / Mês</span>
											<span class="type-value">R$ <?php echo $iptu ?> </span>
										</li>
										<li>
											<span class="type-name">Condomínio</span>
											<span class="type-value">R$ <?php echo $condominio ?></span>
										</li>
										<li>
											<span class="type-name">Corretor</span>
											<span class="type-value"><?php echo $nomeCorretor ?></span>
										</li>
									</ul>
									<ul class="right-table">
										<li>
											<span class="type-name">Área Total</span>
											<span class="type-value"><?php echo $area ?> m²</span>
										</li>
										<li>
											<span class="type-name">Área Construída</span>
											<span class="type-value"><?php echo $area_construida ?> m²</span>
										</li>
										<li>
											<span class="type-name">Quartos</span>
											<span class="type-value"><?php echo $quartos ?></span>
										</li>
										<li>
											<span class="type-name">Banheiros</span>
											<span class="type-value"><?php echo $banheiros ?></span>
										</li>
										<li>
											<span class="type-name">Suítes</span>
											<span class="type-value"><?php echo $suites ?></span>
										</li>
										<li>
											<span class="type-name">Garagens</span>
											<span class="type-value"><?php echo $garagens ?></span>
										</li>
										<li>
											<span class="type-name">Piscina</span>
											<span class="type-value"><?php echo $piscinas ?></span>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-pane" id="tabs-2" role="tabpanel">
								<div class="tab-desc">
									<p><?php echo $descricao ?></p>
								</div>
							</div>
							<div class="tab-pane" id="tabs-3" role="tabpanel">
								<div class="tab-desc">

									<div class="container">
										<div class="portfolio-item row">

											<?php 

											$res = $pdo->query("SELECT * FROM imagens_imoveis where id_imovel = '$id_imovel_get' ");
											$dados = $res->fetchAll(PDO::FETCH_ASSOC);
											for ($i=0; $i < count($dados); $i++) { 
												foreach ($dados[$i] as $key => $value) {
												}

												$img_imovel = $dados[$i]['foto']; 

												?>
												<div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
													<a href="sistema/painel/images/detalhes-imoveis/<?php echo $img_imovel ?>" class="fancylight popup-btn" data-fancybox-group="light"> 
														<img class="img-fluid" src="sistema/painel/images/detalhes-imoveis/<?php echo $img_imovel ?>" alt="">
													</a>
												</div>

											<?php } ?>

										</div>

									</div>


								</div>
							</div>


							<div class="tab-pane" id="tabs-4" role="tabpanel">
								<div class="tab-desc">
									<iframe width="100%" height="450" src="<?php echo $video ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
							</div>

						</div>
					</div>
				</div>

				<?php if ($imagemPlanta != "sem-foto.png") {?>

					<div class="pd-widget">
						<h4>Planta do Imóvel</h4>
						<img src="sistema/painel/images/imoveis/<?php echo $imagemPlanta ?>" alt="">
					</div>

				<?php }?>




				<div class="pd-widget">
					<h4>Deseja Visitar?</h4>
					<form method="post" class="review-form">
						<div class="group-input">
							<input type="text" name="nome" placeholder="Nome">
							<input id="telefone" name="telefone" type="text" placeholder="Telefone">
							<input type="email" name="email" placeholder="Email">

							<input type="hidden" value="<?php echo $emailCorretor ?>" name="emailCorretor">

						</div>
						<textarea name="comentario" placeholder="Comentário"></textarea>
						<div class="rating">
							<span>Avaliações:</span>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<button id="btn-enviar" type="submit" class="site-btn">Enviar</button>
					</form>
					<small><div id="mensagem-email" align="center">                 
					</div></small>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="property-sidebar">
				<div class="single-sidebar">
					<div class="section-title sidebar-title">
						<h5>Corretor</h5>
					</div>
					<div class="top-agent">
						<div class="ta-item">
							<div class="ta-pic set-bg" data-setbg="sistema/painel/images/perfil/<?php echo $imgCorretor ?>"></div>
							<div class="ta-text">
								<h6><?php echo $nomeCorretor ?></h6>
								<span>Especialista em Imóveis</span>
								<div class="ta-num"><a class="cor-verde-template-link" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefoneCorretor ?>"><i class="fa fa-whatsapp mr-1"></i><?php echo $telefoneCorretor ?></a></div>
							</div>
						</div>


					</div>
				</div>
				<div class="single-sidebar slider-op">
					<div class="section-title sidebar-title">
						<h5>Imóveis Relacionados</h5>
					</div>
					<div class="sf-slider owl-carousel">

						<?php 
						$res = $pdo->query("SELECT * FROM imoveis where tipo = '" . $tipo . "' and status = '" . $status . "' order by id desc LIMIT 4 ");
						$dados = $res->fetchAll(PDO::FETCH_ASSOC);
						for ($i=0; $i < count($dados); $i++) { 
							foreach ($dados[$i] as $key => $value) {
							}


							$imagem2 = $dados[$i]['img_principal'];
							$valor2 = $dados[$i]['valor'];
							$titulo2 = $dados[$i]['titulo'];
							$id = $dados[$i]['id'];

							?>


							<a href="imovel-<?php echo $url ?>">
								<div class="sf-item set-bg" data-setbg="sistema/painel/images/imoveis/<?php echo $imagem2 ?>">
									<div class="sf-text">
										<h5><small><b><?php echo $titulo2 ?></b></small></h5>
										<span>R$ <?php echo number_format($valor2, 2, ',', '.'); ?></span>
									</div>
								</div>
							</a>

						<?php  }

						?>


					</div>
				</div>

				<div class="single-sidebar slider-op">
					<div class="section-title sidebar-title">
						<h5>Tipos de Imóveis</h5>
					</div>
					<div class="sf-slider owl-carousel">


						<?php 
						$res = $pdo->query("SELECT * FROM tipos order by id asc");
						$dados = $res->fetchAll(PDO::FETCH_ASSOC);
						for ($i=0; $i < count($dados); $i++) { 
							foreach ($dados[$i] as $key => $value) {
							}


							$titulo2 = $dados[$i]['nome'];
							$id2 = $dados[$i]['id'];               
							$imagem2 = $dados[$i]['foto'];

							$res2 = $pdo->query("SELECT * FROM imoveis where tipo = '$id2' and (status = 'Para Venda' or status = 'Para Aluguél')");
							$dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
							$quant = @count($dados2);



							?>



							<a href="lista-imoveis.php?tipo-imovel=<?php echo $id2 ?>">
							<div class="sf-item set-bg" data-setbg="sistema/painel/images/tipos/<?php echo $imagem2 ?>">
								<div class="sf-text">
									<h5><?php echo $titulo2 ?></h5>
									<span><?php echo $quant ?> Imóveis</span>
								</div>
							</div>
							</a>
							<?php  
						}
						?>


					</div>
				</div>


			</div>
		</div>
	</div>
</div>
</section>
<!-- Property Details Section End -->



<?php 
include_once("rodape.php");
?> 





<!--AJAX PARA INSERÇÃO DOS DADOS -->
<script type="text/javascript">
	$(document).ready(function () {

		$('#btn-enviar').click(function (event) {
			$('#mensagem-email').addClass('text-info')
			$('#mensagem-email').text("Enviando!!")
			event.preventDefault();

			$.ajax({
				url: "enviar-email.php",
				method: "post",
				data: $('form').serialize(),
				dataType: "text",
				success: function (mensagem) {

					$('#mensagem-email').removeClass()

					if (mensagem.trim() === "Enviado com Sucesso!") {
						$('#mensagem-email').addClass('text-success')
						$('#mensagem-email').text(mensagem)
					} else {

						$('#mensagem-email').addClass('text-danger')
						$('#mensagem-email').text("Você precisa está com o site hospedado para fazer envio de Emails")

					}



				},

			})
		})
	})
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="js/mascara.js"></script>


<script type="text/javascript">
	$('.portfolio-menu ul li').click(function(){
		$('.portfolio-menu ul li').removeClass('active');
		$(this).addClass('active');

		var selector = $(this).attr('data-filter');
		$('.portfolio-item').isotope({
			filter:selector
		});
		return  false;
	});
	$(document).ready(function() {
		var popup_btn = $('.popup-btn');
		popup_btn.magnificPopup({
			type : 'image',
			gallery : {
				enabled : true
			}
		});
	});
</script>

<style type="text/css">
	

	.portfolio-menu{
		text-align:center;
	}
	.portfolio-menu ul li{
		display:inline-block;
		margin:0;
		list-style:none;
		padding:10px 15px;
		cursor:pointer;
		-webkit-transition:all 05s ease;
		-moz-transition:all 05s ease;
		-ms-transition:all 05s ease;
		-o-transition:all 05s ease;
		transition:all .5s ease;
	}

	.portfolio-item{
		/*width:100%;*/
	}
	.portfolio-item .item{
		/*width:303px;*/
		float:left;
		margin-bottom:10px;
	}
</style>