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
    <link rel="stylesheet" href="../../assets/css/usuarios.css">
    <link rel="stylesheet" href="../../assets/css/inserir-assistencia.css">

    <!--=================== FAVICON ===================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../../../assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../../assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../../assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../../../assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../../../assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="../../assets/js/charts.js"></script>

    <title>
        Inserir - Assistência Técnica - Painel Administrador
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
                <a href="Assistencias.php" class="active">
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

        <main style="overflow-x: auto;height: 800px;">
            <h1>
                Inserir Assistência Técnica
            </h1>            
            <br>
            <div class="div-form">

                <section class="form">
                    <div class="img-form">
                        <img src="../../../assets/images/ImagensPerfil/usuario_sem_foto.png" id="preview">
                    </div>
                    <form method="POST" enctype="multipart/form-data">
                        <?php
                            require_once('../../../../controller/Inserir/Admin/Assistencia.php');
                            require_once('../../../../controller/Mensagens/Mensagem.php');
                        ?>
                        <h1 hidden>
                        </h1>
                        <fieldset>
                            <div class="container-form">
                                <label>
                                    Imagem
                                </label>
                                <input type="file" name="image" id="imagem">
                            </div>
                        </fieldset>
                        <br>
                        <h2 style="text-align: center;font-size: medium;">
                            Dados Pessoais
                        </h2>
                        <fieldset>
                            <div class="container-form nome">
                                <label>
                                    Nome
                                </label>
                                <input type="text" name="nome" placeholder="Nome" required>
                            </div>
                            <div class="container-form nome">
                                <label>
                                    Email
                                </label>
                                <input type="email" name="email" placeholder="Digite seu email" required>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="container-form nome">
                                <label>
                                    CNPJ
                                </label>
                                <input type="text" name="cnpj" onkeypress="$(this).mask('00.000.000/0000-00')" onblur="validarCNPJ(this)" placeholder="XX.XXX.XXX/XXXX-XX">
                            </div>
                            <div class="container-form nome">
                                <label>
                                    Telefone
                                </label>
                                <input type="tel" name="telefone" id="campo_celular" onkeypress="$(this).mask('(00) 0000-00009')" placeholder="(XX)XXXXX-XXXX" required>
                            </div>
                        </fieldset>
                        <br>
                        <h2 style="text-align: center;font-size: medium;">
                            Informações
                        </h2>
                        <fieldset>
                            <div class="container-form">
                                <label>
                                    Descrição
                                </label>
                                <input type="text" name="descricao" placeholder="Descrição" required>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="container-form end">
                                <label>
                                    Horário de Funcionamento
                                </label>                                
                                <input type="time" name="horaabrir" required>
                            </div>
                            <div class="container-form end">
                                <label>
                                    <br>
                                </label>                                
                                <input type="time" name="horafechar" required>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="container-form end">
                                <label>                                    
                                    Dias de Funcionamento
                                </label>
                                <select name="semanainicio" required>
                                    <option value="Domingo">Domingo</option>
                                    <option value="Segunda-Feira">Segunda-Feira</option>
                                    <option value="Terça-Feira">Terça-Feira</option>
                                    <option value="Quarta-Feira">Quarta-Feira</option>
                                    <option value="Quinta-Feira">Quinta-Feira</option>
                                    <option value="Sexta-Feira">Sexta-Feira</option>
                                    <option value="Sábado">Sábado</option>
                                </select>
                            </div>
                            <div class="container-form end">
                                <label>
                                    <br>
                                </label>
                                <select name="semanafinal" required>
                                    <option value="Domingo">Domingo</option>
                                    <option value="Segunda-Feira">Segunda-Feira</option>
                                    <option value="Terça-Feira">Terça-Feira</option>
                                    <option value="Quarta-Feira">Quarta-Feira</option>
                                    <option value="Quinta-Feira">Quinta-Feira</option>
                                    <option value="Sexta-Feira">Sexta-Feira</option>
                                    <option value="Sábado">Sábado</option>
                                </select>
                            </div>
                        </fieldset>
                        <br>
                        <h2 style="text-align: center;font-size: medium;">
                            Dados Residenciais
                        </h2>
                        <fieldset>
                            <div class="container-form">
                                <label>
                                    CEP
                                </label>
                                <input type="text" name="cep" id="cep" onkeypress="$(this).mask('00000-000')" placeholder="XXXXX-XXX" required>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="container-form nome">
                                <label>
                                    Logradouro
                                </label>
                                <input type="text" name="logradouro" id="logradouro" placeholder="Digite seu Endereço" required>
                            </div>
                            <div class="container-form nome">
                                <label>
                                    Número
                                </label>
                                <input type="number" name="numero" id="numero" placeholder="Número" required>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="container-form nome">
                                <label>
                                    Complemento
                                </label>
                                <input type="text" name="complemento" placeholder="Complemente seu endereço">
                            </div>
                            <div class="container-form nome">
                                <label>
                                    Bairro
                                </label>
                                <input type="text" name="bairro" id="bairro" placeholder="Digite seu Bairro" required>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="container-form nome">
                                <label>
                                    Cidade
                                </label>
                                <input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
                            </div>
                            <div class="container-form nome">
                                <label>
                                    Estado
                                </label>
                                <input type="text" name="uf" id="uf" placeholder="Estado" required>
                            </div>
                        </fieldset>
                        <br>
                        <h2 style="text-align: center;font-size: medium;">
                            Dados de Segurança
                        </h2>
                        <span id="password-status"></span>
                        <fieldset style="display: block; padding: 0;">
                            <div class="container-form">
                                <label>
                                    Senha
                                </label>
                                <input type="password" id="password" name="senha" placeholder="Insira uma Senha" onKeyUp="verificaForcaSenha();" required>
                            </div>
                        </fieldset>
                        <fieldset style="justify-content: right; display: flex; padding: 0px 10px;">
                            <input type="submit" value="Inserir" id="cadastrar" name="Inserir" class="btn-atualizar">
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
                <a href="Clientes.php" class="item online">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            add
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                Inserir Cliente
                            </h3>
                        </div>
                    </div>
                </a>
                <a href="Clientes.php" class="item offline">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            remove
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                Remover Cliente
                            </h3>
                        </div>
                    </div>
                </a>
                <a href="Clientes.php" class="item customers">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            update
                        </span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>
                                Atualizar Cliente
                            </h3>
                        </div>
                    </div>
                </a>
                <a href="Clientes.php" class="item add-product">
                    <div>
                        <span class="material-icons-sharp">
                            assignment
                        </span>
                        <h3>
                            Ver Dados Clientes
                        </h3>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <script src="../../assets/js/index.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="../../assets/js/updates.js"></script>
    <script src="../../assets/js/cnpj.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>