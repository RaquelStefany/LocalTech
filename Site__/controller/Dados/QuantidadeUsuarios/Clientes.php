<?php

    include('../../Conexao/Conexao.php');

    $Quantidade = $conexao->prepare("SELECT count(id_cliente) AS QTD FROM cliente;");
    $Quantidade->execute();

    while ($linha = $Quantidade->fetchObject()) {
        echo "{$linha->QTD}<br>Registrados";
    };        

?>