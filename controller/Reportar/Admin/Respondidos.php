<?php

    include('../../Conexao/Conexao.php');

    $Quantidade = $conexao->prepare("SELECT count(id_report) AS QTD FROM report where resposta is not null;");
    $Quantidade->execute();

    while ($linha = $Quantidade->fetchObject()) {
        echo "{$linha->QTD}<br>Respondidos";
    };        

?>