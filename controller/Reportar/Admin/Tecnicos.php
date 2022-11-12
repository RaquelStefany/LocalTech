<?php

    include('../../Conexao/Conexao.php');

    $Quantidade = $conexao->prepare("SELECT count(id_report) AS QTD FROM report where tipo = 'tecnico';");
    $Quantidade->execute();

    while ($linha = $Quantidade->fetchObject()) {
        echo "{$linha->QTD}<br>Técnicos";
    };        

?>