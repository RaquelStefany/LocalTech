<?php

    include('../../Conexao/Conexao.php');

    $usuariosult = $conexao->prepare("SELECT image, nome, sobrenome, cpf, cnpj FROM cliente ORDER BY id_cliente DESC LIMIT 2;");
    $usuariosult->execute();
    
    echo "<table class='dadosdash'>
        <tbody>";
    while ($linha = $usuariosult->fetchObject()) {
    echo "<tr>
            <td class='imguserdash'><img src='../../assets/images/ImagensPerfil/{$linha->image}'></td>
            <td>{$linha->nome} {$linha->sobrenome}</td>
        </tr>";
    }
    echo "</tbody>
        </table>";        

?>