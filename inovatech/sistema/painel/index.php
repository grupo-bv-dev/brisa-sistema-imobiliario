<?php 
require_once("verificar.php");
require_once("../conexao.php");

$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";

$id_usuario = @$_SESSION['id_usuario'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome'];
	$foto_usu = $res[0]['foto'];
	$nivel_usu = $res[0]['nivel'];
	$cpf_usu = $res[0]['cpf'];
	$cpf_user = $res[0]['cpf'];
	$senha_usu = $res[0]['senha'];
	$email_usu = $res[0]['email'];
	$id_usu = $res[0]['id'];
}

if( @$_GET['pagina'] == ""){
	$pagina = 'home';
}else{
	$pagina = @$_GET['pagina'];	
}




$esc_tes = '';
$esc_cor = '';
$esc_recep = '';

$classe_widget = '';
//PERMISSÕES DOS USUÁRIOS
if($nivel_usu == "Corretor"){
	$esc_cor = 'ocultar';
}else if($nivel_usu == "Tesoureiro"){
	$esc_tes = 'ocultar';
}else if($nivel_usu == "Recepcionista"){
	$esc_recep = 'ocultar';
}else if($nivel_usu == "Administrador"){
	$esc_admin = 'ocultar';
}

if($nivel_usu != "Administrador"){
	$esc_todos = 'ocultar';
}


