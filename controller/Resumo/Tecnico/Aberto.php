<?php

    $VerificarAbertos = "SELECT COUNT(a.id_atendimento) AS Contagem FROM atendimento AS a INNER JOIN cliente AS c INNER JOIN tecnico AS t ON c.id_cliente = a.id_cliente AND t.id_tecnico = a.id_tecnico WHERE t.id_tecnico = :id AND a.fim = '0000-00-00 00:00:00';";
    $Abertos = $conexao->prepare($VerificarAbertos);
    $Abertos->bindParam(':id', $_SESSION['id_tecnico']);
    $Abertos->execute();

    $DadosA = $Abertos->rowCount();

    $Aberto = $Abertos->fetch(PDO::FETCH_ASSOC);

    if($DadosA != 0){
        if($Aberto['Contagem'] == 1){
            echo $Aberto['Contagem'] . "<h3> atendimento</h3>";
        }
        else{
            echo $Aberto['Contagem'] . "<h3> atendimentos</h3>";
        }
    }
    else{
        echo "Sem Dados";
    }

?>