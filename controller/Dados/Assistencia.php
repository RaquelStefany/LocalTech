<?php

    $VerificarDados = "SELECT 
                        c.id_assistencia AS ID,
                        c.cod AS COD,
                        c.nome AS Nome,
                        c.image AS Imagem,
                        c.cnpj AS CNPJ,
                        DATE_FORMAT(c.cadastro, '%d-%M-%Y') AS Cadastro,
                        cc.email AS Email,
                        cc.telefone AS Telefone,
                        e.cep AS CEP,
                        e.logradouro AS Logradouro,
                        e.numero AS Numero,
                        e.complemento AS Complemento,
                        b.nome AS Bairro,
                        cdd.nome AS Cidade,
                        etd.sigla AS Estado,
                        ha.descricao AS Descricao,
                        DATE_FORMAT(ha.horaabrir, '%H:%i') AS Hora_Abrir,
                        DATE_FORMAT(ha.horafechar, '%H:%i') AS Hora_Fechar,
                        ha.semanainicio AS Semana_Inicio,
                        ha.semanafinal AS Semana_Final
                    FROM
                        assistencia AS c
                            INNER JOIN
                        contato AS cc
                            INNER JOIN
                        endereco AS e
                            INNER JOIN
                        bairro AS b
                            INNER JOIN
                        cidade AS cdd
                            INNER JOIN
                        estado AS etd 
                            INNER JOIN
                        horario_assistencia AS ha ON c.id_assistencia = cc.id_assistencia
                            AND c.id_assistencia = e.id_assistencia
                            AND e.id_bairro = b.id_bairro
                            AND b.id_cidade = cdd.id_cidade
                            AND cdd.id_estado = etd.id_estado
                            AND c.id_assistencia = ha.id_assistencia
                    WHERE
                        c.id_assistencia = :id;";

    $Dados = $conexao->prepare($VerificarDados);
    $Dados->bindParam(':id', $_SESSION['id_assistencia']);
    $Dados->execute();

    if($Dados->rowCount()){
        $LinhaDados = $Dados->fetch(PDO::FETCH_ASSOC);        

        $VerificarEmail = $conexao->prepare("SELECT 
                                                * 
                                            FROM 
                                                contato 
                                            WHERE id_assistencia = '" . $_SESSION['id_assistencia'] . "' AND verificacao = 'Sim'");
        $VerificarEmail->execute();

        $Verificacao = $VerificarEmail->rowCount();

        $LinhaEmail = $VerificarEmail->fetch(PDO::FETCH_ASSOC);

        if($Verificacao == 0){
            $_SESSION['id_verificacao'] = $LinhaDados['ID'];
            $_SESSION['sessao_verificacao'] = "id_assistencia";
            $_SESSION['tipo_verificacao'] = "assistencia";

            header("Location: ../../../controller/Verificacao/Email.php");
        }
    }    

?>