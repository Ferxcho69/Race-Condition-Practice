<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retiro de Dinero</title>
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
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Realizar Retiro</h2>
        <form id="withdrawForm">
            <div class="form-group">
                <label for="account_number">Número de Cuenta:</label>
                <input type="text" class="form-control" id="account_number" name="account_number" required>
            </div>
            <div class="form-group">
                <label for="withdrawal_amount">Monto a Retirar:</label>
                <input type="number" class="form-control" id="withdrawal_amount" name="withdrawal_amount" required step="0.01">
            </div>
            <div class="form-group">
                <label for="num_threads">Número de Hilos Simultáneos:</label>
                <input type="number" class="form-control" id="num_threads" name="num_threads" required value="1">
            </div>
            <button type="submit" class="btn btn-primary">Retirar</button>
        </form>
        <div id="result" class="mt-4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#withdrawForm').on('submit', function(event) {
                event.preventDefault();
                const formData = $(this).serialize();
                
                $.ajax({
                    url: 'withdraw_simulate.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        $('#result').html('<div class="alert alert-success">Retiro completado. Redirigiendo a logs...</div>');
                        setTimeout(function() {
                            window.location.href = 'logs.php';
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        $('#result').html('<div class="alert alert-danger">Error: ' + error + '</div>');
                    }
                });
            });
        });
    </script>
</body>
</html>
