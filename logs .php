<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configuración de la base de datos
$servername = "localhost";
$username = "goloza69";  
$password = "lacone";  
$dbname = "bank";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los registros de la tabla logs
$sql = "SELECT account_number, transaction_type, amount, transaction_date FROM logs ORDER BY transaction_date DESC";
$result = $conn->query($sql);

// Verificar si la consulta tiene éxito
if ($result === FALSE) {
    die("Error al ejecutar la consulta: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs de Transacciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Logs de Transacciones</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Número de Cuenta</th>
                    <th>Tipo de Transacción</th>
                    <th>Monto</th>
                    <th>Fecha de Transacción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['account_number']}</td>
                                <td>{$row['transaction_type']}</td>
                                <td>{$row['amount']}</td>
                                <td>{$row['transaction_date']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay registros</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
