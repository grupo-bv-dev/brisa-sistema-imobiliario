<?php 
require_once("../../conexao.php");
$pagina = 'receber';
$data_atual = date('Y-m-d');

@session_start();

$nivel_usuario = $_SESSION['nivel_usuario'];

if($nivel_usuario == "Corretor"){
	$id_usuario = '%'.$_SESSION['id_usuario'].'%';
}else{
	$id_usuario = "%%";
}

$total_valor = 0;
$total_valorF = 0;

//PEGAR O TOTAL DAS CONTAS A RECEBER PENDENTES
$query = $pdo->query("SELECT * from $pagina where pago = 'Não' and usuario_lanc LIKE '$id_usuario' order by id desc ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
		$total_valor += $res[$i]['valor'];
		$total_valorF = number_format($total_valor, 2, ',', '.');
}}

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = '%'.@$_POST['status'].'%';
$alterou_data = @$_POST['alterou_data'];
$vencidas = @$_POST['vencidas'];
$hoje = @$_POST['hoje'];
$amanha = @$_POST['amanha'];

$data_hoje = date('Y-m-d');
$data_amanha = date('Y/m/d', strtotime("+1 days",strtotime($data_hoje)));

if($alterou_data == 'Sim'){
	if($dataInicial != "" || $dataFinal != ""){
		$query = $pdo->query("SELECT * from $pagina where (data_venc >= '$dataInicial' and data_venc <= '$dataFinal') and pago LIKE '$status' and usuario_lanc LIKE '$id_usuario' order by id desc ");
	}
}else if($status != '%%' and $alterou_data == ''){
	$query = $pdo->query("SELECT * from $pagina where pago LIKE '$status' and usuario_lanc LIKE '$id_usuario' order by id desc ");
}

else if($vencidas == 'Vencidas'){
	$query = $pdo->query("SELECT * from $pagina where data_venc < curDate() and pago = 'Não' and usuario_lanc LIKE '$id_usuario' order by id desc ");
}

else if($vencidas == 'Hoje'){
	$query = $pdo->query("SELECT * from $pagina where data_venc = curDate() and pago = 'Não' and usuario_lanc LIKE '$id_usuario' order by id desc ");
}

else if($vencidas == 'Amanha'){
	$query = $pdo->query("SELECT * from $pagina where data_venc = '$data_amanha' and pago = 'Não' and usuario_lanc LIKE '$id_usuario' order by id desc ");
}

else{
	$query = $pdo->query("SELECT * from $pagina where usuario_lanc LIKE '$id_usuario' and data_venc = curDate() order by id desc ");
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
				<th>Descrição</th>
				<th class="esc">Valor</th> 
				<th class="esc">Vencimento</th> 
				<th class="esc">Frequência</th>
				<th class="esc">Saída</th>
				<th>Arquivo</th>				
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$descricao = $res[$i]['descricao'];
$comprador = $res[$i]['comprador'];
$locatario = $res[$i]['locatario'];
$proprietario = $res[$i]['proprietario'];
$valor = $res[$i]['valor'];
$data_lanc = $res[$i]['data_lanc'];
$data_venc = $res[$i]['data_venc'];
$data_pgto = $res[$i]['data_pgto'];
$usuario_lanc = $res[$i]['usuario_lanc'];
$usuario_pgto = $res[$i]['usuario_pgto'];
$frequencia = $res[$i]['frequencia'];
$saida = $res[$i]['saida'];
$arquivo = $res[$i]['arquivo'];
$pago = $res[$i]['pago'];
$obs = $res[$i]['obs'];

//extensão do arquivo
$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
if($ext == 'pdf'){
	$tumb_arquivo = 'pdf.png';
}else if($ext == 'rar' || $ext == 'zip'){
	$tumb_arquivo = 'rar.png';
}else if($ext == 'doc' || $ext == 'docx'){
	$tumb_arquivo = 'word.png';
}else{
	$tumb_arquivo = $arquivo;
}

$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
$valorF = number_format($valor, 2, ',', '.');


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_pgto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_pgto = $res2[0]['nome'];
}else{
	$nome_usu_pgto = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM frequencias where dias = '$frequencia'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_frequencia = $res2[0]['frequencia'];
}else{
	$nome_frequencia = 'Indefinida';
}


