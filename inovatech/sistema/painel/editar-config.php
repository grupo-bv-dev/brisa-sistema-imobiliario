<?php 
require_once("../conexao.php");

$nome = $_POST['nome_config'];
$email = $_POST['email_config'];
$endereco = $_POST['end_config'];
$telefone = $_POST['tel_config'];
$telefone_fixo = $_POST['tel_fixo_config'];
$logo = 'logo.png';
$favicon = 'favicon.ico';
$logo_rel = 'logo.jpg';
$relatorio_pdf = $_POST['rel'];
$comissao_venda_imob = $_POST['comissao_venda_imob_config'];
$comissao_aluguel_imob = $_POST['comissao_aluguel_imob_config'];
$comissao_venda_corretor = $_POST['comissao_venda_corretor_config'];
$comissao_aluguel_corretor = $_POST['comissao_aluguel_corretor_config'];

$creci = $_POST['creci_config'];
$nome_banco = $_POST['nome_banco_config'];
$tipo_conta = $_POST['tipo_conta_config'];
$agencia = $_POST['agencia_config'];
$conta = $_POST['conta_config'];
$nome_beneficiario = $_POST['nome_beneficiario_config'];
$tipo_chave_pix = $_POST['tipo_chave_pix_config'];
$chave_pix = $_POST['chave_pix_config'];
$cnpj = $_POST['cnpj_config'];


$comissao_venda_imob = str_replace(',', '.', $comissao_venda_imob);
$comissao_aluguel_imob = str_replace(',', '.', $comissao_aluguel_imob);
$comissao_venda_corretor = str_replace(',', '.', $comissao_venda_corretor);
$comissao_aluguel_corretor = str_replace(',', '.', $comissao_aluguel_corretor);

$comissao_venda_imob = str_replace('%', '', $comissao_venda_imob);
$comissao_aluguel_imob = str_replace('%', '', $comissao_aluguel_imob);
$comissao_venda_corretor = str_replace('%', '', $comissao_venda_corretor);
$comissao_aluguel_corretor = str_replace('%', '', $comissao_aluguel_corretor);

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$caminho = '../imagens/logo.png';
$imagem_temp = @$_FILES['logo']['tmp_name']; 
if(@$_FILES['logo']['name'] != ""){
	$ext = pathinfo(@$_FILES['logo']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão da imagem para a Logo é somente *PNG';
		exit();
	}

}


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$caminho = '../imagens/favicon.ico';
$imagem_temp = @$_FILES['favicon']['tmp_name']; 
if(@$_FILES['favicon']['name'] != ""){
$ext = pathinfo(@$_FILES['favicon']['name'], PATHINFO_EXTENSION);   
	if($ext == 'ico'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão do ícone favicon é somente *ICO';
		exit();
	}
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$caminho = '../imagens/logo.jpg';
$imagem_temp = @$_FILES['imgRel']['tmp_name']; 
if(@$_FILES['imgRel']['name'] != ""){
$ext = pathinfo(@$_FILES['imgRel']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão para a logo do relatório é apenas jpg';
		exit();
	}
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$caminho = '../imagens/qrcodeexemplo.jpg';
$imagem_temp = @$_FILES['imgQRCode']['tmp_name']; 
if(@$_FILES['imgQRCode']['name'] != ""){
$ext = pathinfo(@$_FILES['imgQRCode']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão para a imagem do qrcode pix é apenas jpg';
		exit();
	}
}



$query = $pdo->prepare("UPDATE config SET nome = :nome, telefone = :telefone, endereco = :endereco, logo = '$logo', favicon = '$favicon', logo_rel = '$logo_rel', email = :email,  relatorio = '$relatorio_pdf', comissao_venda_imob = '$comissao_venda_imob', comissao_venda_corretor = '$comissao_venda_corretor', comissao_aluguel_imob = '$comissao_aluguel_imob', comissao_aluguel_corretor = '$comissao_aluguel_corretor', creci = :creci, nome_banco = :nome_banco, tipo_conta = '$tipo_conta', agencia = :agencia, conta = :conta, nome_beneficiario = :nome_beneficiario, tipo_chave_pix = '$tipo_chave_pix', chave_pix = :chave_pix, qr_code_pix = 'qrcodeexemplo.jpg', cnpj = :cnpj, telefone_fixo = :telefone_fixo ");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":creci", "$creci");
$query->bindValue(":nome_banco", "$nome_banco");
$query->bindValue(":agencia", "$agencia");
$query->bindValue(":conta", "$conta");
$query->bindValue(":nome_beneficiario", "$nome_beneficiario");
$query->bindValue(":chave_pix", "$chave_pix");
$query->bindValue(":cnpj", "$cnpj");
$query->bindValue(":telefone_fixo", "$telefone_fixo");
$query->execute();

echo 'Salvo com Sucesso'; 


?>