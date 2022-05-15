<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['Entrar'])){
        /* var_dump($dados); */
        $senha = md5($dados['senha']);

        $VerificarDados = "SELECT 
                                *
                            FROM
                                tecnico AS c
                                    INNER JOIN
                                contato AS cc ON c.id_tecnico = cc.id_tecnico
                            WHERE
                                cc.email = :email AND c.senha = :senha;";

        $Login = $conexao->prepare($VerificarDados);
        $Login->bindParam(':email', $dados['email']);
        $Login->bindParam(':senha', $senha);
        $Login->execute();

        $Dados = $Login->rowCount();

        $LinhaDados = $Login->fetch(PDO::FETCH_ASSOC);

        if($Dados != 0){
            $_SESSION['id_tecnico'] = $LinhaDados['id_tecnico'];
            $_SESSION['cod_tecnico'] = $LinhaDados['cod'];
            $_SESSION['nome_tecnico'] = $LinhaDados['nome'];
            $_SESSION['sobrenome_tecnico'] = $LinhaDados['sobrenome'];
            $_SESSION['image_tecnico'] = $LinhaDados['image'];

            $VerificarEmail = $conexao->prepare("SELECT 
                                                    * 
                                                FROM 
                                                    contato 
                                                WHERE id_contato = '" . $LinhaDados['id_contato'] . "' AND verificacao = 'Sim'");
            $VerificarEmail->execute();

            $Verificacao = $VerificarEmail->rowCount();

            if($Verificacao != 0){
                $AlterarStatus = $conexao->prepare("UPDATE status 
                                            SET 
                                                status = 'Online'
                                            WHERE
                                                id_tecnico = {$_SESSION['id_tecnico']}");
                $AlterarStatus->execute();
    
                header("Location: ../PerfilTecnico/dashboard-tecnico.php");
            }
            else{
                $_SESSION['id_verificacao'] = $LinhaDados['id_tecnico'];
                $_SESSION['tipo_verificacao'] = "tecnico";
                $_SESSION['sessao_verificacao'] = "id_tecnico";

                header("Location: ../../../controller/Verificacao/Verificacao.php");
            }
        }
        else{
            $_SESSION['msg'] = "<p style='color: red';>Erro: Email ou Senha inválida!</p>"; 
        }

    }

?>