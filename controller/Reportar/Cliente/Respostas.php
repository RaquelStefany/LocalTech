<?php

    try {
    
        $respostas = $conexao->prepare("SELECT cod as Codigo, assunto as Assunto, usuario as Sobre, relatorio as Relatorio, DATE_FORMAT(data, '%d-%M-%Y %H:%i') as Data, resposta as Resposta from report where id_cliente = {$_SESSION['id_cliente']} order by id_report desc");
        $respostas->execute();
        
        while ($linha = $respostas->fetchObject()) {
            if($linha->Resposta == ""){
                $resposta = "Aguardando Resposta";
            }
            else{
                $resposta = $linha->Resposta;
            }
            echo "<div class='respostas'>
                    <h3 style='text-align: center;'>
                        Report - OS{$linha->Codigo}
                    </h3>
                    <br>
                    <h5 style='text-align: right; color: grey;'>
                        {$linha->Data}
                    </h5>
                    <h5>
                        <span style='color: dimgray;'>Assunto:</span> {$linha->Assunto}
                    </h5>
                    <h5>
                        <span style='color: dimgray;'>Sobre:</span> {$linha->Sobre}
                    </h5>
                    <h5>
                        <span style='color: dimgray;'>Relatório:</span> {$linha->Relatorio}
                    </h5>
                    <br>
                    <h4>
                        <span style='color: dimgray;'>Resposta:</span> {$resposta}
                    </h4>
                </div>";
        }
        echo '<br>';
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "<br>";

?>