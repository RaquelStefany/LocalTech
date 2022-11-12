<?php
    
    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    ob_start();

?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quem Somos - LocalTech</title>
    <link rel="stylesheet" href="../../assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/icons/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../assets/icons/Iconscout/css/line.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    
    <script src="../../assets/js/index.umd.min.js"></script>
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.mask.min.js"></script>
  </head>
  <body>

    <!--=======Scroll to top button=======-->
    <div class="scrollToTop-btn flex-center">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!--=======Light/Dark theme button=======-->
    <div class="theme-btn flex-center">
        <i class="fas fa-moon"></i>
        <i class="fas fa-sun"></i>
    </div>

    <!--=======Header=======-->
    <header>
        <div class="nav-bar">
            <a href="../../../index.php" class="logo">
                LocalTech
            </a>
            <div class="navigation">
                <div class="nav-items">
                    <div class="nav-close-btn">                        
                    </div>
                    <a href="../../../index.php">
                        Inicio
                    </a>
                    <a href="../Servicos/servicos.php">
                        Serviços
                    </a>
                    <a href="../Postagens/explorar.php">
                        Postagens
                    </a>
                    <a href="../Contato/contato.php">
                        Contato
                    </a>
                    <a class="active" href="quemsomos.php">
                        Quem Somos
                    </a>
                    <?php
                        
                        require_once('../../../controller/Verificacao/Login.php')

                    ?>
                </div>
            </div>
            <div class="nav-menu-btn"></div>
        </div>
    </header>

    <!--=======Home section=======-->
    <section class="home flex-center" id="inicio" style="display: none;">
        <div class="home-container">
            <div class="media-icons">
                <a href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
            <div class="info">
                <h2 id="txt1">
                    
                </h2>
                <h3>
                    Cuidando de tudo por você.
                </h3>
                <p>
                    Encontre soluções para os problemas em seu desktop.
                </p>
                <a href="" class="btn">
                    Serviços
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
            <div class="home-img">
                <img src="../../assets/img/favicon/android-chrome-512x512.png">
            </div>
        </div>
        <a href="#sobrenos" class="scroll-down">
            Arraste Para Baixo
            <i class="fas fa-arrow-down"></i>
        </a>
    </section>

    <!--=======Portfolio section=======-->
    <section class="portfolio section" id="quemsomos">
        <div class="container flex-center">
            <h1 class="section-title-01">
                Quem Somos
            </h1>
            <h2 class="section-title-02">
                Quem Somos
            </h2>
            <div class="content">
                <div class="portfolio-list">
                    <div class="img-card-container">
                        <div class="img-card">
                            <div class="overlay">
                            </div>
                            <div class="info">
                                <h3>
                                    Web Design
                                </h3>
                                <span>
                                    Alice Souza Santos
                                </span>
                            </div>
                            <img src="../../assets/images/Desenvolvedores/Alice.jpeg">
                        </div>
                        <div class="portfolio-model flex-center">
                            <div class="portfolio-model-body">
                                <i class="fas fa-times portfolio-close-btn"></i>
                                <h3>
                                    Web Design
                                </h3>
                                <img src="../../assets/images/Desenvolvedores/Alice.jpeg">
                                <p>
                                    Designer de UI
                                </p>
                                <a href="https://www.instagram.com/alice_santoss013/" target="_blank" style="display: flex; align-items: center;">
                                    <i class="fab fa-instagram" style="font-size: 150%;"></i>
                                    &#160;@alice_santoss013
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="img-card-container">
                        <div class="img-card">
                            <div class="overlay">
                            </div>
                            <div class="info">
                                <h3>
                                    DBA
                                </h3>
                                <span>
                                    Douglas de Almeida Souza
                                </span>
                            </div>
                            <img src="../../assets/images/Desenvolvedores/Douglas.jpeg">
                        </div>
                        <div class="portfolio-model flex-center">
                            <div class="portfolio-model-body">
                                <i class="fas fa-times portfolio-close-btn"></i>
                                <h3>
                                    DBA
                                </h3>
                                <img src="../../assets/images/Desenvolvedores/Douglas.jpeg">
                                <p>
                                    Administrador de Banco de Dados
                                </p>
                                <a href="https://www.instagram.com/srd3co/" target="_blank" style="display: flex; align-items: center;">
                                    <i class="fab fa-instagram" style="font-size: 150%;"></i>
                                    &#160;@srd3co
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="img-card-container">
                        <div class="img-card">
                            <div class="overlay">
                            </div>
                            <div class="info">
                                <h3>
                                    Analista
                                </h3>
                                <span>
                                    Guilherme Lopes Silva do Nascimento
                                </span>
                            </div>
                            <img src="../../assets/images/Desenvolvedores/Guilherme.jpeg">
                        </div>
                        <div class="portfolio-model flex-center">
                            <div class="portfolio-model-body">
                                <i class="fas fa-times portfolio-close-btn"></i>
                                <h3>
                                    Analista
                                </h3>
                                <img src="../../assets/images/Desenvolvedores/Guilherme.jpeg">
                                <p>
                                    Analista de Sistemas
                                </p>
                                <a href="https://www.instagram.com/guilhermelopes392/" target="_blank" style="display: flex; align-items: center;">
                                    <i class="fab fa-instagram" style="font-size: 150%;"></i>
                                    &#160;@guilhermelopes392
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="img-card-container">
                        <div class="img-card">
                            <div class="overlay">
                            </div>
                            <div class="info">
                                <h3>
                                    Designer
                                </h3>
                                <span>
                                    Letícia Moreira Ferreira
                                </span>
                            </div>
                            <img src="../../assets/images/Desenvolvedores/Leticia.jpeg">
                        </div>
                        <div class="portfolio-model flex-center">
                            <div class="portfolio-model-body">
                                <i class="fas fa-times portfolio-close-btn"></i>
                                <h3>
                                    Designer
                                </h3>
                                <img src="../../assets/images/Desenvolvedores/Leticia.jpeg">
                                <p>
                                    Designer de Apresentações
                                </p>
                                <a href="https://www.instagram.com/lemoreirafrr/" target="_blank" style="display: flex; align-items: center;">
                                    <i class="fab fa-instagram" style="font-size: 150%;"></i>
                                    &#160;@lemoreirafrr
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="img-card-container">
                        <div class="img-card">
                            <div class="overlay">
                            </div>
                            <div class="info">
                                <h3>
                                    Back-End
                                </h3>
                                <span>
                                    Raquel Stefany Generoso Rodrigues
                                </span>
                            </div>
                            <img src="../../assets/images/Desenvolvedores/Raquel.jpeg">
                        </div>
                        <div class="portfolio-model flex-center" id="dados">
                            <div class="portfolio-model-body">
                                <i class="fas fa-times portfolio-close-btn"></i>
                                <h3>
                                    Back-End
                                </h3>
                                <img src="../../assets/images/Desenvolvedores/Raquel.jpeg">
                                <p>
                                    Desenvolvimento Back-End
                                </p>
                                <a href="https://www.instagram.com/raquelrodriguez013/" target="_blank" style="display: flex; align-items: center;">
                                    <i class="fab fa-instagram" style="font-size: 150%;"></i>
                                    &#160;@raquelrodriguez013
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=======Footer=======-->
    <footer>
        <div class="footer-container">
            <div class="about group">
                <h2>
                    LocalTech
                </h2>
                <p>
                    Cuidando de tudo por você.
                </p>
                <?php

                    if((isset($_SESSION['id_cliente'])) AND (isset($_SESSION['nome_cliente']))){
                        echo "<a href='../Login/login.php'>
                                Perfil
                            </a>";
                    }
                    else{
                        echo "<a href='../Login/login.php'>
                                Iniciar Sessão
                            </a>";
                    }                        

                ?>
            </div>
            <div class="hr">                
            </div>
            <div class="info group">
                <h3>
                    <br>
                </h3>
                <ul>
                    <li>
                        <a href="../Servicos/servicos.php">
                            Serviços
                        </a>
                    </li>
                    <li>
                        <a href="../Postagens/explorar.php">
                            Postagens
                        </a>
                    </li>
                    <li>
                        <a href="../Contato/contato.php">
                            Contato
                        </a>
                    </li>
                    <li>
                        <a href="quemsomos.php">
                            Quem Somos
                        </a>
                    </li>
                </ul>
            </div>
            <div class="hr">                
            </div>
            <div class="follow group">
                <h3>
                    Siga-nos
                </h3>
                <ul>
                    <li>
                        <a href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>            
        </div>
        <div class="footer-copyright group">
            <p>
                @Etec Dra. Ruth Cardoso. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <!--=======External scripts=======-->
    <script src="../../assets/js/swiper-bundle.min.js"></script>
    <script src="../../assets/js/main.js"></script>

  </body>
</html>
