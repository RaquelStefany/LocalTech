<?php

    session_start();
    include_once('../../../controller/Conexao/Conexao.php');

    try {
  
        $usuarios = $conexao->prepare("SELECT c.id_cliente AS ID, c.cod AS COD, c.nome AS Nome, c.sobrenome AS Sobrenome, c.image AS Imagem, s.status AS Status FROM cliente AS c INNER JOIN status AS s ON c.id_cliente = s.id_cliente ORDER BY c.nome ASC;");
        $usuarios->execute();
        
        foreach ($usuarios->fetchAll() as $row) {
            
            ($row['Status'] == "Offline") ? $offline = "offline" : $offline = "";

            $clientes = $conexao->prepare("SELECT id_cliente as ID FROM atendimento WHERE id_tecnico = :id AND fim = '0000-00-00 00:00:00';");
            $clientes->bindParam(':id', $_SESSION['id_tecnico']);
            $clientes->execute();

            $row_cliente = $clientes->fetch(PDO::FETCH_ASSOC);

            if($clientes->rowCount()){
                echo "<a href='../../../../controller/Chat/Tecnico/Dados.php?cod=" . $row['COD'] . "'>
                    <div class='content'>
                        <img src='../../../assets/images/ImagensPerfil/" . $row['Imagem'] . "' alt=''>
                        <div class='details'>
                            <span>Técnico - " . $row['Nome'] . " " . $row['Sobrenome'] . "</span>
                            <p> Aguardando seu Atendimento </p>
                        </div>
                    </div>
                        <div class='status-dot " . $offline . "'><i class='uil uil-circle'></i></div>
                </a>";
            }
            else{
                echo "<p style='text-align: center;color: red;'>Sem Atendimentos Pendentes<p>";
                break;
            }
        }
      
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }

?>
