<?php
    
    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    ob_start();

    if((!isset($_SESSION['id_admin'])) AND (!isset($_SESSION['nome_admin']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../LoginAdmin.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--==================== UNICONS ====================-->
    <link rel="stylesheet" href="../assets/icons/Iconscout/css/line.css">
    <link href="../assets/fonts/MaterialSharp/font.css" rel="stylesheet">
    <link href="../assets/js/aos.js" rel="stylesheet">

    <!--==================== CSS ====================-->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../assets/js/charts.js"></script>

    <title>
        Dashboard - Painel Administrador
    </title>
</head>

    <div class="container">
        <aside>
            <div class="top">
                <a href="../../../index.php" class="logo">
                    <img src="../../assets/img/logo/logo.png">
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
                <a href="PainelAdmin.php" class="active">
                    <span class="material-icons-sharp">
                        grid_view
                    </span>
                    <h3>
                        Dashboard
                    </h3>
                </a>
                <a href="Trafego/Trafego.php">
                    <span class="material-icons-sharp">
                        insights
                    </span>
                    <h3>
                        Tráfego
                    </h3>
                </a>
                <a href="Cliente/Clientes.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>
                        Clientes
                    </h3>
                </a>
                <a href="Tecnico/Tecnicos.php">
                    <span class="material-icons-sharp">
                        manage_accounts
                    </span>
                    <h3>
                        Técnicos
                    </h3>
                </a>
                <a href="Assistencia/Assistencias.php">
                    <span class="material-icons-sharp">
                        maps_home_work
                    </span>
                    <h3>
                        Assistências Técnicas
                    </h3>
                </a>
                <a href="Atendimentos/Atendimentos.php">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>
                        Atendimentos
                    </h3>
                </a>
                <a href="Reports/Reports.php">
                    <span class="material-icons-sharp">
                        report
                    </span>
                    <h3>
                        Reports
                    </h3>
                </a>
                <a href="Noticias/Noticias.php">
                    <span class="material-icons-sharp">
                        newspaper
                    </span>
                    <h3>
                        Postagens
                    </h3>
                </a>
                <a href="../../../controller/Sair/Sair.php">
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
                Dashboard
            </h1>

            <div class="insights">
                <a href="Cliente/Clientes.php" class="sales">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>
                                Clientes Cadastrados
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div id="ult-cli">

                        </div>
                    </div>
                    <small class="text-muted">
                        Últimos adicionados
                    </small>
                </a>

                <a href="Tecnico/Tecnicos.php" class="expenses">
                    <span class="material-icons-sharp">
                        manage_accounts
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>
                                Técnicos Cadastrados
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div id="ult-tec">

                        </div>
                    </div>
                    <small class="text-muted">
                        Últimos adicionados
                    </small>
                </a>

                <a href="Assistencia/Assistencias.php" class="income">
                    <span class="material-icons-sharp">
                        maps_home_work
                    </span>
                    <div class="middle">
                        <div class="left">
                            <h3>
                                Assistências Técnicas Cadastradas
                            </h3>
                        </div>
                    </div>
                    <div>
                        <div id="ult-ass">

                        </div>
                    </div>
                    <small class="text-muted">
                        Últimos adicionados
                    </small>
                </a>
            </div>

            <div class="recent-orders">
                <h2>
                    Últimos Atendimentos Realizados
                </h2>
                <table>
                    <thead>
                        <tr>
                            <th>
                                OS
                            </th>
                            <th>
                                Inicio
                            </th>
                            <th>
                                Termino
                            </th>
                            <th>
                                Reaberto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require('../../../controller/Dados/Atendimentos/Ultimos-Atendimentos.php')
                        ?>
                    </tbody>
                </table>
                <a href="Atendimentos/Atendimentos.php">Ver Todos</a>
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
                        <img src="../../assets/img/images/user_1.png">
                    </div>
                </div>
            </div>

            <!-- <div class="recent-updates">
                <h2>
                    Últimas Postagens
                </h2>
                <div class="updates">
                    <div class="update" style="display: unset;">
                        <div class="message">
                            <h3>
                                Notícia 1
                            </h3>
                            <p>
                                <b>Alice Santos</b> publicou <b>Como atualizar seu windows corretamente</b>.
                                <br>
                                <small class="text-muted">
                                    2 Minutes Ago
                                </small>
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="update" style="display: unset;">
                        <div class="message">
                            <h3>
                                Notícia 2
                            </h3>
                            <p>
                                <b>Guilherme Lopes</b> publicou <b>Fundamentos básicos ao utilizar o Word</b>.
                                <br>
                                <small class="text-muted">
                                    7 Minutes Ago
                                </small>
                            </p>
                        </div>
                    </div>
                    <br>
                    <div class="update" style="display: unset;">
                        <div class="message">
                            <h3>
                                Notícia 3
                            </h3>
                            <p>
                                <b>Douglas Souza</b> publicou <b>Como solucionar a Tela Azul da Morte</b>.
                                <br>
                                <small class="text-muted">
                                    13 Minutes Ago
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="sales-analytics">
                <h2>
                    Usuários
                </h2>
                <div class="item online">
                    <div class="icon" style="background: #73bfec;">
                        <span class="material-icons-sharp">
                            record_voice_over
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                ONLINES
                            </h3>
                            <small class="text-muted">
                                Total Onlines
                            </small>
                        </div>
                        <h3 id="tt-only">
                            Sem Dados
                        </h3>
                    </div>
                </div>
                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            person_outline
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                CLIENTES
                            </h3>
                            <small class="text-muted">
                                Total Registrados
                            </small>
                        </div>
                        <h3 id="tt-cli">
                            Sem Dados
                        </h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            manage_accounts
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                TÉCNICOS
                            </h3>
                            <small class="text-muted">
                                Total Registrados
                            </small>
                        </div>
                        <h3 id="tt-tec">
                            Sem Dados
                        </h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            maps_home_work
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                ASSISTÊNCIAS TÉCNICAS
                            </h3>
                            <small class="text-muted">
                                Total Registrados
                            </small>
                        </div>
                        <h3 id="tt-ass">
                            Sem Dados
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/index.js"></script>
    <script src="../assets/js/updates-dashboard.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>