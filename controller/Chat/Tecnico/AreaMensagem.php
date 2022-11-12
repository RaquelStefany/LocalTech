<?php

    $atendimento = "SELECT id_atendimento FROM atendimento WHERE id_cliente = :id AND fim = '0000-00-00 00:00:00.000000';";

    $chat = $conexao->prepare($atendimento);
    $chat->bindParam(':id', $_SESSION['IDDadosCliente']);
    $chat->execute();

    $dadoschat = $chat->rowCount();

    $row_chat = $chat->fetch(PDO::FETCH_ASSOC);

    if($dadoschat != 0){
        echo "<input type='text' name='mensagem' class='input-field' placeholder='Insira uma mensagem...' autofocus required>";
    }
    else{
        echo "<input type='text' name='mensagem' class='input-field' placeholder='Inicie um atendimento...' autofocus disabled>";
    }

?>