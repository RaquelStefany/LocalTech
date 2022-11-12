<?php

    session_start();
    ob_start();

    $dados = $_GET['assistencia'];

    if(isset($dados)){

        if($dados != ""){

            $_SESSION['dado_assistencia'] = $dados;

            if($_SESSION['dado_assistencia']){
                header("Location: ../../../../../view/admin/view/Assistencia/Dados.php");
            }
        }
    }

?>