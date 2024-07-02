<?php 
require_once("../../conexao.php");
$pagina = 'tarefas';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = '%'.@$_POST['status'].'%';
$alterou_data = @$_POST['alterou_data'];
$vencidas = @$_POST['vencidas'];
$hoje = @$_POST['hoje'];
$amanha = @$_POST['amanha'];


$data_hoje = date('Y-m-d');
$data_amanha = date('Y/m/d', strtotime("+1 days",strtotime($data_hoje)));
$data_ontem = date('Y/m/d', strtotime("-1 days",strtotime($data_hoje)));

if($alterou_data == 'Sim'){
	if($dataInicial != "" || $dataFinal != ""){
		$query = $pdo->query("SELECT * from $pagina where (data >= '$dataInicial' and data <= '$dataFinal') and status LIKE '$status' order by  data, hora asc");
	}
}else if($status != '%%' and $alterou_data == ''){
	$query = $pdo->query("SELECT * from $pagina where status LIKE '$status' order by data, hora asc ");
}

else if($vencidas == 'Ontem'){
	$query = $pdo->query("SELECT * from $pagina where data = '$data_ontem' order by data, hora asc ");
}

else if($vencidas == 'Hoje'){
	$query = $pdo->query("SELECT * from $pagina where data = curDate()  order by data, hora asc ");
}

else if($vencidas == 'Amanha'){
	$query = $pdo->query("SELECT * from $pagina where data = '$data_amanha'  order by data, hora asc ");
}

else{
	$query = $pdo->query("SELECT * from $pagina where data = curDate() order by data, hora asc ");
}


echo <<<HTML
<small>
HTML;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>Título</th>
				<th class="esc">Descrição</th>
				<th class="esc">Data</th> 
				<th class="esc">Hora</th> 
				<th class="esc">Usuário</th>
							
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$descricao = $res[$i]['descricao'];
$titulo = $res[$i]['titulo'];
$hora = $res[$i]['hora'];
$data = $res[$i]['data'];
$usuario = $res[$i]['usuario'];
$status = $res[$i]['status'];


$dataF = implode('/', array_reverse(explode('-', $data)));
$horaF = date("H:i", strtotime($hora));

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usuario = $res2[0]['nome'];
}else{
	$nome_usuario = 'Sem Registro';
}



if($status == 'Concluída'){
	$classe_pago = 'verde';	
}else{
	$classe_pago = 'text-danger';
}