?>
<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo $nome_sistema; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Sistema para Corretor desenvolvido pela Inova Tech Labs" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome icons CSS-->

    <!-- side nav css file -->
    <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- //side nav css file -->

    <link rel="stylesheet" href="css/monthly.css">

    <!-- js-->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext"
        rel="stylesheet">
    <!--//webfonts-->

    <!-- chart -->
    <script src="js/Chart.js"></script>
    <!-- //chart -->

    <!-- Metis Menu -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/custom.js"></script>
    <link href="css/custom.css" rel="stylesheet">
    <!--//Metis Menu -->

    <link rel="icon" href="../imagens/favicon.ico" type="image/x-icon">
    <style>
    #chartdiv {
        width: 100%;
        height: 295px;
    }
    </style>
    <!--pie-chart -->
    <!-- index page sales reviews visitors pie chart -->
    <script src="js/pie-chart.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#demo-pie-1').pieChart({
            barColor: '#ffc168',
            trackColor: '#eee',
            lineCap: 'round',
            lineWidth: 8,
            onStep: function(from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-2').pieChart({
            barColor: '#09872d',
            trackColor: '#eee',
            lineCap: 'butt',
            lineWidth: 8,
            onStep: function(from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });

        $('#demo-pie-3').pieChart({
            barColor: '#de1024',
            trackColor: '#eee',
            lineCap: 'square',
            lineWidth: 8,
            onStep: function(from, to, percent) {
                $(this.element).find('.pie-value').text(Math.round(percent) + '%');
            }
        });


    });
    </script>
    <!-- //pie-chart -->
    <!-- index page sales reviews visitors pie chart -->

    <!-- requried-jsfiles-for owl -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <script src="js/owl.carousel.js"></script>
    <script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({
            items: 3,
            lazyLoad: true,
            autoPlay: true,
            pagination: true,
            nav: true,
        });
    });
    </script>
    <!-- //requried-jsfiles-for owl -->

    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body class="cbp-spmenu-push">
    <div class="main-content">
        <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <!--left-fixed -navigation-->
            <aside class="sidebar-left">
                <nav class="navbar navbar-inverse" style="overflow: scroll; height:100%; scrollbar-width: thin;">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target=".collapse" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h1><a class="navbar-brand" href="./"><span class="fa fa-area-chart"></span> Inova Tech<span
                                    class="dashboard_text">Sistema Gestão</span></a></h1>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="sidebar-menu">
                            <li class="header">MENU DE NAVEGAÇÃO</li>
                            <li class="treeview">
                                <a href="./">
                                    <i class="fa fa-dashboard"></i> <span>Home</span>
                                </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-plus"></i>
                                    <span>Cadastros</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?pagina=cargos"><i class="fa fa-angle-right"></i> Cargos</a>
                                    </li>
                                    <li><a href="index.php?pagina=tipos"><i class="fa fa-angle-right"></i> Tipos
                                            Imóveis</a></li>

                                    <li><a href="index.php?pagina=cidades"><i class="fa fa-angle-right"></i> Cidades</a>
                                    </li>
                                    <li><a href="index.php?pagina=bairros"><i class="fa fa-angle-right"></i> Bairros</a>
                                    </li>
                                    <li><a href="index.php?pagina=contas_banco"><i class="fa fa-angle-right"></i> Contas
                                            Bancárias</a></li>

                                    <li><a href="index.php?pagina=frequencias"><i class="fa fa-angle-right"></i>
                                            Frequências</a></li>
                                </ul>
                            </li>


                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-home"></i>
                                    <span>Imóveis</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?pagina=imoveis"><i class="fa fa-angle-right"></i> Imóveis
                                            Cadastrados</a></li>
                                    <li><a href="index.php?pagina=imoveis-venda"><i class="fa fa-angle-right"></i>
                                            Imóveis Venda</a></li>

                                    <li><a href="index.php?pagina=imoveis-locacao"><i class="fa fa-angle-right"></i>
                                            Imóveis Locação</a></li>

                                    <li><a href="index.php?pagina=imoveis-vendidos"><i class="fa fa-angle-right"></i>
                                            Imóveis Vendidos</a></li>

                                    <li><a href="index.php?pagina=imoveis-alugados"><i class="fa fa-angle-right"></i>
                                            Imóveis Alugados</a></li>

                                    <li><a href="index.php?pagina=imoveis-inativos"><i class="fa fa-angle-right"></i>
                                            Imóveis Inativos</a></li>


                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i>
                                    <span>Pessoas</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?php echo $esc_tes ?> <?php echo $esc_cor ?>"><a
                                            href="index.php?pagina=funcionarios"><i class="fa fa-angle-right"></i>
                                            Funcionários</a></li>

                                    <li class=""><a href="index.php?pagina=vendedores"><i class="fa fa-angle-right"></i>
                                            Vendedores / Locadores</a></li>

                                    <li class=""><a href="index.php?pagina=compradores"><i
                                                class="fa fa-angle-right"></i> Compradores</a></li>


                                    <li class=""><a href="index.php?pagina=locatarios"><i class="fa fa-angle-right"></i>
                                            Locatários</a></li>


                                    <li class="<?php echo $esc_todos ?>"><a href="index.php?pagina=usuarios"><i
                                                class="fa fa-angle-right"></i> Usuários</a></li>

                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="index.php?pagina=agenda">
                                    <i class="fa fa-calendar-o"></i> <span>Agenda</span>
                                </a>
                            </li>


                            <li class="treeview <?php echo $esc_todos ?>">
                                <a href="index.php?pagina=tarefas">
                                    <i class="fa fa-clock-o"></i> <span>Tarefas Usuários</span>
                                </a>
                            </li>



                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-dollar"></i>
                                    <span>Financeiro</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="<?php echo $esc_recep ?>"><a href="index.php?pagina=pagar"><i
                                                class="fa fa-angle-right"></i> Contas à Pagar</a></li>

                                    <li class="<?php echo $esc_recep ?>"><a href="index.php?pagina=receber"><i
                                                class="fa fa-angle-right"></i> Contas à Receber</a></li>

                                    <li class="<?php echo $esc_recep ?> <?php echo $esc_cor ?>"><a
                                            href="index.php?pagina=movimentacoes"><i class="fa fa-angle-right"></i>
                                            Extrato Caixa</a></li>


                                    <li class="<?php echo $esc_recep ?>"><a href="index.php?pagina=comissoes"><i
                                                class="fa fa-angle-right"></i> Comissões</a></li>


                                    <li class="<?php echo $esc_recep ?> <?php echo $esc_cor ?>"><a
                                            href="index.php?pagina=vendas"><i class="fa fa-angle-right"></i> Vendas</a>
                                    </li>

                                    <li class="<?php echo $esc_recep ?> <?php echo $esc_cor ?>"><a
                                            href="index.php?pagina=alugueis"><i class="fa fa-angle-right"></i>
                                            Aluguéis</a></li>



                                </ul>
                            </li>




                            <li class="treeview <?php echo $esc_recep ?>">
                                <a href="#">
                                    <i class="fa fa-file-o"></i>
                                    <span>Relatórios Financeiros</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">


                                    <li class="<?php echo $esc_cor ?>"><a href="#" data-toggle="modal"
                                            data-target="#RelFin"><i class="fa fa-angle-right"></i> Relatório
                                            Movimentações</a></li>

                                    <li class=""><a href="#" data-toggle="modal" data-target="#RelCom"><i
                                                class="fa fa-angle-right"></i> Relatório Comissões</a></li>

                                    <li class=""><a href="#" data-toggle="modal" data-target="#RelVen"><i
                                                class="fa fa-angle-right"></i> Relatório Vendas</a></li>

                                    <li class=""><a href="#" data-toggle="modal" data-target="#RelAlu"><i
                                                class="fa fa-angle-right"></i> Relatório Aluguéis</a></li>


                                    <li class=""><a href="#" data-toggle="modal" data-target="#RelPagar"><i
                                                class="fa fa-angle-right"></i> Relatório Contas Pagar</a></li>


                                    <li class=""><a href="#" data-toggle="modal" data-target="#RelReceb"><i
                                                class="fa fa-angle-right"></i> Relatório Contas Receber</a></li>






                                </ul>
                            </li>





                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </aside>
        </div>
        <!--left-fixed -navigation-->

        <!-- header-starts -->
        <div class="sticky-header header-section ">
            <div class="header-left">
                <!--toggle button start-->
                <button id="showLeftPush"><i class="fa fa-bars"></i></button>
                <!--toggle button end-->
                <div class="profile_details_left">
                    <!--notifications of menu start -->
                    <ul class="nofitications-dropdown">


                        <?php 
						$query2 = $pdo->query("SELECT * FROM tarefas where status = 'Agendada' and usuario = '$id_usuario' order by data asc, hora asc ");
						$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
						$tarefasPendentes_taref = @count($res2);

						$query = $pdo->query("SELECT * FROM tarefas where status = 'Agendada' and usuario = '$id_usuario' order by data asc, hora asc limit 6 ");
						$res = $query->fetchAll(PDO::FETCH_ASSOC);
						$tarefasPendentes_taref_limit = @count($res);
						?>
                        <li class="dropdown head-dpdn">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                                    class="fa fa-bell"></i><span
                                    class="badge blue1"><?php echo $tarefasPendentes_taref ?></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="notification_header">
                                        <h3>Você possui <?php echo $tarefasPendentes_taref ?> Tarefas Pendentes!</h3>
                                    </div>
                                </li>

                                <?php 
								if($tarefasPendentes_taref_limit > 0){
									for($i=0; $i < $tarefasPendentes_taref_limit; $i++){
										foreach ($res[$i] as $key => $value){}
											$id_taref = $res[$i]['id'];
										$titulo_taref = $res[$i]['titulo'];	
										$hora_taref = $res[$i]['hora'];
										$data_taref = $res[$i]['data'];

										$dataF_taref = implode('/', array_reverse(explode('-', $data_taref)));
										$horaF_taref = date("H:i", strtotime($hora_taref));
										?>
                                <li>
                                    <a href="#">
                                        <div class="notification_desc">
                                            <p><i class="fa fa-calendar-o text-danger"
                                                    style="margin-right: 3px"></i><?php echo $titulo_taref ?></p>
                                            <p><span><?php echo $dataF_taref ?> às <?php echo $horaF_taref ?></span></p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                    <hr style="margin:2px">
                                </li>
                                <?php }} ?>


                                <li>
                                    <div class="notification_bottom">
                                        <a href="index.php?pagina=agenda">Ver toda Agenda</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>


                    <div class="clearfix"> </div>
                </div>
                <!--notification menu end -->
                <div class="clearfix"> </div>
            </div>
            <div class="header-right">




                <div class="profile_details">
                    <ul>
                        <li class="dropdown profile_details_drop">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">
                                    <span class="prfil-img"><img src="images/perfil/<?php echo $foto_usu ?>" alt=""
                                            width="50px" height="50px"> </span>
                                    <div class="user-name">
                                        <p><?php echo $nome_user ?></p>
                                        <span><?php echo $nivel_usu ?></span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                            <ul class="dropdown-menu drp-mnu">

                                <li> <a href="#" data-toggle="modal" data-target="#modalPerfil"><i
                                            class="fa fa-user"></i> Perfil</a> </li>

                                <li class="<?php echo $esc_todos ?>"> <a href="#" data-toggle="modal"
                                        data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li>

                                <li> <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <!-- //header-ends -->




        <!-- main content start-->
        <div id="page-wrapper">
            <?php 					
				require_once($pagina.'.php');	
				?>
        </div>






    </div>

    <!-- new added graphs chart js-->

    <script src="js/Chart.bundle.js"></script>
    <script src="js/utils.js"></script>



    <!-- Classie -->
    <!-- for toggle left push menu script -->
    <script src="js/classie.js"></script>
    <script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
        showLeftPush = document.getElementById('showLeftPush'),
        body = document.body;

    showLeftPush.onclick = function() {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };


    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
    </script>
    <!-- //Classie -->
    <!-- //for toggle left push menu script -->

    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->

    <!-- side nav js -->
    <script src='js/SidebarNav.min.js' type='text/javascript'></script>
    <script>
    $('.sidebar-menu').SidebarNav()
    </script>
    <!-- //side nav js -->

    <!-- for index page weekly sales java script -->
    <script src="js/SimpleChart.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>
    <!-- //Bootstrap Core JavaScript -->

    <!-- Mascaras JS -->
    <script type="text/javascript" src="js/mascaras.js"></script>
    <!-- Ajax para funcionar Mascaras JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

