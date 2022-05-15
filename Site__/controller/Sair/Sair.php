<?php

    session_start();
    ob_start();
    include_once('../Conexao/Conexao.php');

    if((isset($_SESSION['id_cliente'])) AND (isset($_SESSION['nome_cliente']))){
        $offline = $conexao->prepare("UPDATE status 
                                        SET 
                                            status = 'Offline'
                                        WHERE
                                            id_cliente = {$_SESSION['id_cliente']}");
        $offline->execute();
    }

    if((isset($_SESSION['id_tecnico'])) AND (isset($_SESSION['nome_tecnico']))){
        $offline = $conexao->prepare("UPDATE status 
                                        SET 
                                            status = 'Offline'
                                        WHERE
                                            id_tecnico = {$_SESSION['id_tecnico']}");
        $offline->execute();
    }

    session_destroy();
    $_SESSION['msg'] = "<p class='sair'>Deslogado com sucesso!</p>";

    header("Location: ../../index.php");
    
?>