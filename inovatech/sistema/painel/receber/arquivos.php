<?php 
$tabela = 'arquivos';
require_once("../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

$id = $_POST['id-arquivo'];
$nome = $_POST['nome-arq'];

$query = $pdo->query("SELECT * FROM receber where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$comprador = $res[0]['comprador'];
	$locatario = $res[0]['locatario'];
	$proprietario = $res[0]['proprietario'];
}else{
	$comprador = "0";
	$locatario = "0";
	$proprietario = "0";
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo_conta']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/arquivos/' .$nome_img;

$imagem_temp = @$_FILES['arquivo_conta']['tmp_name']; 

if(@$_FILES['arquivo_conta']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'txt' or $ext == 'xlsx' or $ext == 'xlsm' or $ext == 'xls' or $ext == 'xml' ){ 

		if (@$_FILES['arquivo_conta']['name'] != ""){			

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}else{
	echo 'Insira um Arquivo!';
	exit();
}

$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,  data_cad = curDate(), usuario = '$id_usuario', arquivo = '$foto', registro = 'Conta à Receber', id_reg = '$id'");

$query->bindValue(":nome", "$nome");
$query->execute();


if($comprador != "0"){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,  data_cad = curDate(), usuario = '$id_usuario', arquivo = '$foto', registro = 'Compradores', id_reg = '$comprador'");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	
}


if($locatario != "0"){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,  data_cad = curDate(), usuario = '$id_usuario', arquivo = '$foto', registro = 'Locatarios', id_reg = '$locatario'");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	
}


if($proprietario != "0"){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome,  data_cad = curDate(), usuario = '$id_usuario', arquivo = '$foto', registro = 'Vendedores', id_reg = '$proprietario'");
	$query->bindValue(":nome", "$nome");
	$query->execute();
	
}

echo 'Inserido com Sucesso';


?>