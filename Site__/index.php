<?php
    
    session_start();
    include_once('controller/Conexao/Conexao.php');
    ob_start();

?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - LocalTech</title>
    <link rel="stylesheet" href="view/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="view/assets/css/style.css">
    <link rel="stylesheet" href="view/assets/icons/FontAwesome/css/all.css">
    <link rel="stylesheet" href="view/assets/icons/Iconscout/css/line.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="view/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="view/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="view/assets/img/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="view/assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="view/assets/js/index.umd.min.js"></script>
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
            <a href="index.php" class="logo">
                LocalTech
            </a>
            <div class="navigation">
                <div class="nav-items">
                    <div class="nav-close-btn">                        
                    </div>
                    <a class="active" href="index.php">
                        Inicio
                    </a>
                    <a href="view/pages/Servicos/servicos.php">
                        Serviços
                    </a>
                    <a href="view/pages/Postagens/explorar.php">
                        Postagens
                    </a>
                    <a href="view/pages/Contato/contato.php">
                        Contato
                    </a>
                    <a href="view/pages/QuemSomos/quemsomos.php">
                        Quem Somos
                    </a>
                    <?php

                        if((isset($_SESSION['id_cliente'])) AND (isset($_SESSION['nome_cliente']))){
                            echo "<a href='view/pages/Login/login.php'>
                                    Perfil
                                </a>";
                        }
                        else if((isset($_SESSION['id_tecnico'])) AND (isset($_SESSION['nome_tecnico']))){
                            echo "<a href='view/pages/Login/login.php'>
                                    Perfil
                                </a>";
                        }
                        else if((isset($_SESSION['id_assistencia'])) AND (isset($_SESSION['nome_assistencia']))){
                            echo "<a href='view/pages/Login/login.php'>
                                    Perfil
                                </a>";
                            
                        }
                        else{
                            echo "<a href='view/pages/Login/login.php'>
                                    Iniciar Sessão
                                </a>";
                        }

                    ?>                    
                </div>
            </div>
            <div class="nav-menu-btn"></div>
        </div>
    </header>

    <!--=======Home section=======-->
    <section class="home flex-center" id="inicio">
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
                    Cuidando do seu desktop por você.
                </h3>
                <p>
                    Encontre soluções para os problemas em seu desktop.
                </p>
                <a href="view/pages/Servicos/servicos.php" class="btn">
                    Serviços
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
            <div class="home-img">
                <img src="view/assets/images/LocalTech.svg">
            </div>
        </div>
        <a href="#sobrenos" class="scroll-down">
            Arraste Para Baixo&nbsp;&nbsp;
            <i class="fas fa-arrow-down"></i>
        </a>
    </section>

    <!--=======About section=======-->
    <section class="about section" id="sobrenos">
        <div class="container flex-center">
            <h1 class="section-title-01">
                Sobre Nós
            </h1>
            <h2 class="section-title-02">
                Sobre Nós
            </h2>
            <div class="content flex-center">
                <div class="about-img">
                    <img src="view/assets/img/images/e-lixo-qual-e-o-impacto-do-seu-lixo-eletronico.jpg">
                </div>
                <div class="about-info">
                    <div class="description">
                        <!-- <h3>
                            LocalTech
                        </h3> -->
                        <h4>
                            Por que <span>estamos aqui?</span>
                        </h4>
                        <p>
                            Você sabia que o Brasil é um dos maiores produtores de lixo eletrônico da América Latina e o quinto maior produtor de e-lixo do mundo?
                            <br><br>
                            <span>LocalTech</span> foi concebida em resposta aos inúmeros problemas que surgiram em decorrência da inadequação do descarte de lixo eletrônico.
                            <br><br>
                            Um site dedicado a auxiliar no reparo de computadores desktop, reduzindo assim a quantidade de lixo que é desnecessária.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=======Skills section=======-->
    <section class="skills section" id="vantagens">
        <div class="container flex-center">
            <h1 class="section-title-01">
                Vantagens
            </h1>
            <h2 class="section-title-02">
                Vantagens
            </h2>
            <div class="content">
                <div class="skills-description">
                    <h3>
                        Porque utilizar o LocalTech?
                    </h3>
                </div>
                <div class="skills-info">
                    <div class="experience-card">
                        <div class="upper">
                            <h3>
                                Notícias
                            </h3>
                            <h5>
                                Fique por dentro das novidades
                            </h5>
                        </div>
                        <div class="hr">
                        </div>
                        <h4>
                            <label>
                                <i class="uil uil-newspaper icon_skill"></i>
                            </label>
                        </h4>
                        <p>
                            Com artigos tecnológicos, você pode aprender sobre novas tecnologias, novos hardwares no mercado e obter respostas para perguntas sobre possíveis problemas em seu desktop.
                        </p>
                    </div>
                    <div class="experience-card">
                        <div class="upper">
                            <h3>
                                Sustentabilidade
                            </h3>
                            <h5>
                                Ajude o meio ambiente
                            </h5>
                        </div>
                        <div class="hr">
                        </div>
                        <h4>
                            <label>
                                <i class="uil uil-trees icon_skill"></i>
                            </label>
                        </h4>
                        <p>
                            Ao reparar seu desktop, você evita que componentes eletrônicos se tornem "e-lixo".  Esse tipo de resíduo é extremamente prejudicial ao meio ambiente e, consequentemente aos seres vivos.
                        </p>
                    </div>
                    <div class="experience-card">
                        <div class="upper">
                            <h3>
                                Segurança
                            </h3>
                            <h5>
                                Seus dados sempre seguros
                            </h5>
                        </div>
                        <div class="hr">
                        </div>
                        <h4>
                            <label>
                                <i class="uil uil-shield-check icon_skill"></i>
                            </label>
                        </h4>
                        <p>
                            Quando consertamos os equipamentos de nossos clientes, garantimos total privacidade dos dados, não interferindo em seus computadores sem seu conhecimento ou permissão.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=======Portfolio section=======-->
    <section class="portfolio section" id="quemsomos">
            
        <!--=======Get-in-touct=======-->
        <div class="get-in-touch sub-section">
            <div class="container">
                <div class="content flex-center">
                    <div class="contact-card flex-center">
                        <div class="title">
                            <h4>
                                Cadastre-se
                            </h4>
                            <h3>
                                E descubra
                            </h3>
                            <h2>
                                muito mais
                            </h2>
                        </div>
                        <div class="contact-btn">
                        <?php

                            if((isset($_SESSION['id_cliente'])) AND (isset($_SESSION['nome_cliente']))){
                                echo "<a href='view/pages/Login/login.php' class='btn'>
                                        Perfil
                                        <i class='fas fa-arrow-turn-right'></i>
                                    </a>";
                            }
                            else if((isset($_SESSION['id_tecnico'])) AND (isset($_SESSION['nome_tecnico']))){
                                echo "<a href='view/pages/Login/login.php' class='btn'>
                                        Perfil
                                        <i class='fas fa-arrow-turn-right'></i>
                                    </a>";
                            }
                            else{
                                echo "<a href='view/pages/Login/login.php' class='btn'>
                                        Iniciar Sessão
                                        <i class='fas fa-arrow-turn-right'></i>
                                    </a>";
                            }                        

                        ?>
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
                        echo "<a href='view/pages/Login/login.php'>
                                Perfil
                            </a>";
                    }
                    else if((isset($_SESSION['id_tecnico'])) AND (isset($_SESSION['nome_tecnico']))){
                        echo "<a href='view/pages/Login/login.php'>
                                Perfil
                            </a>";
                    }
                    else if((isset($_SESSION['id_assistencia'])) AND (isset($_SESSION['nome_assistencia']))){
                        echo "<a href='view/pages/Login/login.php'>
                                Perfil
                            </a>";
                    }
                    else{
                        echo "<a href='view/pages/Login/login.php'>
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
                        <a href="view/pages/Servicos/servicos.php">
                            Serviços
                        </a>
                    </li>
                    <li>
                        <a href="view/pages/Postagens/explorar.php">
                            Postagens
                        </a>
                    </li>
                    <li>
                        <a href="view/pages/Contato/contato.php">
                            Contato
                        </a>
                    </li>
                    <li>
                        <a href="view/pages/QuemSomos/quemsomos.php">
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
                ©Etec Dra. Ruth Cardoso. Todos os direitos reservados.
            </p>
            <div style="text-align: center;">
                <a href="view/admin/LoginAdmin.php">
                    @
                </a>
            </div>
        </div>
    </footer>

    <!--=======External scripts=======-->
    <script src="view/assets/js/swiper-bundle.min.js"></script>
    <script src="view/assets/js/main.js"></script>

  </body>
</html>
