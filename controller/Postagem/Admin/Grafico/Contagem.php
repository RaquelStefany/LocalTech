<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao3 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);

    $Dados_P = $conexao3->prepare("SELECT count(id_postagem) as QTD from postagem;");
    $Dados_P->execute();

    if($Dados_P->RowCount() != 0){
        while ($linha = $Dados_P->fetchObject()){
            echo "{$linha->QTD}<br>Postagens&emsp;&emsp;&nbsp;";
        };
    }
    else{
        echo "Sem Dados";
    }

?>