</body>

</html>




<!-- Modal -->
<div class="modal fade" id="modalPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Editar Dados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-usu">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome_usu" value="<?php echo $nome_user ?>"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>CPF</label>
                                <input type="text" class="form-control" id="cpf_usu" name="cpf_usu"
                                    value="<?php echo $cpf_user ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email_usu"
                                    value="<?php echo $email_usu ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Senha</label>
                                <input type="password" class="form-control" name="senha_usu"
                                    value="<?php echo $senha_usu ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" onChange="carregarImg2();" id="foto-usu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="divImg">
                                <img src="images/perfil/<?php echo $foto_usu ?>" width="100px" id="target-usu">
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="id_usu" value="<?php echo $id_usuario ?>">
                    <input type="hidden" name="foto_usu" value="<?php echo $foto_usu ?>">

                    <small>
                        <div id="msg-usu" align="center" class="mt-3"></div>
                    </small>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Editar Dados</button>
                </div>
            </form>

        </div>
    </div>
</div>








<!-- Modal CONFIG-->
<div class="modal fade" id="modalConfig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Configurações do Sistema Imobiliário</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-config">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" name="nome_config"
                                    value="<?php echo $nome_sistema ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Whatsapp</label>
                                <input type="text" class="form-control" name="tel_config" id="tel_config"
                                    value="<?php echo $tel_sistema ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telefone Fixo</label>
                                <input type="text" class="form-control" name="tel_fixo_config" id="tel_fixo_config"
                                    value="<?php echo $tel_fixo_sistema ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email_config"
                                    value="<?php echo $email_adm ?>" required>
                            </div>
                        </div>



                    </div>



                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nome Banco</label>
                                <input type="text" class="form-control" name="nome_banco_config"
                                    value="<?php echo $nome_banco_imob ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tipo Conta</label>
                                <select class="form-control" name="tipo_conta_config" id="tipo_conta_config"
                                    value="<?php echo $tipo_conta_imob ?>">
                                    <option value="Corrente">Corrente</option>
                                    <option value="Poupança">Poupança</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Agência</label>
                                <input type="text" class="form-control" name="agencia_config" id="agencia_config"
                                    value="<?php echo $agencia_imob ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Conta</label>
                                <input type="text" class="form-control" name="conta_config" id="conta_config"
                                    value="<?php echo $conta_imob ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nome Beneficiário</label>
                                <input type="text" class="form-control" name="nome_beneficiario_config"
                                    id="nome_beneficiario_config" value="<?php echo $nome_beneficiario_imob ?>">
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo Chave</label>
                                <select class="form-control" name="tipo_chave_pix_config" id="tipo_chave_pix_config"
                                    value="<?php echo $tipo_chave_pix_imob ?>">
                                    <option value="CNPJ">CNPJ</option>
                                    <option value="CPF">CPF</option>
                                    <option value="E-mail">E-mail</option>
                                    <option value="Telefone">Telefone</option>
                                    <option value="Código">Código</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Chave Pix</label>
                                <input type="text" class="form-control" name="chave_pix_config" id="chave_pix_config"
                                    value="<?php echo $chave_pix_imob ?>">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CRECI Imobiliária</label>
                                <input type="text" class="form-control" name="creci_config"
                                    value="<?php echo $creci_imob ?>">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CNPJ Imobiliária</label>
                                <input type="text" class="form-control" name="cnpj_config" id="cnpj_config"
                                    value="<?php echo $cnpj_imob ?>">
                            </div>
                        </div>

                    </div>




                    <div class="row">



                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Endereço</label>
                                <input type="text" class="form-control" name="end_config"
                                    value="<?php echo $end_sistema ?>">
                            </div>
                        </div>



                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Relatório PDF/HTML</label>
                                <select class="form-control" name="rel" required>
                                    <option <?php if($relatorio_pdf == 'pdf'){ ?>selected <?php } ?> value="pdf">PDF
                                    </option>
                                    <option <?php if($relatorio_pdf == 'html'){ ?>selected <?php } ?> value="html">HTML
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Comissão Venda IMOB</label>
                                <input maxlength="5" type="text" class="form-control" name="comissao_venda_imob_config"
                                    value="<?php echo @$comissao_venda_imob ?>" placeholder="Ex: 4 ou 4.5">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Comissão Venda Corretor</label>
                                <input maxlength="5" type="text" class="form-control"
                                    name="comissao_venda_corretor_config"
                                    value="<?php echo @$comissao_venda_corretor ?>" placeholder="Ex: 4 ou 4.5">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Comissão Aluguél IMOB</label>
                                <input maxlength="5" type="text" class="form-control"
                                    name="comissao_aluguel_imob_config" value="<?php echo @$comissao_aluguel_imob ?>"
                                    placeholder="Ex: 4 ou 4.5">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Comissão Aluguél Corretor</label>
                                <input maxlength="5" type="text" class="form-control"
                                    name="comissao_aluguel_corretor_config"
                                    value="<?php echo @$comissao_aluguel_corretor ?>"
                                    placeholder="Comissão para Primeiro Aluguél">
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" onChange="carregarImgLogo();" id="foto-logo">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="divImgLogo">
                                <img src="../imagens/<?php echo $logo ?>" width="100px" id="target-logo">
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Favicon (ico)</label>
                                <input type="file" name="favicon" onChange="carregarImgFavicon();" id="foto-favicon">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="divImgFavicon">
                                <img src="../imagens/<?php echo $favicon ?>" width="20px" id="target-favicon">
                            </div>
                        </div>





                    </div>


                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Img Relatório (*jpg) 200x60</label>
                                <input type="file" name="imgRel" onChange="carregarImgRel();" id="foto-rel">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="divImgRel">
                                <img src="../imagens/<?php echo $logo_rel ?>" width="100px" id="target-rel">
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>QRCode <small>(*jpg) Min 200x200</small></label>
                                <input type="file" name="imgQRCode" onChange="carregarImgQRCode();" id="foto-QRCode">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div id="divImgQRCode">
                                <img src="../imagens/<?php echo $qr_code_pix_imob ?>" width="80px" id="target-QRCode">
                            </div>
                        </div>

                    </div>


                    <small>
                        <div id="msg-config" align="center" class="mt-3"></div>
                    </small>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Editar Dados</button>
                </div>
            </form>

        </div>
    </div>
