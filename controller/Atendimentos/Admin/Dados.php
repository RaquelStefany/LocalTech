<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                            a.id_atendimento AS ID,
                                            a.cod AS Codigo,
                                            CONCAT(c.nome, ' ', c.sobrenome) AS Cliente,
                                            CONCAT(t.nome, ' ', t.sobrenome) AS Tecnico,
                                            DATE_FORMAT(a.inicio, '%d-%M-%Y') AS Inicio,
                                            IF(a.fim = '0000-00-00 00:00:00',
                                                'Não Finalizado',
                                                DATE_FORMAT(a.fim, '%d-%M-%Y')) AS Termino,
                                            IF(a.id_reabertura = 0,
                                                'Não Reaberto',
                                                CONCAT('OS ', a.id_reabertura)) AS Reaberto
                                        FROM
                                            atendimento AS a
                                                INNER JOIN
                                            cliente AS c
                                                INNER JOIN
                                            tecnico AS t ON c.id_cliente = a.id_cliente
                                                AND t.id_tecnico = a.id_tecnico
                                        WHERE
                                            a.id_atendimento = :id
                                        ORDER BY id_atendimento DESC");
        $usuarios->bindParam(':id', $_SESSION['dado_atendimento']);
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
            echo "<div class='hidden' id='div-dados'>
                <div id='dados'>
                    <div class='wrapper'>
                        <div class='leftd'>
                            <img src='../../../assets/img/images/registro-online.png' width='100' style='object-fit: contain;'>
                            <h4>
                                <b>
                                    ID:
                                </b>
                                <br>
                                    {$linha->ID}
                            </h4>
                        </div>
                        <div class='rightd'>
                            <div class='info'>
                                <h3>
                                    Atendimento OS {$linha->Codigo}
                                </h3>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Código
                                        </h4>
                                        <p>
                                            OS {$linha->Codigo}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Reaberto
                                        </h4>
                                        <p>
                                            {$linha->Reaberto}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Cliente
                                        </h4>
                                        <p>
                                            {$linha->Cliente}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Técnico
                                        </h4>
                                        <p>
                                            {$linha->Tecnico}
                                        </p>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class='info_data'>
                                    <div class='data'>
                                        <h4>
                                            Início
                                        </h4>
                                        <p>
                                            {$linha->Inicio}
                                        </p>
                                    </div>
                                    <div class='data'>
                                        <h4>
                                            Término
                                        </h4>
                                        <p>
                                            {$linha->Termino}
                                        </p>
                                    </div>
                                </div>
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