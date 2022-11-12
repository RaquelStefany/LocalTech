<?php

    error_reporting(0);

    $cliente = $_POST['cliente'];
    $tecnico = $_POST['tecnico'];
    $mensagem = $_POST['mensagem'];

    date_default_timezone_set('America/Sao_Paulo');
    $horario = date('Y-m-d H:i:s');


    if($mensagem != ""){

        $mensagemx = "INSERT INTO chat (id_atendimento, remetente, mensagem, horario) VALUES ({$_SESSION['id_atendimento']}, 'Cliente' , '{$mensagem}', '{$horario}')";

        $envio = $conexao->prepare($mensagemx);
        $envio->execute();

        header("Location: chat.php");
    }

?>