</div>






<!-- Modal Rel Fin -->
<div class="modal fade" id="RelFin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Relatório Financeiro
                    <small>(
                        <a href="#" onclick="datas('1980-01-01', 'tudo-Fin', 'Fin')">
                            <span style="color:#000" id="tudo-Fin">Tudo</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Fin', 'Fin')">
                            <span id="hoje-Fin">Hoje</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Fin', 'Fin')">
                            <span style="color:#000" id="mes-Fin">Mês</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Fin', 'Fin')">
                            <span style="color:#000" id="ano-Fin">Ano</span>
                        </a>
                        )</small>



                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="rel/financeiro_class.php" target="_blank">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Fin"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Fin"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Movimentações em:</label>
                                <select class="form-control " name="local_filtro">
                                    <option value="">Tudo</option>
                                    <option value="Caixa">Caixa</option>
                                    <option value="Cartão de Débito">Cartão de Débito</option>
                                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                                    <option value="Boleto">Boleto</option>

                                    <?php 
										$query = $pdo->query("SELECT * FROM contas_banco order by nome asc");
										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}

												?>
                                    <option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?>
                                    </option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Entrada / Saídas</label>
                                <select class="form-control" name="tipo_mov" style="width:100%;">
                                    <option value="">Tudo</option>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saída">Saída</option>
                                </select>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>

        </div>
    </div>
