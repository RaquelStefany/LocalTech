<?php
    
    session_start();
    include_once('../../../../controller/Conexao/Conexao.php');
    ob_start();

    if((!isset($_SESSION['id_cliente'])) AND (!isset($_SESSION['nome_cliente']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../../Login/login-cliente.php");
    }

    require_once('../../../../controller/Dados/Cliente.php');
    
    require_once('../../../../controller/Status/Cliente.php');

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/icons/LineAwesome/css/line-awesome.css">
    <link rel="stylesheet" href="../../../assets/css/dashboard-users.css">
    <title><?php echo $LinhaDados['Nome'] . " " . $LinhaDados['Sobrenome']; ?> - Reports - LocalTech</title>
    <link rel="stylesheet" href="../../../assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <link rel="stylesheet" href="../../../assets/css/dados.css">
    <link rel="stylesheet" href="../../../assets/icons/FontAwesome/css/all.css">
    <link rel="stylesheet" href="../../../assets/icons/Iconscout/css/line.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
    <link rel="mask-icon" href="../../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="../../../assets/js/index.umd.min.js"></script>
    <script src="../../../assets/js/jquery.min.js"></script>
    <script src="../../../assets/js/jquery.mask.min.js"></script>
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
            <a href="../../../../index.php" class="logo">
                LocalTech
            </a>
            <div class="navigation">
                <div class="nav-items">
                    <div class="nav-close-btn">
                    </div>
                    <a href="../../../../index.php">
                        Inicio
                    </a>
                    <a href="../../Servicos/servicos.php">
                        Serviços
                    </a>
                    <a href="../../Postagens/explorar.php">
                        Postagens
                    </a>
                    <a href="../../Contato/contato.php">
                        Contato
                    </a>
                    <a href="../../QuemSomos/quemsomos.php">
                        Quem Somos
                    </a>
                    <?php
                        
                        require_once('../../../../controller/Verificacao/Login.php')

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
                <img src="../../../assets/img/favicon/android-chrome-512x512.png">
            </div>
        </div>
        <a href="#sobrenos" class="scroll-down">
            Arraste Para Baixo
            <i class="fas fa-arrow-down"></i>
        </a>
    </section>

    <div>

        <input type="checkbox" name="" id="user-menu-toggle">

        <div class="user-overlay">
            <label for="user-menu-toggle">
            </label>
        </div>

        <div class="user-sidebar">
            <div class="user-sidebar-container">
                <br>
                <div class="user-sidebar-avartar">
                    <div>
                        <img src="../../../assets/images/ImagensPerfil/<?php echo $LinhaDados['Imagem']; ?>" alt=""
                            class="user-img">
                    </div>
                    <div class="avartar-info">
                        <div class="avartar-text">
                            <h4>
                                <?php echo $LinhaDados['Nome'] . " " . $LinhaDados['Sobrenome']; ?>
                            </h4>
                            <small>
                                <?php echo $LinhaDados['Email']; ?>
                            </small>
                        </div>
                        <a href="../../../../controller/Sair/Sair.php" style="color: red;"
                            class="las la-sign-out-alt"></a>
                    </div>
                </div>

                <div class="user-sidebar-menu">
                    <ul>
                        <li>
                            <a href="../dashboard-cliente.php">
                                <span class="las la-history"></span>
                                <span>
                                    Resumo
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="../Chat/tecnicos.php">
                                <span class="las la-comments"></span>
                                <span>
                                    Chat
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="../Atendimentos/atendimentos.php">
                                <span class="las la-clipboard-list"></span>
                                <span>
                                    Atendimentos
                                </span>
                            </a>
                        </li>
                        <!-- <li>
                        <a href="">
                            <span class="las la-star-half-alt"></span>
                            <span>
                                Avaliações
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="las la-sms"></span>
                            <span>
                                Respostas
                            </span>
                        </a>
                    </li> -->
                        <li>
                            <a href="../conta-cliente.php">
                                <span class="las la-user"></span>
                                <span>
                                    Conta
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="Reportar.php" class="user-active">
                                <span class="las la-exclamation-triangle"></span>
                                <span>
                                    Reportar
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="user-main-content">
            <div class="user-header">
                <div class="user-header-title-wrapper">
                    <label for="user-menu-toggle">
                        <span class="las la-bars"></span>
                    </label>
                    <div class="user-header-title">
                        <h1>
                            Relatórios
                        </h1>
                    </div>
                </div>
            </div>

            <main class="user-main">
                <section class="user-section">
                    <div>
                        <?php
                            require_once('../../../../controller/Reportar/Cliente/Respostas.php');
                        ?>
                    </div>
                </section>
            </main>

        </div>

        <!--=======External scripts=======-->
        <script>
        $('#tipo').on('change', function() {
            var tipo = $('#tipo').val();
            if (tipo == "tecnico") {
                $("#tecnico").css("display", "unset");
                $("#assistencia").css("display", "none");
            } else {
                $("#assistencia").css("display", "unset");
                $("#tecnico").css("display", "none");
            }
        });
        </script>
        <script src="../../../assets/js/swiper-bundle.min.js"></script>
        <script src="../../../assets/js/main.js"></script>

</body>

</html>