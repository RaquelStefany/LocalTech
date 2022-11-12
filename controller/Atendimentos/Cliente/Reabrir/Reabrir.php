<?php

    session_start();
    include_once('../../../Conexao/Conexao.php');
    require_once('../../../Dados/Cliente.php');

    $id_idatend = $_GET['idatend'];
    $_SESSION['idatend_atendimento'] = $id_idatend;
    $id_reabrir = $_GET['reabrir'];
    $_SESSION['reabrir_atendimento'] = $id_reabrir;
    $id_tecnico_reabrir = $_GET['tecnico'];
    $_SESSION['tecnico_atendimento'] = $id_tecnico_reabrir;

    if(isset($_SESSION['reabrir_atendimento'])){

        date_default_timezone_set('America/Sao_Paulo');
        $inicio = date('Y-m-d H:i:s');
        $random_cod = rand(time(), 10000000);

        $atendimento = "INSERT INTO atendimento (id_tecnico, id_cliente, cod, inicio) VALUES (:tecnico, :cliente, :cod, :inicio); SELECT id_atendimento FROM atendimento WHERE id_cliente = :id AND fim = '0000-00-00 00:00:00.000000'; UPDATE status SET status = 'Em Atendimento' WHERE id_cliente = :id;";

        $reabrir = $conexao->prepare($atendimento);
        $reabrir->bindParam(':tecnico', $_SESSION['tecnico_atendimento']);
        $reabrir->bindParam(':cliente', $LinhaDados['ID']);
        $reabrir->bindParam(':cod', $random_cod);
        $reabrir->bindParam(':inicio', $inicio);
        $reabrir->bindParam(':reabrir', $_SESSION['reabrir_atendimento']);
        $reabrir->bindParam(':id', $LinhaDados['ID']);
        $reabrir->execute();

        if($reabrir->rowCount()){
            $reabrir->closeCursor();
            $pegar_atendimento = $conexao->prepare("SELECT * FROM atendimento WHERE cod = :cod; SELECT cod AS ID_Tec FROM tecnico WHERE id_tecnico = :tecnico;");
            $pegar_atendimento->bindParam(':cod', $random_cod);
            $pegar_atendimento->bindParam(':tecnico', $_SESSION['tecnico_atendimento']);
            $pegar_atendimento->execute();

            if($pegar_atendimento->rowCount()){

                $row_atendimento = $pegar_atendimento->fetch(PDO::FETCH_ASSOC);

                $id_aten = $row_atendimento['id_atendimento'];

                $pegar_atendimento->closeCursor();
                $pegar_tecnico = $conexao->prepare("SELECT cod AS ID_Tec FROM tecnico WHERE id_tecnico = :tecnico;");
                $pegar_tecnico->bindParam(':tecnico', $_SESSION['tecnico_atendimento']);
                $pegar_tecnico->execute();

                $row_tecnico = $pegar_tecnico->fetch(PDO::FETCH_ASSOC);

                $cod_tec = $row_tecnico['ID_Tec'];

                if($pegar_tecnico->rowCount()){

                    $pegar_atendimento->closeCursor();
    
                    $update_atendimento = $conexao->prepare("UPDATE atendimento SET id_reabertura = :id WHERE id_atendimento = :idatend;");
                    $update_atendimento->bindParam(':id', $random_cod);
                    $update_atendimento->bindParam(':idatend', $_SESSION['idatend_atendimento']);
                    $update_atendimento->execute();
    
                    header("Location: ../../../Chat/Cliente/Dados.php?cod={$cod_tec}");
                }
            }
            else{
                echo "Foi não";
            }
        }
    }

?>