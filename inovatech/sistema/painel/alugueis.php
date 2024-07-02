<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'alugueis';

 ?>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="nome_mostrar"> </span> <small> </small></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
				<div class="modal-body">			
					


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Valor: </b></span>
							<span id="valor_mostrar"></span>							
						</div>

						<div class="col-md-6">							
							<span><b>Corretor: </b></span>
							<span id="corretor_mostrar"></span>							
						</div>
						
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Proprietário: </b></span>
							<span id="vendedor_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Inquilino: </b></span>
							<span id="comprador_mostrar"></span>
						</div>
						
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Comissão Corretor: </b></span>
							<span id="comissao_corretor_mostrar"></span>
						</div>
						<div class="col-md-6">							
							<span><b>Comissão Imobiliária </b></span>
							<span id="comissao_imob_mostrar"></span>							
						</div>
					</div>


					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Data de PGTO: </b></span>
							<span id="data_pgto_mostrar"></span>							
						</div>
						<div class="col-md-6">							
							<span><b>Data de Cadastro: </b></span>
							<span id="data_cad_mostrar"></span>
						</div>
					</div>	



					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-6">							
							<span><b>Início Contrato</b></span>
							<span id="data_inicio_mostrar"></span>							
						</div>

						<div class="col-md-6">							
							<span><b>Final Contrato</b></span>
							<span id="data_final_mostrar"></span>							
						</div>
						
					</div>	

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
							<span><b>Lançamento: </b></span>
							<span id="usuario_mostrar"></span>
						</div>	
					</div>

					

					<div class="row" style="border-bottom: 1px solid #cac7c7;">
						<div class="col-md-12">							
							<span><b>OBS: </b></span>
							<span id="obs_mostrar"></span>							
						</div>
					</div>


					<div class="row">
						<div class="col-md-12" align="center">		
							<img  width="200px" id="target_mostrar">	
						</div>
					</div>
					
								

				</div>


		</div>
	</div>
</div>





	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
					<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-arquivos" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
								</div>	
							</div>
							<div class="col-md-4" style="margin-top:-10px">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
								</div>					
							</div>




						</div>

						<div class="row" style="margin-top:-40px">
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome-arq"  id="nome-arq" placeholder="Nome do Arquivo * " required>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Inserir</button>
							</div>
						</div>

						<hr>

						<small><div id="listar-arquivos"></div></small>

						<br>
						<small><div align="center" id="mensagem-arquivo"></div></small>

						<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo">


					</div>
				</form>
			</div>
		</div>
	</div>






	<!-- Modal Parcelas -->
	<div class="modal fade" id="modalParcelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Parcelas da Locação - <span id="nome-parcelas"> </span></h4>
					<button id="btn-fechar-parcelas" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				
					<div class="modal-body">


						<small><div id="listar-parcelas"></div></small>

						<br>
						<small><div align="center" id="mensagem-parcelas"></div></small>

						<input type="hidden" class="form-control" name="id-parcelas"  id="id-parcelas">


					</div>
				
			</div>
		</div>
	</div>








	<!-- Modal -->
	<div class="modal fade" id="modalBaixar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<h4 class="modal-title" id="tituloModal">Baixar Conta: <span id="descricao-baixar"> </span></h4>
				<button id="btn-fechar-baixar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form id="form-baixar" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Valor <small class="text-muted">(Total ou Parcial)</small></label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-baixar"  id="valor-baixar" required>
								</div>
							</div>


							<div class="col-md-6">
								<div class="form-group"> 
								<label>Local Entrada</label> 
								<select class="form-control sel4" name="saida-baixar" id="saida-baixar" required style="width:100%;">
										<option value="Caixa">Caixa (Movimento)</option>
										<option value="Cartão de Débito">Cartão de Débito</option>
									<option value="Cartão de Crédito">Cartão de Crédito</option>

										<?php 
										$query = $pdo->query("SELECT * FROM contas_banco order by nome asc");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){	}
												$id_item = $res[$i]['id'];
											$nome_item = $res[$i]['nome'];
											?>
											<option value="<?php echo $nome_item ?>"><?php echo $nome_item ?></option>

										<?php } ?>


									</select>
								</div>
							</div>

						</div>	


						<div class="row">


							<div class="col-md-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Multa em R$</label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-multa"  id="valor-multa" placeholder="Ex 15.00" value="0" >
								</div>
							</div>

							<div class="col-md-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Júros em R$</label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-juros"  id="valor-juros" placeholder="Ex 0.15" value="0" >
								</div>
							</div>

								<div class="col-md-4">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Desconto em R$</label>
									<input onkeyup="totalizar()" type="text" class="form-control" name="valor-desconto"  id="valor-desconto" placeholder="Ex 15.00" value="0" >
								</div>
							</div>

						</div>


						<div class="row">

						
								<div class="col-md-6">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Data da Baixa</label>
									<input type="date" class="form-control" name="data-baixar"  id="data-baixar" value="<?php echo date('Y-m-d') ?>" >
								</div>
							</div>


							<div class="col-md-6">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">SubTotal</label>
									<input type="text" class="form-control" name="subtotal"  id="subtotal" readonly>
								</div>	
							</div>
						</div>




						<small><div id="mensagem-baixar" align="center"></div></small>

						<input type="hidden" class="form-control" name="id-baixar"  id="id-baixar">


					</div>
					<div class="modal-footer">
						
						<button type="submit" class="btn btn-success">Baixar</button>
					</div>
				</form>
			</div>
		</div>
	</div>








	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivosParcela" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo-parcela"> </span></h4>
					<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-arquivos-parcela" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input type="file" name="arquivo_conta" onChange="carregarImgArquivosParcela();" id="arquivo_conta_parcela">
								</div>	
							</div>
							<div class="col-md-4" style="margin-top:-10px">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos-parcela">									
								</div>					
							</div>




						</div>

						<div class="row" style="margin-top:-40px">
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome-arq"  id="nome-arq-parcela" placeholder="Nome do Arquivo * " required>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Inserir</button>
							</div>
						</div>

						<hr>

						<small><div id="listar-arquivos-parcela"></div></small>

						<br>
						<small><div align="center" id="mensagem-arquivo-parcela"></div></small>

						<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo-parcela">


					</div>
				</form>
			</div>
		</div>
	</div>






