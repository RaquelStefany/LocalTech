<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    $atendimento = "SELECT id_atendimento FROM atendimento WHERE id_cliente = :id AND fim = '0000-00-00 00:00:00';";

    $chat = $conexao->prepare($atendimento);
    $chat->bindParam(':id', $_SESSION['IDDadosCliente']);
    $chat->execute();

    $dadoschat = $chat->rowCount();

    $row_chat = $chat->fetch(PDO::FETCH_ASSOC);

    if($dadoschat != 0){
        $_SESSION['id_atendimento'] = $row_chat['id_atendimento'];
        $chatt = $conexao->prepare("SELECT id_atendimento FROM atendimento WHERE id_atendimento = {$_SESSION['id_atendimento']} AND fim = '0000-00-00 00:00:00'");
        $chatt->execute();

        $verificar = $chatt->rowCount();

        if($verificar == 0){
            echo "<a href='clientes.php' class='logout'>Voltar</a>";
        }
        else{
            echo "<a href='../../../../controller/Chat/Tecnico/EncerrarChat.php' class='logout'>Encerrar Atendimento</a>";
        }
    }
    else{
        echo "<a href='clientes.php' class='logout'>Voltar</a>";
    }

?>