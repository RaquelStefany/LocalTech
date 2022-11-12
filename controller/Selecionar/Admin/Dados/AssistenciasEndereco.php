<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                            a.id_assistencia AS ID,
                                            a.cod AS COD,
                                            a.image AS Imagem,
                                            a.nome AS Nome,
                                            a.cnpj AS CNPJ,
                                            DATE_FORMAT(a.cadastro, '%d %M %Y') AS Cadastro,
                                            ha.descricao AS Descricao,
                                            DATE_FORMAT(ha.horaabrir, '%H:%i') AS Hora_Abrir,
                                            DATE_FORMAT(ha.horafechar, '%H:%i') AS Hora_Fechar,
                                            ha.semanainicio AS Semana_Inicio,
                                            ha.semanafinal AS Semana_Final,
                                            cc.email AS Email,
                                            cc.telefone AS Telefone,
                                            e.cep AS CEP,
                                            e.logradouro AS Logradouro,
                                            e.numero AS Numero,
                                            e.complemento AS Complemento,
                                            b.nome AS Bairro,
                                            cdd.nome AS Cidade,
                                            etd.sigla AS Estado
                                        FROM
                                            assistencia AS a
                                                INNER JOIN
                                            endereco AS e
                                                INNER JOIN
                                            contato AS cc
                                                INNER JOIN
                                            estado AS etd
                                                INNER JOIN
                                            cidade AS cdd
                                                INNER JOIN
                                            bairro AS b
                                                INNER JOIN
                                            horario_assistencia AS ha ON a.id_assistencia = cc.id_assistencia
                                                AND a.id_assistencia = e.id_assistencia
                                                AND e.id_bairro = b.id_bairro
                                                AND b.id_cidade = cdd.id_cidade
                                                AND cdd.id_estado = etd.id_estado
                                        WHERE
                                            a.id_assistencia = :id
                                        LIMIT 1");
        $usuarios->bindParam(':id', $_SESSION['dado_assistencia']);
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
            echo "<div class='hidden' id='div-dados'>
                <div id='dados'>
                    <div class='wrapper' style='flex-direction: row-reverse;'>
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
                            <div class='hrefass' style='margin-top: 30%;'>
                                <a href='Dados.php'>
                                    Dados Comerciais
                                </a>
                                <a href='DadosEndereco.php'>
                                    Dados Residencias
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