<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "localtech";
    $porta = 3306;

    $conexao2 = new PDO("mysql:host=$host;port=$porta;dbname=".$dbname, $user, $password);

    try {
    
        $assistencia = $conexao2->prepare("SELECT 
                                            a.nome AS Nome
                                        FROM
                                            assistencia AS a;");
        $assistencia->execute();
        
        while ($linha = $assistencia->fetchObject()) {
            echo "<option value='{$linha->Nome}'>{$linha->Nome}</option>";
        }
        echo '</select>';
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "</select>";

?>