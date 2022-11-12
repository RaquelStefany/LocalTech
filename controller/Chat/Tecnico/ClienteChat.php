<?php

    if(isset($_SESSION['cliente_chat'])){
        $usuario = "SELECT c.id_cliente AS ID, c.cod AS COD, c.nome AS Nome, c.sobrenome AS Sobrenome, c.image AS Imagem, s.status AS Status FROM cliente AS c INNER JOIN status AS s ON c.id_cliente = s.id_cliente WHERE c.cod = {$_SESSION['cliente_chat']}";

        $usuarios = $conexao->prepare($usuario);
        $usuarios->execute();

        if($usuarios->rowCount()){
            $cli_chat = $usuarios->fetch(PDO::FETCH_ASSOC);
        }
    }
    else{
        header("Location: clientes.php");
    }

?>