<?php
    
    session_start();
    include_once('../../controller/Conexao/Conexao.php');
    ob_start();

    require_once('../../controller/Verificacao/Admin.php');
    
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--==================== UNICONS ====================-->
    <link rel="stylesheet" href="assets/icons/Iconscout/css/line.css">

    <!--==================== CSS ====================-->
    <link rel="stylesheet" href="assets/css/admin.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="assets/js/jquery.min.js"></script>

    <title>Entrar - LocalTech</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    

    <!--==================== MAIN ====================-->
    <main class=" main ">
        <!--==================== HOME ====================-->
        <section class="aconta" id="home">
            <div class="container grid cconta">
                <section class="form login">
                    <header>Entrar</header>
                    <?php

                        require_once('../../controller/Selecionar/Admin.php');
                        require_once('../../controller/Mensagens/Mensagem.php');

                    ?>
                    <form method="POST">
                        <div class="error-txt">
                            Essa é a mensagem de erro!
                        </div>
                        <div class="field input">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Insira seu email">
                        </div>
                        <div class="field input">
                            <label>Senha</label>
                            <input type="password" name="senha" placeholder="Insira sua senha">
                            <i class="uil uil-eye"></i>
                        </div>
                        <div class="field button" style="background-color: #fff;">
                            <input type="submit" name="Entrar" value="Entrar">
                        </div>
                    </form>
                </section>
            </div>
        </section>

    <!--==================== MAIN JS ====================-->
    <script src="../assets/js/main.js"></script>
    <script src="assets/js/pass-show-hide.js"></script>
</body>

</html>