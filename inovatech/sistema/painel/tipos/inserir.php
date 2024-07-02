<?php 
$tabela = 'tipos';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$id = $_POST['id'];

//validar nome
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Nome já Cadastrado, escolha Outro!';
	exit();
}



$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['foto'];
	$foto_ficha = $res[0]['foto_ficha'];
}else{
	$foto = 'sem-foto.png';
	$foto_ficha = 'sem-foto.png';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/tipos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['foto']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.png"){
				@unlink('images/tipos/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}





//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto-ficha']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/tipos/' .$nome_img;

$imagem_temp = @$_FILES['foto-ficha']['tmp_name']; 

if(@$_FILES['foto-ficha']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'jpg'){ 

		if (@$_FILES['foto-ficha']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto_ficha != "sem-foto.png"){
				@unlink('images/tipos/'.$foto_ficha);
			}

			$foto_ficha = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem da ficha não permitida!';
		exit();
	}
}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, foto = '$foto', ativo = 'Sim', foto_ficha = '$foto_ficha'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, foto = '$foto', foto_ficha = '$foto_ficha' WHERE id = '$id'");

}
$query->bindValue(":nome", "$nome");
$query->execute();



echo 'Salvo com Sucesso'; 

?>