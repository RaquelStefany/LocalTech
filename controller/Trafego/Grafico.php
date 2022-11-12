<?php

    $porcentagem = $conexao->prepare("SELECT (select count(c.id_cliente) as cliente from cliente as c) as Cliente, (select count(t.id_tecnico) as tecnico from tecnico as t) as Tecnico, (select count(a.id_assistencia) as assistencia from assistencia as a) as Assistencia;");
    $porcentagem->execute();

    if($porcentagem->rowCount()){
        $LinhaDados = $porcentagem->fetch(PDO::FETCH_ASSOC);

        $cliente = $LinhaDados['Cliente'];
        $tecnico = $LinhaDados['Tecnico'];
        $assistencia = $LinhaDados['Assistencia'];
    }
?>

<script>

const labels = [
    'Cliente',
    'Técnico',
    'Assistência',
];

const data = {
    labels: labels,
    datasets: [{
        data: ['<?=$cliente?>', '<?=$tecnico?>', '<?=$assistencia?>'],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
        ],
        borderWidth: 1,
    }]
};

const config = {
    type: 'bar',
    data: data,
    options: {
        plugins: {
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Usuários Cadastrados',
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


const Grafico = new Chart(
    document.getElementById('ChartsGrafico'),
    config
);

</script>