<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'imoveis';


?>

<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Imóvel</button>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<small>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados Cadastrais</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Título e Descrição</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Fotos e Vídeo</a>
							</li>
						</ul>
					</small>
				</h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -40px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-text">
				<div class="modal-body" style="margin-top: -20px">

					

					<div class="tab-content" id="myTabContent">

						<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

							<div class="row">
								<div class="col-md-5">						
									<div class="form-group"> 
										<label>Dono / Locador*</label> 
										<select class="form-control sel2" name="dono" id="dono" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM vendedores order by id desc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?> - <?php echo $res[$i]['doc'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>

								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Corretor*</label> 
										<select class="form-control sel2" name="corretor" id="corretor" required style="width:100%;"> 
											<?php 
											if($nivel_usu == 'Corretor'){
												$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' order by id asc");
											}else{
												$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Corretor' or nivel = 'Administrador' order by id asc");
											}

											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>					
								</div>


								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Tipo*</label> 
										<select class="form-control sel2" name="tipo" id="tipo" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM tipos order by id desc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>





							</div>


							<div class="row">

								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Cidade*</label> 
										<select class="form-control sel2" name="cidade" id="cidade" required style="width:100%;"> 
											<?php 
											$query = $pdo->query("SELECT * FROM cidades order by nome asc");
											$res = $query->fetchAll(PDO::FETCH_ASSOC);
											for($i=0; $i < @count($res); $i++){
												foreach ($res[$i] as $key => $value){}

													?>	
												<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

											<?php } ?>

										</select>
									</div>						
								</div>




								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Bairro*</label> 
										<div id="listar-bairros"></div>
									</div>						
								</div>




							<div class="col-md-3">						
									<div class="form-group"> 
										<label>Status*</label> 
										<select class="form-control sel2" name="status" id="status" required style="width:100%;"> 
											<option value="Para Venda">Para Venda</option>
											<option value="Para Aluguél">Para Aluguél</option>
											<option value="Vendido">Vendido</option>
											<option value="Alugado">Alugado</option>
											<option value="Inativo">Inativo</option>

										</select>
									</div>						
								</div>

								<div class="col-md-3">						
									<div class="form-group"> 
										<label>Condição*</label> 
										<select class="form-control sel2" name="condicao" id="condicao" required style="width:100%;"> 
											<option value="Usado">Usado</option>
											<option value="Novo">Novo</option>
											<option value="Planta">Planta</option>

										</select>
									</div>						
								</div>	






							</div>


							<div class="row">

								<div class="col-md-2">
									<div class="form-group"> 
										<label>Área Total</label> 
										<input type="number" class="form-control" name="area_total" id="area_total" placeholder="Ex: 200" > 
									</div>
								</div>	

								
								<div class="col-md-2">
									<div class="form-group"> 
										<label>Área Construída</label> 
										<input type="number" class="form-control" name="area_construida" id="area_construida" placeholder="Ex: 120" > 
									</div>
								</div>



								<div class="col-md-2">
									<div class="form-group"> 
										<label>Quartos</label> 
										<input type="number" class="form-control" name="quartos" id="quartos" placeholder="" > 
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group"> 
										<label>Banheiros</label> 
										<input type="number" class="form-control" name="banheiros" id="banheiros" placeholder="" > 
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group"> 
										<label>Suítes</label> 
										<input type="number" class="form-control" name="suites" id="suites" placeholder="" > 
									</div>
								</div>


								<div class="col-md-2">
									<div class="form-group"> 
										<label>Garagens</label> 
										<input type="number" class="form-control" name="garagens" id="garagens" placeholder="" > 
									</div>
								</div>


							</div>	



							<div class="row">

								<div class="col-md-2">
									<div class="form-group"> 
										<label>Piscinas</label> 
										<input type="number" class="form-control" name="piscinas" id="piscinas" placeholder="" > 
									</div>
								</div>	


								<div class="col-md-2">
									<div class="form-group"> 
										<label>Ano do Imóvel*</label> 
										<input type="number" class="form-control" name="ano" id="ano" placeholder="Ex: 1990" required> 
									</div>
								</div>	


								<div class="col-md-4">
									<div class="form-group"> 
										<label>Valor</label> 
										<input type="text" class="form-control" name="valor" id="valor" placeholder="Valor de Locação ou Venda" > 
									</div>
								</div>	

								


								<div class="col-md-2">
									<div class="form-group"> 
										<label>R$ IPTU Mês</label> 
										<input type="text" class="form-control" name="iptu" id="iptu" placeholder="Valor Mensal do IPTU" > 
									</div>
								</div>	


								<div class="col-md-2">
									<div class="form-group"> 
										<label>R$ Condomínio</label> 
										<input type="text" class="form-control" name="condominio" id="condominio" placeholder="Valor do Condomínio" > 
									</div>
								</div>							
								


							</div>	




							<div class="row">

								<div class="col-md-6">
									<div class="form-group"> 
										<label>Endereço</label> 
										<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua X Número 50 Bairro Centro BH ..." > 
									</div>
								</div>	

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Comissão Imobiliária</label> 
										<input maxlength="5" type="text" class="form-control" name="comissao_imob" id="comissao_imob" placeholder="Ex: 5 ou 5.5" > 
									</div>
								</div>	

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Comissão Corretor</label> 
										<input maxlength="5" type="text" class="form-control" name="comissao_corretor" id="comissao_corretor" placeholder="Ex: 5 ou 5.5" > 
									</div>
								</div>	

							</div>



							<div class="row">

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Validade Anúncio</label> 
										<select class="form-control sel2" name="validade" id="validade" required style="width:100%;"> 
											<option value="Sim">Sim</option>
											<option value="Não">Não</option>

										</select>
									</div>
								</div>	

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Data Início Anúncio</label> 
										<input type="date" class="form-control" name="data_inicio" id="data_inicio" value="<?php echo date('Y-m-d') ?>" > 
									</div>
								</div>	

								<div class="col-md-3">
									<div class="form-group"> 
										<label>Data Final Anúncio</label> 
										<input type="date" class="form-control" name="data_final" id="data_final"  value="<?php echo date('Y-m-d') ?>"> 
									</div>
								</div>	

							</div>






							<hr>
							<div align="right">
								<button type="button" id="seguinte_aba2" name="seguinte_aba2" class="btn btn-primary">Seguinte</button>
							</div>

						</div>


						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

							<div class="form-group"> 
								<label>Título*</label> 
								<input type="text" maxlength="100" class="form-control" name="titulo" id="titulo" placeholder="Casa 3 quartos etc.." required> 
							</div>


							<div class="form-group"> 
								<label>Descrição</label> 
								<textarea name="descricao" id="area" class="textareag"> </textarea>
							</div>

							<div class="row">
								<div class="col-md-6">
									<button type="button" id="voltar_aba1" name="voltar_aba1" class="btn btn-danger">Voltar</button>
								</div>

								<div class="col-md-6" align="right">
									<button type="button" id="seguinte_aba3" name="seguinte_aba3" class="btn btn-primary">Seguinte</button>
								</div>
							</div>

						</div>


						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">



							<div class="row">
								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Imagem Principal</label> 
										<input type="file" name="principal" onChange="carregarImgPrincipal();" id="foto-principal">
									</div>						
								</div>
								<div class="col-md-2">
									<div id="divImgPrincipal">
										<img src="images/sem-foto.png"  width="100px" id="target-principal">									
									</div>
								</div>



								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Imagem Planta</label> 
										<input type="file" name="planta" onChange="carregarImgPlanta();" id="foto-planta">
									</div>						
								</div>
								<div class="col-md-2">
									<div id="divImgPlanta">
										<img src="images/sem-foto.png"  width="100px" id="target-planta">									
									</div>
								</div>





							</div>


							<div class="row">

								<div class="col-md-4">						
									<div class="form-group"> 
										<label>Imagem Banner</label> 
										<input type="file" name="banner" onChange="carregarImgBanner();" id="foto-banner">
									</div>						
								</div>
								<div class="col-md-2">
									<div id="divImgBanner">
										<img src="images/sem-foto.png"  width="100px" id="target-banner">									
									</div>
								</div>


								<div class="col-md-4">
									<div class="form-group"> 
										<label>Vídeo <small>(Url do Youtube)</small></label> 
										<input onkeyup="carregarVideo();" type="text" maxlength="100" class="form-control" name="video" id="video" placeholder="URL Incorporada do Youtube"> 
									</div>
								</div>

								<div class="col-md-2">
									<div id="divVideo">
										 <iframe width="100%" height="100" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="target-video"></iframe>						
									</div>
								</div>

							</div>



							<div class="row">
								<div class="col-md-6">
									<button type="button" id="voltar_aba2" name="voltar_aba2" class="btn btn-danger">Voltar</button>
								</div>

								<div class="col-md-6" align="right">
									<button type="submit" id="salvar" name="salvar" class="btn btn-primary">Salvar</button>
								</div>
							</div>

						</div>

					</div>



					

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>


				</div>


				



			</form>

		</div>
	</div>
</div>





<!-- ModalMostrar -->
<div class="modal fade" id="modalMostrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"><span id="titulo_mostrar"> </span></h4>
				<button id="btn-fechar-excluir" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">


			<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Id do Imóvel: </b></span>
						<span id="id_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Dono: </b></span>
						<span id="dono_mostrar"></span>
					</div>

					<div class="col-md-5">							
						<span><b>Telefone Dono: </b></span>
						<span id="tel_mostrar"></span>							
					</div>
					
				</div>	


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">							
						<span><b>Email do Dono: </b></span>
						<span id="email_mostrar"></span>
					</div>
					<div class="col-md-6">							
						<span><b>Documento Dono: </b></span>
						<span id="doc_mostrar"></span>					
					</div>

					
					
				</div>			




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					
					<div class="col-md-4">							
						<span><b>Corretor: </b></span>
						<span id="corretor_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Tipo: </b></span>
						<span id="tipo_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Valor: </b></span>
						<span id="valor_mostrar"></span>
					</div>
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Cidade: </b></span>
						<span id="cidade_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Bairro: </b></span>
						<span id="bairro_mostrar"></span>
					</div>

					<div class="col-md-6">							
						<span><b>Endereço: </b></span>
						<span id="endereco_mostrar"></span>							
					</div>
				
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Ano Imóvel: </b></span>
						<span id="ano_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Total Visitas: </b></span>
						<span id="visitas_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>Área Total: </b></span>
						<span id="area_total_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Área Construída: </b></span>
						<span id="area_construida_mostrar"></span>
					</div>
				</div>



					<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-2">							
						<span><b>Quartos: </b></span>
						<span id="quartos_mostrar"></span>							
					</div>
					<div class="col-md-2">							
						<span><b>Suítes: </b></span>
						<span id="suites_mostrar"></span>
					</div>

					<div class="col-md-2">							
						<span><b>Garagens: </b></span>
						<span id="garagens_mostrar"></span>							
					</div>
					<div class="col-md-2">							
						<span><b>Piscinas: </b></span>
						<span id="piscinas_mostrar"></span>
					</div>

					<div class="col-md-2">							
						<span><b>Banheiros: </b></span>
						<span id="banheiros_mostrar"></span>
					</div>
				</div>




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-3">							
						<span><b>Status: </b></span>
						<span id="status_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Condição: </b></span>
						<span id="condicao_mostrar"></span>
					</div>

					<div class="col-md-3">							
						<span><b>IPTU Mês: </b></span>
						<span id="iptu_mostrar"></span>							
					</div>
					<div class="col-md-3">							
						<span><b>Condomínio: </b></span>
						<span id="condominio_mostrar"></span>
					</div>
				</div>



				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-4">							
						<span><b>Comissão Imobiliária %: </b></span>
						<span id="comissao_imob_mostrar"></span>							
					</div>
					<div class="col-md-4">							
						<span><b>Comissão Corretor %: </b></span>
						<span id="comissao_corretor_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Castradado Em: </b></span>
						<span id="data_cad_mostrar"></span>							
					</div>
					
				</div>


				<div class="row" style="border-bottom: 1px solid #cac7c7;">
				<div class="col-md-4">							
						<span><b>Validade do Anúncio: </b></span>
						<span id="validade_mostrar"></span>
					</div>

					<div class="col-md-4">							
						<span><b>Data Inicial Anúncio: </b></span>
						<span id="data_inicio_mostrar"></span>
					</div>
					
					<div class="col-md-4">							
						<span><b>Data Final Anúncio: </b></span>
						<span id="data_final_mostrar"></span>
					</div>
				</div>




				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-12">							
						<span><b>Descrição: </b></span>
						<div id="descricao_mostrar"></div>							
					</div>
				</div>





				


				<div class="row">
					<div class="col-md-6" align="center">		
						<img  width="300px" id="target_principal_mostrar">	
					</div>

					<div class="col-md-6" align="center">		
						<img  width="300px" id="target_planta_mostrar">	
					</div>
				</div>


				<div class="row">
					<div class="col-md-12" align="center">		
							 <iframe width="100%" height="500" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen id="target_video_mostrar"></iframe>	
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







<div class="modal" id="modalImagens" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Demais Imagens do Imóvel - <span id="nome-imagens"> </span></h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close" style="margin-top: -15px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-fotos" method="POST" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12 form-group">
                                <label>Imagens do Imóvel</label>
                                <input type="file" class="form-control-file" id="imgimovel" name="imgimovel" onchange="carregarImgImovel();">

                            </div>

                            <div class="col-md-12 mb-2">
                                <img src="images/detalhes-imoveis/sem-foto.png" alt="Carregue sua Imagem" id="targetImovel" width="100%">
                            </div>

                        </div>

                        <div class="col-md-7" id="listar-imagens">

                        </div>




                    </div>

                    <div class="col-md-12" align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-fotos">Cancelar</button>
                        
                       <input type="hidden" class="form-control" name="id-imagens"  id="id-imagens">

                        <button type="submit" id="btn-fotos" name="btn-fotos" class="btn btn-primary">Salvar</button>

                    </div>

                    <hr>


                    <small>  
                        <div align="center" id="mensagem_fotos" class="">

                        </div>
                    </small>   
                </form>
            </div>

        </div>
    </div>
</div>   



<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	$(document).ready(function() {

		$('#myTab a[href="#home"]').tab('show');

		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});


		listarBairros();

		$('#cidade').change(function(){
				listarBairros();
			});
	});