$nome_pessoa = 'Sem Registro';
$tel_pessoa = 'Sem Registro';
$email_pessoa = 'Sem Registro';
$tipo_pessoa = 'Pessoa';
$classe_whats = 'ocultar';

$query2 = $pdo->query("SELECT * FROM compradores where id = '$comprador'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];
	$tel_pessoa = $res2[0]['telefone'];
	$email_pessoa = $res2[0]['email'];
	$tipo_pessoa = 'Comprador';
	$classe_whats = '';
}

$query2 = $pdo->query("SELECT * FROM vendedores where id = '$proprietario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];
	$tel_pessoa = $res2[0]['telefone'];
	$email_pessoa = $res2[0]['email'];
	$tipo_pessoa = 'Proprietário';
	$classe_whats = '';
}

$query2 = $pdo->query("SELECT * FROM locatarios where id = '$locatario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_pessoa = $res2[0]['nome'];
	$tel_pessoa = $res2[0]['telefone'];
	$email_pessoa = $res2[0]['email'];
	$tipo_pessoa = 'Inquilino';
	$classe_whats = '';
}

if($pago == 'Sim'){
	$classe_pago = 'verde';
	$ocultar = 'ocultar';
	$classe_whats = 'ocultar';
}else{
	$classe_pago = 'text-danger';
	$ocultar = '';	
}


//PEGAR RESIDUOS DA CONTA
	$total_resid = 0;
	$valor_com_residuos = 0;
	$query2 = $pdo->query("SELECT * FROM valor_parcial WHERE id_conta = '$id' and tipo = 'Receber'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res2) > 0){

		$descricao = '(Resíduo) - ' .$descricao;

		for($i2=0; $i2 < @count($res2); $i2++){
			foreach ($res2[$i2] as $key => $value){} 
				$id_res = $res2[$i2]['id'];
			$valor_resid = $res2[$i2]['valor'];
			$total_resid += $valor_resid;
		}


		$valor_com_residuos = $valor + $total_resid;
	}
	if($valor_com_residuos > 0){
		$vlr_antigo_conta = '('.$valor_com_residuos.')';
		$descricao_link = '';
		$descricao_texto = 'd-none';
	}else{
		$vlr_antigo_conta = '';
		$descricao_link = 'd-none';
		$descricao_texto = '';
	}


	//DEFINIR O TEXTO DA COBRANÇA
	if($data_venc < $data_atual){
		$texto_cobranca = 'http://api.whatsapp.com/send?1=pt_BR&phone=55'.$tel_pessoa.'&text=Ola, *'.$nome_pessoa.'* Sua conta no valor de: *R$ '.$valorF.'* venceu no dia: *'.$data_vencF.'*, favor efetuar o Pagamento o quanto antes!';
		$cor_icone_whatsapp = 'text-danger';
	}else if($data_venc == $data_atual){
		$texto_cobranca = 'http://api.whatsapp.com/send?1=pt_BR&phone=55'.$tel_pessoa.'&text=Ola, *'.$nome_pessoa.'* Sua conta no valor de: *R$ '.$valorF.'* vence hoje: *'.$data_vencF.'*, caso já tenha efetuado o pagamento favor ignorar!';
		$cor_icone_whatsapp = 'verde';
	}
	else{
		$texto_cobranca = 'http://api.whatsapp.com/send?1=pt_BR&phone=55'.$tel_pessoa.'&text=Ola, *'.$nome_pessoa.'* Lembrete de vencimento de sua conta no dia: *'.$data_vencF.'* no valor de: *R$ '.$valorF.'*';
		$cor_icone_whatsapp = 'verde';
	}
	


