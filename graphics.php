<?php
$servername = "34.125.240.38";
$username = "admin";
$password = "Temporal1";
$dbname = "viajerodb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Consulta SQL
$sql = "SELECT tipoViajeId, SUM(precio) as suma_precios FROM viajes GROUP BY tipoViajeId";

$result = $conn->query($sql);

// Datos primer grafico
$labels_precios = [];
$data_precios = [];

while ($row = $result->fetch_assoc()) {
    $tipoViajeId = $row['tipoViajeId'];
    $sumaPrecios = $row['suma_precios'];

    $label = ($tipoViajeId == 4) ? 'Terrestres' : 'Aereos';

    $labels_precios[] = $label;
    $data_precios[] = $sumaPrecios;
}

// Consulta SQL
$sql_viajes = "SELECT tipoViajeId, COUNT(*) as suma_viajes FROM viajes GROUP BY tipoViajeId";

$result_viajes = $conn->query($sql_viajes);

//Datos para segundo grafico
$labels_viajes = [];
$data_viajes = [];

while ($row_viajes = $result_viajes->fetch_assoc()) {
    $tipoViajeId_viajes = $row_viajes['tipoViajeId'];
    $sumaViajes = $row_viajes['suma_viajes'];

    $label_viajes = ($tipoViajeId_viajes == 4) ? 'Terrestres' : 'Aereos';

    $labels_viajes[] = $label_viajes;
    $data_viajes[] = $sumaViajes;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Viajes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/jpg" href="img/favicon.jpg">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        canvas {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .chart-container {
            max-width: 800px;
            margin: 0 auto;
            display: block;
            justify-content: space-around;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <div>
            <h2>Informe de Ventas Aereos vs Terrestres</h2>
            <?php
            if (!empty($labels_precios)) {
                echo '<canvas id="chartPrecios" width="400" height="200"></canvas>';
            } else {
                echo "No se encontraron resultados.";
            }
            ?>
        </div>
        
        <div>
            <h2>Cantidad de viajes Aereos vs Terrestres</h2>
            <?php
            if (!empty($labels_viajes)) {
                echo '<canvas id="chartViajes" width="400" height="200"></canvas>';
            } else {
                echo "No se encontraron resultados.";
            }
            ?>
        </div>
    </div>

    <script>
        // Primer Grafico
        var ctxPrecios = document.getElementById('chartPrecios').getContext('2d');
        var chartPrecios = new Chart(ctxPrecios, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_precios); ?>,
                datasets: [{
                    label: 'Ventas',
                    data: <?php echo json_encode($data_precios); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                    grid: {
                            display: false
                        }
                    },
                    y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                return 'Lps ' + value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: 'rgba(0, 0, 0, 0.7)'
                        }
                    },
                    title: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.8)',
                        padding: {
                            top: 10,
                            bottom: 15
                        }
                    }
                }
            }
        });

        // Segundo Grafico
        var ctxViajes = document.getElementById('chartViajes').getContext('2d');
        var chartViajes = new Chart(ctxViajes, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels_viajes); ?>,
                datasets: [{
                    label: 'Viajes',
                    data: <?php echo json_encode($data_viajes); ?>,
                    backgroundColor: 'rgba(153, 153, 102, 0.5)',
                    borderColor: 'rgba(153, 153, 102)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: 'rgba(0, 0, 0, 0.7)'
                        }
                    },
                    title: {
                        display: true,
                        color: 'rgba(0, 0, 0, 0.8)',
                        padding: {
                            top: 10,
                            bottom: 15
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>