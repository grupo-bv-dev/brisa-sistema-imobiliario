<?php 
require_once("cabecalho.php");
?>


<!--SlideShow Carroussel -->
<?php 
 $res = $pdo->query("SELECT * FROM imoveis where status = 'Para Venda' or status = 'Para Aluguél' order by id desc limit 4");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          if(@count($dados) > 0){
 ?>
<section class="hero-section">
    <div class="container">
        <div class="hs-slider owl-carousel">

            <?php        

          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id']; 
            $status = $dados[$i]['status']; 
                        $imagem = $dados[$i]['img_banner']; 
                        $valor = $dados[$i]['valor']; 
                        $titulo = $dados[$i]['titulo']; 
                        $bairro = $dados[$i]['bairro']; 
                        $area = $dados[$i]['area_total']; 
                        $quartos = $dados[$i]['quartos']; 
                        $banheiros = $dados[$i]['banheiros']; 
                        $garagens = $dados[$i]['garagens']; 
                        $corretor = $dados[$i]['corretor']; 
                        $url = $dados[$i]['url']; 

            $res_2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);            
            $nomeBairro = $dados_2[0]['nome'];

             if ($status == "Para Venda") {
                            $classe = "c-red";
                        } else {
                            $classe = "";
              }

            ?>



            <a href="imovel-<?php echo $url ?>">
                <div class="hs-item set-bg" data-setbg="sistema/painel/images/imoveis/<?php echo $imagem ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hc-inner-text">
                                <div class="hc-text">
                                    <h4><?php echo $titulo ?></h4>
                                    <p><span class="icon_pin_alt"></span> <?php echo $nomeBairro ?></p>
                                    <div class="label <?php echo $classe ?>"><?php echo $status ?></div>
                                    <h5>R$ <?php echo number_format($valor, 2, ',', '.'); ?><span>
                                            <?php if ($status == "Para Aluguel") {
                                        echo "<span>/mês</span>" ;
                                    }?></span></h5>
                                </div>
                                <div class="hc-widget">
                                    <ul>
                                        <li><i class="fa fa-object-group"></i> <?php echo $area ?>m²</li>
                                        <li><i class="fa fa-bathtub"></i> <?php echo $banheiros ?></li>
                                        <li><i class="fa fa-bed"></i> <?php echo $quartos ?></li>
                                        <li><i class="fa fa-automobile"></i> <?php echo $garagens ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <?php 
             }        
                
            ?>


        </div>
    </div>
</section>
<?php 
 }else{
            echo 'Não possui nenhum imóvel Cadastrado!';
             }
 ?>
<!-- Final do Slideshow -->


