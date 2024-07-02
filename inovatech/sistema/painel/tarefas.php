<?php 
require_once("verificar.php");
require_once("../conexao.php");
$pag = 'tarefas';


if(@$_SESSION['nivel_usuario'] != "Administrador"){
	echo "<script>window.location='../index.php'</script>";
	exit();
}


?>


<div class="row">
	<div class="col-md-12">
		
		
		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span>
		</div>
		<div class="esc" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="data-inicial"  id="data-inicial" value="<?php echo date('Y-m-d') ?>" required>
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:30px">
			<input type="date" class="form-control " name="data-final"  id="data-final" value="<?php echo date('Y-m-d') ?>" required>
		</div>


		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<select class="form-control" aria-label="Default select example" name="status-busca" id="status-busca">
				<option value="">Todas</option>
				<option value="Agendada">Agendada</option>
				<option value="Concluída">Concluída</option>
				
			</select>
		</div>

		<div style="margin-top:5px;"> 
			<small >
				<a title="Tarefas de Ontem" class="text-muted" href="#" onclick="listarContasVencidas('Ontem')"><span>Ontem</span></a> / 
				<a title="Tarefas de Hoje" class="text-muted" href="#" onclick="listarContasVencidas('Hoje')"><span>Hoje</span></a> / 
				<a title="Tarefas Amanhã" class="text-muted" href="#" onclick="listarContasVencidas('Amanha')"><span>Amanhã</span></a>
			</small>
		</div>

		
	</div>

</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>



		<script type="text/javascript">var pag = "<?=$pag?>"</script>
		<script src="js/ajax.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});



				$('#data-inicial').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					var alterou_data = 'Sim';
					listarBusca(dataInicial, dataFinal, status, alterou_data);
				});

				$('#data-final').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					var alterou_data = 'Sim';
					listarBusca(dataInicial, dataFinal, status, alterou_data);
				});

				$('#status-busca').change(function(){
					var dataInicial = $('#data-inicial').val();
					var dataFinal = $('#data-final').val();
					var status = $('#status-busca').val();
					listarBusca(dataInicial, dataFinal, status);
				});


			});
		</script>


	
		
			<script type="text/javascript">

			function listarBusca(dataInicial, dataFinal, status, alterou_data){
				$.ajax({
					url: pag + "/listar.php",
					method: 'POST',
					data: {dataInicial, dataFinal, status, alterou_data},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}



			function listarContasVencidas(vencidas){
				$.ajax({
					url: pag + "/listar.php",
					method: 'POST',
					data: {vencidas},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasHoje(hoje){
				$.ajax({
					url: pag + "/listar.php",
					method: 'POST',
					data: {hoje},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}


			function listarContasAmanha(amanha){
				$.ajax({
					url: pag + "/listar.php",
					method: 'POST',
					data: {amanha},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}

		</script>




		



