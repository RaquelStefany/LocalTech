<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');
    
    $texto = $_POST['searchTerm'];
    //echo $texto;
    $output = "";
    
    $pesquisa = "SELECT t.cod AS COD, t.nome AS Nome, t.sobrenome AS Sobrenome, t.image AS Imagem, s.status AS Status FROM tecnico AS t INNER JOIN status AS s ON t.id_tecnico = s.id_tecnico WHERE t.nome LIKE '%{$texto}%' OR t.sobrenome LIKE '%{$texto}%'";

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