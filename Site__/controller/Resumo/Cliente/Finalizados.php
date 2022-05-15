<?php

    $VerificarFinalizados = "SELECT COUNT(a.id_atendimento) AS Contagem FROM atendimento AS a INNER JOIN cliente AS c INNER JOIN tecnico AS t ON c.id_cliente = a.id_cliente AND t.id_tecnico = a.id_tecnico WHERE c.id_cliente = :id AND a.fim != '0000-00-00 00:00:00';";
    $Finalizados = $conexao->prepare($VerificarFinalizados);
    $Finalizados->bindParam(':id', $_SESSION['id_cliente']);
    $Finalizados->execute();

    $DadosF = $Finalizados->rowCount();

    $Finalizado = $Finalizados->fetch(PDO::FETCH_ASSOC);

    if($DadosF != 0){
        if($Finalizado['Contagem'] == 1){
            echo $Finalizado['Contagem'] . "<h3> atendimento</h3>";
        }
        else{
            echo $Finalizado['Contagem'] . "<h3> atendimentos</h3>";
        }
    }
    else{
        echo "Sem Dados";
    }

?>