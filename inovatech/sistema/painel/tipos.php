<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'tipos';
 ?>

 <button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Tipo</button>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="tituloModal"></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form">
				<div class="modal-body">

							<div class="row">
							<div class="col-md-12">			
							<div class="form-group"> 
								<label>Nome</label> 
								<input type="text" class="form-control" name="nome" id="nome" required> 
							</div>				
							</div>
							</div>	


							<div class="row">
							<div class="col-md-8">					
							<div class="form-group"> 
								<label>Foto</label> 
								<input type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>		
							</div>	

							<div class="col-md-4">	
							<div id="divImg">
								<img src="images/tipos/sem-foto.png"  width="100px" id="target">									
							</div>
							</div>

							
							
						</div>


						<div class="row">
							<div class="col-md-8">					
							<div class="form-group"> 
								<label>Foto da Ficha (Somente *jpg)</label> 
								<input type="file" name="foto-ficha" onChange="carregarImgFicha();" id="foto-ficha">
							</div>		
							</div>	

							<div class="col-md-4">	
							<div id="divImgFicha">
								<img src="images/tipos/sem-foto.png"  width="100px" id="target-ficha">									
							</div>
							</div>

							
							
						</div>						
					
					

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
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
			dropdownParent: $('#modalForm')
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
	function carregarImgFicha() {
		var target = document.getElementById('target-ficha');
		var file = document.querySelector("#foto-ficha").files[0];

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
