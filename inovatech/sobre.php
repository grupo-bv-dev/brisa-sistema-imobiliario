<?php 

include_once("sistema/conexao.php");
include_once("cabecalho.php");

 ?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section spad set-bg" data-setbg="img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <h4><?php echo $nome_sistema ?></h4>
                    <div class="bt-option">
                        <a href="./index.php"><i class="fa fa-home"></i> Home</a>
                        <span>Sobre</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- About Section Begin -->
<section class="about-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-text">
                    <div class="at-title">
                        <h3><small><b>Bem vindo a <?php echo $nome_sistema ?></b></small></h3>
                        <p>Entendemos suas necessidades e estamos comprometidos em oferecer o melhor serviço.</p>
                    </div>
                    <div class="at-feature">
                        <div class="af-item">
                            <div class="af-icon">
                                <img src="img/chooseus/chooseus-icon-1.png" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Os melhores imóveis</h6>
                                <p>Ajudamos você a encontrar uma nova casa, oferecendo um imóvel inteligente.</p>
                            </div>
                        </div>
                        <div class="af-item">
                            <div class="af-icon">
                                <img src="img/chooseus/chooseus-icon-2.png" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Sua compra facilitada</h6>
                                <p>Encontre um agente que conheça melhor o seu mercado</p>
                            </div>
                        </div>
                        <div class="af-item">
                            <div class="af-icon">
                                <img src="img/chooseus/chooseus-icon-3.png" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Corretores Especilizados</h6>
                                <p>Milhões de casas e apartamentos nas suas cidades favoritas</p>
                            </div>
                        </div>
                        <div class="af-item">
                            <div class="af-icon">
                                <img src="img/chooseus/chooseus-icon-4.png" alt="">
                            </div>
                            <div class="af-text">
                                <h6>Melhores Localizações</h6>
                                <p>Cadastre-se agora e venda ou alugue seus próprios imóveis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-pic set-bg" data-setbg="img/about-us.jpg">
                    <a href="https://www.youtube.com/watch?v=8EJ3zbKTWQ8" class="play-btn video-popup">
                        <i class="fa fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->


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




<!-- Testimonial Section Begin -->
<section class="testimonial-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h4>Alguns de nossos Clientes</h4>
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
                        <p>“A integração do Conta Azul com o meu sistema de gestão financeira foi um diferencial. Agora
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