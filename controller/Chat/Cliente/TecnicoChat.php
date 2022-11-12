<?php

    if(isset($_SESSION['tecnico_chat'])){
        $usuario = "SELECT t.id_tecnico AS ID, t.cod AS COD, t.nome AS Nome, t.sobrenome AS Sobrenome, t.image AS Imagem, s.status AS Status FROM tecnico AS t INNER JOIN status AS s ON t.id_tecnico = s.id_tecnico WHERE t.cod = {$_SESSION['tecnico_chat']}";

        $usuarios = $conexao->prepare($usuario);
        $usuarios->execute();

        if($usuarios->rowCount()){
            $tec_chat = $usuarios->fetch(PDO::FETCH_ASSOC);
        }
    }
    else{
        header("Location: tecnicos.php");
    }

?>