<?php

    include('../../Conexao/Conexao.php');

    $Quantidade = $conexao->prepare("SELECT t.nome AS Nome, t.sobrenome AS Sobrenome FROM atendimento AS a INNER JOIN tecnico AS t ON t.id_tecnico = a.id_tecnico ORDER BY id_atendimento DESC LIMIT 1;");
    $Quantidade->execute();

    while ($linha = $Quantidade->fetchObject()) {
        echo "{$linha->Nome} {$linha->Sobrenome}";
    };        

?>