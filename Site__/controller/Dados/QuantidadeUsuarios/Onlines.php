<?php

    include('../../Conexao/Conexao.php');

    $Online = $conexao->prepare("SELECT COUNT(id_status) AS Onlines FROM status WHERE status = 'Online';");
    $Online->execute();

    while ($linha = $Online->fetchObject()){
        echo "{$linha->Onlines}<br>Onlines&emsp;&emsp;&nbsp;";
    };       

?>