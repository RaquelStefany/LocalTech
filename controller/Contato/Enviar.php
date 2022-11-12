<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;                               

    //require('../../../view/assets/vendor/autoload.php');

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $mail = new PHPMailer(true);

    if(!empty($dados['enviar'])){
        /* $dados['email'] */
        try{
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            /*$mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host       = 'smtp.office365.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'localtech.contato@hotmail.com';
            $mail->Password   = 'Localtechetec';
            $mail->SMTPSecure = 'STARTTLS';
            $mail->Port       = 587;
    
            $mail->setFrom('localtech.contato@hotmail.com', 'LocalTech');
            $mail->addAddress('localtech.contato@hotmail.com');
    
            $mail->isHTML(true);
            $mail->Subject = $dados['assunto'] . " - Contato - LocalTech";
            $mail->Body    = "<div>
                                <p><b>Enviado por:</b> " .$dados['nome']. " <br>
                                <b>Email:</b> " .$dados['email']. " <br>
                                <b>Assunto:</b> " .$dados['assunto']. "</p>
                                <p><b>Mensagem:</b> " .$dados['mensagem']. "</p>
                                <br><br><br><br>
                                <div style='display: inline-flex;'>
                                    <img src='https://i.pinimg.com/564x/61/99/23/619923e36de4526bb0521bd17e242ef6.jpg' style='width: 50px;'>
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
    
            if($mail->send()){*/
                $_SESSION['msg'] = "<p style='color: green;text-align: center'>Email enviado com sucesso</p>";
                /* echo "<script>window.location.replace('../../../index.php');</script>"; */
            /*}
            else{
                $_SESSION['msg'] = "<p style='color: red;text-align: center'>Erro ao enviar email! Por favor tente novamente</p>";
            }
    
            $_SESSION['reverificar'] = "reverificar";
            echo "<script>window.location.replace('../../view/pages/Verificar/reenviar-email.php');</script>"; */
        }
        catch (Exception $e){
            echo "Error: {$mail->ErrorInfo}";
        }
    }    

    /* $_SESSION['reverificar'] = "reverificar";
    echo "<script>window.location.replace('../../view/pages/Verificar/reenviar-email.php');</script>"; */

?>