</div>






<!-- Modal Rel Comissões -->
<div class="modal fade" id="RelCom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Relatório Comissões
                    <small>(
                        <a href="#" onclick="datas('1980-01-01', 'tudo-Com', 'Com')">
                            <span style="color:#000" id="tudo-Com">Tudo</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Com', 'Com')">
                            <span id="hoje-Com">Hoje</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Com', 'Com')">
                            <span style="color:#000" id="mes-Com">Mês</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Com', 'Com')">
                            <span style="color:#000" id="ano-Com">Ano</span>
                        </a>
                        )</small>



                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="rel/comissoes_class.php" target="_blank">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Com"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Com"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Corretor</label>
                                <select class="form-control sel12" name="corretor" style="width:100%;">

                                    <?php 									
										if($nivel_usu == 'Corretor'){
											$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' order by nivel asc");
										}else{
											echo '<option value="">Todos</option>';
											$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Administrador' or nivel = 'Corretor' order by nivel asc");
										}

										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}

												?>
                                    <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pago / Pendentes</label>
                                <select class="form-control sel12" name="pago" style="width:100%;">
                                    <option value="">Todas</option>
                                    <option value="Não">Pendentes</option>
                                    <option value="Sim">Pagas</option>
                                </select>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>

        </div>
    </div>
