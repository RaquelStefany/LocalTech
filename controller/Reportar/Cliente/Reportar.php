<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d H:i:s');

    if(!empty($dados['Reportar'])){        
        $random_id = rand(time(), 10000000);

        if($dados['tecnico'] != ""){
            $report = $conexao->prepare("INSERT INTO report (cod, id_cliente, assunto, tipo, usuario, relatorio, data) VALUES ('" . $random_id . "', '" . $_SESSION['id_cliente'] . "', '" . $dados['assunto'] . "', '" . $dados['tipo'] . "', '" . $dados['tecnico'] . "', '" . $dados['mensagem'] . "', '" . $data . "');");
            $report->execute();        

            if($report->rowCount()){
                header("Location: Respostas.php");
            }
        }

        if($dados['assistencia'] != ""){
            $report = $conexao->prepare("INSERT INTO report (cod, id_cliente, assunto, tipo, usuario, relatorio, data) VALUES ('" . $random_id . "', '" . $_SESSION['id_cliente'] . "', '" . $dados['assunto'] . "', '" . $dados['tipo'] . "', '" . $dados['assistencia'] . "', '" . $dados['mensagem'] . "', '" . $data . "');");
            $report->execute();        

            if($report->rowCount()){
                header("Location: Respostas.php");
            }
        }
    }

?>