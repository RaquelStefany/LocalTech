<?php
    
    session_start();
    ob_start();
    include_once('../../../controller/Conexao/Conexao.php');
    require_once('../../../controller/Dados/Cliente.php');
    require_once('../../../controller/Chat/Cliente/TecnicoChat.php');

    $cliente = $LinhaDados['ID'];
    $tecnico = $tec_chat['ID'];
    $cod_tecnico = $tec_chat['COD'];

    date_default_timezone_set('America/Sao_Paulo');
    $inicio = date('Y-m-d H:i:s');
    $random_cod = rand(time(), 10000000);

    $atendimento = "INSERT INTO atendimento (id_tecnico, id_cliente, cod, inicio) VALUES (:tecnico, :cliente, :cod, :inicio); SELECT id_atendimento FROM atendimento WHERE id_cliente = :id; AND fim = '0000-00-00 00:00:00.000000'; UPDATE status SET status = 'Em Atendimento' WHERE id_cliente = :id;";

    $chat = $conexao->prepare($atendimento);
    $chat->bindParam(':tecnico', $tecnico);
    $chat->bindParam(':cliente', $cliente);
    $chat->bindParam(':cod', $random_cod);
    $chat->bindParam(':inicio', $inicio);
    $chat->bindParam(':id', $LinhaDados['ID']);
    $chat->execute();

    $dadoschat = $chat->rowCount();

    $row_chat = $chat->fetch(PDO::FETCH_ASSOC);

    if($dadoschat != 0){
        header("Location: ../../../view/pages/PerfilCliente/Chat/chat.php");
    }
    else{
        echo "Error!!";
    }

?>