</div>







<!-- Modal Rel Vendas -->
<div class="modal fade" id="RelVen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Relatório de Vendas
                    <small>(
                        <a href="#" onclick="datas('1980-01-01', 'tudo-Ven', 'Ven')">
                            <span style="color:#000" id="tudo-Ven">Tudo</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Ven', 'Ven')">
                            <span id="hoje-Ven">Hoje</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Ven', 'Ven')">
                            <span style="color:#000" id="mes-Ven">Mês</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Ven', 'Ven')">
                            <span style="color:#000" id="ano-Ven">Ano</span>
                        </a>
                        )</small>



                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="rel/vendas_class.php" target="_blank">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Ven"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Ven"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Corretor</label>
                                <select class="form-control sel13" name="corretor" style="width:100%;">

                                    <?php 									
										if($nivel_usu == 'Corretor'){
											$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' order by nivel asc");
										}else{
											echo '<option value="">Todos</option>';
											$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Administrador' or nivel = 'Corretor' order by nivel asc");
										}

										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}

												?>
                                    <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Concluídas / Pendentes</label>
                                <select class="form-control sel13" name="pago" style="width:100%;">
                                    <option value="">Todas</option>
                                    <option value="Não">Pendentes</option>
                                    <option value="Sim">Concluídas</option>
                                </select>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>

        </div>
    </div>
