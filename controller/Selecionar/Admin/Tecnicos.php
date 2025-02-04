<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                            t.id_tecnico AS ID,
                                            t.cod AS COD,
                                            t.image AS Imagem,
                                            t.nome AS Nome,
                                            t.sobrenome AS Sobrenome,
                                            t.tipo AS Tipo,
                                            t.cpf AS CPF,
                                            t.cnpj AS CNPJ,
                                            DATE_FORMAT(t.datanascimento, '%d %M %Y') AS Nascimento,
                                            DATE_FORMAT(t.cadastro, '%d %M %Y') AS Cadastro,
                                            cc.email AS Email,
                                            cc.telefone AS Telefone,
                                            s.status AS Status
                                        FROM
                                            tecnico AS t
                                                INNER JOIN
                                            contato AS cc
                                                INNER JOIN
                                            status AS s ON t.id_tecnico = cc.id_tecnico
                                                AND t.id_tecnico = s.id_tecnico;");
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
        echo "<tr class='infodados'>
                <td>
                    <input type='radio' id='tecnico' name='tecnico' value='{$linha->ID}' required>
                </td>
                <td onclick=\"window.location='../../../../controller/Selecionar/Admin/Dados/Selecionar/DadosTecnico.php?tecnico=". $linha->ID ."'\">
                    <img src='../../../assets/images/ImagensPerfil/{$linha->Imagem}'>
                </td>
                <td onclick=\"window.location='../../../../controller/Selecionar/Admin/Dados/Selecionar/DadosTecnico.php?tecnico=". $linha->ID ."'\">
                    {$linha->Nome} {$linha->Sobrenome}
                </td>
                <td onclick=\"window.location='../../../../controller/Selecionar/Admin/Dados/Selecionar/DadosTecnico.php?tecnico=". $linha->ID ."'\">
                    {$linha->Email}
                </td>
                <td onclick=\"window.location='../../../../controller/Selecionar/Admin/Dados/Selecionar/DadosTecnico.php?tecnico=". $linha->ID ."'\">
                    {$linha->Cadastro}
                </td>
            </tr>";
        }
        echo '</table>';
    
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conexao = null;
    echo "</table>";

?>