</script>


<script type="text/javascript">
	$("#seguinte_aba2").click(function () {

		if($("#ano").val() == ""){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Ano!!")
		}
		else if($("#dono").val() == "" || $("#dono").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Cadastre um Dono e insira ele no Campo Dono")
		}
		else if($("#tipo").val() == "" || $("#tipo").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Tipo!!")
		}
		else if($("#cidade").val() == "" || $("#cidade").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Cidade!!")
		}
		else if($("#bairro").val() == "" || $("#bairro").val() == null){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Bairro!!")
		}

		else{
			$('#myTab a[href="#profile"]').tab('show');
			$('#mensagem').text("")
		}
		
	});



	$("#voltar_aba1").click(function () {
		$('#myTab a[href="#home"]').tab('show');
		$('#mensagem').addClass('')
	});



	$("#seguinte_aba3").click(function () {
		if($("#titulo").val() == ""){
			$('#mensagem').addClass('text-danger')
			$('#mensagem').text("Preencha o Campo Título!!")
		}	
		
		else{
			$('#myTab a[href="#contact"]').tab('show');
			$('#mensagem').text("")
		}

	});


	$("#voltar_aba2").click(function () {
		$('#myTab a[href="#profile"]').tab('show');
		$('#mensagem').addClass('')
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
	function carregarImgPrincipal() {
		var target = document.getElementById('target-principal');
		var file = document.querySelector("#foto-principal").files[0];

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
	function carregarImgPlanta() {
		var target = document.getElementById('target-planta');
		var file = document.querySelector("#foto-planta").files[0];

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
	function carregarImgBanner() {
		var target = document.getElementById('target-banner');
		var file = document.querySelector("#foto-banner").files[0];

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
	function carregarImgImovel() {

        var target = document.getElementById('targetImovel');
        var file = document.querySelector("input[id=imgimovel]").files[0];
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
	function carregarVideo() {		
		$('#target-video').attr('src', $('#video').val());
	}
</script>






<!--AJAX PARA LISTAR OS DADOS DAS IMAGENS DOS IMÓVEIS NA MODAL -->
<script type="text/javascript">
			function listarImagens(){
				var id = $('#id-imagens').val();	
				$.ajax({
					url: pag + "/listar-imagens.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-imagens").html(result);
					}
				});
			}

		</script>





<!--AJAX PARA EXECUTAR A INSERÇÃO DAS DEMAIS FOTOS DO IMÓVEL -->
<script type="text/javascript">


    $("#form-fotos").submit(function () {

        var pag = "<?=$pag?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir-fotos.php",
            type: 'POST',
            data: formData,

            success: function (mensagem) {

                $('#mensagem_fotos').removeClass()

                if (mensagem.trim() == "Inserido com Sucesso") {
                    $('#mensagem_fotos').addClass('text-success');
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    //$('#btn-cancelar-fotos').click();
                    listarImagens();

                } else {

                    $('#mensagem_fotos').addClass('text-danger')

                }

                $('#mensagem_fotos').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });



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
	function listarBairros(){
		var cidade = $('#cidade').val();
    $.ajax({
        url: pag + "/listar-bairros.php",
        method: 'POST',
        data: {cidade},
        dataType: "text",

        success:function(result){
            $("#listar-bairros").html(result);
        },

    });
}
</script>





<script>

$("#form-text").submit(function () {
	event.preventDefault();
    nicEditors.findEditor('area').saveContent();
	var formData = new FormData(this);

	$.ajax({
		url: pag + "/inserir.php",
		type: 'POST',
		data: formData,

		success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {                    
                    $('#btn-fechar').click();
                    listar();
                } else {
                	$('#mensagem').addClass('text-danger')
                    $('#mensagem').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,
            
        });

});

</script>


<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>