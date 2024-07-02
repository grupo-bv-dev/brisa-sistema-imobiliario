<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
echo <<<HTML
<small>
HTML;
if($nivel_usuario == 'Corretor'){
	$query = $pdo->query("SELECT * FROM imoveis where status = 'Para Venda' corretor = '$id_usuario' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM imoveis where status = 'Para Venda' ORDER BY id desc");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th class="esconder">id</td>
	<th>Título</th>
	<th class="esc">Tipo</th> 
	<th class="esc">Status</th> 
	<th class="esc">Corretor</th>
	<th class="esc">Valor</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$dono = $res[$i]['dono'];
		$corretor = $res[$i]['corretor'];
		$titulo = $res[$i]['titulo'];
		$descricao = $res[$i]['descricao'];
		$tipo = $res[$i]['tipo'];
		$cidade = $res[$i]['cidade'];
		$bairro = $res[$i]['bairro'];
		$valor = $res[$i]['valor'];
		$ano = $res[$i]['ano'];
		$visitas = $res[$i]['visitas'];
		$area_total = $res[$i]['area_total'];
		$area_construida = $res[$i]['area_construida'];
		$quartos = $res[$i]['quartos'];
		$banheiros = $res[$i]['banheiros'];
		$suites = $res[$i]['suites'];
		$garagens = $res[$i]['garagens'];
		$piscinas = $res[$i]['piscinas'];
		$img_principal = $res[$i]['img_principal'];
		$img_planta = $res[$i]['img_planta'];
		$img_banner = $res[$i]['img_banner'];
		$endereco = $res[$i]['endereco'];
		$status = $res[$i]['status'];
		$condicao = $res[$i]['condicao'];
		$video = $res[$i]['video'];
		$iptu = $res[$i]['iptu'];
		$condominio = $res[$i]['condominio'];
		$comissao_imob = $res[$i]['comissao_imob'];
		$comissao_corretor = $res[$i]['comissao_corretor'];
		$url = $res[$i]['url'];
		$data_cad = $res[$i]['data_cad'];
		$validade_anuncio = $res[$i]['validade_anuncio'];
		$data_inicio = $res[$i]['data_inicio'];
		$data_final = $res[$i]['data_final'];

		if($status == 'Inativo'){			
			$classe_linha = 'text-muted';
		}else{			
			$classe_linha = '';
		}

//retirar aspas do texto do obs
		$descricao = str_replace('"', "**", $descricao);
		$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));
		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));
		$valorF = number_format($valor, 2, ',', '.');
		$iptuF = number_format($iptu, 2, ',', '.');
		$condominioF = number_format($condominio, 2, ',', '.');
		$tituloF = mb_strimwidth($titulo, 0, 40, "...");

		$query2 = $pdo->query("SELECT * FROM vendedores where id = '$dono'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_dono = $res2[0]['nome'];
			$doc_dono = $res2[0]['doc'];
			$email_dono = $res2[0]['email'];
			$tel_dono = $res2[0]['telefone'];
		}else{
			$nome_dono = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_corretor = $res2[0]['nome'];
		}else{
			$nome_corretor = 'Sem Registro';
		}


		$query2 = $pdo->query("SELECT * FROM tipos where id = '$tipo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_tipo = $res2[0]['nome'];
		}else{
			$nome_tipo = 'Sem Registro';
		}


		$query2 = $pdo->query("SELECT * FROM cidades where id = '$cidade'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cidade = $res2[0]['nome'];
		}else{
			$nome_cidade = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_bairro = $res2[0]['nome'];
		}else{
			$nome_bairro = 'Sem Registro';
		}

		//CALCULAR A COMISSÃO DA IMOB EM R$
		if($comissao_corretor != "0" || $comissao_imob != "0"){
			$comissao_imob_RS = ($comissao_imob / 100) * $valor;
		}else{
			$comissao_imob_RS = ($comissao_venda_imob / 100) * $valor;
		}

		//CALCULAR A COMISSÃO DA CORRETOR EM R$
		if($comissao_corretor != "0" || $comissao_imob != "0"){
			$comissao_corretor_RS = ($comissao_corretor / 100) * $valor;
		}else{
			$comissao_corretor_RS = ($comissao_venda_corretor / 100) * $valor;
		}

		//Formatar o valor do imóvel
		$valor = $valor * 1;



		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td class="esconder">{$id}</td>
		<td>
		<img src="images/imoveis/{$img_principal}" width="27px" class="mr-2">
		{$tituloF}
		</td> 
		<td class="esc">{$nome_tipo}</td>
		<td class="esc">{$status}</td>
		<td class="esc">{$nome_corretor}</td>
		<td class="esc">{$valorF}</td>
		<td>		

		<big><a href="#" onclick="mostrar('{$id}','{$doc_dono}','{$email_dono}','{$tel_dono}','{$nome_dono}', '{$nome_corretor}', '{$titulo}', '{$descricao}', '{$nome_tipo}', '{$nome_cidade}', '{$nome_bairro}', '{$valorF}', '{$ano}', '{$visitas}', '{$area_total}', '{$area_construida}', '{$quartos}', '{$banheiros}', '{$suites}', '{$garagens}', '{$piscinas}', '{$img_principal}', '{$img_planta}', '{$img_banner}', '{$endereco}', '{$status}', '{$condicao}', '{$video}', '{$iptuF}', '{$condominioF}', '{$comissao_imob}', '{$comissao_corretor}',  '{$data_cadF}', '{$validade_anuncio}', '{$data_inicioF}', '{$data_finalF}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>
		
		<a href="#" onclick="arquivo('{$id}', '{$titulo}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a>

		<a href="#" onclick="vender('{$id}', '{$titulo}', '{$comissao_imob_RS}', '{$comissao_corretor_RS}', '{$valor}', '{$valorF}')" title="Vender Imóvel"><i class="fa fa-money " style="color:green; margin-left:3px"></i></a>


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



	function mostrar(id, doc, email, tel, dono, corretor, titulo, descricao, tipo, cidade, bairro, valor, ano, visitas, area_total, area_construida, quartos, banheiros, suites, garagens, piscinas, img_principal, img_planta, img_banner, endereco, status, condicao, video, iptu, condominio, comissao_imob, comissao_corretor, data_cadF, validade, data_inicio, data_final){	

		for (let letra of descricao){  				
			if (letra === '+'){
				descricao = descricao.replace(' +  + ', '\n')
			}			
		}
		$('#id_mostrar').text(id);
		$('#email_mostrar').text(email);
		$('#doc_mostrar').text(doc);
		$('#tel_mostrar').text(tel);
		$('#dono_mostrar').text(dono);
		$('#corretor_mostrar').text(corretor);
		$('#titulo_mostrar').text(titulo);
		$('#descricao_mostrar').html(descricao);
		$('#tipo_mostrar').text(tipo);
		$('#cidade_mostrar').text(cidade);		
		$('#bairro_mostrar').text(bairro);			
		$('#valor_mostrar').text(valor);		
		$('#ano_mostrar').text(ano);
		$('#visitas_mostrar').text(visitas);
		$('#area_total_mostrar').text(area_total + 'm²');
		$('#area_construida_mostrar').text(area_construida + 'm²');
		$('#quartos_mostrar').text(quartos);
		$('#banheiros_mostrar').text(banheiros);
		$('#suites_mostrar').text(suites);		
		$('#garagens_mostrar').text(garagens);			
		$('#piscinas_mostrar').text(piscinas);		
		$('#endereco_mostrar').text(endereco);
		$('#status_mostrar').text(status);
		$('#condicao_mostrar').text(condicao);
		$('#iptu_mostrar').text(iptu);
		$('#condominio_mostrar').text(condominio);
		$('#comissao_imob_mostrar').text(comissao_imob);
		$('#comissao_corretor_mostrar').text(comissao_corretor);
		$('#data_cad_mostrar').text(data_cadF);
		$('#validade_mostrar').text(validade);
		$('#data_inicio_mostrar').text(data_inicio);
		$('#data_final_mostrar').text(data_final);
	


		$('#target_principal_mostrar').attr('src','images/imoveis/' + img_principal);	
		$('#target_planta_mostrar').attr('src','images/imoveis/' + img_planta);
		$('#target_video_mostrar').attr('src', video);	

		$('#modalMostrar').modal('show');		
	}
	


function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}

function vender(id, nome, comissao_imob, comissao_corretor, valor, valorf){
    $('#id-vender').val(id);    
    $('#nome-vender').text(nome + ' R$: ' + valorf);    
    $('#mensagem-vender').text('');
    $('#data_pgto').val('<?=$data_atual?>'); 
    $('#comprador').val('').change();
    $('#valor').val(valor);   
 	$('#comissao_imob').val(comissao_imob);   
    $('#comissao_corretor').val(comissao_corretor); 
    $('#obs').val('');     
    $('#modalVender').modal('show');

}





</script>



