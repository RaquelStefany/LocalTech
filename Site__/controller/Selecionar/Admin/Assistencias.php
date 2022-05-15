<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                            a.id_assistencia AS ID,
                                            a.cod AS COD,
                                            a.image AS Imagem,
                                            a.nome AS Nome,
                                            a.cnpj AS CNPJ,
                                            DATE_FORMAT(a.cadastro, '%d %M %Y') AS Cadastro,
                                            ha.descricao AS Descricao,
                                            DATE_FORMAT(ha.horaabrir, '%H:%i') AS Hora_Abrir,
                                            DATE_FORMAT(ha.horafechar, '%H:%i') AS Hora_Fechar,
                                            ha.semanainicio AS Semana_Inicio,
                                            ha.semanafinal AS Semana_Final,
                                            cc.email AS Email,
                                            cc.telefone AS Telefone,
                                            e.cep AS CEP,
                                            e.logradouro AS Logradouro,
                                            e.numero AS Numero,
                                            e.complemento AS Complemento,
                                            b.nome AS Bairro,
                                            cdd.nome AS Cidade,
                                            etd.sigla AS Estado
                                        FROM
                                            assistencia AS a
                                                INNER JOIN
                                            endereco AS e
                                                INNER JOIN
                                            contato AS cc
                                                INNER JOIN
                                            estado AS etd
                                                INNER JOIN
                                            cidade AS cdd
                                                INNER JOIN
                                            bairro AS b
                                                INNER JOIN
                                            horario_assistencia AS ha ON a.id_assistencia = cc.id_assistencia
                                                AND a.id_assistencia = e.id_assistencia
                                                AND e.id_bairro = b.id_bairro
                                                AND b.id_cidade = cdd.id_cidade
                                                AND cdd.id_estado = etd.id_estado
                                        GROUP BY a.id_assistencia;");
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
        echo "<tr>
                <td>
                    <input type='radio' id='assistencia' name='assistencia' value='{$linha->ID}' required>
                </td>
                <td>
                    {$linha->ID}
                </td>
                <td>
                    <img src='../../../assets/images/ImagensPerfil/{$linha->Imagem}'>
                </td>
                <td>
                    {$linha->Nome}
                </td>
                <td>
                    {$linha->Email}
                </td>
                <td>
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