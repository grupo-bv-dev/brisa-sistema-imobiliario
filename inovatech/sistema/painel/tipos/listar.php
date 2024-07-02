<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM tipos ORDER BY id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>
	<th class="esc">Foto</th> 	
	<th class="esc">Foto Ficha</th> 	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];		
		$foto = $res[$i]['foto'];
		$ativo = $res[$i]['ativo'];
		$foto_ficha = $res[$i]['foto_ficha'];

		if($ativo == 'Sim'){
			$icone = 'fa-check-square';
			$titulo_link = 'Desativar Item';
			$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'fa-square-o';
			$titulo_link = 'Ativar Item';
			$acao = 'Sim';
			$classe_linha = 'text-muted';
		}

		if($foto_ficha == null or $foto_ficha == "" or $foto_ficha == "sem-foto.png"){
			$ocultar = 'ocultar';
			$foto_ficha = 'sem-foto.png';
		}else{
			$ocultar = '';

		}



		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td>
		
		{$nome}
		</td> 
		<td class="esc"><img src="images/tipos/{$foto}" width="35px" height="35px" class="mr-2"></td>

		<td class="esc"><a href="images/tipos/{$foto_ficha}" target="_blank"><img src="images/tipos/{$foto_ficha}" width="35px" height="35px" class="mr-2"></a></td>
		
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$foto}', '{$foto_ficha}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>


		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


		<big><a href="#" onclick="ativar('{$id}', '{$nome}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>


		<a class="{$ocultar}" href="rel/ficha_capitacao_class.php?id={$id}" target="_blank" title="Ficha de Capitação"><i class="fa fa-file-pdf-o text-danger"></i></a>


		</td>  
		</tr> 
		HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	</small>
	HTML;
}else{
	echo 'Não possui nenhum registro cadastrado!';
}

?>




<script type="text/javascript">


	$(document).ready( function () {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true,
		});
		$('#tabela_filter label input').focus();
	} );



	function editar(id, nome, foto, foto_ficha){

		
		$('#id').val(id);
		$('#nome').val(nome);
		
		$('#foto').val('');
		$('#target').attr('src','images/tipos/' + foto);
		$('#target-ficha').attr('src','images/tipos/' + foto_ficha);			

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}




	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');		
		$('#target').attr('src','images/tipos/sem-foto.png');
		$('#target-ficha').attr('src','images/tipos/sem-foto.png');
		$('#foto').val('');
		$('#foto-ficha').val('');
	}


	

</script>



