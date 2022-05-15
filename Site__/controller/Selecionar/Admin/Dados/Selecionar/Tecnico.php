<?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(isset($dados['Selecionar'])){

        if(isset($_POST['tecnico'])){

            $tecnico = $dados['tecnico'];

            $_SESSION['dado_tecnico'] = $tecnico;

            if($_SESSION['dado_tecnico']){
                header("Location: Dados.php");
            }
        }
    }

?>