<!--Filtro por Imóveis -->
<section class="search-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="section-title">
                    <h4>Qual imóvel está Procurando?</h4>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="change-btn">
                    <div class="cb-item">
                        <label for="cb-rent" class="active">
                            Compra
                            <input type="radio" id="cb-rent">
                        </label>
                    </div>
                    <div class="cb-item">
                        <label for="cb-sale">
                            Aluguel
                            <input type="radio" id="cb-sale">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-form-content">
            <form action="lista-imoveis.php" method="GET" class="filter-form">
                <input type="hidden" id="status-form" name="status-form">
                <select class="sm-width" name="cidade" id="cidade">
                    <?php
                         
                $res = $pdo->query("SELECT * from cidades order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id_item = $dados[$i]['id'];  
                  $nome_item = $dados[$i]['nome'];
                     echo '<option value="'.$id_item.'">'.$nome_item.'</option>';
                 
                }
                ?>

                </select>

                <span id="listar-bairros"></span>
                <input value="teste" type="hidden" name="txtcidade" id="txtcidade">



                <select class="sm-width" name="condicao">
                    <option value="">Imóvel Status</option>
                    <option value="Novo">Novo</option>
                    <option value="Planta">Planta</option>
                    <option value="Usado">Usado</option>
                </select>
                <select class="sm-width" name="tipo">
                    <option value="">Tipo do Imóvel</option>
                    <?php
                         
                $res = $pdo->query("SELECT * from tipos order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id_item = $dados[$i]['id'];  
                  $nome_item = $dados[$i]['nome'];
                     echo '<option value="'.$id_item.'">'.$nome_item.'</option>';
                 
                }
                ?>
                </select>
                <select class="sm-width" name="quartos">
                    <option value="">Número de Quartos</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="mais">Mais de 5</option>
                </select>
                <select class="sm-width" name="garagem">
                    <option value="">Vagas de Garagem</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="mais">Mais de 5</option>
                </select>


                <div class="room-size-range-wrap sm-width">
                    <div class="price-text">
                        <label for="roomsizeRange">Tamanho m²:</label>
                        <input type="text" id="roomsizeRange" name="area" readonly>
                        <input type="hidden" id="tamanhoMenor" name="tamanhoMenor">
                        <input type="hidden" id="tamanhoMaior" name="tamanhoMaior">
                    </div>
                    <div id="roomsize-range" class="slider"></div>

                </div>


                <div id="priceCompra" class="price-range-wrap sm-width">
                    <div class="price-text">
                        <label for="priceRange">Valor:</label>
                        <input type="text" id="priceRange" name="valorCompra" readonly>
                        <input type="hidden" id="valorMenorCompra" name="valorMenorCompra">
                        <input type="hidden" id="valorMaiorCompra" name="valorMaiorCompra">
                    </div>
                    <div id="price-range" class="slider"></div>
                </div>


                <div id="priceAluguel" class="price-range-wrap sm-width">
                    <div class="price-text">
                        <label for="priceRange">Valor:</label>
                        <input type="text" id="priceRangeAluguel" name="valorAluguel" readonly>
                        <input type="hidden" id="valorMenorAluguel" name="valorMenorAluguel">
                        <input type="hidden" id="valorMaiorAluguel" name="valorMaiorAluguel">
                    </div>
                    <div id="price-range-aluguel" class="slider"></div>
                </div>



                <button type="submit" class="search-btn sm-width">Buscar</button>
            </form>
        </div>

    </div>
</section>
<!-- Final dos Filtros por imóveis -->





<!-- Property Section Begin -->
<section class="property-section latest-property-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="section-title">
                    <h4>ULTIMOS IMÓVEIS</h4>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="property-controls">
                    <ul>
                        <li id="listarTodos" data-filter="all">Todos</li>

                        <?php
                         
                $res = $pdo->query("SELECT * FROM tipos order by id asc limit 5");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id_item = $dados[$i]['id'];  
                  $nome_item = $dados[$i]['nome'];
                     echo "<li><a class='text-secondary' href='lista-imoveis.php?tipo-imovel=" . $id_item . "'>" . $nome_item . "</a></li>";
                 
                }
                ?>


                    </ul>
                </div>
            </div>
        </div>



        <div class="row property-filter">

            <!-- Início dos cards -->


            <?php 
          $res = $pdo->query("SELECT * FROM imoveis where status = 'Para Venda' or status = 'Para Aluguél' order by id desc limit 6");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
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
                         $url = $dados[$i]['url'];


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



            <div class="col-lg-4 col-md-6 mix all house">
                <div class="property-item">
                    <a href="imovel-<?php echo $url ?>">
                        <div class="pi-pic set-bg" data-setbg="sistema/painel/images/imoveis/<?php echo $imagem ?>">
                            <div class="label <?php echo $classe ?>"><?php echo $status ?></div>
                        </div>
                    </a>
                    <div class="pi-text">
                        <a title="Enviar Mensagem" href="" data-toggle="modal" data-target="#modalMensagemImovel"
                            class="heart-icon"><span class="icon_heart_alt"></span></a>
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
                                    <a class="cor-verde-template-link" target="_blank"
                                        href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefoneCorretor ?>"><i
                                            class="fa fa-whatsapp"></i> <?php echo $telefoneCorretor ?> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php  } ?>

            <!-- Fim dos Cards com os Imóveis -->

        </div>
    </div>
