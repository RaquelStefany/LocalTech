<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    require_once('../../../controller/Dados/Cliente.php');

    $atendimento = "SELECT id_atendimento FROM atendimento WHERE id_cliente = :id AND fim = '0000-00-00 00:00:00.000000';";

    $chat = $conexao->prepare($atendimento);
    $chat->bindParam(':id', $LinhaDados['ID']);
    $chat->execute();

    $dadoschat = $chat->rowCount();

    $row_chat = $chat->fetch(PDO::FETCH_ASSOC);

    if($dadoschat != 0){
        $_SESSION['id_atendimento'] = $row_chat['id_atendimento'];
        $chatt = $conexao->prepare("SELECT id_atendimento FROM atendimento WHERE id_atendimento = {$_SESSION['id_atendimento']} AND fim = '0000-00-00 00:00:00'");
        $chatt->execute();

        $verificar = $chatt->rowCount();

        if($verificar == 0){
            echo "<a href='tecnicos.php' class='logout'>Voltar</a>";
        }
        else{
            echo "<a href='../../../../controller/Chat/Cliente/EncerrarChat.php' class='logout'>Encerrar Atendimento</a>";
        }
    }
    else{
        echo "<a href='../../../../controller/Chat/Cliente/InserirChat.php' class='logout'>Iniciar Atendimento</a>";
    }


?>