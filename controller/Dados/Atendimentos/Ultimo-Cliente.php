<?php

    include('../../Conexao/Conexao.php');

    $Quantidade = $conexao->prepare("SELECT c.nome AS Nome, c.sobrenome AS Sobrenome FROM atendimento AS a INNER JOIN cliente AS c ON c.id_cliente = a.id_cliente ORDER BY id_atendimento DESC LIMIT 1;");
    $Quantidade->execute();

    while ($linha = $Quantidade->fetchObject()) {
        echo "{$linha->Nome} {$linha->Sobrenome}";
    };        

?>