<?php

    session_start();
    ob_start();

    $dados = $_GET['atendimento'];

    if(isset($dados)){

        if($dados != ""){

            $_SESSION['dado_atendimento'] = $dados;

            if($_SESSION['dado_atendimento']){
                header("Location: ../../../view/admin/view/Atendimentos/Dados.php");
            }
        }
    }

?>