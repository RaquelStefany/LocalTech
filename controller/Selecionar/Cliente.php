<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['Entrar'])){
        /* var_dump($dados); */
        $senha = md5($dados['senha']);

        $VerificarDados = "SELECT 
                                *
                            FROM
                                cliente AS c
                                    INNER JOIN
                                contato AS cc ON c.id_cliente = cc.id_cliente
                            WHERE
                                cc.email = :email AND c.senha = :senha";

        $Login = $conexao->prepare($VerificarDados);
        $Login->bindParam(':email', $dados['email']);
        $Login->bindParam(':senha', $senha);
        $Login->execute();

        $Dados = $Login->rowCount();

        $LinhaDados = $Login->fetch(PDO::FETCH_ASSOC);

        if($Dados != 0){
            $_SESSION['id_cliente'] = $LinhaDados['id_cliente'];
            $_SESSION['cod_cliente'] = $LinhaDados['cod'];
            $_SESSION['nome_cliente'] = $LinhaDados['nome'];
            $_SESSION['sobrenome_cliente'] = $LinhaDados['sobrenome'];
            $_SESSION['image_cliente'] = $LinhaDados['image'];

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
                                            id_cliente = {$_SESSION['id_cliente']}");
                $AlterarStatus->execute();

                header("Location: ../PerfilCliente/dashboard-cliente.php");
            }
            else{
                $_SESSION['id_verificacao'] = $LinhaDados['id_cliente'];
                $_SESSION['tipo_verificacao'] = "cliente";
                $_SESSION['sessao_verificacao'] = "id_cliente";

                header("Location: ../../../controller/Verificacao/Verificacao.php");
            }
            
        }
        else{
            $_SESSION['msg'] = "<p style='color: red';>Erro: Email ou Senha inválida!</p>"; 
        }

    }

?>