<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['Entrar'])){
        /* var_dump($dados); */
        $senha = md5($dados['senha']);

        $VerificarDados = "SELECT 
                                *
                            FROM
                                assistencia AS c
                                    INNER JOIN
                                contato AS cc ON c.id_assistencia = cc.id_assistencia
                            WHERE
                                cc.email = :email AND c.senha = :senha";

        $Login = $conexao->prepare($VerificarDados);
        $Login->bindParam(':email', $dados['email']);
        $Login->bindParam(':senha', $senha);
        $Login->execute();

        $Dados = $Login->rowCount();

        $LinhaDados = $Login->fetch(PDO::FETCH_ASSOC);

        if($Dados != 0){
            $_SESSION['id_assistencia'] = $LinhaDados['id_assistencia'];
            $_SESSION['cod_assistencia'] = $LinhaDados['cod'];
            $_SESSION['nome_assistencia'] = $LinhaDados['nome'];
            $_SESSION['image_assistencia'] = $LinhaDados['image'];

            $VerificarEmail = $conexao->prepare("SELECT 
                                                    * 
                                                FROM 
                                                    contato 
                                                WHERE id_contato = '" . $LinhaDados['id_contato'] . "' AND verificacao = 'Sim'");
            $VerificarEmail->execute();

            $Verificacao = $VerificarEmail->rowCount();

            if($Verificacao != 0){
                header("Location: ../PerfilAssistencia/dashboard-assistencia.php");
            }
            else{
                $_SESSION['id_verificacao'] = $LinhaDados['id_assistencia'];
                $_SESSION['tipo_verificacao'] = "assistencia";
                $_SESSION['sessao_verificacao'] = "id_assistencia";

                header("Location: ../../../controller/Verificacao/Verificacao.php");
            }
            
        }
        else{
            $_SESSION['msg'] = "<p style='color: red';>Erro: Email ou Senha inválida!</p>"; 
        }

    }

?>