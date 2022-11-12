<?php

    session_start();
    include_once('../../Conexao/Conexao.php');
    ob_start();

    if(isset($_SESSION['assistencia_r'])){
        $query_assistencia = "DELETE FROM assistencia
                            WHERE
                                (id_assistencia = :id);
                        DELETE FROM contato
                            WHERE
                                (id_assistencia = :id);
                        DELETE FROM horario_assistencia
                            WHERE
                                (id_assistencia = :id);
                        DELETE FROM endereco
                            WHERE
                                (id_assistencia = :id);";
        $assistencia = $conexao->prepare($query_assistencia);
        $assistencia->bindParam(':id', $_SESSION['assistencia_r']);
        $assistencia->execute();

        if($assistencia->rowCount()){
            unset($_SESSION['assistencia_r']);
            header("Location: ../../../view/admin/view/Assistencia/Assistencias.php");
        }
    }
    else{
        header("Location: ../../../view/admin/view/Assistencia/Assistencias.php");
    }

?>