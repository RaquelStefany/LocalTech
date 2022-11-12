<?php

    $porcentagem = $conexao->prepare("SELECT (select count(c.id_cliente) as cliente from cliente as c) as Cliente, (select count(t.id_tecnico) as tecnico from tecnico as t) as Tecnico, (select count(a.id_assistencia) as assistencia from assistencia as a) as Assistencia;");
    $porcentagem->execute();

    if($porcentagem->rowCount()){
        $LinhaDados = $porcentagem->fetch(PDO::FETCH_ASSOC);

        $total = $LinhaDados['Cliente'] + $LinhaDados['Tecnico'] + $LinhaDados['Assistencia'];

        $cliente = ($LinhaDados['Cliente'] / $total) * 100;
        $tecnico = ($LinhaDados['Tecnico'] / $total) * 100;
        $assistencia = ($LinhaDados['Assistencia'] / $total) * 100;
    }
?>

<script>

const labels2 = [
    'Cliente',
    'Técnico',
    'Assistência',
];

const data2 = {
    labels: labels2,
    datasets: [{
        data: ['<?=intval($cliente)?>', '<?=intval($tecnico)?>', '<?=intval($assistencia)?>'],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
        ],
        borderWidth: 1,
        hoverOffset: 4
    }]
};

const config2 = {
    type: 'pie',
    data: data2,
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: 'Porcentagem de Cadastros',
                font: {
                    size: 20,
                },
            }
        },
    },
};


const Porcentagem = new Chart(
    document.getElementById('ChartsPorcentagem'),
    config2
);

</script>