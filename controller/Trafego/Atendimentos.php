<?php

    $porcentagem = $conexao->prepare("SELECT (SELECT count(a.id_atendimento) FROM atendimento as a where a.fim = '0000-00-00 00:00:00') as Aberto, (SELECT count(a.id_atendimento) FROM atendimento as a inner join status as s on a.id_cliente = s.id_cliente where a.fim = '0000-00-00 00:00:00' and s.status = 'Em Atendimento') as Andamento, (SELECT count(a.id_atendimento) FROM atendimento as a where a.fim != '0000-00-00 00:00:00') as Fechado, (SELECT count(a.id_atendimento) FROM atendimento as a where a.id_reabertura != 0) as Reaberto;");
    $porcentagem->execute();

    if($porcentagem->rowCount()){
        $LinhaDados = $porcentagem->fetch(PDO::FETCH_ASSOC);

        $aberto = $LinhaDados['Aberto'];
        $fechado = $LinhaDados['Fechado'];
        $andamento = $LinhaDados['Andamento'];
        $reaberto = $LinhaDados['Reaberto'];
    }
?>

<script>

const labels4 = [
    'Abertos',
    'Fechados',
    'Em Andamento',
    'Reabertos',
];

const data4 = {
    labels: labels4,
    datasets: [{
        axis: 'y',
        data: ['<?=$aberto?>', '<?=$fechado?>', '<?=$andamento?>', '<?=$reaberto?>'],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)',
        ],
        borderWidth: 1,
    }]
};

const config4 = {
    type: 'bar',
    data: data4,
    options: {
        indexAxis: 'y',
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Atendimentos',
                font: {
                    size: 20,
                },
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        },
    },
};


const Atendimentos = new Chart(
    document.getElementById('ChartsAtendimentos'),
    config4
);

</script>