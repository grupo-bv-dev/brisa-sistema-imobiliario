<?php 
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;

$query = $pdo->query("SELECT * FROM vendas ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Valor</th>
	<th class="esc">Corretor</th> 
	<th class="esc">Comprador</th> 
	<th class="esc">Vendedor</th>
	<th class="esc">R$ Corretor</th>
	<th class="esc">R$ Imobiliária</th>	
	<th class="esc">Data PGTO</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$valor = $res[$i]['valor_total'];
		$vendedor = $res[$i]['vendedor'];
		$comprador = $res[$i]['comprador'];
		$comissao_corretor = $res[$i]['comissao_corretor'];
		$comissao_imob = $res[$i]['comissao_imob'];
		$corretor = $res[$i]['corretor'];
		$data = $res[$i]['data'];
		$data_pgto = $res[$i]['data_pgto'];
		$obs = $res[$i]['obs'];
		$pago = $res[$i]['pago'];
		$usuario = $res[$i]['usuario'];
		$imovel = $res[$i]['imovel'];
		
		
//retirar quebra de texto do obs		
		$dataF = implode('/', array_reverse(explode('-', $data)));
		$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));

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

		$query2 = $pdo->query("SELECT * FROM compradores where id = '$comprador'");
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


		if($pago == 'Sim'){
			$classe_pago = 'verde';
			$ocultar = 'ocultar';
			$icone = 'fa-check-square';
			$titulo_link = 'Status Não Pago';
			$acao = 'Não';
		}else{
			$classe_pago = 'text-danger';
			$ocultar = '';
			$icone = 'fa-square-o';
			$titulo_link = 'Venda Finalizada Paga';
			$acao = 'Sim';
		}
		


		echo <<<HTML
		<tr> 
		<td><i class="fa fa-square {$classe_pago} mr-1"></i> R$ {$valorF}	</td> 
		<td class="esc">{$nome_corretor}</td>
		<td class="esc">{$nome_comprador}</td>
		<td class="esc">{$nome_vendedor}</td>		
		<td class="esc">{$comissao_corretorF}</td>
		<td class="esc">{$comissao_imobF}</td>
		<td class="esc">{$data_pgtoF}</td>
		<td>
		
		<big><a href="#" onclick="mostrar('{$valorF}', '{$nome_corretor}', '{$nome_comprador}', '{$nome_vendedor}', '{$comissao_corretorF}', '{$comissao_imobF}', '{$data_pgtoF}', '{$dataF}', '{$pago}', '{$obs}', '{$nome_usuario}', '{$titulo}', '{$img_principal}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<li class="dropdown head-dpdn2 " style="display: inline-block;">
		<a href="#" class="dropdown-toggle {$ocultar}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$valorF}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

		
		<a href="#" onclick="arquivo('{$imovel}', '{$valorF}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a>



		<a href="#" onclick="ativar('{$id}', '{$titulo}', '{$acao}')" title="{$titulo_link}" style="margin-left:2px;"><i class="fa {$icone} text-success"></i></a>


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

	

	function mostrar(valor, corretor, comprador, vendedor, comissao_corretor, comissao_imob, data_pgto, data, pago, obs, usuario, titulo, img_principal){

		$('#nome_mostrar').text(titulo);
		$('#valor_mostrar').text(valor);
		$('#corretor_mostrar').text(corretor);
		$('#comprador_mostrar').text(comprador);
		$('#vendedor_mostrar').text(vendedor);
		$('#comissao_corretor_mostrar').text(comissao_corretor);
		$('#comissao_imob_mostrar').text(comissao_imob);		
		$('#data_pgto_mostrar').text(data_pgto);
		$('#data_cad_mostrar').text(data);				
		$('#obs_mostrar').text(obs);		
		$('#pago_mostrar').text(pago);	
		$('#usuario_mostrar').text(usuario);
		$('#target_mostrar').attr('src','images/imoveis/' + img_principal);			

		$('#modalMostrar').modal('show');		
	}

	

function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}
	

</script>



