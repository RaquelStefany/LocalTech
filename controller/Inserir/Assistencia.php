<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;                               

    //require('../../view/assets/vendor/autoload.php');

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
            echo "<script>window.location.replace('../Login/login-assistencia.php');</script>";
            $_SESSION['msg'] = "<p style='color: red;text-align: center'>Email já cadastrado no Sistema!</p>";
        }
        else{
            $cnpj_usuario = "SELECT 
                                * 
                            FROM 
                                assistencia 
                            WHERE cnpj = :cnpj";

            $login_cnpj = $conexao->prepare($cnpj_usuario);
            $login_cnpj->bindParam(':cnpj', $dados['cnpj']);
            $login_cnpj->execute();

            $lcnpj = $login_cnpj->rowCount();

            if($lcnpj > 0){
                $erro = 1;
                echo "<script>window.location.replace('../Login/login-assistencia.php');</script>";
                $_SESSION['msg'] = "<p style='color: red;text-align: center'>CNPJ já cadastrado no Sistema!</p>";
            }

            if($erro == 1){
                echo "<script>window.location.replace('../Login/login-assistencia.php');</script>";
            }
            else{
                if(empty($_FILES['imagem']['name'])){
                    $new_img_name = "assistencia_sem_foto.jpg";
                    $random_id = rand(time(), 10000000);
                }
                
                $assistencia = $conexao->prepare("INSERT INTO assistencia (cod, image, nome, cnpj) VALUES ('" . $random_id . "', '" . $new_img_name . "', '" . $dados['nome'] . "', '" . $dados['cnpj'] . "')");
                $assistencia->execute();
        
                if($assistencia->rowCount()){
                    $id_assistencia = $conexao->prepare("SELECT 
                                                        id_assistencia 
                                                    FROM 
                                                        assistencia 
                                                    WHERE cnpj = '" . $dados['cnpj'] . "'");
                    $id_assistencia->execute();
        
                    $pegar_id_assistencia = $id_assistencia->rowCount();
        
                    $row_id_assistencia = $id_assistencia->fetch(PDO::FETCH_ASSOC);
                }
        
                if($pegar_id_assistencia > 0){
                    $_SESSION['id_cadastro'] = $row_id_assistencia['id_assistencia'];
        
                    $cadastrar_data = $conexao->prepare("UPDATE assistencia 
                                                            SET 
                                                        cadastro = '" . $data . "' 
                                                        WHERE id_assistencia = '" . $_SESSION['id_cadastro'] . "'");
                    $cadastrar_data->execute();
        
                    if($cadastrar_data->rowCount()){
        
                        $codificacao = md5($random_id);
        
                        $assistencia = $conexao->prepare("INSERT INTO contato (id_assistencia, codificacao, email, telefone, verificacao) VALUES ('" . $_SESSION['id_cadastro'] . "', '" . $codificacao . "', '" . $dados['email'] . "', '" . $dados['telefone'] . "', 'Sim')");
                        $assistencia->execute();
                
                        if($assistencia->rowCount()){     
                            
                                                    /* ESTADO */
        
                            $estado = $conexao->prepare("SELECT 
                                                            id_estado 
                                                        FROM 
                                                            estado 
                                                        WHERE sigla = '" . $dados['uf'] . "'");
                            $estado->execute();
        
                            $estados = $estado->rowCount();
        
                            $row_id_estado = $estado->fetch(PDO::FETCH_ASSOC);
        
                            if($estados > 0){
                                $_SESSION['estado_cadastro'] = $row_id_estado['id_estado'];
                            }
                            else{
                                $estadoi = $conexao->prepare("INSERT INTO estado (sigla) VALUES ('" . $dados['uf'] . "')");
                                $estadoi->execute();
        
                                $estado = $conexao->prepare("SELECT 
                                                                id_estado 
                                                            FROM 
                                                                estado 
                                                            WHERE sigla = '" . $dados['uf'] . "'");
                                $estado->execute();
        
                                $estados = $estado->rowCount();
        
                                $row_id_estado = $estado->fetch(PDO::FETCH_ASSOC);
        
                                $_SESSION['estado_cadastro'] = $row_id_estado['id_estado'];
                            }
        
                                                            /* CIDADE */
        
                            $cidade = $conexao->prepare("SELECT 
                                                            id_cidade 
                                                        FROM 
                                                            cidade 
                                                        WHERE nome = '" . $dados['cidade'] . "'");
                            $cidade->execute();
        
                            $cidades = $cidade->rowCount();
        
                            $row_id_cidade = $cidade->fetch(PDO::FETCH_ASSOC);
        
                            if($cidades > 0){
                                $_SESSION['cidade_cadastro'] = $row_id_cidade['id_cidade'];
                            }
                            else{
                                $cidadei = $conexao->prepare("INSERT INTO cidade (nome, id_estado) VALUES ('" . $dados['cidade'] . "', '" . $_SESSION['estado_cadastro'] . "')");
                                $cidadei->execute();
        
                                $cidade = $conexao->prepare("SELECT 
                                                                id_cidade 
                                                            FROM 
                                                                cidade 
                                                            WHERE nome = '" . $dados['cidade'] . "'");
                                $cidade->execute();
        
                                $cidades = $cidade->rowCount();
        
                                $row_id_cidade = $cidade->fetch(PDO::FETCH_ASSOC);
        
                                $_SESSION['cidade_cadastro'] = $row_id_cidade['id_cidade'];
                            }
        
                                                            /* BAIRRO */
        
                            $bairro = $conexao->prepare("SELECT 
                                                            id_bairro 
                                                        FROM 
                                                            bairro 
                                                        WHERE nome = '" . $dados['bairro'] . "'");
                            $bairro->execute();
        
                            $bairros = $bairro->rowCount();
        
                            $row_id_bairro = $bairro->fetch(PDO::FETCH_ASSOC);
        
                            if($bairros > 0){
                                $_SESSION['bairro_cadastro'] = $row_id_bairro['id_bairro'];
                            }
                            else{
                                $bairroi = $conexao->prepare("INSERT INTO bairro (nome, id_cidade) VALUES ('" . $dados['bairro'] . "', '" . $_SESSION['cidade_cadastro'] . "')");
                                $bairroi->execute();
        
                                $bairro = $conexao->prepare("SELECT 
                                                                id_bairro 
                                                            FROM 
                                                                bairro 
                                                            WHERE nome = '" . $dados['bairro'] . "'");
                                $bairro->execute();
        
                                $bairros = $bairro->rowCount();
        
                                $row_id_bairro = $bairro->fetch(PDO::FETCH_ASSOC);
        
                                $_SESSION['bairro_cadastro'] = $row_id_bairro['id_bairro'];
                            }
                            
                                                            /* ENDEREÇO */
                            
                            $endereco = $conexao->prepare("INSERT INTO endereco (id_assistencia, cep, logradouro, numero, complemento, id_bairro) VALUES ('" . $_SESSION['id_cadastro'] . "', '" . $dados['cep'] . "', '" . $dados['logradouro'] . "', '" . $dados['numero'] . "', '" . $dados['complemento'] . "', '" . $_SESSION['bairro_cadastro'] . "')");
                            $endereco->execute();
        
                            if($endereco->rowCount()){
                                $senha = md5($dados['senha']);
        
                                $assistencia = $conexao->prepare("UPDATE assistencia 
                                                                SET 
                                                                    senha = :senha 
                                                                WHERE id_assistencia = :id");
                                $assistencia->bindParam(':senha', $senha);
                                $assistencia->bindParam(':id', $_SESSION['id_cadastro']);
                                $assistencia->execute();
        
                                $email_assistencia = $conexao->prepare("SELECT 
                                                                        email 
                                                                    FROM 
                                                                        contato 
                                                                    WHERE id_assistencia = :id");
                                $email_assistencia->bindParam(':id', $_SESSION['id_cadastro']);
                                $email_assistencia->execute();
        
                                $pegar_email_assistencia = $email_assistencia->rowCount();
        
                                $row_email_assistencia = $email_assistencia->fetch(PDO::FETCH_ASSOC);
        
                                $_SESSION['email_cadastro'] = $row_email_assistencia['email'];
        
                                if($assistencia->rowCount()){
                                    $login = $conexao->prepare("SELECT 
                                                                    * 
                                                                FROM 
                                                                    assistencia AS c 
                                                                INNER JOIN 
                                                                    contato AS cc 
                                                                ON 
                                                                    c.id_assistencia = cc.id_assistencia 
                                                                WHERE cc.email = :email 
                                                                AND 
                                                                    c.senha = :senha;");
                                    $login->bindParam(':email', $_SESSION['email_cadastro']);
                                    $login->bindParam(':senha', $senha);
                                    $login->execute();
        
                                    $online = $conexao->prepare("INSERT INTO horario_assistencia (id_assistencia, descricao, horaabrir, horafechar, semanainicio, semanafinal) VALUES ('" . $_SESSION['id_cadastro'] . "', '". $dados['descricao'] ."', '". $dados['horaabrir'] ."', '". $dados['horafechar'] ."', '". $dados['semanainicio'] ."', '". $dados['semanafinal'] . "')");
                                    $online->execute();
        
                                    $row_assistencia = $login->fetch(PDO::FETCH_ASSOC);
        
                                    if($login->rowCount()){
                                        /* $_SESSION['id_assistencia'] = $row_assistencia['id_assistencia'];
                                        $_SESSION['cod_assistencia'] = $row_assistencia['cod'];
                                        $_SESSION['nome_assistencia'] = $row_assistencia['nome'];
                                        $_SESSION['sobrenome_assistencia'] = $row_assistencia['sobrenome'];
                                        $_SESSION['image_assistencia'] = $row_assistencia['image']; */ 
        
                                        $mail = new PHPMailer(true);
            
                                        $link = $linkemail . $codificacao . "";
            
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
                                            $mail->addAddress($_SESSION['email_cadastro']);
                                    
                                            $mail->isHTML(true);
                                            $mail->Subject = "LocalTech - Confirme seu cadastro";
                                            $mail->Body    = "<div style='text-align: center;'>
                                                                <h1>Bem Vindo ao LocalTech, " .$row_assistencia['nome']. "</h1>
                                                                <br>
                                                                Antes de começar a utilizar os serviços LocalTech é necessário clicar no link abaixo para verificar que seu email é valido.<br><br>
                                                                <a href='" .$link. "' style='text-align: center;'>Clique para verificar seu email</a>
                                                                <br><br><br><br>
                                                                <div style='display: inline-flex;'>
                                                                    <img src='https://i.pinimg.com/564x/61/99/23/619923e36de4526bb0521bd17e242ef6.jpg' style='width: 50px;'>
                                                                    <div style='align-self: center;'>
                                                                        <h2 style='margin: 0;'>
                                                                            LocalTech
                                                                        </h2>
                                                                        <h5 style='margin: 0;'>
                                                                            Cuidando do seu desktop por você
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                            $mail->AltBody = 'E-mail indisponível em modo texto';
                                    
                                            $mail->send();*/
                                            
                                            $_SESSION['verificar'] = "verificar";
                                            echo "<script>window.location.replace('../Login/login-assistencia.php');</script>";
                                        }
                                        catch (Exception $e){
                                            echo "Error: {$mail->ErrorInfo}";
                                        }
        
                                        /* header("Location: ../Perfilassistencia/dashboard-assistencia.php"); */
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
            }
        }          
    }

?>