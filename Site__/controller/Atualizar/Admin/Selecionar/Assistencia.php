<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Atualizar'])){

        if(isset($_POST['assistencia'])){

            $assistencia = $dados['assistencia'];

            $_SESSION['update_assistencia'] = $assistencia;

            if($_SESSION['update_assistencia']){
                header("Location: Atualizar.php");
            }
        }
    }

?>