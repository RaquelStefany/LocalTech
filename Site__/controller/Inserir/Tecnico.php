<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;  

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $data = date('Y-m-d');

    if(!empty($dados['Cadastrar'])){
        $email_usuario = "SELECT 
                                * 
                            FROM
                                contato 
                            WHERE email = :email";

        $login_email = $conexao->prepare($email_usuario);
        $login_email->bindParam(':email', $dados['email']);
        $login_email->execute();

        $lemial = $login_email->rowCount();

        if($lemial > 0){
            echo "<p style='color: red;text-align: center'> ". $dados['email'] ." já está cadastrado!</p>";
            echo "<script type='javascript'>alert('Email já está cadastrado!');";
            echo "javascript:window.location='login-tecnico.php';</script>";
        }

        if(($dados['pessoa']) == "CPF"){
            
            $cpf_usuario = "SELECT 
                                * 
                            FROM 
                                tecnico 
                            WHERE cpf = :cpf";

            $login_cpf = $conexao->prepare($cpf_usuario);
            $login_cpf->bindParam(':cpf', $dados['cpf']);
            $login_cpf->execute();

            $lcpf = $login_cpf->rowCount();

            if($lcpf > 0){
                echo "<p style='color: red;text-align: center'> ". $dados['cpf'] ." já está cadastrado!</p>";
                echo "<script type='javascript'>alert('CPF já está cadastrado!');";
                echo "javascript:window.location='login-tecnico.php';</script>";
            }
        }

        if(($dados['pessoa']) == "CNPJ"){
            
            $cnpj_usuario = "SELECT 
                                * 
                            FROM 
                                tecnico 
                            WHERE cnpj = :cnpj";

            $login_cnpj = $conexao->prepare($cnpj_usuario);
            $login_cnpj->bindParam(':cnpj', $dados['cnpj']);
            $login_cnpj->execute();

            $lcnpj = $login_cnpj->rowCount();

            if($lcnpj > 0){
                echo "<p style='color: red;text-align: center'> ". $dados['cnpj'] ." já está cadastrado!</p>";
                echo "<script type='javascript'>alert('CNPJ já está cadastrado!');";
                echo "javascript:window.location='login-tecnico.php';</script>";
            }
        }

        if(empty($_FILES['imagem']['name'])){
            $new_img_name = "usuario_sem_foto.png";
            $random_id = rand(time(), 10000000);
        }

        if(($dados['pessoa']) == "CPF"){
            $tecnico = $conexao->prepare("INSERT INTO tecnico (cod, image, nome, sobrenome, tipo, cpf, datanascimento) VALUES ('" . $random_id . "', '" . $new_img_name . "', '" . $dados['nome'] . "', '" . $dados['sobrenome'] . "', 'CPF', '" . $dados['cpf'] . "', '" . $dados['datanascimento'] . "')");
            $tecnico->execute();

            if($tecnico->rowCount()){
                $id_tecnico = $conexao->prepare("SELECT 
                                                    id_tecnico 
                                                FROM 
                                                    tecnico 
                                                WHERE cpf = '" . $dados['cpf'] . "'");
                $id_tecnico->execute();

                $pegar_id_tecnico = $id_tecnico->rowCount();

                $row_id_tecnico = $id_tecnico->fetch(PDO::FETCH_ASSOC);
            }
        }

        if(($dados['pessoa']) == "CNPJ"){
            $tecnico = $conexao->prepare("INSERT INTO tecnico (cod, image, nome, sobrenome, tipo, cnpj, datanascimento) VALUES ('" . $random_id . "', '" . $new_img_name . "', '" . $dados['nome'] . "', '" . $dados['sobrenome'] . "', 'CNPJ', '" . $dados['cnpj'] . "', '" . $dados['datanascimento'] . "')");
            $tecnico->execute();

            if($tecnico->rowCount()){
                $id_tecnico = $conexao->prepare("SELECT 
                                                    id_tecnico 
                                                FROM 
                                                    tecnico 
                                                WHERE cnpj = '" . $dados['cnpj'] . "'");
                $id_tecnico->execute();

                $pegar_id_tecnico = $id_tecnico->rowCount();

                $row_id_tecnico = $id_tecnico->fetch(PDO::FETCH_ASSOC);
            }
        }

        if($pegar_id_tecnico > 0){
            $_SESSION['id_cadastro'] = $row_id_tecnico['id_tecnico'];

            $cadastrar_data = $conexao->prepare("UPDATE tecnico 
                                                    SET 
                                                cadastro = '" . $data . "' 
                                                WHERE id_tecnico = '" . $_SESSION['id_cadastro'] . "'");
            $cadastrar_data->execute();

            if($cadastrar_data->rowCount()){

                $codificacao = md5($random_id);

                $tecnico = $conexao->prepare("INSERT INTO contato (id_tecnico, codificacao, email, telefone, verificacao) VALUES ('" . $_SESSION['id_cadastro'] . "', '" . $codificacao . "', '" . $dados['email'] . "', '" . $dados['telefone'] . "', 'Nao')");
                $tecnico->execute();
        
                if($tecnico->rowCount()){     
                    $senha = md5($dados['senha']);

                    $tecnico = $conexao->prepare("UPDATE tecnico 
                                                    SET 
                                                        senha = :senha 
                                                    WHERE id_tecnico = :id");
                    $tecnico->bindParam(':senha', $senha);
                    $tecnico->bindParam(':id', $_SESSION['id_cadastro']);
                    $tecnico->execute();

                    $email_tecnico = $conexao->prepare("SELECT 
                                                            email 
                                                        FROM 
                                                            contato 
                                                        WHERE id_tecnico = :id");
                    $email_tecnico->bindParam(':id', $_SESSION['id_cadastro']);
                    $email_tecnico->execute();

                    $pegar_email_tecnico = $email_tecnico->rowCount();

                    $row_email_tecnico = $email_tecnico->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['email_cadastro'] = $row_email_tecnico['email'];

                    if($tecnico->rowCount()){
                        $login = $conexao->prepare("SELECT 
                                                        * 
                                                    FROM 
                                                        tecnico AS c 
                                                    INNER JOIN 
                                                        contato AS cc 
                                                    ON 
                                                        c.id_tecnico = cc.id_tecnico 
                                                    WHERE cc.email = :email 
                                                    AND 
                                                        c.senha = :senha;");
                        $login->bindParam(':email', $_SESSION['email_cadastro']);
                        $login->bindParam(':senha', $senha);
                        $login->execute();

                        $online = $conexao->prepare("INSERT INTO status (id_tecnico, status) VALUES ('" . $_SESSION['id_cadastro'] . "', 'Online')");
                        $online->execute();

                        $row_tecnico = $login->fetch(PDO::FETCH_ASSOC);

                        if($login->rowCount()){
                            /* $_SESSION['id_tecnico'] = $row_tecnico['id_tecnico'];
                            $_SESSION['cod_tecnico'] = $row_tecnico['cod'];
                            $_SESSION['nome_tecnico'] = $row_tecnico['nome'];
                            $_SESSION['sobrenome_tecnico'] = $row_tecnico['sobrenome'];
                            $_SESSION['image_tecnico'] = $row_tecnico['image']; */

                            $mail = new PHPMailer(true);
    
                            $link = $linkemail . $codificacao . "";

                            try{
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
                                                    <h1>Bem Vindo ao LocalTech, " .$row_tecnico['nome']. "</h1>
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
                                
                                $_SESSION['verificar'] = "verificar";
                                echo "<script>window.location.replace('../Verificar/verificar-conta.php');</script>";
                            }
                            catch (Exception $e){
                                echo "Error: {$mail->ErrorInfo}";
                            }

                            /* header("Location: ../PerfilTecnico/dashboard-tecnico.php"); */
                        }
                    }
                    else{
                        $_SESSION['msg'] = "<p style='color: red;text-align: center'>Erro ao adicionar dados!</p>";
                    }
                }
            }
            else{
                $_SESSION['msg'] = "<p style='color: red;text-align: center'>Erro ao adicionar dados!</p>";
            }
        }
        else{
            $_SESSION['msg'] = "<p style='color: red;text-align: center'>Erro ao adicionar dados!</p>";
        }
    }

?>