<?php
    
    session_start();
    include_once('../../../../controller/Conexao/Conexao.php');
    ob_start();

    if((!isset($_SESSION['id_admin'])) AND (!isset($_SESSION['nome_admin']))){
        $_SESSION['msg'] = "<p style='color: red;'>Login necessário para acessar a página!</p>";
        header("Location: ../../LoginAdmin.php");
    }

    require_once('../../../../controller/Postagem/Admin/Dados.php');

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
    <link rel="stylesheet" href="../../../assets/vendor/Trumbowyg-main/dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="../../assets/css/postagem.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.mask.min.js"></script>
    <script src="../../assets/js/package/dist/chart.min.js"></script>
    <script src="../../../assets/vendor/Trumbowyg-main/dist/trumbowyg.min.js"></script>
    <script src="../../../assets/vendor/Trumbowyg-main/dist/langs/pt_br.min.js"></script>
    <script src="../../../assets/vendor/Trumbowyg-main/dist/plugins/upload/trumbowyg.upload.min.js"></script>
    <script src="../../../assets/vendor/Trumbowyg-main/dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <script src="../../../assets/vendor/jquery-resizable.min.js"></script>

    <title>
        Editar - Postagens - Painel Administrador
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
            <div class="div-form">

                <section class="form">
                    <div class="img-form">
                        <img src="../../../assets/images/Postagens/Capas/<?php echo $row_dados['Capa']; ?>" id="preview" style="border-radius: 0 !important;">
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <?php
                            require_once('../../../../controller/Postagem/Admin/Update.php');
                        ?>
                        <h1 hidden>
                        </h1>
                        <fieldset>
                            <div class="container-form">
                                <label>
                                    Capa da Postagem
                                </label>
                                <input type="file" name="imagem" id="imagem">
                            </div>
                        </fieldset>
                        <br>
                        <fieldset class="dadospost">
                            <div class="container-form nome">
                                <label>
                                    Título da Postagem
                                </label>
                                <input type="text" name="titulo" placeholder="Digite o Título da Postagem" value="<?php echo $row_dados['Titulo']; ?>" required>
                            </div>
                            <div class="container-form">
                                <label>
                                    Autor da Postagem
                                </label>
                                <input type="text" name="autor" placeholder="Digite o Autor da Postagem" value="<?php echo $row_dados['Autor']; ?>" required>
                            </div>
                        </fieldset>
                        <br>
                        <fieldset>
                            <div class="container-form">
                                <label>
                                    Conteúdo da Postagem
                                </label>
                                <div style="padding: 1% 1% 0%;">
                                    <textarea name="conteudo" id="trumbowyg-editor" cols="30" rows="10" placeholder="Digite o Conteúdo da Postagem" required><?php echo $row_dados['Conteudo']; ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset style="justify-content: right; display: flex; padding: 0px 10px;">
                            <input type="submit" value="Atualizar Postagem" id="cadastrar" name="Editar" class="btn-atualizar">
                        </fieldset>
                    </form>
                </section>

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
    <script src="../../assets/js/updates.js"></script>
    <script>
        AOS.init();
        $('#trumbowyg-editor').trumbowyg({
            lang: 'pt_br',
            btns: [
                    ['viewHTML'],
                    ['undo', 'redo'],
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['insertImage'],
                    ['upload'],
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen']
                    ],
            plugins: {
                upload: {
                    serverPath: '../../../../controller/Postagem/Admin/Upload.php',
                    fileFieldName: 'image',
                    headers: {
                        'Authorization': 'Client-ID xxxxxxxxxxxx'
                    },
                    urlPropertyName: 'file'
                },
                resizimg: {
                    minSize: 64,
                    step: 16,
                }
            }
        });
    </script>

</body>

</html>