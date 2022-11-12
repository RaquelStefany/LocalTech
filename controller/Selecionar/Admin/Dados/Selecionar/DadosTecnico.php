<?php

    session_start();
    ob_start();

    $dados = $_GET['tecnico'];

    if(isset($dados)){

        if($dados != ""){

            $_SESSION['dado_tecnico'] = $dados;

            if($_SESSION['dado_tecnico']){
                header("Location: ../../../../../view/admin/view/Tecnico/Dados.php");
            }
        }
    }

?>