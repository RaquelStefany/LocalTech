<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    try {
  
        $usuarios = $conexao->prepare("SELECT DISTINCT c.id_cliente AS ID, c.cod AS COD, c.nome AS Nome, c.sobrenome AS Sobrenome, c.image AS Imagem, s.status AS Status FROM cliente AS c INNER JOIN status AS s INNER JOIN atendimento AS a ON c.id_cliente = s.id_cliente AND c.id_cliente = a.id_cliente WHERE a.id_tecnico = {$_SESSION['id_tecnico']} AND fim = '0000-00-00 00:00:00';");
        $usuarios->execute();

        if($usuarios->rowCount()){
            foreach ($usuarios->fetchAll() as $row) {
                
                ($row['Status'] == "Offline") ? $offline = "offline" : $offline = "";
    
                    echo "<a href='../../../../controller/Chat/Tecnico/Dados.php?cod=" . $row['COD'] . "'>
                        <div class='content'>
                            <img src='../../../assets/images/ImagensPerfil/" . $row['Imagem'] . "' alt=''>
                            <div class='details'>
                                <span>Cliente - " . $row['Nome'] . " " . $row['Sobrenome'] . "</span>
                                <p> Aguardando seu Atendimento </p>
                            </div>
                        </div>
                            <div class='status-dot " . $offline . "'><i class='uil uil-circle'></i></div>
                    </a>";
            }
        }
        else{
            echo "<p style='text-align: center;color: red;'>Sem Atendimentos Pendentes<p>";
        }        
      
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }

?>
