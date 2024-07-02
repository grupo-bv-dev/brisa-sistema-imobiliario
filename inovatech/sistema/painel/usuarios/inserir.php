<?php 
$tabela = 'usuarios';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = '123';
$senha_crip = md5($senha);

//validar email
$query = $pdo->query("SELECT * FROM $tabela where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Email já Cadastrado, escolha Outro!';
	exit();
}


$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, cpf = '', senha_crip = '$senha_crip', senha = '$senha', nivel = 'Administrador', foto = 'sem-perfil.jpg', id_func = 0, ativo = 'Sim'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->execute();

echo 'Salvo com Sucesso'; 

?>