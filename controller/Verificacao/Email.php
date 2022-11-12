<?php

    session_start();
    include('../Conexao/Conexao.php');
    ob_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;                               

    require('../../view/assets/vendor/autoload.php');

    $mail = new PHPMailer(true);

    $VerificarDados = $conexao->prepare("SELECT 
                                            *
                                        FROM
                                            {$_SESSION['tipo_verificacao']} AS c
                                                INNER JOIN
                                            contato AS cc ON c.{$_SESSION['sessao_verificacao']} = cc.{$_SESSION['sessao_verificacao']}
                                        WHERE
                                            cc.{$_SESSION['sessao_verificacao']} = {$_SESSION['id_verificacao']}");
    $VerificarDados->execute();

    $LinhaDados = $VerificarDados->fetch(PDO::FETCH_ASSOC);
    
    $link = $linkemail . $LinhaDados['codificacao'] . "";

    /* try{
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'localtech.contato@hotmail.com';
        $mail->Password   = 'Localtechetec';
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Port       = 587;

        $mail->setFrom('localtech.contato@hotmail.com', 'LocalTech');
        $mail->addAddress($_SESSION['email_cadastro']);

        $mail->isHTML(true);
        $mail->Subject = "LocalTech - Confirme seu cadastro";
        $mail->Body    = "<div style='text-align: center;'>
                            <h1>Bem Vindo ao LocalTech, " .$LinhaDados['nome']. "</h1>
                            <br>
                            Antes de começar a utilizar os serviços LocalTech é necessário clicar no link abaixo para verificar que seu email é valido.<br><br>
                            <a href='" .$link. "' style='text-align: center;'>Clique para verificar seu email</a>
                            <br><br><br><br>
                            <div style='display: inline-flex;'>
                                <img src='https://i.pinimg.com/564x/61/99/23/619923e36de4526bb0521bd17e242ef6.jpg' style='width: 100px;'>
                                <div style='align-self: center;'>
                                    <h2 style='margin: 0;'>
                                        LocalTech
                                    </h2>
                                    <h5 style='margin: 0;'>
                                        Cuidando de tudo por você.
                                    </h5>
                                </div>
                            </div>
                        </div>";
        $mail->AltBody = 'E-mail indisponível em modo texto';

        $mail->send();

        $_SESSION['reverificar'] = "reverificar";
        echo "<script>window.location.replace('../../view/pages/Verificar/reenviar-email.php');</script>";
    }
    catch (Exception $e){
        echo "Error: {$mail->ErrorInfo}";
    } */

    $_SESSION['reverificar'] = "reverificar";
    echo "<script>window.location.replace('../../view/pages/Verificar/reenviar-email.php');</script>";

?>