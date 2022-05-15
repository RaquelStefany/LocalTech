<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);

    if($conexao){
        //echo "Conexão realizada com Sucesso";

        $linkemail = "http://localhost/xampp/LocalTech/Site__/controller/Verificacao/Dados.php?4bb9ff48e657b4864c82c53e5529077080860b95=";
    }
    else{
        echo "Falha na Conexão";
    }

?>