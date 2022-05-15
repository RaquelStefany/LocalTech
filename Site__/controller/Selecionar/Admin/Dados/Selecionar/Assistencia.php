<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Selecionar'])){

        if(isset($_POST['assistencia'])){

            $assistencia = $dados['assistencia'];

            $_SESSION['dado_assistencia'] = $assistencia;

            if($_SESSION['dado_assistencia']){
                header("Location: Dados.php");
            }
        }
    }

?>