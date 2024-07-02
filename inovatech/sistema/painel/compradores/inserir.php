<?php 
$tabela = 'compradores';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$doc = $_POST['doc'];
$email = $_POST['email'];
$data_nasc = $_POST['data_nasc'];
$endereco = $_POST['endereco'];
$obs = $_POST['obs'];
$pessoa = $_POST['pessoa'];
$corretor = $_POST['corretor'];
$id = $_POST['id'];

$banco = $_POST['banco'];
$tipo = @$_POST['tipo'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$pix = $_POST['pix'];


//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where doc = '$doc'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'CPF já Cadastrado, escolha Outro!';
	exit();
}

//validar email
$query = $pdo->query("SELECT * FROM $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Email já Cadastrado, escolha Outro!';
	exit();
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, pessoa = '$pessoa', telefone = :telefone, doc = :doc, email = :email, data_nasc = '$data_nasc', corretor = '$corretor', data_cadastro = curDate(), endereco = :endereco, obs = :obs, banco = :banco, tipo = '$tipo', agencia = :agencia, conta = :conta, pix = :pix");

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, pessoa = '$pessoa', telefone = :telefone, doc = :doc, email = :email, data_nasc = '$data_nasc', corretor = '$corretor', data_cadastro = curDate(), endereco = :endereco, obs = :obs, banco = :banco, tipo = '$tipo', agencia = :agencia, conta = :conta, pix = :pix WHERE id = '$id'");

}

$query->bindValue(":nome", "$nome");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":doc", "$doc");
$query->bindValue(":email", "$email");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":obs", "$obs");
$query->bindValue(":banco", "$banco");
$query->bindValue(":agencia", "$agencia");
$query->bindValue(":conta", "$conta");
$query->bindValue(":pix", "$pix");
$query->execute();


echo 'Salvo com Sucesso'; 

?>