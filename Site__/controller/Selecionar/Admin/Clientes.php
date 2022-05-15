<?php

    try {
    
        $usuarios = $conexao->prepare("SELECT 
                                            c.id_cliente AS ID,
                                            c.cod AS COD,
                                            c.image AS Imagem,
                                            c.nome AS Nome,
                                            c.sobrenome AS Sobrenome,
                                            c.tipo AS Tipo,
                                            c.cpf AS CPF,
                                            c.cnpj AS CNPJ,
                                            DATE_FORMAT(c.datanascimento, '%d %M %Y') AS Nascimento,
                                            DATE_FORMAT(c.cadastro, '%d %M %Y') AS Cadastro,
                                            cc.email AS Email,
                                            cc.telefone AS Telefone,
                                            e.cep AS CEP,
                                            e.logradouro AS Logradouro,
                                            e.numero AS Numero,
                                            e.complemento AS Complemento,
                                            b.nome AS Bairro,
                                            cdd.nome AS Cidade,
                                            etd.sigla AS Estado,
                                            s.status AS Status
                                        FROM
                                            cliente AS c
                                                INNER JOIN
                                            contato AS cc
                                                INNER JOIN
                                            endereco AS e
                                                INNER JOIN
                                            bairro AS b
                                                INNER JOIN
                                            cidade AS cdd
                                                INNER JOIN
                                            estado AS etd
                                                INNER JOIN
                                            status AS s ON c.id_cliente = cc.id_cliente
                                                AND c.id_cliente = e.id_cliente
                                                AND c.id_cliente = s.id_cliente
                                                AND e.id_bairro = b.id_bairro
                                                AND b.id_cidade = cdd.id_cidade
                                                AND cdd.id_estado = etd.id_estado;");
        $usuarios->execute();
        
        while ($linha = $usuarios->fetchObject()) {
        echo "<tr>
                <td>
                    <input type='radio' id='cliente' name='cliente' value='{$linha->ID}' required>
                </td>
                <td>
                    {$linha->ID}
                </td>
                <td>
                    <img src='../../../assets/images/ImagensPerfil/{$linha->Imagem}'>
                </td>
                <td>
                    {$linha->Nome} {$linha->Sobrenome}
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