</section>
<!-- Property Section End -->






<!-- Chooseus Section Begin -->
<section class="chooseus-section spad set-bg" data-setbg="img/chooseus/chooseus-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="chooseus-text">
                    <div class="section-title">
                        <h4>Invista no seu futuro!</h4>
                    </div>
                    <p>Seus Sonhos, Nosso Comando: Transmitindo a ideia de que o sistema está pronto para atender às
                        necessidades e desejos dos clientes.</p>
                </div>
                <div class="chooseus-features">
                    <div class="cf-item">
                        <div class="cf-pic">
                            <img src="img/chooseus/chooseus-icon-1.png" alt="">
                        </div>
                        <div class="cf-text">
                            <h5>Os Melhores Imóveis</h5>
                            <p>Ajudamos você a encontrar uma nova casa, oferecendo um imóvel inteligente.</p>
                        </div>
                    </div>
                    <div class="cf-item">
                        <div class="cf-pic">
                            <img src="img/chooseus/chooseus-icon-2.png" alt="">
                        </div>
                        <div class="cf-text">
                            <h5>Sua compra Facilitada</h5>
                            <p>Encontre um agente que conheça melhor o seu mercados</p>
                        </div>
                    </div>
                    <div class="cf-item">
                        <div class="cf-pic">
                            <img src="img/chooseus/chooseus-icon-3.png" alt="">
                        </div>
                        <div class="cf-text">
                            <h5>Corretores Especializados</h5>
                            <p>Milhões de casas e apartamentos nas suas cidades favoritas</p>
                        </div>
                    </div>
                    <div class="cf-item">
                        <div class="cf-pic">
                            <img src="img/chooseus/chooseus-icon-4.png" alt="">
                        </div>
                        <div class="cf-text">
                            <h5>Melhores Localizações</h5>
                            <p>Cadastre-se agora e venda ou alugue seus próprios imóveis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Chooseus Section End -->





<!-- Feature Property Section Begin -->
<section class="feature-property-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 p-0">
                <div class="feature-property-left">
                    <div class="section-title">
                        <h4>Categorias</h4>
                    </div>
                    <ul>

                        <?php 
                            $res_2 = $pdo->query("SELECT * FROM tipos order by id asc limit 6 ");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC); 
            for ($i=0; $i < count($dados_2); $i++) { 
            foreach ($dados_2[$i] as $key => $value) {
            }           
            $nomeTipo2 = $dados_2[$i]['nome'];
            $idTipo2 = $dados_2[$i]['id'];

             echo "<li><a class='linkul' href='lista-imoveis.php?tipo-imovel=" . $idTipo2 . "'>" . $nomeTipo2 . "</a></li>";

                      }   ?>

                    </ul>
                    <a class="linkcategorias" href="imoveis.php">Ver Todos Imóveis</a>
                </div>
            </div>
            <div class="col-lg-8 p-0">
                <div class="fp-slider owl-carousel">

                    <?php 
          $res = $pdo->query("SELECT * FROM imoveis where status = 'Para Venda' or status = 'Para Aluguél' order by id desc limit 5");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
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
                        $url = $dados[$i]['url'];


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

                    <!-- Inicio do Carrousel -->
                    <a href="imovel-<?php echo $url ?>">
                        <div class="fp-item set-bg" data-setbg="sistema/painel/images/imoveis/<?php echo $imagem ?>">
                            <div class="fp-text">
                                <h5 class="title"><?php echo $titulo ?></h5>
                                <p><span class="icon_pin_alt"></span> <?php echo $nomeBairro ?></p>
                                <div class="label <?php echo $classe ?>"><?php echo $status ?></div>
                                <h5>R$ <?php echo number_format($valor, 2, ',', '.'); ?><span><?php if ($status=="Para Aluguel") {
                                    echo "<span>/mes</span>";
                                } 
                                ?></span></h5>
                                <ul>
                                    <li><i class="fa fa-object-group"></i> <?php echo $area ?>m²</li>
                                    <li><i class="fa fa-bathtub"></i> <?php echo $banheiros ?></li>
                                    <li><i class="fa fa-bed"></i> <?php echo $quartos ?></li>
                                    <li><i class="fa fa-automobile"></i> <?php echo $garagens ?></li>
                                </ul>
                            </div>
                        </div>
                    </a>


                    <?php  }
                       ?>

                    <!-- Final do Carrousel -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Feature Property Section End -->



