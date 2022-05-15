<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $data = date('Y-m-d');

    if(!empty($dados['Inserir'])){
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
            echo "<p style='color: red;text-align: center'> ". $dados['email'] ." já está cadastrado!</p>";echo "<script type='javascript'>alert('Email já está cadastrado!');";
            echo "javascript:window.location='tecnicos.php';</script>";
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
                echo "javascript:window.location='tecnicos.php';</script>";
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
                echo "javascript:window.location='tecnicos.php';</script>";
            }
        }

        if(!empty($_FILES['imagem']['name'])){
            $img_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ['png', 'jpeg', 'jpg'];
            if(in_array($img_ext, $extensions) === true){
                $time = time();
                $new_img_name = $time.$img_name;

                if(move_uploaded_file($tmp_name, "../../../assets/images/ImagensPerfil/".$new_img_name)){
                    $random_id = rand(time(), 10000000);
                }
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

                $tecnico = $conexao->prepare("INSERT INTO contato (id_tecnico, email, telefone, verificacao) VALUES ('" . $_SESSION['id_cadastro'] . "', '" . $dados['email'] . "', '" . $dados['telefone'] . "', 'Nao')");
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
                        $login = $conexao->prepare("SELECT * FROM tecnico AS c INNER JOIN contato AS cc ON c.id_tecnico = cc.id_tecnico WHERE cc.email = :email AND c.senha = :senha;");
                        $login->bindParam(':email', $_SESSION['email_cadastro']);
                        $login->bindParam(':senha', $senha);
                        $login->execute();

                        $online = $conexao->prepare("INSERT INTO status (id_tecnico, status) VALUES ('" . $_SESSION['id_cadastro'] . "', 'Offline')");
                        $online->execute();

                        $row_tecnico = $login->fetch(PDO::FETCH_ASSOC);

                        if($login->rowCount()){

                            unset($_SESSION['id_cadastro'], $_SESSION['email_cadastro'], $_SESSION['estado_cadastro'], $_SESSION['cidade_cadastro'], $_SESSION['bairro_cadastro']);

                            header("Location: tecnicos.php");
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
            else{
                $_SESSION['msg'] = "<p style='color: red;text-align: center'>Erro ao adicionar dados!</p>";
            }
        }
    }

?>