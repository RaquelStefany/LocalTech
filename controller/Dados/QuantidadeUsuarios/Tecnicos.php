<?php

    include('../../Conexao/Conexao.php');

    $Quantidade = $conexao->prepare("SELECT count(id_tecnico) AS QTD FROM tecnico;");
    $Quantidade->execute();

    while ($linha = $Quantidade->fetchObject()) {
        echo "{$linha->QTD}<br>Registrados";
    };        

?>