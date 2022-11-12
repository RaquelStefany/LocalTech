<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    $id_tec = $_GET['cod'];
    $_SESSION['tecnico_chat'] = $id_tec;

    if(isset($_SESSION['tecnico_chat'])){
        header("Location: ../../../view/pages/PerfilCliente/Chat/chat.php");
    }

?>