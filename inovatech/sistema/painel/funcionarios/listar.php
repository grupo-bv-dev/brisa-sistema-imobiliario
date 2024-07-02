<?php 
require_once("../../conexao.php");
$data_atual = date('Y-m-d');
echo <<<HTML
<small>
HTML;
$query = $pdo->query("SELECT * FROM funcionarios ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>
	<th class="esc">Telefone</th> 
	<th class="esc">CPF</th> 
	<th class="esc">Email</th>
	<th class="esc">Cargo</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody> 
	HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
			$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$telefone = $res[$i]['telefone'];
		$cpf = $res[$i]['cpf'];
		$email = $res[$i]['email'];
		$endereco = $res[$i]['endereco'];
		$cargo = $res[$i]['cargo'];
		$data_admissao = $res[$i]['data_admissao'];
		$obs = $res[$i]['obs'];
		$creci = $res[$i]['creci'];
		$foto = $res[$i]['foto'];
		$ativo = $res[$i]['ativo'];
		$banco = $res[$i]['banco'];
		$tipo = $res[$i]['tipo'];
		$conta = $res[$i]['conta'];
		$agencia = $res[$i]['agencia'];
		$pix = $res[$i]['pix'];

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

//retirar quebra de texto do obs
		$obs = str_replace(array("\n", "\r"), ' + ', $obs);
		$data_admissaoF = implode('/', array_reverse(explode('-', $data_admissao)));

		$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cargo = $res2[0]['nome'];
		}else{
			$nome_cargo = 'Sem Cargo';
		}


		echo <<<HTML
		<tr class="{$classe_linha}"> 
		<td>
		<img src="images/perfil/{$foto}" width="27px" class="mr-2">
		{$nome}
		</td> 
		<td class="esc">{$telefone}</td>
		<td class="esc">{$cpf}</td>
		<td class="esc">{$email}</td>
		<td class="esc">{$nome_cargo}</td>
		<td>

		<big><a href="#" onclick="editar('{$id}', '{$nome}', '{$telefone}', '{$cpf}', '{$email}', '{$endereco}', '{$cargo}', '{$data_admissao}', '{$obs}', '{$creci}', '{$foto}', '{$banco}', '{$tipo}', '{$agencia}', '{$conta}', '{$pix}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$cpf}', '{$email}', '{$endereco}', '{$nome_cargo}', '{$data_admissaoF}', '{$obs}', '{$creci}', '{$foto}', '{$banco}', '{$tipo}', '{$agencia}', '{$conta}', '{$pix}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

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



	function editar(id, nome, telefone, cpf, email, endereco, cargo, data_admissao, obs, creci, foto, banco, tipo, agencia, conta, pix){


		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}

		$('#id').val(id);
		$('#nome').val(nome);
		$('#telefone').val(telefone);
		$('#cpf').val(cpf);
		$('#email').val(email);
		$('#endereco').val(endereco);
		$('#cargo').val(cargo).change();
		$('#data_adm').val(data_admissao);
		$('#obs').val(obs);
		$('#creci').val(creci);	
		$('#foto').val('');
		$('#target').attr('src','images/perfil/' + foto);

		$('#tipo').val(tipo).change();
		$('#banco').val(banco);
		$('#agencia').val(agencia);
		$('#conta').val(conta);
		$('#pix').val(pix);			

		$('#tituloModal').text('Editar Registro');
		$('#modalForm').modal('show');
		$('#mensagem').text('');
	}



	function mostrar(nome, telefone, cpf, email, endereco, cargo, data_admissao, obs, creci, foto, banco, tipo, agencia, conta, pix){

		for (let letra of obs){  				
					if (letra === '+'){
						obs = obs.replace(' +  + ', '\n')
					}			
				}
		
		$('#nome_mostrar').text(nome);
		$('#cpf_mostrar').text(cpf);
		$('#telefone_mostrar').text(telefone);
		$('#email_mostrar').text(email);
		$('#endereco_mostrar').text(endereco);
		$('#cargo_mostrar').text(cargo);		
		$('#data_adm_mostrar').text(data_admissao);			
		$('#obs_mostrar').text(obs);		
		$('#creci_mostrar').text(creci);
		$('#target_mostrar').attr('src','images/perfil/' + foto);	

		$('#banco_mostrar').text(banco);
		$('#agencia_mostrar').text(agencia);
		$('#tipo_mostrar').text(tipo);
		$('#conta_mostrar').text(conta);
		$('#pix_mostrar').text(pix);

		$('#modalMostrar').modal('show');		
	}

	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#cpf').val('');
		$('#email').val('');
		$('#endereco').val('');
		$('#creci').val('');
		$('#obs').val('');
		$('#data_adm').val('<?=$data_atual?>');
		$('#target').attr('src','images/perfil/sem-perfil.jpg');

		$('#banco').val('');
		$('#agencia').val('');
		$('#tipo').val('');
		$('#conta').val('');
		$('#pix').val('');
	}


	

</script>



