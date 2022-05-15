<?php

    $VerificarDados = "SELECT 
                            t.id_tecnico AS ID,
                            t.cod AS COD,
                            t.nome AS Nome,
                            t.sobrenome AS Sobrenome,
                            t.image AS Imagem,
                            t.cpf AS CPF,
                            t.cnpj AS CNPJ,
                            t.tipo AS Tipo,
                            DATE_FORMAT(t.datanascimento, '%d-%m-%Y') AS Nascimento,
                            DATE_FORMAT(t.cadastro, '%d-%M-%Y') AS Cadastro,
                            cc.email AS Email,
                            cc.telefone AS Telefone,
                            s.status AS Status
                        FROM
                            tecnico AS t
                                INNER JOIN
                            contato AS cc
                                INNER JOIN
                            status AS s ON t.id_tecnico = cc.id_tecnico
                                AND t.id_tecnico = s.id_tecnico
                        WHERE
                            t.id_tecnico = :id;";

    $Dados = $conexao->prepare($VerificarDados);
    $Dados->bindParam(':id', $_SESSION['id_tecnico']);
    $Dados->execute();

    if($Dados->rowCount()){
        $LinhaDados = $Dados->fetch(PDO::FETCH_ASSOC);
    }

?>