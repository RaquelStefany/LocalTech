<?php

    $tec1 = $conexao->prepare("SELECT count(a.id_atendimento) as QTD, concat(t.nome, ' ', t.sobrenome) as Tecnico from atendimento as a inner join tecnico as t on t.id_tecnico = a.id_tecnico group by a.id_tecnico order by row_number() OVER(ORDER BY a.id_tecnico ASC) limit 0, 1;");
    $tec1->execute();

    if($tec1->rowCount()){
        $LinhaTec1 = $tec1->fetch(PDO::FETCH_ASSOC);

        $qtdt1 = $LinhaTec1['QTD'];
        $tecnico1 = $LinhaTec1['Tecnico'];
    }

    $tec2 = $conexao->prepare("SELECT count(a.id_atendimento) as QTD, concat(t.nome, ' ', t.sobrenome) as Tecnico from atendimento as a inner join tecnico as t on t.id_tecnico = a.id_tecnico group by a.id_tecnico order by row_number() OVER(ORDER BY a.id_tecnico ASC) limit 1, 1;");
    $tec2->execute();

    if($tec2->rowCount()){
        $LinhaTec2 = $tec2->fetch(PDO::FETCH_ASSOC);

        $qtdt2 = $LinhaTec2['QTD'];
        $tecnico2 = $LinhaTec2['Tecnico'];
    }

    $tec3 = $conexao->prepare("SELECT count(a.id_atendimento) as QTD, concat(t.nome, ' ', t.sobrenome) as Tecnico from atendimento as a inner join tecnico as t on t.id_tecnico = a.id_tecnico group by a.id_tecnico order by row_number() OVER(ORDER BY a.id_tecnico ASC) limit 2, 1;");
    $tec3->execute();

    if($tec3->rowCount()){
        $LinhaTec3 = $tec3->fetch(PDO::FETCH_ASSOC);

        $qtdt3 = $LinhaTec3['QTD'];
        $tecnico3 = $LinhaTec3['Tecnico'];
    }
?>

<script>

const labels7 = [
    '<?=$tecnico1?>',
    '<?=$tecnico2?>',
    '<?=$tecnico3?>',
];

const data7 = {
    labels: labels7,
    datasets: [{
        axis: 'y',
        data: ['<?=$qtdt1?>', '<?=$qtdt2?>', '<?=$qtdt3?>'],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
        ],
        borderWidth: 1,
    }]
};

const config7 = {
    type: 'bar',
    data: data7,
    options: {
        indexAxis: 'y',
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Técnicos com mais Atendimentos',
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


const Tecnicos = new Chart(
    document.getElementById('ChartsTecnicos'),
    config7
);

</script>