<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['atualizar'])){

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

        if(!empty($_FILES['imagem']['name'])){

            $img_name = $_FILES['imagem']['name'];
            $tmp_name = $_FILES['imagem']['tmp_name'];

            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode);

            $extensions = ['png', 'jpeg', 'jpg'];
            if(in_array($img_ext, $extensions) === true){
                $time = time();
                $new_img_name = $time.$img_name;

                if(move_uploaded_file($tmp_name, "../../../assets/images/ImagensPerfil/".$new_img_name)){
                    $NovosDados = "UPDATE assistencia 
                                SET image = :imagem,
                                    nome = :nome,
                                    cnpj = :cnpj
                                WHERE id_assistencia = :id;
                            UPDATE horario_assistencia
                                SET descricao = :descricao,
                                    horaabrir = :horaabrir,
                                    horafechar = :horafechar,
                                    semanainicio = :semanainicio,
                                    semanafinal = :semanafinal
                                WHERE id_assistencia = :id;
                            UPDATE contato
                                SET email = :email,
                                    telefone = :telefone
                                WHERE id_assistencia = :id;
                            UPDATE endereco
                                SET cep = :cep,
                                    logradouro = :logradouro,
                                    numero = :numero,
                                    complemento = :complemento,
                                    id_bairro = :bairro
                                WHERE id_assistencia = :id;";

                    $Atualizar = $conexao->prepare($NovosDados);
                    $Atualizar->bindParam(':imagem', $new_img_name);
                    $Atualizar->bindParam(':nome', $dados['nome']);
                    $Atualizar->bindParam(':cnpj', $dados['cnpj']);
                    $Atualizar->bindParam(':descricao', $dados['descricao']);
                    $Atualizar->bindParam(':horaabrir', $dados['horaabrir']);
                    $Atualizar->bindParam(':horafechar', $dados['horafechar']);
                    $Atualizar->bindParam(':semanainicio', $dados['semanainicio']);
                    $Atualizar->bindParam(':semanafinal', $dados['semanafinal']);
                    $Atualizar->bindParam(':email', $dados['email']);
                    $Atualizar->bindParam(':telefone', $dados['telefone']);
                    $Atualizar->bindParam(':cep', $dados['cep']);
                    $Atualizar->bindParam(':logradouro', $dados['logradouro']);
                    $Atualizar->bindParam(':numero', $dados['numero']);
                    $Atualizar->bindParam(':complemento', $dados['complemento']);
                    $Atualizar->bindParam(':bairro', $_SESSION['bairro_cadastro']);
                    $Atualizar->bindParam(':id', $_SESSION['update_assistencia']);
                    $Atualizar->execute();

                    header("Location: assistencias.php");
                }
            }
        }
        
        if(empty($_FILES['imagem']['name'])){
            $NovosDadosf = "UPDATE assistencia 
                            SET nome = :nome,
                                cnpj = :cnpj
                            WHERE id_assistencia = :id;
                        UPDATE horario_assistencia
                            SET descricao = :descricao,
                                horaabrir = :horaabrir,
                                horafechar = :horafechar,
                                semanainicio = :semanainicio,
                                semanafinal = :semanafinal
                            WHERE id_assistencia = :id;
                        UPDATE contato
                            SET email = :email,
                                telefone = :telefone
                            WHERE id_assistencia = :id;
                        UPDATE endereco
                            SET cep = :cep,
                                logradouro = :logradouro,
                                numero = :numero,
                                complemento = :complemento,
                                id_bairro = :bairro
                            WHERE id_assistencia = :id;";

            $Atualizarf = $conexao->prepare($NovosDadosf);
            $Atualizarf->bindParam(':nome', $dados['nome']);
            $Atualizarf->bindParam(':cnpj', $dados['cnpj']);
            $Atualizarf->bindParam(':descricao', $dados['descricao']);
            $Atualizarf->bindParam(':horaabrir', $dados['horaabrir']);
            $Atualizarf->bindParam(':horafechar', $dados['horafechar']);
            $Atualizarf->bindParam(':semanainicio', $dados['semanainicio']);
            $Atualizarf->bindParam(':semanafinal', $dados['semanafinal']);
            $Atualizarf->bindParam(':email', $dados['email']);
            $Atualizarf->bindParam(':telefone', $dados['telefone']);
            $Atualizarf->bindParam(':cep', $dados['cep']);
            $Atualizarf->bindParam(':logradouro', $dados['logradouro']);
            $Atualizarf->bindParam(':numero', $dados['numero']);
            $Atualizarf->bindParam(':complemento', $dados['complemento']);
            $Atualizarf->bindParam(':bairro', $_SESSION['bairro_cadastro']);
            $Atualizarf->bindParam(':id', $_SESSION['update_assistencia']);
            $Atualizarf->execute();

            header("Location: assistencias.php");
        }
    }

?>