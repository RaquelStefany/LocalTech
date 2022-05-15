<?php

    if((isset($_SESSION['id_cliente'])) AND (isset($_SESSION['nome_cliente']))){
        header("Location: ../PerfilCliente/dashboard-cliente.php");
    }

    if((isset($_SESSION['id_tecnico'])) AND (isset($_SESSION['nome_tecnico']))){
        header("Location: ../PerfilTecnico/dashboard-tecnico.php");
    }

    if((isset($_SESSION['id_assistencia'])) AND (isset($_SESSION['nome_assistencia']))){
        header("Location: ../PerfilAssistencia/dashboard-assistencia.php");
    }

    unset($_SESSION['verificado']);
    unset($_SESSION['everificado']);
    unset($_SESSION['verificar']);
    unset($_SESSION['reverificar']);

?>