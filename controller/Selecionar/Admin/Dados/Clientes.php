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
                                    Dados Pessoais
                                </h3>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Nome
                                        </h4>
                                        <p>
                                            {$linha->Nome} {$linha->Sobrenome}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            {$linha->Tipo}
                                        </h4>
                                        <p>
                                            {$linha->CPF}{$linha->CNPJ}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Email
                                        </h4>
                                        <p>
                                            {$linha->Email}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Telefone
                                        </h4>
                                        <p>
                                            {$linha->Telefone}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Data de Nascimento
                                        </h4>
                                        <p>
                                            {$linha->Nascimento}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Status
                                        </h4>
                                        <p>
                                            {$linha->Status}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        
                            <div class='projects'>
                                <h3>
                                    Dados Residenciais
                                </h3>
                                <div class='projects_data'>
                                    <div class='data'>
                                        <h4>
                                            CEP
                                        </h4>
                                        <p>
                                            {$linha->CEP}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Logradouro
                                        </h4>
                                        <p>
                                            {$linha->Logradouro}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Número
                                        </h4>
                                        <p>
                                            {$linha->Numero}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class='projects_data'>
                                    <div class='data'>
                                        <h4>
                                            Bairro
                                        </h4>
                                        <p>
                                            {$linha->Bairro}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Cidade
                                        </h4>
                                        <p>
                                            {$linha->Cidade}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Estado
                                        </h4>
                                        <p>
                                            {$linha->Estado}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class='projects_data' style='justify-content: center;'>
                                    <div class='data'>
                                        <h4>
                                            Complemento
                                        </h4>
                                        <p>
                                            {$linha->Complemento}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <br>                        
                            <div class='hrefass'>
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