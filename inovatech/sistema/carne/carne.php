<?php
require_once("../conexao.php");
$id = $_GET['id'];
if($id == ""){
  echo 'Você não selecionou um contrato de aluguél valido!';
  exit();
}

$query = $pdo->query("SELECT * FROM alugueis where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
    $valor = $res[0]['valor_total']; 
    $data_pgto = $res[0]['data_pgto'];
    $obs = $res[0]['obs'];
    $data_inicio = $res[0]['data_inicio'];
    $data_final = $res[0]['data_final'];   
    $inquilino = $res[0]['inquilino']; 

    $valorF = number_format($valor, 2, ',', '.');  
    
}else{
  echo 'Você não selecionou um contrato de aluguél valido!';
  exit();
}

$data_ini  = $data_inicio;
$data_end  = $data_final; 
$dif = strtotime($data_end) - strtotime($data_ini); 
$qtd = floor($dif / (60 * 60 * 24 * 30));

$data_format = explode("-", $data_inicio);

$vence = $data_pgto;
$primeiro_dia = $data_format[2];
$primeiro_mes = $data_format[1];
$primeiro_ano = $data_format[0];



//dados do cliente
$query = $pdo->query("SELECT * FROM locatarios where id = '$inquilino'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
$nome = $res[0]['nome'];   
$cpf = $res[0]['doc'];   
$endereco = $res[0]['endereco'];   
$pessoa = $res[0]['pessoa'];
if($pessoa == 'Física'){
  $tipo_pessoa = 'CPF';
}else{
  $tipo_pessoa = 'CNPJ';
}
}else{
$nome = '';
$cpf = '';
$endereco = '';
$tipo_pessoa = '';
}



$hoje = date("d/m/Y");

if ($qtd > 212) { header("Location: index.php?error=qtd_limite"); }
?>
<!DOCTYPE HTML>
<!-- SPACES 2 -->
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="Resource-type" content="document">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="author" content="Gabriel Masson">
    <title>Carnê</title>
   <link rel="icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <div class="bto">
    Ao Imprimir o carnê certifique-se se a impressão está ajustada à página
    <br>
    <br>
    <button class="btn-impress" onclick="window.print()">Imprimir</button>
    &nbsp;
    <?php echo "<a href=\"capa.php\" class=\"btn\" target=\"_blank\">
      Capa do carnê
    </a>"; ?>
    &nbsp;
   
  </div>

<?php

$count = 1;
$ano_vence = $primeiro_ano;
$mes_vence = $primeiro_mes - 1;

while ($count <= $qtd) {

  if ($mes_vence == 12) { 
    $ano_vence = $ano_vence + 1;
    $mes_vence = 1;
  } else {
    $mes_vence++;
  }

  if($mes_vence < 10){
    $mes_vence = '0'.$mes_vence;
  }

  echo "<!-- PARCELA -->
  <div class=\"parcela\">
    <div class=\"grid\">
      <div class=\"col3\">
        <div class=\"destaca\">
          <table width=\"100%\">
            <tr>
              <td>
                <small>Parcela</small>
                <br>{$count} / {$qtd}
              </td>
            <td>
              <small>Valor</small>
              <br>R$ {$valorF}
            </td>
            </tr>
            <tr>
              <td colspan=\"2\">
                <small>Vencimento</small>
                <br>{$primeiro_dia}/{$mes_vence}/{$ano_vence}
              </td>
            </tr>
            <tr>
              <td colspan=\"2\">
                <small>Observações</small><br>
                <small>{$obs}</small>
                <br><br><br>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class=\"col9\">
        <table width=\"100%\">
          <tr>
            <td colspan=\"2\">
              <small>Nome do cedente</small>
              <br>{$nome_sistema}
            </td>
            <td>
              <small>Parcela</small>
              <br>{$count} / {$qtd}
            </td>
            <td>
              <small>Valor</small>
              <br>R$ {$valorF}
            </td>
          </tr>
          <tr>
            <td>
              <small>Data do Documento</small>
              <br>{$hoje}
            </td>
            <td>
              <small>Tipo de Documento</small>
              <br>Carnê
            </td>
            <td colspan=\"2\">
              <small>Vencimento</small>
              <br>{$primeiro_dia}/{$mes_vence}/{$ano_vence}
            </td>
          </tr>
          <tr>
            <td colspan=\"1\">
            <small>
              <b>Dados do Cliente</b><br>  
              <small>Nome: {$nome}</small> <br>
              <small>{$tipo_pessoa}: {$cpf}</small><br>
            </small>  
             
            </td>
            
            <td colspan=\"2\">
            <small>
              <b>Dados para Pagamento</b><br>  
              <small>Banco: {$nome_banco_imob} Conta {$tipo_conta_imob}</small> <br>
              <small>Conta: {$conta_imob} Agência: {$agencia_imob}</small><br>
             
              <small>{$nome_beneficiario_imob}</small>
              </small>
            </td>
            <td colspan=\"1\">
            <small>
             <b>Pix</b> 
              <small>Chave {$tipo_chave_pix_imob} <br> {$chave_pix_imob}</small> <br><br>
            <img src='../imagens/qrcodepix.jpg' width='65px' height='65px'>
            </small>
            </td>
          </tr>
        </table>
       
      </div>
    </div>
  </div>";

  if (!@$count_quebra_pg) { @$count_quebra_pg = 0; } // Preenche Variavel
  @$count_quebra_pg++; // contagem de loop
  if (@$count_quebra_pg == 4) { // Adiciona quebra a cada 4 loops e zera a variavel
    echo "<div class=\"quebra-pagina\"></div>";
    @$count_quebra_pg = 0;
  }

  $count++;
}

?>

  </body>
</html>