echo <<<HTML
			<tr> 
				<td><i class="fa fa-square {$classe_pago} mr-1"></i> {$titulo}</td> 
					<td class="esc">{$descricao}</td>	
				<td class="esc">{$dataF}</td>
				<td class="esc">{$horaF}</td>
				<td class="esc">{$nome_usuario}</td>
				
			
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
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
	    $('#total_itens').text('R$ <?=$total_valorF?>');
	} );



	function editar(id, descricao, pessoa, valor, data_venc, frequencia, saida, arquivo, locatario, obs, corretor){

		if(pessoa == 0){
			pessoa = "";
		}

		if(locatario == 0){
			locatario = "";
		}

		if(corretor == 0){
			corretor = "";
		}
		
		$('#id').val(id);
		$('#descricao').val(descricao);
		$('#pessoa').val(pessoa).change();
		$('#valor').val(valor);
		$('#data_venc').val(data_venc);
		$('#frequencia').val(frequencia).change();
		$('#saida').val(saida).change();
		$('#locatario').val(locatario).change();
		$('#corretor').val(corretor).change();
		$('#obs').val(obs);		

		$('#arquivo').val('');
		

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');


		resultado = arquivo.split(".", 2);

    	 if(resultado[1] === 'pdf'){
            $('#target').attr('src', "images/pdf.png");
            return;
        } else if(resultado[1] === 'rar' || resultado[1] === 'zip'){
            $('#target').attr('src', "images/rar.png");
            return;
        }else if(resultado[1] === 'doc' || resultado[1] === 'docx'){
            $('#target').attr('src', "images/word.png");
            return;
        }else{
        	$('#target').attr('src','images/contas/' + arquivo);			
        }		
	}



	function mostrar(id, descricao, pessoa, valor, data_lanc, data_venc, data_pgto, usuario_lanc, usuario_pgto, frequencia, saida, arquivo, pago, locatario, obs, corretor){

		
		if(data_pgto == "00/00/0000"){
			data_pgto = 'Não Pago Ainda';
		}

		if(pessoa != "Sem Registro" && locatario == "Sem Registro" && corretor == "Sem Registro"){
			$('#pessoa_mostrar').text(pessoa);
			$('#tipo_pessoa_mostrar').text('Comprador');
		}else if(locatario != "Sem Registro" && pessoa == "Sem Registro" && corretor == "Sem Registro"){
			$('#pessoa_mostrar').text(locatario);
			$('#tipo_pessoa_mostrar').text('Locatário');
		}else if(locatario == "Sem Registro" && pessoa == "Sem Registro" && corretor != "Sem Registro"){
			$('#pessoa_mostrar').text(corretor);
			$('#tipo_pessoa_mostrar').text('Corretor');
		}
		else{
			$('#pessoa_mostrar').text('Sem Registro');
			$('#tipo_pessoa_mostrar').text('Pessoa');
		}


		$('#nome_mostrar').text(descricao);
		
		$('#valor_mostrar').text(valor);
		$('#lanc_mostrar').text(data_lanc);
		$('#venc_mostrar').text(data_venc);
		$('#pgto_mostrar').text(data_pgto);		
		$('#usu_lanc_mostrar').text(usuario_lanc);	
		$('#usu_pgto_mostrar').text(usuario_pgto);	
		$('#freq_mostrar').text(frequencia);
		$('#saida_mostrar').text(saida);
		$('#pago_mostrar').text(pago);
		$('#obs_mostrar').text(obs);
		
		$('#link_arquivo').attr('href','images/contas/' + arquivo);
		

		$('#modalMostrar').modal('show');

		resultado = arquivo.split(".", 2);

    	 if(resultado[1] === 'pdf'){
            $('#target_mostrar').attr('src', "images/pdf.png");
            return;
        } else if(resultado[1] === 'rar' || resultado[1] === 'zip'){
            $('#target_mostrar').attr('src', "images/rar.png");
            return;
        }else if(resultado[1] === 'doc' || resultado[1] === 'docx'){
            $('#target_mostrar').attr('src', "images/word.png");
            return;
        }else{
        	$('#target_mostrar').attr('src','images/contas/' + arquivo);			
        }		
	}

	function limparCampos(){
		$('#id').val('');
		$('#descricao').val('');		
		$('#valor').val('');		
		$('#data_venc').val('<?=$data_atual?>');			
		$('#arquivo').val('');
		$('#target').attr('src','images/contas/sem-foto.png');
		$('#obs').val('');
		$('#corretor').val('').change();
		$('#locatario').val('').change();
		$('#pessoa').val('').change();
	}


	function parcelar(id, valor, nome){
    $('#id-parcelar').val(id);
    $('#valor-parcelar').val(valor);
    $('#qtd-parcelar').val('');
    $('#nome-parcelar').text(nome);
    $('#nome-input-parcelar').val(nome);
    $('#modalParcelar').modal('show');
    $('#mensagem-parcelar').text('');
}


function baixar(id, valor, descricao, saida){
	$('#id-baixar').val(id);
	$('#descricao-baixar').text(descricao);
	$('#valor-baixar').val(valor);
	$('#saida-baixar').val(saida).change();
	$('#subtotal').val(valor);

	$('#juros-baixar').val('');
	$('#desconto-baixar').val('');
	$('#multa-baixar').val('');

	$('#modalBaixar').modal('show');
	$('#mensagem-baixar').text('');
}



function mostrarResiduos(id){

	$.ajax({
		url: pag + "/listar-residuos.php",
		method: 'POST',
		data: {id},
		dataType: "html",

		success:function(result){
			$("#listar-residuos").html(result);
		}
	});
	$('#modalResiduos').modal('show');
	
	
}


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


</script>