</div>







<!-- Modal Rel Alugueis -->
<div class="modal fade" id="RelAlu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Relatório de Aluguéis
                    <small>(
                        <a href="#" onclick="datas('1980-01-01', 'tudo-Alu', 'Alu')">
                            <span style="color:#000" id="tudo-Alu">Tudo</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Alu', 'Alu')">
                            <span id="hoje-Alu">Hoje</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Alu', 'Alu')">
                            <span style="color:#000" id="mes-Alu">Mês</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Alu', 'Alu')">
                            <span style="color:#000" id="ano-Alu">Ano</span>
                        </a>
                        )</small>



                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="rel/alugueis_class.php" target="_blank">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Alu"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Alu"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Corretor</label>
                                <select class="form-control sel14" name="corretor" style="width:100%;">

                                    <?php 									
										if($nivel_usu == 'Corretor'){
											$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario' order by nivel asc");
										}else{
											echo '<option value="">Todos</option>';
											$query = $pdo->query("SELECT * FROM usuarios where nivel = 'Administrador' or nivel = 'Corretor' order by nivel asc");
										}

										$res = $query->fetchAll(PDO::FETCH_ASSOC);
										for($i=0; $i < @count($res); $i++){
											foreach ($res[$i] as $key => $value){}

												?>
                                    <option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>

        </div>
    </div>
</div>







<!-- Modal Rel Contas Pagar -->
<div class="modal fade" id="RelPagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Relatório de Contas à Pagar
                    <small>(
                        <a href="#" onclick="datas('1980-01-01', 'tudo-Pag', 'Pag')">
                            <span style="color:#000" id="tudo-Pag">Tudo</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Pag', 'Pag')">
                            <span id="hoje-Pag">Hoje</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Pag', 'Pag')">
                            <span style="color:#000" id="mes-Pag">Mês</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Pag', 'Pag')">
                            <span style="color:#000" id="ano-Pag">Ano</span>
                        </a>
                        )</small>



                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="rel/pagar_class.php" target="_blank">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Pag"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Pag"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Contas</label>
                                <select class="form-control" name="tipo" style="width:100%;">
                                    <option value="">Todas</option>
                                    <option value="Repasse Aluguél">Repasse Aluguél</option>
                                    <option value="Comissão">Comissões</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Concluídas / Pendentes</label>
                                <select class="form-control" name="pago" style="width:100%;">
                                    <option value="">Todas</option>
                                    <option value="Não">Pendentes</option>
                                    <option value="Sim">Concluídas</option>
                                </select>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>

        </div>
    </div>
</div>







<!-- Modal Rel Contas Receber -->
<div class="modal fade" id="RelReceb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Relatório de Contas à Receber
                    <small>(
                        <a href="#" onclick="datas('1980-01-01', 'tudo-Rec', 'Rec')">
                            <span style="color:#000" id="tudo-Rec">Tudo</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Rec', 'Rec')">
                            <span id="hoje-Rec">Hoje</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Rec', 'Rec')">
                            <span style="color:#000" id="mes-Rec">Mês</span>
                        </a> /
                        <a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Rec', 'Rec')">
                            <span style="color:#000" id="ano-Rec">Ano</span>
                        </a>
                        )</small>



                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="rel/receber_class.php" target="_blank">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Inicial</label>
                                <input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Rec"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Rec"
                                    value="<?php echo date('Y-m-d') ?>" required>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipo Contas</label>
                                <select class="form-control" name="tipo" style="width:100%;">
                                    <option value="">Todas</option>
                                    <option value="Aluguél">Aluguél</option>
                                    <option value="Venda">Venda</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Concluídas / Pendentes</label>
                                <select class="form-control" name="pago" style="width:100%;">
                                    <option value="">Todas</option>
                                    <option value="Não">Pendentes</option>
                                    <option value="Sim">Concluídas</option>
                                </select>
                            </div>
                        </div>



                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar Relatório</button>
                </div>
            </form>

        </div>
    </div>
</div>





<script type="text/javascript">
$(document).ready(function() {
    $('.sel12').select2({
        dropdownParent: $('#RelCom')
    });

    $('.sel13').select2({
        dropdownParent: $('#RelVen')
    });

    $('.sel14').select2({
        dropdownParent: $('#RelAlu')
    });
});
</script>

<script type="text/javascript">
function datas(data, id, campo) {

    var data_atual = "<?=$data_atual?>";
    var separarData = data_atual.split("-");
    var mes = separarData[1];
    var ano = separarData[0];

    var separarId = id.split("-");

    if (separarId[0] == 'tudo') {
        data_atual = '2100-12-31';
    }

    if (separarId[0] == 'ano') {
        data_atual = ano + '-12-31';
    }

    if (separarId[0] == 'mes') {
        if (mes == 1 || mes == 3 || mes == 5 || mes == 7 || mes == 8 || mes == 10 || mes == 12) {
            data_atual = ano + '-' + mes + '-31';
        } else if (mes == 4 || mes == 6 || mes == 9 || mes == 11) {
            data_atual = ano + '-' + mes + '-30';
        } else {
            data_atual = ano + '-' + mes + '-28';
        }

    }

    $('#dataInicialRel-' + campo).val(data);
    $('#dataFinalRel-' + campo).val(data_atual);

    document.getElementById('hoje-' + campo).style.color = "#000";
    document.getElementById('mes-' + campo).style.color = "#000";
    document.getElementById(id).style.color = "blue";
    document.getElementById('tudo-' + campo).style.color = "#000";
    document.getElementById('ano-' + campo).style.color = "#000";
    document.getElementById(id).style.color = "blue";
}
</script>


<script type="text/javascript">
function carregarImg2() {
    var target = document.getElementById('target-usu');
    var file = document.querySelector("#foto-usu").files[0];

    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        target.src = "";
    }
}
</script>



