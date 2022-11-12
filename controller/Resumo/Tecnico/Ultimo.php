<?php

    $VerificarUltimo = "SELECT a.id_atendimento AS ID, CONCAT(c.nome, ' ', c.sobrenome) AS Cliente, IF(a.fim = '0000-00-00 00:00:00', 'Não Finalizado', DATE_FORMAT(a.fim, '%d-%M-%Y')) AS Termino FROM atendimento AS a INNER JOIN cliente AS c INNER JOIN tecnico AS t ON c.id_cliente = a.id_cliente AND t.id_tecnico = a.id_tecnico WHERE t.id_tecnico = :id ORDER BY a.id_atendimento DESC LIMIT 1;";
    $Ultimo = $conexao->prepare($VerificarUltimo);
    $Ultimo->bindParam(':id', $_SESSION['id_tecnico']);
    $Ultimo->execute();

    $DadosU = $Ultimo->rowCount();

    $Ult = $Ultimo->fetch(PDO::FETCH_ASSOC);

    if($DadosU != 0){
        echo "<h1>
                Cliente " . $Ult['Cliente'] . "
            </h1>
            <h5>
                <i>
                    " . $Ult['Termino'] . "
                </i>
            </h5>";
    }
    else{
        echo "<h1>
                Sem Dados
            </h1>";
    }

?>