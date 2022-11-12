<?php

    try {
    
        $tecnicos = $conexao->prepare("SELECT 
                                            t.nome AS Nome,
                                            t.sobrenome AS Sobrenome
                                        FROM
                                            tecnico AS t;");
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