<!-- Team Section Begin -->
<section class="team-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div class="section-title">
                    <h4>Corretores Destaques</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="team-btn">
                    <a href="corretores.php"><i class="fa fa-user"></i> Ver Todos</a>
                </div>
            </div>
        </div>
        <div class="row">

            <?php 
          $res = $pdo->query("SELECT * FROM usuarios where (nivel = 'Corretor' or nivel = 'Administrador') and ativo = 'Sim' order by id desc limit 3");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $id = $dados[$i]['id_func'];

             $res_2 = $pdo->query("SELECT * FROM funcionarios where id = '$id'");
            $dados_2 = $res_2->fetchAll(PDO::FETCH_ASSOC);
            if(@count($dados_2)> 0) {

                        $nome = $dados_2[0]['nome'];                       
                        $telefone = $dados_2[0]['telefone'];
                        $email = $dados_2[0]['email'];                        
                        $imagem = $dados_2[0]['foto'];
               
           }else{
            $nome = $dados[$i]['nome'];                     
            $telefone = $tel_sistema;
            $email = $dados[$i]['email'];                      
            $imagem = $dados[$i]['foto'];
           }        

            
                        

            ?>


            <div class="col-md-4">
                <div class="ts-item">
                    <div class="ts-text">
                        <img src="sistema/painel/images/perfil/<?php echo $imagem ?>" alt="">
                        <h5><?php echo $nome ?></h5>
                        <span><i class="fa fa-whatsapp mr-1"></i><?php echo $telefone ?></span>
                        <div class="ts-social">
                            <a target="_blank" title="<?php echo $email ?>" href="<?php echo $email ?>"><i
                                    class="fa fa-envelope-o"></i></a>
                            <a target="_blank" title="<?php echo $telefone ?>"
                                href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $telefone ?>"><i
                                    class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <?php  }
               ?>


        </div>
    </div>
</section>
<!-- Team Section End -->


<!-- Categories Section Begin -->
<section class="categories-section">
    <div class="cs-item-list">

        <?php 
          $res = $pdo->query("SELECT * FROM tipos order by id asc limit 5");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }
           
                $nomeTipo3 = $dados[$i]['nome'];
                $idTipo3 = $dados[$i]['id'];                
                $imagemTipo = $dados[$i]['foto'];

                $res2 = $pdo->query("SELECT * FROM imoveis where tipo = '$idTipo3' and (status = 'Para Venda' or status = 'Para Aluguél')");
                $dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
                $quantImoveis = @count($dados2);

            ?>


        <a class='linkul' href='lista-imoveis.php?tipo-imovel=<?php echo $idTipo3 ?>'>
            <div class="cs-item set-bg" data-setbg="sistema/painel/images/tipos/<?php echo $imagemTipo ?>">
                <div class="cs-text">
                    <h5><?php echo $nomeTipo3 ?></h5>
                    <span><?php echo $quantImoveis ?> imóveis</span>
                </div>
            </div>
        </a>


        <?php  }  ?>

    </div>
</section>
<!-- Categories Section End -->


