<?php

    try {
    
        $tecnicos = $conexao->prepare("SELECT 
                                            c.nome AS Nome,
                                            c.sobrenome AS Sobrenome
                                        FROM
                                            cliente AS c;");
        $tecnicos->execute();
        
        while ($linha = $tecnicos->fetchObject()) {
            echo "<option value='{$linha->Nome} {$linha->Sobrenome}'>{$linha->Nome} {$linha->Sobrenome}</option>";
        }
        echo '</select>';
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "</select>";

?>