<?php
date_default_timezone_set('America/Sao_Paulo'); 

$url_sistema = "http://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/imobiliaria/";
}

//conexao local

$usuario = 'root';
$senha = '';
$banco = 'imobiliaria';
$servidor = 'localhost';


try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao Conectar com o banco de dados! <br><br>';
	echo $e;
}





//VARIAVEIS GLOBAIS DO SISTEMA
$itens_por_pagina = 6; //essa informação vai totalizar os imóveis colocando 6 por página no site

$nome_sistema = 'INOVA TECH';
$email_adm = 'codigoquente@gamil.com';



//inserir registros na tabela config
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_adm',  logo = 'logo.png', favicon = 'favicon.ico', logo_rel = 'logo.jpg',  relatorio = 'pdf', comissao_venda_imob = '6', comissao_venda_corretor = '2', comissao_aluguel_imob = '10', comissao_aluguel_corretor = '6', qr_code_pix = 'qrcodeexemplo.jpg' ");
}


//VARIAVEIS DE CONFIGURAÇÕES DA TABELA CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$nome_sistema = $res[0]['nome'];
$email_adm = $res[0]['email'];
$tel_sistema = $res[0]['telefone'];
$tel_fixo_sistema = $res[0]['telefone_fixo'];
$end_sistema = $res[0]['endereco'];
$logo = $res[0]['logo'];
$favicon = $res[0]['favicon'];
$logo_rel = $res[0]['logo_rel'];
$relatorio_pdf = $res[0]['relatorio'];
$comissao_venda_imob = $res[0]['comissao_venda_imob'];
$comissao_aluguel_imob = $res[0]['comissao_aluguel_imob'];
$comissao_venda_corretor = $res[0]['comissao_venda_corretor'];
$comissao_aluguel_corretor = $res[0]['comissao_aluguel_corretor'];
$data_verificacao = $res[0]['data_verificacao'];
$creci_imob = $res[0]['creci'];
$nome_banco_imob = $res[0]['nome_banco'];
$tipo_conta_imob = $res[0]['tipo_conta'];
$nome_beneficiario_imob = $res[0]['nome_beneficiario'];
$agencia_imob = $res[0]['agencia'];
$conta_imob = $res[0]['conta'];
$tipo_chave_pix_imob = $res[0]['tipo_chave_pix'];
$chave_pix_imob = $res[0]['chave_pix'];
$qr_code_pix_imob = $res[0]['qr_code_pix'];
$cnpj_imob = $res[0]['cnpj'];

//CHAMADA DAS VERIFICAÇÕES DIÁRIAS
if($data_verificacao != date('Y-m-d')){
	require_once("verificacoes.php");
}
 ?>