<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalBaixar')
		});
	});
</script>





<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];

		var reader = new FileReader();

		reader.onloadend = function () {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>







		<script type="text/javascript">
			function carregarImgArquivos() {
				var target = document.getElementById('target-arquivos');
				var file = document.querySelector("#arquivo_conta").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "images/xml.png");
					return;
				}




				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>




<script type="text/javascript">
			$("#form-arquivos").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: pag + "/arquivos.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-arquivo').text('');
						$('#mensagem-arquivo').removeClass()
						if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq').val('');
						$('#arquivo_conta').val('');
						$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarArquivos();
					} else {
						$('#mensagem-arquivo').addClass('text-danger')
						$('#mensagem-arquivo').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>



		<script type="text/javascript">
			function listarArquivos(){
				var id = $('#id-arquivo').val();	
				$.ajax({
					url: pag + "/listar-arquivos.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-arquivos").html(result);
					}
				});
			}

		</script>



		<script type="text/javascript">
			function listarParcelas(){
				var id = $('#id-parcelas').val();	
				$.ajax({
					url: pag + "/listar-parcelas.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-parcelas").html(result);
					}
				});
			}

		</script>



<script type="text/javascript">
		$("#form-baixar").submit(function () {
			event.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: pag + "/baixar.php",
				type: 'POST',
				data: formData,

				success: function (mensagem) {
					$('#mensagem-baixar').text('');
					$('#mensagem-baixar').removeClass()
					if (mensagem.trim() == "Baixado com Sucesso") {                    
						$('#btn-fechar-baixar').click();
						listarParcelas();
						listar();
					} else {
						$('#mensagem-baixar').addClass('text-danger')
						$('#mensagem-baixar').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

		});
	</script>




<script type="text/javascript">
		
		function totalizar(){
			valor = $('#valor-baixar').val();
			desconto = $('#valor-desconto').val();
			juros = $('#valor-juros').val();
			multa = $('#valor-multa').val();

			valor = valor.replace(",", ".");
			desconto = desconto.replace(",", ".");
			juros = juros.replace(",", ".");
			multa = multa.replace(",", ".");

			if(valor == ""){
				valor = 0;
			}

			if(desconto == ""){
				desconto = 0;
			}

			if(juros == ""){
				juros = 0;
			}

			if(multa == ""){
				multa = 0;
			}

			subtotal = parseFloat(valor) + parseFloat(juros) + parseFloat(multa) - parseFloat(desconto);


			console.log(subtotal)

			$('#subtotal').val(subtotal);

		}
	</script>



		<script type="text/javascript">
			function carregarImgArquivosParcela() {
				var target = document.getElementById('target-arquivos-parcela');
				var file = document.querySelector("#arquivo_conta_parcela").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target-arquivos-parcela').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos-parcela').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos-parcela').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos-parcela').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos-parcela').attr('src', "images/xml.png");
					return;
				}




				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>




<script type="text/javascript">
			$("#form-arquivos-parcela").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: pag + "/arquivos-parcela.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-arquivo-parcela').text('');
						$('#mensagem-arquivo-parcela').removeClass()
						if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq-parcela').val('');
						$('#arquivo_conta_parcela').val('');
						$('#target-arquivos-parcela').attr('src','images/arquivos/sem-foto.png');
						listarArquivosParcela();
					} else {
						$('#mensagem-arquivo-parcela').addClass('text-danger')
						$('#mensagem-arquivo-parcela').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>



		<script type="text/javascript">
			function listarArquivosParcela(){
				var id = $('#id-arquivo-parcela').val();	
				$.ajax({
					url: pag + "/listar-arquivos-parcela.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-arquivos-parcela").html(result);
					}
				});
			}

		</script>