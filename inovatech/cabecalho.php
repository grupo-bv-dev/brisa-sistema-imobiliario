<?php
require_once("sistema/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $nome_sistema ?>">
    <meta name="keywords" content="Imóveis no bairro x, comprar casa em Belo Horizonte..">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $nome_sistema ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

    <link rel="icon" href="sistema/imagens/favicon.ico" type="image/x-icon">
</head>

<body>
    <!-- Page Preloder  -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Wrapper Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <span class="icon_close"></span>
        </div>
        <div class="logo">
            <a href="./index.php">
                <img src="sistema/imagens/logo.png" alt="">
            </a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="om-widget">
            <ul>
                <li><i class="icon_mail_alt"></i> <?php echo $email_adm ?></li>
               <li><a class="text-dark" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $tel_sistema; ?>"><i class="fa fa-whatsapp"></i> <?php echo $tel_sistema; ?></a></li>
            </ul>

             <div class="col-lg-2">
                             <form action="imovel-detalhes.php" method="get">
                                   
                                    <div class="container2">  
                                        <input class="busca" type="search" id="busca" name="id" placeholder="Id do Imóvel">
                                        <button class="btnbusca" type="submit"><i class="fa fa-search"></i></button>
                                    </div>

                                </form>
                        </div>

           
        </div>
        <div class="om-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-youtube-play"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
    </div>
    <!-- Offcanvas Menu Wrapper End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="hs-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="./index.php"> <img src="sistema/imagens/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ht-widget">
                            <ul>
                                <li><i class="icon_mail_alt"></i> <?php echo $email_adm ?></li>
                                  <li><a class="text-dark" target="_blank" href="http://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo $tel_sistema; ?>"><i class="fa fa-whatsapp"></i> <?php echo $tel_sistema; ?></a><span><?php echo $tel_fixo_sistema ?></span></li>
                            </ul>
                           

                        </div>
                    </div>

                     <div class="col-lg-2 d-none d-md-block">
                             <form action="imovel-detalhes.php" method="get">
                                   
                                    <div class="container2">  
                                        <input class="busca" type="search" id="busca" name="id" placeholder="Id do Imóvel">
                                        <button class="btnbusca" type="submit"><i class="fa fa-search"></i></button>
                                    </div>

                                </form>
                        </div>
                </div>
                <div class="canvas-open">
                    <span class="icon_menu"></span>
                </div>
            </div>
        </div>
        <div class="hs-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <nav class="nav-menu">
                            <ul>
                                <li ><a href="./index.php">Home</a></li>
                                    <li><a href="imoveis.php">Imóveis</a></li>
                                    <li><a href="corretores.php">Corretores</a></li>
                                    <li><a href="sobre.php">Sobre</a></li>

                                    <li><a href="contatos.php">Contatos</a></li>
                                     <li><a href="sistema" target="_blank">Login</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="hn-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->




    

<style type="text/css">
    .alerta{
      background-color: #1d9670; color:#FFF; padding:15px; font-family: Arial; text-align:center; position:fixed; bottom:0; width:100%; opacity: 80%; z-index: 100;
    }

     .alerta.hide{
       display:none !important;
    }

    .link-alerta{
      color:#f2f2f2; 
    }

    .link-alerta:hover{
      text-decoration: underline;
      color:#FFF;
    }

    .botao-aceitar{
      background-color: #e3e3e3; padding:7px; margin-left: 15px; border-radius: 5px; border: none; margin-top:3px;
    }

    .botao-aceitar:hover{
      background-color: #f7f7f7;
      text-decoration: none;

    }

  </style>

<div class="alerta hide">
  A gente guarda estatísticas de visitas para melhorar sua experiência de navegação, saiba mais em nossa  <a class="link-alerta" title="Ver as políticas de privacidade" data-toggle="modal" href="#modalTermosCondicoes"" >política de privacidade.</a>
  <a class="botao-aceitar text-dark" href="#">Aceitar</a>
</div>


<script>
        if (!localStorage.meuCookie) {
            document.querySelector(".alerta").classList.remove('hide');
        }

        const acceptCookies = () => {
            document.querySelector(".alerta").classList.add('hide');
            localStorage.setItem("meuCookie", "accept");
        };

        const btnCookies = document.querySelector(".botao-aceitar");

        btnCookies.addEventListener('click', acceptCookies);
    </script>
