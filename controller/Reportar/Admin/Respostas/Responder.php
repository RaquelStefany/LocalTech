<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(!empty($dados['Resposta'])){

        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "localtech";
        $porta = 3306;
    
        $conexao2 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);
        
        $responder = $conexao2->prepare("UPDATE report SET resposta = :resposta WHERE id_report = {$_SESSION['user']}");
        $responder->bindParam(':resposta', $dados['admresposta']);
        $responder->execute();

        if($responder->rowCount()){
            header("Location: Reports.php");
        }
    }
    
?>