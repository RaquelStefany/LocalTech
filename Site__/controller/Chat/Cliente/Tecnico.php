<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    try {
  
        $usuarios = $conexao->prepare("SELECT t.id_tecnico AS ID, t.cod AS COD, t.nome AS Nome, t.sobrenome AS Sobrenome, t.image AS Imagem, s.status AS Status FROM tecnico AS t INNER JOIN status AS s ON t.id_tecnico = s.id_tecnico ORDER BY t.nome ASC;");
        $usuarios->execute();

        $verificar = $usuarios->rowCount();

        if($verificar != 0){
            foreach ($usuarios->fetchAll() as $row) {
            
                ($row['Status'] == "Offline") ? $offline = "offline" : $offline = "";
    
                $tecnicos = $conexao->prepare("SELECT id_tecnico as ID FROM atendimento WHERE id_cliente = :id AND fim = '0000-00-00 00:00:00';");
                $tecnicos->bindParam(':id', $_SESSION['id_cliente']);
                $tecnicos->execute();
    
                $row_tecnico = $tecnicos->fetch(PDO::FETCH_ASSOC);
    
                if($tecnicos->rowCount()){
                    if($row_tecnico['ID'] == $row['ID']){
                        echo "<a href='../../../../controller/Chat/Cliente/Dados.php?cod=" . $row['COD'] . "'>
                            <div class='content'>
                                <img src='../../../assets/images/ImagensPerfil/" . $row['Imagem'] . "' alt=''>
                                <div class='details'>
                                    <span>Técnico - " . $row['Nome'] . " " . $row['Sobrenome'] . "</span>
                                    <p> Em Atendimento com Você </p>
                                </div>
                            </div>
                                <div class='status-dot " . $offline . "'><i class='uil uil-circle'></i></div>
                        </a>";
                    }/* 
                    if($row_tecnico['ID'] != $row['ID']){
                        echo "<a href='../../../../controller/Chat/Cliente/Dados.php?cod=" . $row['COD'] . "'>
                            <div class='content'>
                                <img src='../../../assets/images/ImagensPerfil/" . $row['Imagem'] . "' alt=''>
                                <div class='details'>
                                    <span>Técnico - " . $row['Nome'] . " " . $row['Sobrenome'] . "</span>
                                    <p>" . $row['Status'] . "</p>
                                </div>
                            </div>
                                <div class='status-dot " . $offline . "'><i class='uil uil-circle'></i></div>
                        </a>";
                    } */
                }
                else{
                    echo "<a href='../../../../controller/Chat/Cliente/Dados.php?cod=" . $row['COD'] . "'>
                            <div class='content'>
                                <img src='../../../assets/images/ImagensPerfil/" . $row['Imagem'] . "' alt=''>
                                <div class='details'>
                                    <span>Técnico - " . $row['Nome'] . " " . $row['Sobrenome'] . "</span>
                                    <p>" . $row['Status'] . "</p>
                                </div>
                            </div>
                                <div class='status-dot " . $offline . "'><i class='uil uil-circle'></i></div>
                        </a>";
                }
    
            }
        }
        else{
            echo "<p style='text-align: center; color: red;'>
                    Sem Técnicos disponíveis no momento.
                </p>";
        }
      
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }

?>
