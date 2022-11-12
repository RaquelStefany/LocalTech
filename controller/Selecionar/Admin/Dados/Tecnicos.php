<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                        t.id_tecnico AS ID,
                                        t.cod AS COD,
                                        t.image AS Imagem,
                                        t.nome AS Nome,
                                        t.sobrenome AS Sobrenome,
                                        t.tipo AS Tipo,
                                        t.cpf AS CPF,
                                        t.cnpj AS CNPJ,
                                        DATE_FORMAT(t.datanascimento, '%d %M %Y') AS Nascimento,
                                        DATE_FORMAT(t.cadastro, '%d %M %Y') AS Cadastro,
                                        cc.email AS Email,
                                        cc.telefone AS Telefone,
                                        s.status AS Status,
                                        (SELECT 
                                            COUNT(id_atendimento)
                                        FROM
                                            atendimento
                                        WHERE
                                            id_tecnico = :id
                                                AND fim = '0000-00-00 00:00:00') AS At_Ab,
                                        (SELECT 
                                                COUNT(id_atendimento)
                                            FROM
                                                atendimento
                                            WHERE
                                                id_tecnico = :id
                                                    AND fim != '0000-00-00 00:00:00') AS At_Fn,
                                        (SELECT 
                                                COUNT(id_report)
                                            FROM
                                                report
                                            WHERE
                                                id_tecnico = :id
                                                    AND resposta != '') AS Rp_Rs,
                                        (SELECT 
                                                COUNT(id_report)
                                            FROM
                                                report
                                            WHERE
                                                id_tecnico = :id
                                                    AND resposta = '') AS Rp_NRs
                                        FROM
                                            tecnico AS t
                                                INNER JOIN
                                            contato AS cc
                                                INNER JOIN
                                            status AS s ON t.id_tecnico = cc.id_tecnico
                                                AND t.id_tecnico = s.id_tecnico
                                        WHERE
                                            t.id_tecnico = :id
                                        LIMIT 1;");
        $usuarios->bindParam(':id', $_SESSION['dado_tecnico']);
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
        echo "<div class='hidden' id='div-dados'>
                <div id='dados'>
                    <div class='wrapper'>
                        <div class='leftd'>
                            <img src='../../../assets/images/ImagensPerfil/{$linha->Imagem}' width='100'>
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
                                </div>
                                <br>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Email
                                        </h4>
                                        <p>
                                            {$linha->Email}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Telefone
                                        </h4>
                                        <p>
                                            {$linha->Telefone}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class='info_data'>
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