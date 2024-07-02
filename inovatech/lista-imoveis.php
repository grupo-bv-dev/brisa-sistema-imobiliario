<?php 

include_once("sistema/conexao.php");
include_once("cabecalho.php");

 

//recuperar os dados da busca
    $status = @$_GET['status-form'];
    $cidade = @$_GET['cidade'];
    $bairro = @$_GET['bairro'];
    $condicao = @$_GET['condicao'];
    $tipo = @$_GET['tipo'];
    $quartos = @$_GET['quartos'];
    $garagens = @$_GET['garagens'];
    $areaInicio = @$_GET['tamanhoMenor'];
    $areaFinal = @$_GET['tamanhoMaior'];

    if ($status != null) {
        if ($status=="Venda") {
            $status = "Para Venda";
        } else {
            $status = "Para Aluguél";
        }

        if ($status=="Para Venda") {
            $valorInicio = @$_GET['valorMenorCompra'];
            $valorFinal = @$_GET['valorMaiorCompra'];
        } else {
            $valorInicio = @$_GET['valorMenorAluguel'];
            $valorFinal = @$_GET['valorMaiorAluguel'];
        }
    }

    
?>




<!-- Property Section Begin -->
<section class="property-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>IMÓVEIS ENCONTRADOS</h4>
                </div>
            </div>
        </div>
        <div class="row">


            <?php 

                if (@$_GET['tipo-imovel'] != null) {
                        
                        $idTipo = @$_GET['tipo-imovel'];
                        $res = $pdo->query("SELECT * FROM imoveis WHERE tipo = '$idTipo' and (status = 'Para Venda' or status = 'Para Aluguél') order by id desc ");
                       
                    } else {
                        if ($quartos=="mais" && $garagens=="mais") {
                            $res = $pdo->query("SELECT * FROM imoveis where status LIKE '%" . $status . "%' and cidade = '" . $cidade . "' and bairro LIKE '%" . $bairro . "%' and tipo LIKE '%" . $tipo . "%' and quartos >= 6 and garagens >= 6 and condicao LIKE '%" . $condicao . "%' and area_total >= '" . $areaInicio . "' and area_total <= '" . $areaFinal . "' and valor >= '" . $valorInicio . "' and valor <= '" . $valorFinal . "' order by id desc ");
                            

                        } else if ($quartos=="mais" && $garagens!="mais") {
                             $res = $pdo->query("SELECT * FROM imoveis where status LIKE '%" . $status . "%' and cidade = '" . $cidade . "' and bairro LIKE '%" . $bairro . "%' and tipo LIKE '%" . $tipo . "%' and quartos >= 6 and garagens LIKE '%" . $garagens . "%' and condicao LIKE '%" . $condicao . "%' and area_total >= '" . $areaInicio . "' and area_total <= '" . $areaFinal . "' and valor >= '" . $valorInicio . "' and valor <= '" . $valorFinal . "' order by id desc ");
                            

                        } else if ($quartos!="mais" && $garagens=="mais") {
                             $res = $pdo->query("SELECT * FROM imoveis where status LIKE '%" . $status . "%' and cidade = '" . $cidade . "' and bairro LIKE '%" . $bairro . "%' and tipo LIKE '%" . $tipo . "%' and quartos LIKE '%" . $quartos . "%' and garagens >= 6 and condicao LIKE '%" . $condicao . "%' and area_total >= '" . $areaInicio . "' and area_total <= '" . $areaFinal . "' and valor >= '" . $valorInicio . "' and valor <= '" . $valorFinal . "' order by id desc ");

                           

                        } else {
                             $res = $pdo->query("SELECT * FROM imoveis where status LIKE '%" . $status . "%' and cidade = '" . $cidade . "' and bairro LIKE '%" . $bairro . "%' and tipo LIKE '%" . $tipo . "%' and quartos LIKE '%" . $quartos . "%' and garagens LIKE '%" . $garagens . "%' and condicao LIKE '%" . $condicao . "%' and area_total >= '" . $areaInicio . "' and area_total <= '" . $areaFinal . "' and valor >= '" . $valorInicio . "' and valor <= '" . $valorFinal . "' order by id desc ");


                        }
                    }

                         
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
           if(@count($dados) == 0){
                echo '<span class="mb-4">Nenhum Imóvel com estas características foi encontrado!</span>';

              }

          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id']; 
            $status = $dados[$i]['status']; 
                        $imagem = $dados[$i]['img_principal']; 
                        $valor = $dados[$i]['valor']; 
                        $titulo = $dados[$i]['titulo']; 
                        $bairro = $dados[$i]['bairro']; 
                        $area = $dados[$i]['area_total']; 
                        $quartos = $dados[$i]['quartos']; 
                        $banheiros = $dados[$i]['banheiros']; 
                        $garagens = $dados[$i]['garagens']; 
                        $corretor = $dados[$i]['corretor'];


                         $res_2 = $pdo->query("SELECT * FROM usuarios where id = '$corretor'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);            
            $nomeCorretor = $dados_2[0]['nome'];
                            $id_func = $dados_2[0]['id_func'];
                            $imgCorretor = $dados_2[0]['foto'];

             $res_2 = $pdo->query("SELECT * FROM funcionarios where id = '$id_func'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
            if(@count($dados_2)> 0) {
               $telefoneCorretor = $dados_2[0]['telefone']; 
           }else{
            $telefoneCorretor = $tel_sistema; 
           }           


            $res_2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);            
            $nomeBairro = $dados_2[0]['nome'];

             if ($status == "Para Venda") {
                            $classe = "c-red";
                        } else {
                            $classe = "";
              }

             

            ?>

           

            <!-- Início dos cards -->

                             

           
            <div class="col-lg-4 col-md-6 mix all house">
                <div class="property-item">
                    <a href="imovel-<?php echo $url ?>">
                        <div class="pi-pic set-bg" data-setbg="sistema/painel/images/imoveis/<?php echo $imagem ?>">
                            <div class="label <?php echo $classe ?>"><?php echo $status ?></div>
                        </div>
                    </a>
                    <div class="pi-text">
                        <a title="Enviar Mensagem" href="" data-toggle="modal" data-target="#modalMensagemImovel" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <div class="pt-price">R$ <?php echo number_format($valor, 2, ',', '.'); ?>
                            <?php if ($status == "Para Aluguel") {
                                    echo "<span>/mes</span>";
                                }?>

                        </div>
                        <h5> <a href="imovel-<?php echo $url ?>"><?php echo $titulo ?></a></h5>
                        <p><span class="icon_pin_alt"></span> <?php echo $nomeBairro ?></p>
                        <ul>
                            <li><i class="fa fa-object-group"></i> <?php echo $area ?> m²</li>
                            <li><i class="fa fa-bathtub"></i> <?php echo $banheiros ?></li>
                            <li><i class="fa fa-bed"></i> <?php echo $quartos ?></li>
                            <li><i class="fa fa-automobile"></i> <?php echo $garagens ?></li>
                        </ul>
                        <div class="pi-agent">
                            <div class="pa-item">
                                <div class="pa-info">
                                    <img src="sistema/painel/images/perfil/<?php echo $imgCorretor ?>" alt="">
                                    <h6><?php echo $nomeCorretor ?></h6>
                                </div>
                                <div class="pa-text">
                                    <a class="cor-verde-template-link" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefoneCorretor ?>"><i class="fa fa-whatsapp"></i> <?php echo $telefoneCorretor ?> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php  }
           ?>



            <!-- Fim dos Cards com os Imóveis --> 


            <?php 
include_once("rodape.php");
 ?> 





<!-- Modal Mensagem Imovel-->
<div class="modal fade" data-backdrop="static" id="modalMensagemImovel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enviar Mensagem</h5>
                <button id="btn-cancelar-dismiss" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="cc-form">
                    <div class="group-input">
                        <input type="text" id="nome" name="nome" placeholder="Nome">
                        <input id="telefone" name="telefone" type="text" placeholder="Telefone">
                        <input type="email" id="email" name="email" placeholder="Email">

                    </div>
                    <textarea name="comentario" placeholder="Comentário"></textarea>

                     <small><div id="mensagem" class="mt-3"> </div></small>
                    <div align="right">
                        <button id="btn-enviar" class="site-btn">Enviar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<!--AJAX PARA CHAMAR O ENVIAR.PHP DO EMAIL -->
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#btn-enviar').click(function(event){
            $('#mensagem').addClass('text-info')
            $('#mensagem').text("Enviando!!")
            event.preventDefault();
            
            $.ajax({
                url: "enviar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem.trim() === 'Enviado com Sucesso!'){
                        
                        $('#mensagem').addClass('text-success')

                       
                        $('#nome').val('');
                        $('#telefone').val('');
                        $('#email').val('');
                        $('#comentario').val('');
                      
                        $('#mensagem').text(mensagem)
                        //$('#btn-fechar').click();
                        //location.reload();


                   } else {

                        $('#mensagem').addClass('text-danger')
                        $('#mensagem').text("Você precisa está com o site hospedado para fazer envio de Emails")
                       
                    }

                },
                
            })
        })
    })
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="js/mascara.js"></script>
