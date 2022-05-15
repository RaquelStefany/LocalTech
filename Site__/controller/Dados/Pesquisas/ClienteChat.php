<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    
    $texto = $_POST['searchTerm'];
    //echo $texto;
    $output = "";
    
    $pesquisa = "SELECT c.cod AS COD, c.nome AS Nome, c.sobrenome AS Sobrenome, c.image AS Imagem, s.status AS Status FROM cliente AS c INNER JOIN status AS s ON c.id_cliente = s.id_cliente WHERE c.nome LIKE '%{$texto}%' OR c.sobrenome LIKE '%{$texto}%'";

    $usuarios = $conexao->prepare($pesquisa);
    $usuarios->execute();

    $search = $usuarios->rowCount();

    $row = $usuarios->fetch(PDO::FETCH_ASSOC);

    if($search > 0){
        //while ($linha = $usuarios->fetchObject()) {
            ($row['Status'] == "Offline") ? $offline = "offline" : $offline = "";

                echo "<a href='chat.php?id=" . $row['COD'] . "'>
            <div class='content'>
                <img src='../../../assets/images/ImagensPerfil/" . $row['Imagem'] . "' alt=''>
                <div class='details'>
                    <span>Técnico - " . $row['Nome'] . " " . $row['Sobrenome'] . "</span>
                    <p>" . $row['Status'] . "</p>
                </div>
            </div>
            <div class='status-dot " . $offline . "'><i class='uil uil-circle'></i></div>
        </a>";
        //}
    }
    else{
        $output .= "Não foram encontrados usuarios em sua pesquisa";
    }

    echo $output;
?>