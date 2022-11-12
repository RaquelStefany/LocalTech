<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Atualizar'])){

        if(isset($_POST['tecnico'])){

            $tecnico = $dados['tecnico'];

            $_SESSION['update_tecnico'] = $tecnico;

            if($_SESSION['update_tecnico']){
                header("Location: Atualizar.php");
            }
        }
    }

?>