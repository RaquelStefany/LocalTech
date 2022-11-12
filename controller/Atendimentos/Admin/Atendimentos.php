<?php

    try {

        $VerificarAtendimentos = "SELECT a.id_atendimento AS ID, a.cod AS Codigo, CONCAT(c.nome, ' ', c.sobrenome) AS Cliente, CONCAT(t.nome, ' ', t.sobrenome) AS Tecnico, DATE_FORMAT(a.inicio, '%d-%M-%Y') AS Inicio, IF(a.fim = '0000-00-00 00:00:00', 'Não Finalizado', DATE_FORMAT(a.fim, '%d-%M-%Y')) AS Termino, IF(a.id_reabertura = 0, 'Não Reaberto', CONCAT('OS ', a.id_reabertura)) AS Reaberto FROM atendimento AS a INNER JOIN cliente AS c INNER JOIN tecnico AS t ON c.id_cliente = a.id_cliente AND t.id_tecnico = a.id_tecnico ORDER BY id_atendimento DESC;";
        $Atendimentos = $conexao->prepare($VerificarAtendimentos);
        $Atendimentos->execute();
        
        while ($linha = $Atendimentos->fetchObject()) {
            echo "<tr onclick=\"window.location='../../../../controller/Atendimentos/Admin/Selecionar.php?atendimento=". $linha->ID ."'\" class='infodados'>
                    <td>
                        {$linha->Codigo}
                    </td>
                    <td>
                        {$linha->Inicio}
                    </td>
                    <td>
                        {$linha->Termino}
                    </td>
                    <td>
                        {$linha->Reaberto}
                    </td>
                    <td>
                        <a class='btntable' href='../../../../controller/Atendimentos/Admin/Selecionar.php?atendimento={$linha->ID}'>Detalhes</a>
                    </td>
                </tr>";
        }
        echo "</tbody>
            </table>";
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "</tbody>
            </table>";

?>