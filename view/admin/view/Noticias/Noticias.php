<?php
    
    session_start();
    include_once('../../../../controller/Conexao/Conexao.php');
    ob_start();

    if((!isset($_SESSION['id_admin'])) AND (!isset($_SESSION['nome_admin']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../../LoginAdmin.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--==================== UNICONS ====================-->
    <link rel="stylesheet" href="../../assets/icons/Iconscout/css/line.css">
    <link href="../../assets/fonts/MaterialSharp/font.css" rel="stylesheet">
    <link href="../../assets/js/aos.js" rel="stylesheet">

    <!--==================== CSS ====================-->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/modal/style.css">
    <link rel="stylesheet" href="../../assets/css/dados.css">
    <link rel="stylesheet" href="../../assets/css/postagens.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.mask.min.js"></script>
    <script src="../../assets/js/package/dist/chart.min.js"></script>

    <title>
        Postagens - Painel Administrador
    </title>
</head>

    <div class="container">
        <aside>
            <div class="top">
                <a href="../../../../index.php" class="logo">
                    <img src="../../../assets/img/logo/logo.png">
                    <h2>
                        Local<span class="primary">Tech</span>
                    </h2>
                </a>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="../PainelAdmin.php">
                    <span class="material-icons-sharp">
                        grid_view
                    </span>
                    <h3>
                        Dashboard
                    </h3>
                </a>
                <a href="../Trafego/Trafego.php">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>
                        Tráfego
                    </h3>
                </a>
                <a href="../Cliente/Clientes.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>
                        Clientes
                    </h3>
                </a>
                <a href="../Tecnico/Tecnicos.php">
                    <span class="material-icons-sharp">
                        manage_accounts
                    </span>
                    <h3>
                        Técnicos
                    </h3>
                </a>
                <a href="../Assistencia/Assistencias.php">
                    <span class="material-icons-sharp">
                        maps_home_work
                    </span>
                    <h3>
                        Assistências Técnicas
                    </h3>
                </a>
                <a href="../Atendimentos/Atendimentos.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>
                        Atendimentos
                    </h3>
                </a>
                <a href="../Reports/Reports.php">
                    <span class="material-icons-sharp">
                        report
                    </span>
                    <h3>
                        Reports
                    </h3>
                </a>
                <a href="Noticias.php" class="active">
                    <span class="material-icons-sharp">
                        newspaper
                    </span>
                    <h3>
                        Postagens
                    </h3>
                </a>
                <a href="../../../../controller/Sair/Sair.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>
                        Logout
                    </h3>
                </a>
            </div>
        </aside>

        <main>
            <h1>
                Postagens
            </h1>
            <br>
            <br>
            <div class="search-field">
                <input id="searchbar" style="width: 100%; background: transparent; text-align: center; font-size: large;" class="search" onkeyup="search_postagem()" type="text" name="search" placeholder="Procurar Postagem">
            </div>
            <script>
                // JavaScript code
                function search_postagem() {
                    let input = document.getElementById('searchbar').value
                    input=input.toLowerCase();
                    let x = document.getElementsByClassName('infodados');
                    
                    for (i = 0; i < x.length; i++) { 
                        if (!x[i].innerHTML.toLowerCase().includes(input)) {
                            x[i].style.display="none";
                        }
                        else {
                            x[i].style.display="table-row";
                        }
                    }
                }
            </script>
            <div class="recent-orders">                    
                <?php
                    require_once('../../../../controller/Postagem/Admin/Postagens.php');
                ?>
            </div>
            
            <div id="demo-modal" class="modal">
                <div class="modal__conteudo">
                    <h1>
                        Remover Postagem
                    </h1>
                    <a href="Noticias.php" class="modal__fechar">
                        &times;
                    </a>
                    <br>
                    <h2>
                        Deseja realmente remover essa postagem?
                    </h2>
                    <p style="text-align: center;">
                        Essa ação não pode ser desfeita.
                    </p>
                    <br>
                    <br>
                    <div class="options">
                        <a href="../../../../controller/Postagem/Admin/Remover/Remover.php" id="btnopr">
                            Remover
                        </a>
                        <a href="Noticias.php" id="btnopc">
                            Cancelar
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="theme-toggler">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>
                            Hey, <b>Administrador</b>
                        </p>
                        <small class="text-muted">
                            Admin
                        </small>
                    </div>
                    <div class="profile-photo">
                        <img src="../../../assets/img/images/user_1.png">
                    </div>
                </div>
            </div>

            <div class="sales-analytics">
                <h2>
                    Opções
                </h2>
                <a href="Inserir.php" class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            add
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                Inserir Postagem
                            </h3>
                        </div>
                    </div>
                </a>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            newspaper
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                Postagens
                            </h3>
                            <small class="text-muted">
                                Total Postagens no Sistema
                            </small>
                        </div>
                        <h3>
                            <?php
                                require('../../../../controller/Postagem/Admin/Grafico/Contagem.php');
                            ?>
                        </h3>
                    </div>
                </div>
                <div class="item online">
                    <div>
                        <canvas id="ChartsPostagemMes" style="margin-left: -15px;"></canvas>
                        <?php
                            require('../../../../controller/Postagem/Admin/Grafico/PostagensMes.php');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/index.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>