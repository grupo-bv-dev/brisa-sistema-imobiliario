<?php 
require_once("../../conexao.php");
$pagina = 'receber';
$id = $_POST['id'];
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM $pagina where referencia = 'Aluguél' and id_ref = '$id' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="">
		<thead> 
			<tr> 				
				<th>Parcela</th>
				<th>Valor</th>
				<th class="esc">Vencimento</th>				
				<th class="esc">Pago</th>				
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


if($data_venc < date('Y-m-d') and $pago != "Sim"){
	$classe_linha = 'text-danger';
}else{
	$classe_linha = '';
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

$parcelas = $i + 1;
echo <<<HTML
			<tr class="{$classe_linha}">					
				<td class="">{$parcelas}</td>
				<td >{$valorF}</td>				
				<td class="esc">{$data_vencF}</td>
				<td class="esc"><i class="fa fa-square {$classe_pago} mr-1"></i></td>
				<td>

					<a class="{$ocultar}" href="#" onclick="baixar('{$id}', '{$valor}', '{$descricao}', '{$saida}')" title="Baixar Conta"><i class="fa fa-check-square " style="color:#079934"></i></a>

					<a href="#" onclick="arquivoParcela('{$id}', '{$descricao}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a>

					<big><a class="{$ocultar}" href="../boletos/transacao.php?id={$id}" target="_blank" title="Gerar Boleto"><i class="fa fa-file-pdf-o text-danger " ></i></a></big>

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
	echo 'Não possui nenhum arquivo cadastrado!';
}

?>


<script type="text/javascript">


	


	function excluirArquivo(id, nome){
    
    $.ajax({
        url: "arquivos/excluir-arquivo.php",
        method: 'POST',
        data: {id, nome},
        dataType: "text",

        success: function (mensagem) {
            $('#mensagem-arquivo').text('');
            $('#mensagem-arquivo').removeClass()
            if (mensagem.trim() == "Excluído com Sucesso") {                
                listarArquivos();                
            } else {

                $('#mensagem-arquivo').addClass('text-danger')
                $('#mensagem-arquivo').text(mensagem)
            }


        },      

    });
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

function arquivoParcela(id, nome){
    $('#id-arquivo-parcela').val(id);    
    $('#nome-arquivo-parcela').text(nome);
    $('#modalArquivosParcela').modal('show');
    $('#mensagem-arquivo-parcela').text(''); 
    listarArquivosParcela();   
}




</script>


