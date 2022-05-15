<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['atualizar'])){

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
                    $NovosDados = "UPDATE tecnico 
                                SET image = :imagem,
                                    nome = :nome, 
                                    sobrenome = :sobrenome,
                                    cpf = :cpf,
                                    cnpj = :cnpj,
                                    datanascimento = :datanascimento
                                WHERE id_tecnico = :id;
                            UPDATE contato
                                SET email = :email,
                                    telefone = :telefone
                                WHERE id_tecnico = :id";

                    $Atualizar = $conexao->prepare($NovosDados);
                    $Atualizar->bindParam(':imagem', $new_img_name);
                    $Atualizar->bindParam(':nome', $dados['nome']);
                    $Atualizar->bindParam(':sobrenome', $dados['sobrenome']);
                    $Atualizar->bindParam(':cpf', $dados['cpf']);
                    $Atualizar->bindParam(':cnpj', $dados['cnpj']);
                    $Atualizar->bindParam(':datanascimento', $dados['datanascimento']);
                    $Atualizar->bindParam(':email', $dados['email']);
                    $Atualizar->bindParam(':telefone', $dados['telefone']);
                    $Atualizar->bindParam(':id', $_SESSION['update_tecnico']);
                    $Atualizar->execute();

                    header("Location: tecnicos.php");
                }
            }
        }
        
        if(empty($_FILES['imagem']['name'])){
            $NovosDadosf = "UPDATE tecnico 
                        SET nome = :nome, 
                            sobrenome = :sobrenome,
                            cpf = :cpf,
                            cnpj = :cnpj,
                            datanascimento = :datanascimento
                        WHERE id_tecnico = :id;
                    UPDATE contato
                        SET email = :email,
                            telefone = :telefone
                        WHERE id_tecnico = :id";

            $Atualizarf = $conexao->prepare($NovosDadosf);
            $Atualizarf->bindParam(':nome', $dados['nome']);
            $Atualizarf->bindParam(':sobrenome', $dados['sobrenome']);
            $Atualizarf->bindParam(':cpf', $dados['cpf']);
            $Atualizarf->bindParam(':cnpj', $dados['cnpj']);
            $Atualizarf->bindParam(':datanascimento', $dados['datanascimento']);
            $Atualizarf->bindParam(':email', $dados['email']);
            $Atualizarf->bindParam(':telefone', $dados['telefone']);
            $Atualizarf->bindParam(':id', $_SESSION['update_tecnico']);
            $Atualizarf->execute();

            header("Location: Tecnicos.php");
        }
    }

?>