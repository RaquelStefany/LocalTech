<?php

    $VerificarDados = "SELECT 
                        c.id_cliente AS ID,
                        c.cod AS COD,
                        c.nome AS Nome,
                        c.sobrenome AS Sobrenome,
                        c.image AS Imagem,
                        c.cpf AS CPF,
                        c.cnpj AS CNPJ,
                        c.tipo AS Tipo,
                        DATE_FORMAT(c.datanascimento, '%d-%m-%Y') AS Nascimento,
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
                        s.status AS Status
                    FROM
                        cliente AS c
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
                        status AS s ON c.id_cliente = cc.id_cliente
                            AND c.id_cliente = e.id_cliente
                            AND c.id_cliente = s.id_cliente
                            AND e.id_bairro = b.id_bairro
                            AND b.id_cidade = cdd.id_cidade
                            AND cdd.id_estado = etd.id_estado
                    WHERE
                        c.id_cliente = :id;";

    $Dados = $conexao->prepare($VerificarDados);
    $Dados->bindParam(':id', $_SESSION['id_cliente']);
    $Dados->execute();

    if($Dados->rowCount()){
        $LinhaDados = $Dados->fetch(PDO::FETCH_ASSOC);        

        $VerificarEmail = $conexao->prepare("SELECT 
                                                * 
                                            FROM 
                                                contato 
                                            WHERE id_cliente = '" . $_SESSION['id_cliente'] . "' AND verificacao = 'Sim'");
        $VerificarEmail->execute();

        $Verificacao = $VerificarEmail->rowCount();

        $LinhaEmail = $VerificarEmail->fetch(PDO::FETCH_ASSOC);

        if($Verificacao == 0){
            $_SESSION['id_verificacao'] = $LinhaDados['ID'];
            $_SESSION['sessao_verificacao'] = "id_cliente";
            $_SESSION['tipo_verificacao'] = "cliente";

            header("Location: ../../../controller/Verificacao/Email.php");
        }
    }    

?>