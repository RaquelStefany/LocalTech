<?php

    $atendimento_status = "UPDATE status SET status = 'Em Atendimento' WHERE id_tecnico = :id;";

    $chat_status = $conexao->prepare($atendimento_status);
    $chat_status->bindParam(':id', $LinhaDados['ID']);
    $chat_status->execute();

?>