<script type="text/javascript">
$("#form-usu").submit(function() {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "editar-dados.php",
        type: 'POST',
        data: formData,

        success: function(mensagem) {
            $('#msg-usu').text('');
            $('#msg-usu').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
                location.reload();
            } else {

                $('#msg-usu').addClass('text-danger')
                $('#msg-usu').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>



<style type="text/css">
.select2-selection__rendered {
    line-height: 36px !important;
    font-size: 16px !important;
    color: #666666 !important;

}

.select2-selection {
    height: 36px !important;
    font-size: 16px !important;
    color: #666666 !important;

}
</style>




<script type="text/javascript">
function carregarImgLogo() {
    var target = document.getElementById('target-logo');
    var file = document.querySelector("#foto-logo").files[0];

    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        target.src = "";
    }
}
</script>




<script type="text/javascript">
function carregarImgFavicon() {
    var target = document.getElementById('target-favicon');
    var file = document.querySelector("#foto-favicon").files[0];

    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        target.src = "";
    }
}
</script>



<script type="text/javascript">
function carregarImgRel() {
    var target = document.getElementById('target-rel');
    var file = document.querySelector("#foto-rel").files[0];

    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        target.src = "";
    }
}
</script>



<script type="text/javascript">
function carregarImgQRCode() {
    var target = document.getElementById('target-QRCode');
    var file = document.querySelector("#foto-QRCode").files[0];

    var reader = new FileReader();

    reader.onloadend = function() {
        target.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);

    } else {
        target.src = "";
    }
}
</script>





<script type="text/javascript">
$("#form-config").submit(function() {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: "editar-config.php",
        type: 'POST',
        data: formData,

        success: function(mensagem) {
            $('#msg-config').text('');
            $('#msg-config').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
                location.reload();
            } else {

                $('#msg-config').addClass('text-danger')
                $('#msg-config').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});
</script>