<!-- Testimonial Section Begin -->
<section class="testimonial-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>O que nosso cliente diz?</h4>
                </div>
            </div>
        </div>
        <div class="row testimonial-slider owl-carousel">
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>"Agradeço ao Inova Tech por tornar a busca pelo meu novo lar tão tranquila. O sistema
                            facilitou a visualização dos imóveis disponíveis e a comunicação com os corretores.”</p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="img/testimonial-author/ta-1.jpg" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Carlos Oliveira</h5>
                            <span>Corretor de imóveis</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>“O Inova Tech é uma ferramenta essencial para o meu negócio. Consigo atender meus clientes em
                            várias plataformas de forma rápida e eficiente.”</p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="img/testimonial-author/ta-2.jpg" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Paulo Rodrigues</h5>
                            <span>Corretor de imóveis</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-item">
                    <div class="ti-text">
                        <p>“A integração do Inova Tech com o meu sistema de gestão financeira foi um diferencial. Agora
                            consigo controlar minhas finanças com mais precisão.”</p>
                    </div>
                    <div class="ti-author">
                        <div class="ta-pic">
                            <img src="img/testimonial-author/ta-1.jpg" alt="">
                        </div>
                        <div class="ta-text">
                            <h5>Danilo Santos</h5>
                            <span>Corretor de imóveis</span>
                            <div class="ta-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial Section End -->



<?php 
include_once("rodape.php");
 ?>



<!-- Modal Mensagem Imovel-->
<div class="modal fade" data-backdrop="static" id="modalMensagemImovel" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                    <small>
                        <div id="mensagem" class="mt-3"> </div>
                    </small>
                    <div align="right">
                        <button id="btn-enviar" class="site-btn">Enviar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>





<!-- Script para mostrar div do slider aluguel/compra -->
<script type="text/javascript">
$(document).ready(function() {
    $('#priceAluguel').hide();
    $('#priceCompra').show();
    document.getElementById('status-form').value = "Venda";

    $('#cb-rent').click(function(event) {
        $('#priceAluguel').hide();
        $('#priceCompra').show();
        document.getElementById('status-form').value = "Venda";
    })

    $('#cb-sale').click(function(event) {
        $('#priceAluguel').show();
        $('#priceCompra').hide();
        document.getElementById('status-form').value = "Aluguel";
    })

})
</script>



<!-- Listar todos os imoveis apos abrir modal -->
<script type="text/javascript">
$('#btn-cancelar-dismiss').click(function(event) {
    $('#listarTodos').click();
})


$('#btn-enviar').click(function(event) {
    $('#listarTodos').click();
})
</script>




<!--AJAX PARA LISTAR OS DADOS DO BAIRRO NO SELECT -->
<script type="text/javascript">
$(document).ready(function() {
    document.getElementById('txtcidade').value = document.getElementById('cidade').value;
    listarBairros();

})
</script>

<script type="text/javascript">
function listarBairros() {

    $.ajax({
        url: "listar-bairros.php",
        method: "post",
        data: $('form').serialize(),
        dataType: "html",
        success: function(result) {

            $('#listar-bairros').html(result);
        }
    })
}
</script>


<!-- Script para buscar pelo select -->
<script type="text/javascript">
$('#cidade').change(function() {
    document.getElementById('txtcidade').value = $(this).val();
    listarBairros();
})
</script>





<!--AJAX PARA CHAMAR O ENVIAR.PHP DO EMAIL -->
<script type="text/javascript">
$(document).ready(function() {

    $('#btn-enviar').click(function(event) {
        $('#mensagem').addClass('text-info')
        $('#mensagem').text("Enviando!!")
        event.preventDefault();

        $.ajax({
            url: "enviar.php",
            method: "post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() === 'Enviado com Sucesso!') {

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
                    $('#mensagem').text(
                        "Você precisa está com o site hospedado para fazer envio de Emails"
                    )

                }



            },

        })
    })
})
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="js/mascara.js"></script>