echo <<<HTML
			<tr> 
				<td><i class="fa fa-square {$classe_pago} mr-1"></i> {$descricao}</td> 
					<td class="esc">R$ {$valorF} <small><a href="#" onclick="mostrarResiduos('{$id}')" class="text-danger" title="Ver Resíduos">{$vlr_antigo_conta}</a></small></td>	
				<td class="esc">{$data_vencF}</td>
				<td class="esc">{$nome_frequencia}</td>
				<td class="esc">{$saida}</td>
				<td><a href="images/contas/{$arquivo}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="30px" height="30px"></a></td>
				<td>
					<big><a class="{$ocultar}" href="#" onclick="editar('{$id}', '{$descricao}', '{$comprador}', '{$locatario}','{$valor}','{$data_venc}','{$frequencia}','{$saida}','{$arquivo}','{$obs}','{$proprietario}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>

					<big><a href="#" onclick="mostrar('{$id}', '{$descricao}', '{$nome_pessoa}', '{$tel_pessoa}', '{$email_pessoa}', '{$tipo_pessoa}','{$valorF}','{$data_lancF}','{$data_vencF}','{$data_pgtoF}','{$nome_usu_lanc}','{$nome_usu_pgto}','{$nome_frequencia}','{$saida}','{$arquivo}','{$pago}','{$obs}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

					<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$descricao}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

					<big><a class="{$ocultar}" href="#" onclick="parcelar('{$id}', '{$valor}', '{$descricao}')" title="Parcelar Conta"><i class="fa fa-calendar-o " style="color:#7f7f7f"></i></a></big>

					<big><a class="{$ocultar}" href="#" onclick="baixar('{$id}', '{$valor}', '{$descricao}', '{$saida}')" title="Baixar Conta"><i class="fa fa-check-square " style="color:#079934"></i></a></big>

					<big><a href="#" onclick="arquivo('{$id}', '{$descricao}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>


					<big><a href="../boletos/transacao.php?id={$id}" target="_blank" title="Gerar Boleto"><i class="fa fa-file-pdf-o verde " ></i></a></big>


					<big><a class="{$classe_whats}" target="_blank" href="{$texto_cobranca}" title="Cobrar pelo WhatsApp: $tel_pessoa">
					<i class="fa fa-whatsapp {$cor_icone_whatsapp}"></i></a></big>

				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
	</table>
</small>
HTML;
}else{
	echo 'Não possui nenhuma conta para esta data!';
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



	function editar(id, descricao, comprador, locatario, valor, data_venc, frequencia, saida, arquivo, obs, proprietario){

		if(comprador == 0){
			comprador = "";
		}

		if(locatario == 0){
			locatario = "";
		}

		if(proprietario == 0){
			proprietario = "";
		}

				
		
		$('#id').val(id);
		$('#descricao').val(descricao);
		$('#comprador').val(comprador).change();
		$('#locatario').val(locatario).change();
		$('#proprietario').val(proprietario).change();
		$('#valor').val(valor);
		$('#data_venc').val(data_venc);
		$('#frequencia').val(frequencia).change();
		$('#saida').val(saida).change();	
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



	function mostrar(id, descricao, nome, telefone, email, tipo_pessoa, valor, data_lanc, data_venc, data_pgto, usuario_lanc, usuario_pgto, frequencia, saida, arquivo, pago, obs){

		
		if(data_pgto == "00/00/0000"){
			data_pgto = 'Não Pago Ainda';
		}

	
		$('#pessoa_mostrar').text(nome);
		$('#tipo_pessoa_mostrar').text(tipo_pessoa);

		$('#tel_mostrar').text(telefone);
		$('#email_mostrar').text(email);

		$('#nome_mostrar').text(descricao);
		
		$('#locatario_mostrar').text(locatario);		
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
		$('#locatario').val('').change();
		$('#proprietario').val('').change();
		$('#comprador').val('').change();
		$('#target').attr('src','images/contas/sem-foto.png');
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

	$('#valor-juros').val('');
	$('#valor-desconto').val('');
	$('#valor-multa').val('');

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



