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
    <link rel="stylesheet" href="../../assets/css/dados.css">
    <link rel="stylesheet" href="../../assets/modal/style.css">

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
        Técnicos - Painel Administrador
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
                <a href="Tecnicos.php" class="active">
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

        <main style="overflow-x: auto;">
            <h1>
                Técnicos
            </h1>
            <br>
            <form method="POST">
                <?php
                    require_once('../../../../controller/Remover/Admin/Verificacao/Tecnico.php');
                    require_once('../../../../controller/Selecionar/Admin/Dados/Selecionar/Tecnico.php');
                    require_once('../../../../controller/Atualizar/Admin/Selecionar/Tecnico.php');
                ?>
                <div style="width: 100%;text-align: -webkit-center;">
                    <div class="header_fixed">
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Imagem
                                    </th>
                                    <th>
                                        Nome
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Adicionado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require_once('../../../../controller/Selecionar/Admin/Tecnicos.php');
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="demo-modal" class="modal">
                    <div class="modal__conteudo">
                        <h1>
                            Remover Usuário
                        </h1>
                        <a href="Clientes.php" class="modal__fechar">
                            &times;
                        </a>
                        <br>
                        <h2>
                            Deseja realmente remover esse usuário?
                        </h2>
                        <p style="text-align: center;">
                            Essa ação não pode ser desfeita.
                        </p>
                        <br>
                        <br>
                        <div class="options">
                            <a href="../../../../controller/Remover/Admin/Tecnico.php" id="btnopr">
                                Remover
                            </a>
                            <a href="Tecnicos.php" id="btnopc">
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
                                    Inserir Técnico
                                </h3>
                            </div>
                        </div>
                    </a>
                    <button type="submit" name="Verificar" class="item offline" style="width: 100%;">                        
                        <div class="icon">
                            <span class="material-icons-sharp">
                                remove
                            </span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>
                                    Remover Técnico
                                </h3>
                            </div>
                        </div>
                    </button>
                    <button type="submit" name="Atualizar" class="item customers" style="width: 100%;">
                        <div class="icon">
                            <span class="material-icons-sharp">
                                update
                            </span>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>
                                    Atualizar Técnico
                                </h3>
                            </div>
                        </div>
                    </button>
                    <button type="submit" name="Selecionar" class="item add-product" style="width: 100%;">
                        <div>
                            <span class="material-icons-sharp">
                                assignment
                            </span>
                            <h3>
                                Ver Dados Técnicos
                            </h3>
                        </div>
                    </button>
                </form>
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