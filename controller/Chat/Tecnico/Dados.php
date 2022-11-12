<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    $id_cli = $_GET['cod'];
    $_SESSION['cliente_chat'] = $id_cli;

    $cliente = $conexao->prepare("SELECT id_cliente AS ID FROM cliente WHERE cod = {$id_cli};");
    $cliente->execute();

    $DadosCliente = $cliente->fetch(PDO::FETCH_ASSOC);

    if(isset($_SESSION['cliente_chat'])){
        $_SESSION['IDDadosCliente'] = $DadosCliente['ID'];
        header("Location: ../../../view/pages/PerfilTecnico/Chat/chat.php");
    }

?>