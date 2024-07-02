<?php 
require_once("../../conexao.php");

$id = $_GET['id'];

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."sistema/painel/rel/ficha_capitacao.php?id=$id");

if($relatorio_pdf != 'pdf'){
	echo $html;
	exit();
}


//CARREGAR DOMPDF
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new DOMPDF($options);



//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'fichaCapitacao.pdf',
array("Attachment" => false)
);

?>