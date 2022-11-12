<?php

    session_start();
    include_once('../../Conexao/Conexao.php');
    ob_start();

    if(isset($_SESSION['tecnico_r'])){

        $query_tecnico = "DELETE FROM tecnico
                            WHERE
                                (id_tecnico = :id);
                        DELETE FROM contato
                            WHERE
                                (id_tecnico = :id);
                        DELETE FROM status
                            WHERE
                                (id_tecnico = :id);";
        $tecnico = $conexao->prepare($query_tecnico);
        $tecnico->bindParam(':id', $_SESSION['tecnico_r']);
        $tecnico->execute();

        if($tecnico->rowCount()){
            unset($_SESSION['tecnico_r']);
            header("Location: ../../../view/admin/view/Tecnico/Tecnicos.php");
        }
    }
    else{
        header("Location: ../../../view/admin/view/Tecnico/Tecnicos.php");
    }

?>