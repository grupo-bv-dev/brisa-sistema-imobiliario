<?php 
$tabela = 'imoveis';
require_once("../../conexao.php");

$dono = $_POST['dono'];
$corretor = $_POST['corretor'];
$tipo = $_POST['tipo'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$ano = $_POST['ano'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$area_total = $_POST['area_total'];
$area_construida = $_POST['area_construida'];
$quartos = $_POST['quartos'];
$banheiros = $_POST['banheiros'];
$suites = $_POST['suites'];
$garagens = $_POST['garagens'];
$piscinas = $_POST['piscinas'];
$status = $_POST['status'];
$condicao = $_POST['condicao'];
$iptu = $_POST['iptu'];
$iptu = str_replace(',', '.', $iptu);
$condominio = $_POST['condominio'];
$condominio = str_replace(',', '.', $condominio);
$endereco = $_POST['endereco'];
$comissao_imob = $_POST['comissao_imob'];
$comissao_corretor = $_POST['comissao_corretor'];
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$video = $_POST['video'];
$validade = $_POST['validade'];
$data_inicio = $_POST['data_inicio'];
$data_final = $_POST['data_final'];
$id = $_POST['id'];

$comissao_imob = str_replace(',', '.', $comissao_imob);
$comissao_imob = str_replace('%', '', $comissao_imob);
$comissao_corretor = str_replace(',', '.', $comissao_corretor);
$comissao_corretor = str_replace('%', '', $comissao_corretor);

$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($titulo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
$url = preg_replace('/[ -]+/' , '-' , $nome_novo);

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$img_principal = $res[0]['img_principal'];
	$img_banner = $res[0]['img_banner'];
	$img_planta = $res[0]['img_planta'];
}else{
	$img_principal = 'sem-foto.png';
	$img_banner = 'sem-foto.png';
	$img_planta = 'sem-foto.png';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['principal']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/imoveis/' .$nome_img;

$imagem_temp = @$_FILES['principal']['tmp_name']; 

if(@$_FILES['principal']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['principal']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($img_principal != "sem-perfil.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$img_principal = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['planta']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/imoveis/' .$nome_img;

$imagem_temp = @$_FILES['planta']['tmp_name']; 

if(@$_FILES['planta']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['planta']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($img_planta != "sem-perfil.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$img_planta = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}




//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['banner']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../images/imoveis/' .$nome_img;

$imagem_temp = @$_FILES['banner']['tmp_name']; 

if(@$_FILES['banner']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 

		if (@$_FILES['banner']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($img_banner != "sem-perfil.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$img_banner = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET dono = '$dono', corretor = '$corretor', titulo = :titulo, descricao = :descricao, tipo = '$tipo', cidade = '$cidade', bairro = '$bairro', valor = :valor, ano = :ano, area_total = :area_total, area_construida = :area_construida, quartos = :quartos, banheiros = :banheiros, suites = :suites, garagens = :garagens, piscinas = :piscinas, img_principal = '$img_principal', img_banner = '$img_banner', img_planta = '$img_planta', endereco = :endereco, status = '$status', condicao = '$condicao', video = :video, iptu = :iptu, condominio = :condominio, comissao_imob = :comissao_imob, comissao_corretor = :comissao_corretor, data_cad = curDate(), validade_anuncio = '$validade', data_inicio = '$data_inicio', data_final = '$data_final'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET dono = '$dono', corretor = '$corretor', titulo = :titulo, descricao = :descricao, tipo = '$tipo', cidade = '$cidade', bairro = '$bairro', valor = :valor, ano = :ano, area_total = :area_total, area_construida = :area_construida, quartos = :quartos, banheiros = :banheiros, suites = :suites, garagens = :garagens, piscinas = :piscinas, img_principal = '$img_principal', img_banner = '$img_banner', img_planta = '$img_planta', endereco = :endereco, status = '$status', condicao = '$condicao', video = :video, iptu = :iptu, condominio = :condominio, comissao_imob = :comissao_imob, comissao_corretor = :comissao_corretor, validade_anuncio = '$validade', data_inicio = '$data_inicio', data_final = '$data_final' WHERE id = '$id'");



}



$query->bindValue(":titulo", "$titulo");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->bindValue(":ano", "$ano");
$query->bindValue(":area_total", "$area_total");
$query->bindValue(":area_construida", "$area_construida");
$query->bindValue(":quartos", "$quartos");
$query->bindValue(":banheiros", "$banheiros");
$query->bindValue(":suites", "$suites");
$query->bindValue(":garagens", "$garagens");
$query->bindValue(":piscinas", "$piscinas");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":video", "$video");
$query->bindValue(":iptu", "$iptu");
$query->bindValue(":condominio", "$condominio");
$query->bindValue(":comissao_imob", "$comissao_imob");
$query->bindValue(":comissao_corretor", "$comissao_corretor");
$query->execute();
$ult_id = $pdo->lastInsertId();

if($id == ""){
	$url = $url .'-'.$ult_id;
	$novo_id = $ult_id;
}else{
	$url = $url .'-'.$id;
	$novo_id = $id;
}

//atualizar no imovel o campo url
$query = $pdo->query("UPDATE $tabela SET url = '$url' WHERE id = '$novo_id'");

echo 'Salvo com Sucesso'; 

?>