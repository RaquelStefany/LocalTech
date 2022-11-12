<?php

    $atendimento_status = "UPDATE status SET status = 'Online' WHERE id_cliente = :id;";

    $chat_status = $conexao->prepare($atendimento_status);
    $chat_status->bindParam(':id', $LinhaDados['ID']);
    $chat_status->execute();

?>