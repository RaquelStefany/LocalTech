<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);

    if($conexao){
        //echo "Conexão realizada com Sucesso";
        //error_reporting(0);

        echo "<script>
                    document.addEventListener('contextmenu', event => event.preventDefault());
                </script>";

        $linkemail = "http://localhost/xampp/LocalTech/Site/controller/Verificacao/Dados.php?4bb9ff48e657b4864c82c53e5529077080860b95=";

    }
    else{
        echo "Falha na Conexão";
    }

?>