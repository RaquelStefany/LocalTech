<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    require_once('../../../controller/Dados/Tecnico.php');

    date_default_timezone_set('America/Sao_Paulo');
    $fim = date('Y-m-d H:i:s');

    $encerrar = "UPDATE atendimento SET fim = :fim WHERE id_atendimento = :id_atendimento; UPDATE status SET status = 'Online' WHERE id_cliente = :id;";

    $chat = $conexao->prepare($encerrar);
    $chat->bindParam(':fim', $fim);
    $chat->bindParam(':id_atendimento', $_SESSION['id_atendimento']);
    $chat->bindParam(':id', $LinhaDados['ID']);
    $chat->execute();

    $dadoschat = $chat->rowCount();

    $row_chat = $chat->fetch(PDO::FETCH_ASSOC);

    if($dadoschat != 0){
        //unset($_SESSION['id_chat'], $_SESSION['iddt']);
        /* header("Location: ../../view/chat/avaliar.php#fim_chat"); */
        header("Location: ../../../view/pages/PerfilTecnico/Chat/clientes.php");
    }

?>