<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                        c.id_cliente AS ID,
                                        c.cod AS COD,
                                        c.image AS Imagem,
                                        c.nome AS Nome,
                                        c.sobrenome AS Sobrenome,
                                        c.tipo AS Tipo,
                                        c.cpf AS CPF,
                                        c.cnpj AS CNPJ,
                                        DATE_FORMAT(c.datanascimento, '%d %M %Y') AS Nascimento,
                                        DATE_FORMAT(c.cadastro, '%d %M %Y') AS Cadastro,
                                        cc.email AS Email,
                                        cc.telefone AS Telefone,
                                        e.cep AS CEP,
                                        e.logradouro AS Logradouro,
                                        e.numero AS Numero,
                                        e.complemento AS Complemento,
                                        b.nome AS Bairro,
                                        cdd.nome AS Cidade,
                                        etd.sigla AS Estado,
                                        s.status AS Status,
                                        (SELECT 
                                            COUNT(id_atendimento)
                                        FROM
                                            atendimento
                                        WHERE
                                            id_cliente = :id
                                                AND fim = '0000-00-00 00:00:00') AS At_Ab,
                                        (SELECT 
                                                COUNT(id_atendimento)
                                            FROM
                                                atendimento
                                            WHERE
                                                id_cliente = :id
                                                    AND fim != '0000-00-00 00:00:00') AS At_Fn,
                                        (SELECT 
                                                COUNT(id_report)
                                            FROM
                                                report
                                            WHERE
                                                id_cliente = :id
                                                    AND resposta != '') AS Rp_Rs,
                                        (SELECT 
                                                COUNT(id_report)
                                            FROM
                                                report
                                            WHERE
                                                id_cliente = :id
                                                    AND resposta = '') AS Rp_NRs
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
                                            c.id_cliente = :id
                                        LIMIT 1;");
        $usuarios->bindParam(':id', $_SESSION['dado_cliente']);
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
        echo "<div class='hidden' id='div-dados'>
                <div id='dados'>
                    <div class='wrapper'>
                        <div class='leftd'>
                            <img src='../../../assets/images/ImagensPerfil/{$linha->Imagem}' width='100'>
                            <br>
                            <br>
                            <br>
                            <h4>
                                <b>ID:</b>
                                <br>
                                {$linha->ID}
                                <br>
                                <br>
                                <b>COD:</b>
                                <br>
                                {$linha->COD}
                            </h4>
                            <br>
                            <p>
                                Cadastrado em:
                                <br>
                                <span style='color: white;'>{$linha->Cadastro}</span>
                            </p>
                        </div>
                        <div class='rightd'>
                            <div class='info'>
                                <h3>
                                    Atendimentos
                                </h3>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Em Aberto
                                        </h4>
                                        <p>
                                            {$linha->At_Ab}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Finalizados
                                        </h4>
                                        <p>
                                            {$linha->At_Fn}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class='info'>
                                <h3>
                                    Relatórios
                                </h3>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Respondidos
                                        </h4>
                                        <p>
                                            {$linha->Rp_Rs}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Não Respondidos
                                        </h4>
                                        <p>
                                            {$linha->Rp_NRs}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <br>                        
                            <div class='hrefass' style='margin-top: 10%;'>
                                <a href='Dados.php'>
                                    Dados Pessoais
                                </a>
                                <a href='DadosInfo.php'>
                                    Informações
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
        }
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "</table>";

?>