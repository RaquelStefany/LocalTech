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
    <link rel="stylesheet" href="../../assets/css/atendimentos.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../../assets/js/charts.js"></script>

    <title>
        Atendimentos - Painel Administrador
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
                <a href="#">
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
                <a href="Atendimentos.php" class="active">
                    <span class="material-icons-sharp">
                        receipt_long
                    </span>
                    <h3>
                        Atendimentos
                    </h3>
                </a>
                <!-- <a href="#">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>
                        Mensagens
                    </h3>
                    <span class="message-count">
                        26
                    </span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        newspaper
                    </span>
                    <h3>
                        Postagens
                    </h3>
                </a> -->
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
                Atendimentos
            </h1>

            <div class="recent-orders">
                <table>
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Código
                            </th>
                            <th>
                                Técnico
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
                            <th>
                                Detalhes
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require('../../../../controller/Atendimentos/Admin/Atendimentos.php')
                        ?>
                    </tbody>
                </table>
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
                    Detalhes
                </h2>
                <div class="item online">
                    <div class="icon" style="background: #73bfec;">
                        <span class="material-icons-sharp">
                            comment
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                ATENDIMENTOS
                            </h3>
                            <small class="text-muted">
                                Total Atendimentos Realizados
                            </small>
                        </div>
                        <h3 id="at-chat">
                            Sem Dados
                        </h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            mark_unread_chat_alt
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                REABERTOS
                            </h3>
                            <small class="text-muted">
                                Total Atendimentos Reabertos
                            </small>
                        </div>
                        <h3 id="at-rea">
                            Sem Dados
                        </h3>
                    </div>
                </div>
                <br>
                <h2>
                    Últimas Atualizações
                </h2>
                <div class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            comment
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                CLIENTE<br>ATENDIDO
                            </h3>
                            <small class="text-muted">
                                Último Cliente Atendido
                            </small>
                        </div>
                        <h3 id="at-cli">
                            Sem Dados
                        </h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon" style="background: #bd73ec;">
                        <span class="material-icons-sharp">
                            mark_unread_chat_alt
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                TÉCNICO<br>ATENDENDO
                            </h3>
                            <small class="text-muted">
                                Último Técnico Atendendo
                            </small>
                        </div>
                        <h3 id="at-tec">
                            Sem Dados
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/index.js"></script>
    <script src="../../assets/js/updates-atendimentos.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>