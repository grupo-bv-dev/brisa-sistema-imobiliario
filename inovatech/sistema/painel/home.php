<?php 
require_once("verificar.php");
require_once("../conexao.php");

$total_corretores = 0;
$total_compradores = 0;
$total_vendedores = 0;
$total_imoveis = 0;
$total_locatarios = 0;
$totalTarefasHoje = 0;
$totalTarefasConcluidasHoje = 0;
$porcentagemTarefas = 0;

$saldoDia = 0;
$saldoCaixaDia = 0;
$saldoDiaF = 0;
$saldoCaixaDiaF = 0;
$classe_saldo_caixa_dia = 'fundo-verde';

$contasReceberVencidas = 0;
$contasPagarVencidas = 0;
$contasReceberHoje = 0;
$contasPagarHoje = 0;
$contasReceberPendentes = 0;
$totalContasPagasHoje = 0;
$totalContasRecebidasHoje = 0;
$porcentagemReceber = 0;
$porcentagemPagar = 0;
$totalContasPgHoje = 0;
$totalContasRbHoje = 0;

$query = $pdo->query("SELECT * FROM usuarios WHERE nivel = 'Corretor' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_corretores = @count($res);

$query = $pdo->query("SELECT * FROM compradores");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_compradores = @count($res);


$query = $pdo->query("SELECT * FROM vendedores");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_vendedores = @count($res);

$query = $pdo->query("SELECT * FROM imoveis");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_imoveis = @count($res);

$query = $pdo->query("SELECT * FROM locatarios");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_locatarios = @count($res);


$query = $pdo->query("SELECT * FROM tarefas where data = curDate() and usuario = '$id_usu'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefasHoje = @count($res);

$query = $pdo->query("SELECT * FROM tarefas where data = curDate() and usuario = '$id_usu' and status = 'Concluída'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalTarefasConcluidasHoje = @count($res);

if($totalTarefasConcluidasHoje > 0 and $totalTarefasHoje > 0){
	$porcentagemTarefas = ($totalTarefasConcluidasHoje / $totalTarefasHoje) * 100;
}



$query = $pdo->query("SELECT * FROM pagar where data_venc < curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasPagarVencidas = @count($res);

$query = $pdo->query("SELECT * FROM receber where data_venc < curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasReceberVencidas = @count($res);


$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasPagarHoje = @count($res);

$query = $pdo->query("SELECT * FROM receber where data_venc = curDate() and pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasReceberHoje = @count($res);


$query = $pdo->query("SELECT * FROM receber where pago != 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$contasReceberPendentes = @count($res);


$query = $pdo->query("SELECT * FROM receber where data_venc = curDate() and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasRecebidasHoje = @count($res);

$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate() and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasPagasHoje = @count($res);


$query = $pdo->query("SELECT * FROM receber where data_venc = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasRbHoje = @count($res);

$query = $pdo->query("SELECT * FROM pagar where data_venc = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$totalContasPgHoje = @count($res);

if($totalContasRecebidasHoje > 0 and $totalContasRbHoje > 0){
	$porcentagemReceber = ($totalContasRecebidasHoje / $totalContasRbHoje) * 100;
}


if($totalContasPagasHoje > 0 and $totalContasPgHoje > 0){
	$porcentagemPagar = ($totalContasPagasHoje / $totalContasPgHoje) * 100;
}


//TOTALIZAR SALDO DO DIA
$query_t = $pdo->query("SELECT * from movimentacoes where data = curDate()");
$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
if(@count($res_t)>0){
	for($it=0; $it < @count($res_t); $it++){
		foreach ($res_t[$it] as $key => $value){}			

		if($res_t[$it]['tipo'] == 'Entrada'){
			$saldoDia += $res_t[$it]['valor'];
		}else{
			$saldoDia -= $res_t[$it]['valor'];
		}

		if($res_t[$it]['lancamento'] == 'Caixa'){
			if($res_t[$it]['tipo'] == 'Entrada'){
				$saldoCaixaDia += $res_t[$it]['valor'];
			}else{
				$saldoCaixaDia -= $res_t[$it]['valor'];
			}
		}
	}	

	if($saldoDia < 0){
		$classe_saldo_dia = 'fundo-vermelho';
	}else{
		$classe_saldo_dia = 'fundo-verde-escuro';
	}


	if($saldoCaixaDia < 0){
		$classe_saldo_caixa_dia = 'fundo-vermelho';
	}else{
		$classe_saldo_caixa_dia = 'fundo-verde-claro';
	}

	$saldoDiaF = number_format($saldoDia, 2, ',', '.');
	$saldoCaixaDiaF = number_format($saldoCaixaDia, 2, ',', '.');
}




//alimentar o gráfico de linhas 
$valor_pagar_dia = '';
$valor_pagar = 0;

$valor_receber_dia = '';
$valor_receber = 0;
for($i=0; $i < 6; $i++){
	$data_nova = date('Y-m-d', strtotime("-$i days",strtotime($data_atual)));
	$data_formatada = implode('/', array_reverse(explode('-', $data_nova)));

	$query = $pdo->query("SELECT * FROM pagar where data_pgto = '$data_nova' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		for($i2=0; $i2 < $total_reg; $i2++){
		foreach ($res[$i2] as $key => $value){}
			$valor_pagar += $res[$i2]['valor'];
		}
	}else{
		$valor_pagar = 0;
	}


	$query = $pdo->query("SELECT * FROM receber where data_pgto = '$data_nova' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		for($i2=0; $i2 < $total_reg; $i2++){
		foreach ($res[$i2] as $key => $value){}
			$valor_receber += $res[$i2]['valor'];
		}
	}else{
		$valor_receber = 0;
	}

	$data_dias = @$data_dias .$data_formatada . '-';
	$valor_pagar_dia = $valor_pagar_dia. @$valor_pagar . '-';
	$valor_receber_dia = $valor_receber_dia. @$valor_receber . '-';
	
	
}




$total_entradas_grafico = '';
$total_saidas_grafico = '';
//alimentar o gráfico de barras
for($i=1; $i <= 12; $i++){
	
	if($i < 10){
		$data_mes_atual = $ano_atual.'-0'.$i.'-01';
		$data_mes_final = $ano_atual.'-0'.$i.'-28';
	}else{
		$data_mes_atual = $ano_atual.'-'.$i.'-01';
		$data_mes_final = $ano_atual.'-'.$i.'-28';
	}

	$total_entradas = 0;
	$total_saidas = 0;

	$query_t = $pdo->query("SELECT * from movimentacoes where data >= '$data_mes_atual' and data <= '$data_mes_final'");
	$res_t = $query_t->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res_t)>0){
		for($it=0; $it < @count($res_t); $it++){
			foreach ($res_t[$it] as $key => $value){}			

			if($res_t[$it]['tipo'] == 'Entrada'){
				$total_entradas += $res_t[$it]['valor'];
			}else{
				$total_saidas += $res_t[$it]['valor'];
			}

		}
	}

	$total_entradas_grafico = $total_entradas_grafico. @$total_entradas . '-';
	$total_saidas_grafico = $total_saidas_grafico. @$total_saidas . '-';

}
 ?>

<?php 
if(@$_SESSION['nivel_usuario'] == "Administrador" || @$_SESSION['nivel_usuario'] == "Tesoureiro"){	

 ?>

<input type="hidden" value="<?php echo $data_dias ?>" id="valor_coluna">
<input type="hidden" value="<?php echo $valor_pagar_dia ?>" id="valor_pagar_dia">
<input type="hidden" value="<?php echo $valor_receber_dia ?>" id="valor_receber_dia">

<input type="hidden" value="<?php echo $total_entradas_grafico ?>" id="total_entradas_grafico">
<input type="hidden" value="<?php echo $total_saidas_grafico ?>" id="total_saidas_grafico">

<div class="main-page">
    <div class="col_3">

        <a href="index.php?pagina=funcionarios">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-users icon-rounded"></i>
                    <div class="stats">
                        <h5><strong><?php echo $total_corretores ?></strong></h5>
                        <span>Corretores</span>
                    </div>
                </div>
            </div>
        </a>

        <a href="index.php?pagina=compradores">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-user user1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong><?php echo $total_compradores ?></strong></h5>
                        <span>Compradores</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="index.php?pagina=vendedores">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-users user2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong><?php echo $total_vendedores ?></strong></h5>
                        <span>Vendedores</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="index.php?pagina=locatarios">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-user dollar1 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong><?php echo $total_locatarios ?></strong></h5>
                        <span>Locatários</span>
                    </div>
                </div>
            </div>
        </a>
        <a href="index.php?pagina=imoveis">
            <div class="col-md-3 widget">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-home dollar2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong><?php echo $total_imoveis ?></strong></h5>
                        <span>Imóveis</span>
                    </div>
                </div>
            </div>
        </a>

        <a href="index.php?pagina=receber">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-money <?php echo $classe_saldo_dia ?> icon-verde"></i>
                    <div class="stats">
                        <h5><strong><?php echo $contasReceberHoje ?></strong></h5>
                        <span>Estudo de mercado</span>
                    </div>
                </div>
            </div>
        </a>

        <a href="index.php?pagina=pagar">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-money icon-vermelho"></i>
                    <div class="stats">
                        <h5><strong><?php echo $contasPagarHoje ?></strong></h5>
                        <span>Valor abaixo do mercado</span>
                    </div>
                </div>
            </div>
        </a>

        <a href="index.php?pagina=receber">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-money icon-verde"></i>
                    <div class="stats">
                        <h5><strong><?php echo $contasReceberVencidas ?></strong></h5>
                        <span>Valor acima do mercado</span>
                    </div>
                </div>
            </div>
        </a>

        <a href="index.php?pagina=pagar">
            <div class="col-md-3 widget widget1">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-money icon-verde"></i>
                    <div class="stats">
                        <h5><strong><?php echo $contasPagarVencidas ?></strong></h5>
                        <span>Valor competitivo</span>
                    </div>
                </div>
            </div>
        </a>


     <!--   <a href="index.php?pagina=movimentacoes">
            <div class="col-md-3 widget">
                <div class="r3_counter_box">
                    <i class="pull-left fa fa-money <?php echo $classe_saldo_dia ?> icon-rounded"></i>
                    <div class="stats">
                        <h5><strong><?php echo $saldoDiaF ?></strong></h5>
                        <span>R$ Saldo do Dia</span>
                    </div>
                </div>
            </div>
        </a>-->



        <div class="clearfix"> </div>
    </div>

    <div class="row-one widgettable">
        <div class="col-md-8 content-top-2 card">
            <div class="agileinfo-cdr">
                <div class="card-header">
                    <h3>Pagar e Receber</h3>
                </div>

                <div id="Linegraph" style="width: 98%; height: 350px">
                </div>

            </div>
        </div>
        <div class="col-md-4 stat">

            <a href="index.php?pagina=agenda">
                <div class="content-top-1">
                    <div class="col-md-6 top-content">
                        <h5>Tarefas Concluídas</h5>
                        <label><?php echo $totalTarefasConcluidasHoje ?> de <?php echo $totalTarefasHoje ?></label>
                    </div>
                    <div class="col-md-6 top-content1">
                        <div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $porcentagemTarefas ?>">
                            <span class="pie-value"></span>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>



            <a href="index.php?pagina=receber">
                <div class="content-top-1">
                    <div class="col-md-6 top-content">
                        <h5>Contas à Receber Hoje</h5>
                        <label><?php echo $totalContasRecebidasHoje ?> de <?php echo $totalContasRbHoje ?></label>
                    </div>
                    <div class="col-md-6 top-content1">
                        <div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $porcentagemReceber ?>">
                            <span class="pie-value"></span>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>

            <a href="index.php?pagina=pagar">
                <div class="content-top-1">
                    <div class="col-md-6 top-content">
                        <h5>Contas à Pagar Hoje</h5>
                        <label><?php echo $totalContasPagasHoje ?> de <?php echo $totalContasPgHoje ?></label>
                    </div>
                    <div class="col-md-6 top-content1">
                        <div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $porcentagemPagar ?>">
                            <span class="pie-value"></span>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>




        </div>

        <div class="clearfix"> </div>
    </div>

    <div class="row-one widgettable">
        <div class="col-md-12 content-top-2 card" style="padding:20px">
            <div class="card-header">
                <h3>Entradas e Saídas</h3>
            </div>
            <canvas id="canvas" style="width: 100%; height:450px;"></canvas>

        </div>
    </div>



    <?php }else{
	echo 'Vai mostrar a agenda';
} 
?>


    <!-- GRAFICO DE LINHA -->
    <script type="text/javascript">
    $(document).ready(function() {

        var valor_col_graf_linha = $('#valor_coluna').val()
        var colunas_graf_linha = valor_col_graf_linha.split("-");

        var valor_linha_graf_linha_pagar = $('#valor_pagar_dia').val()
        var linha_graf_linha_pagar = valor_linha_graf_linha_pagar.split("-");

        var valor_linha_graf_linha_receber = $('#valor_receber_dia').val()
        var linha_graf_linha_receber = valor_linha_graf_linha_receber.split("-");


        var maior_valor_linha_pagar = Math.max(...linha_graf_linha_pagar);
        var maior_valor_linha_receber = Math.max(...linha_graf_linha_receber);
        var maior_valor = Math.max(maior_valor_linha_pagar, maior_valor_linha_receber);
        maior_valor = parseFloat(maior_valor) + 100;

        var menor_valor_linha_pagar = Math.min(...linha_graf_linha_pagar);
        var menor_valor_linha_receber = Math.min(...linha_graf_linha_receber);
        var menor_valor = Math.max(menor_valor_linha_pagar, menor_valor_linha_receber);

        var dadosReceber = {
            linecolor: "green",
            title: "Conta à Receber",
            values: [{
                    X: colunas_graf_linha[5],
                    Y: linha_graf_linha_receber[5]
                },
                {
                    X: colunas_graf_linha[4],
                    Y: linha_graf_linha_receber[4]
                },
                {
                    X: colunas_graf_linha[3],
                    Y: linha_graf_linha_receber[3]
                },
                {
                    X: colunas_graf_linha[2],
                    Y: linha_graf_linha_receber[2]
                },
                {
                    X: colunas_graf_linha[1],
                    Y: linha_graf_linha_receber[1]
                },
                {
                    X: colunas_graf_linha[0],
                    Y: linha_graf_linha_receber[0]
                },

            ]
        };
        var dadosPagar = {
            linecolor: "#da2a2a",
            title: "Conta à Pagar",
            values: [{
                    X: colunas_graf_linha[5],
                    Y: linha_graf_linha_pagar[5]
                },
                {
                    X: colunas_graf_linha[4],
                    Y: linha_graf_linha_pagar[4]
                },
                {
                    X: colunas_graf_linha[3],
                    Y: linha_graf_linha_pagar[3]
                },
                {
                    X: colunas_graf_linha[2],
                    Y: linha_graf_linha_pagar[2]
                },
                {
                    X: colunas_graf_linha[1],
                    Y: linha_graf_linha_pagar[1]
                },
                {
                    X: colunas_graf_linha[0],
                    Y: linha_graf_linha_pagar[0]
                },

            ]
        };


        var dataRangeLinha = {
            linecolor: "transparent",
            title: "",
            values: [{
                    X: colunas_graf_linha[5],
                    Y: menor_valor
                },
                {
                    X: colunas_graf_linha[4],
                    Y: menor_valor
                },
                {
                    X: colunas_graf_linha[3],
                    Y: menor_valor
                },
                {
                    X: colunas_graf_linha[2],
                    Y: menor_valor
                },
                {
                    X: colunas_graf_linha[1],
                    Y: menor_valor
                },
                {
                    X: colunas_graf_linha[0],
                    Y: maior_valor
                },

            ]
        };


        $("#Linegraph").SimpleChart({
            ChartType: "Line",
            toolwidth: "50",
            toolheight: "25",
            axiscolor: "#E6E6E6",
            textcolor: "#6E6E6E",
            showlegends: true,
            data: [dadosPagar, dadosReceber, dataRangeLinha],
            legendsize: "30",
            legendposition: 'bottom',
            xaxislabel: 'Data',
            title: 'Demonstrativo de Contas',
            yaxislabel: 'Total de Contas R$',
            responsive: true,
        });

    })
    </script>



    <!-- GRAFICO DE BARRAS -->
    <script type="text/javascript">
    $(document).ready(function() {

        var valor_graf_barra_saidas = $('#total_saidas_grafico').val()
        var total_saidas = valor_graf_barra_saidas.split("-");

        var valor_graf_barra_entradas = $('#total_entradas_grafico').val()
        var total_entradas = valor_graf_barra_entradas.split("-");


        var color = Chart.helpers.color;
        var barChartData = {
            labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto",
                "Setembro", "Outubro", "Novembro", "Dezembro"
            ],
            datasets: [{
                label: 'Entradas',
                backgroundColor: color('green').alpha(0.5).rgbString(),
                borderColor: 'green',
                borderWidth: 1,
                data: [
                    total_entradas[0],
                    total_entradas[1],
                    total_entradas[2],
                    total_entradas[3],
                    total_entradas[4],
                    total_entradas[5],
                    total_entradas[6],
                    total_entradas[7],
                    total_entradas[8],
                    total_entradas[9],
                    total_entradas[10],
                    total_entradas[11],
                    total_entradas[12],
                ]
            }, {
                label: 'Saídas',
                backgroundColor: color('red').alpha(0.5).rgbString(),
                borderColor: 'red',
                borderWidth: 1,
                data: [
                    total_saidas[0],
                    total_saidas[1],
                    total_saidas[2],
                    total_saidas[3],
                    total_saidas[4],
                    total_saidas[5],
                    total_saidas[6],
                    total_saidas[7],
                    total_saidas[8],
                    total_saidas[9],
                    total_saidas[10],
                    total_saidas[11],
                    total_saidas[12],
                ]
            }]

        };

        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Comparativo de Movimentações'
                }
            }
        });

    })
    </script>