<?php 

include_once("sistema/conexao.php");

$remetente = $_POST['emailCorretor'];
$assunto = 'Contato do Site Imobiliária';

$mensagem = utf8_decode('Nome: '.$_POST['nome']. "\r\n"."\r\n" . 'Telefone: '.$_POST['telefone']. "\r\n"."\r\n" . 'Mensagem: ' . "\r\n"."\r\n" .$_POST['comentario']);
$dest = $_POST['email'];
$cabecalhos = "From: " .$dest;

mail($remetente, $assunto, $mensagem, $cabecalhos);

echo 'Enviado com Sucesso!';

 ?>

