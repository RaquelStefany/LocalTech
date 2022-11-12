<?php

    session_start();
    include_once('../../Conexao/Conexao.php');
    ob_start();

    if(isset($_SESSION['cliente_r'])){
        $query_cliente = "DELETE FROM cliente
                            WHERE
                                (id_cliente = :id);
                        DELETE FROM contato
                            WHERE
                                (id_cliente = :id);
                        DELETE FROM endereco
                            WHERE
                                (id_cliente = :id);
                        DELETE FROM status
                            WHERE
                                (id_cliente = :id);";
        $Cliente = $conexao->prepare($query_cliente);
        $Cliente->bindParam(':id', $_SESSION['cliente_r']);
        $Cliente->execute();

        if($Cliente->rowCount()){
            unset($_SESSION['cliente_r']);
            header("Location: ../../../view/admin/view/Cliente/Clientes.php");
        }
    }
    else{
        header("Location: ../../../view/admin/view/Cliente/Clientes.php");
    }

?>