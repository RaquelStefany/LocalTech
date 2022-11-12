<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    ob_start();
    require_once('../../../controller/Verificacao/Sessao.php');
    require('../../assets/vendor/autoload.php');

?>
<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente - Iniciar Sessão - LocalTech</title>
    <link rel="stylesheet" href="../../assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/logins.css">
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
                    <a href="../QuemSomos/quemsomos.php">
                        Quem Somos
                    </a>
                    <a class="active" href="login.php">
                        Iniciar Sessão
                    </a>
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

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <form class="sign-in-form" method="POST" enctype="multipart/form-data">
                    <?php

                        require_once('../../../controller/Selecionar/Cliente.php');
                        require_once('../../../controller/Mensagens/Mensagem.php');

                    ?>
                    <h2 class="title">
                        Iniciar Sessão
                    </h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" placeholder="Insira seu email*" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="senha" placeholder="Insira sua senha*" class="password" />
                        <i class="fa-solid fa-eye senha"></i>
                    </div>
                    <input type="submit" value="Entrar" name="Entrar" class="btn-login solid" />
                </form>

                <form class="sign-up-form" method="POST" enctype="multipart/form-data">
                    <h2 class="title">
                        Cadastrar
                    </h2>
                    <?php

                    require_once('../../../controller/Inserir/Cliente.php');
                    require_once('../../../controller/Mensagens/Mensagem.php');

                    ?>
                    <div class="register">
                        <h4>
                            Dados Pessoais
                        </h4>
                        <div class="input-field imagem" style="display: none;">
                            <i class="fas fa-image"></i>
                            <input type="file" name="image" id="imagem">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Nome*" name="nome" required />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Sobrenome*" name="sobrenome" required />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-envelope"></i>
                            <input type="email" placeholder="Email*" name="email" required />
                        </div>
                        <div class="tipoconta">
                            <input type="radio" name="pessoa" value="CPF" required>
                            <label style="color:grey;" for="age1">CPF*</label><span id="spacee"></span>
                            <input type="radio" name="pessoa" value="CNPJ" required>
                            <label style="color:grey;" for="age2">CNPJ*</label>
                        </div>
                        <div class="input-field" id="cpf" style="display: none;">
                            <i class="fas fa-id-card"></i>
                            <input id="campo_cpf" type="text" name="cpf" onkeypress="$(this).mask('000.000.000-00')"
                                onblur="validarCPF(this)" placeholder="CPF*" maxlength="20">
                        </div>
                        <div class="input-field" id="cnpj" style="display: none;">
                            <i class="fas fa-id-card"></i>
                            <input id="cnpj" type="text" name="cnpj" onkeypress="$(this).mask('00.000.000/0000-00')"
                                onblur="validarCNPJ(this)" placeholder="CNPJ*">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-calendar-days"></i>
                            <input type="date" name="datanascimento" min="1920-01-01" max="2010-12-31"
                                placeholder="Data de Nascimento" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="telefone" id="campo_celular"
                                onkeypress="$(this).mask('(00) 0000-00009')" placeholder="Telefone*" required />
                        </div>
                        <h4>
                            Dados Residenciais
                        </h4>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="text" name="cep" id="cep" onkeypress="$(this).mask('00000-000')"
                                placeholder="CEP*" required />
                        </div>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="text" name="logradouro" id="logradouro" placeholder="Logradouro*" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="number" name="numero" id="numero" placeholder="Número*" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="text" name="bairro" id="bairro" placeholder="Bairro*" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="text" name="complemento" placeholder="Complemento">
                        </div>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="text" name="cidade" id="cidade" placeholder="Cidade*" required>
                        </div>
                        <div class="input-field">
                            <i class="fas fa-house"></i>
                            <input type="text" name="uf" id="uf" placeholder="Estado*" required>
                        </div>
                        <h4>
                            Dados de Segurança
                        </h4>
                        <span id="password-status"></span>
                        <div class="input-field">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="senha" placeholder="Insira sua senha*"
                                class="password2" onKeyUp="verificaForcaSenha();" required />
                            <i class="fa-solid fa-eye senha2"></i>
                        </div>
                    </div>
                    <li class="">
                        <div class="learn-more-btn">
                            <input type="checkbox" name="termos" id="termos">
                            <label for="termos">Aceito os <span style="color: #6a59d1;">Termos de Uso</span></label>
                        </div>
                        <div class="service-modal flex-center termos">
                            <div class="service-modal-body" id="teste"
                                style="margin-block: auto; margin-top: 2%; height: 80vh; overflow: auto; padding-bottom: 10%; text-align: justify;">
                                <i class="fas fa-times modal-close-btn"></i>
                                <h3>
                                    Termos de Uso
                                </h3>
                                <p>
                                    Bem-vindo ao website Local Tech, onde todos os serviços são ofertados pela empresa
                                    “LocalTech”, cuja função é servir como um recurso para pessoas que encontram algum
                                    tipo de problema em seus respectivos aparelhos eletrônicos poderem ter contato
                                    direto com algum profissional especializado.
                                    <br>
                                    Avisamos previamente que ao acessar esse site você concorda tacitamente com as
                                    disposições contidas nesse documento, por isso muito atenção ao ler cada uma das
                                    cláusulas e obrigações dispostas a seguir:
                                </p>
                                <h4>
                                   <b>1.</b> Do Objeto
                                </h4>
                                <p>
                                    Essa plataforma tem como finalidade ser um local onde pessoas possam encontrar
                                    soluções para seus problemas com aparelhos tecnológicos de uma forma rápida, fácil e
                                    em um só lugar.
                                </p>
                                <h4>
                                    <b>2.</b> O Cliente
                                </h4>
                                <p>
                                    A plataforma possibilita ligação direta entre cliente e técnico, assim, sendo da
                                    responsabilidade do cliente expor de forma concisa seu problema e manter u contato
                                    direto com o técnico.
                                </p>
                                <h4>
                                    <b>3.</b> Das obrigações do cliente
                                </h4>
                                <p>
                                    <b>• 3.1.</b> O cliente deverá informar os dados de forma completa para realizar o cadastro
                                    no website, não fornecendo qualquer informação falsa, fraudulenta ou que não seja
                                    correspondente aos seus dados.
                                    <br>
                                    <b>• 3.2.</b> É responsabilidade do cliente qualquer erro na escrita ou na transmissão
                                    errônea dos dados.
                                    <br>
                                    <b>• 3.3.</b> O cliente deverá se comprometer a receber a visita técnica em sua respectiva
                                    residência respeitando dia e horário.
                                    <br>
                                    <b>• 3.4.</b> Não informar os seus dados de login a terceiros sob pena de ser
                                    responsabilizado por qualquer conduta advinda desse uso.
                                    <br>
                                    <b>• 3.5.</b> Cada cliente só poderá efetuar um cadastro, não sendo aceito mais de uma
                                    conta por CPF.
                                    <br>
                                    <b>• 3.6.</b> Para empresas que desejam se cadastrar, é obrigatório a apresentação do CNPJ.
                                    <br>
                                    <b>• 3.7.</b> Usar a plataforma respeitando a ética, bons costumes, legislações e
                                    ordenamentos vigentes no país, sob pena de sofrer sanções.
                                    <br>
                                    <b>• 3.8.</b> Não Enviar mensagens nas avaliações e/ou chats que possam ir de encontro com
                                    a ética e o respeito, ou que tenha cunho difamatório, ofensivo, de ódio ou
                                    preconceituoso.
                                </p>
                                <h4>
                                    <b>4.</b> Obrigações dos técnicos
                                </h4>
                                <p>
                                    <b>• 4.1.</b> Não ser possível o início de contato através do chat com algum cliente,
                                    apenas os clientes poderão iniciar uma conversa.
                                </p>
                                <h4>
                                    <b>5.</b> Isenção de responsabilidade
                                </h4>
                                <p>
                                    Não nos responsabilizamos por algum serviço prestado por ventura não atender as
                                    expectativas do cliente.
                                    <br>
                                    <b>• 5.1.</b> Todos os técnicos serão submetidos a uma avaliação comprobatória de seus
                                    conhecimentos, além do diploma na área.
                                </p>
                                <h4>
                                    <b>6.</b> Da Propriedade intelectual
                                </h4>
                                <p>
                                    <b>• 6.1.</b> Todo o design e paginação são de propriedade do nosso website, e foram
                                    desenvolvidos por para tal finalidade.
                                    <br>
                                    <b>• 6.2.</b> Toda imagem, ilustração, obras de arte, HTML, nomes comerciais, softwares ou
                                    vídeo disponibilizados em nossa plataforma por um dos gerenciadores da página são de
                                    nossa propriedade.
                                    <br>
                                    <b> 6.2.1.</b> Imagens e vídeos são meramente ilustrativas, pois dependendo do monitor ou
                                    da tela do aparelho eletrônico o mesmo pode apresentar variação de cores ou tons.
                                    <br>
                                    <b>• 6.3.</b> A logo, a marca e toda a aparência da web-empresa/empresa são de nossa
                                    propriedade.
                                    <br>
                                    <b>• 6.4.</b> É vedada a cópia sem autorização de qualquer imagem, vídeo, design, áudios,
                                    aparência ou descrições de produtos existentes em nossa web página, sob pena de
                                    responder por sanções quem desobedecer.
                                    <br>
                                    <b>• 6.5.</b> Não nos responsabilizamos por links externos que possam vir a aparecer em
                                    nossa página.
                                    <br>
                                    <b>• 6.6.</b> Nada contido em nossa web página garante o direito a concessão de licença ou
                                    direito de uso sem o consentimento expresso de um dos gerenciadores da página ou do
                                    proprietário da página.
                                    <br>
                                    <b>• 6.7.</b> O consentimento de cópia ou compartilhamento deve vir por escrito de forma
                                    clara e expressa.
                                </p>
                                <h4>
                                    <b>7.</b> Pagamento
                                </h4>
                                <p>
                                    <b>• 7.1.</b> A forma de pagamento do serviço prestado ficará a critério somente do
                                    profissional e cliente.
                                </p>
                                <h4>
                                    <b>8.</b> Postagens
                                </h4>
                                <p>
                                    <b>• 8.1.</b> Fica eleito no canal de postagem da nossa empresa, para dirimir quaisquer
                                    dúvidas ou questões advindas do objetivo do serviço, serão adicionadas informações
                                    periódicas com intuito de informar sobre o ramo.
                                </p>
                            </div>
                        </div>
                    </li>
                    <input type="submit" class="btn-login" value="Cadastrar" id="cadastrar" name="Cadastrar" style="display: none;"/>
                </form>

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>
                        Não Possui Conta?
                    </h3>
                    <p>
                        Crie uma conta facilmente clicando aqui.
                        <br>
                        E tenha acesso aos serviços LocalTech.
                    </p>
                    <button class="btn-login transparent" id="sign-up-btn">
                        Cadastrar-Se
                    </button>
                </div>
                <img src="../../assets/img/login/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>
                        Já Possui Conta?
                    </h3>
                    <p>
                        Entre em sua conta facilmente clicando aqui.
                        <br>
                        E tenha acesso aos serviços LocalTech
                    </p>
                    <button class="btn-login transparent" id="sign-in-btn">
                        Entrar
                    </button>
                </div>
                <img src="../../assets/img/login/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

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
                <a href="login.php">
                    Iniciar Sessão
                </a>
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
                        <a href="../QuemSomos/quemsomos.php">
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
    <script src="../../assets/js/logins.js"></script>

</body>

</html>