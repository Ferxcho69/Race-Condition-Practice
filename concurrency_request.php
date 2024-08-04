<?php
$account_number = "ACC1234567890"; // Cambiar según sea necesario
$withdrawal_amount = 10; // Monto a retirar en cada solicitud
$num_threads = 1000; // Número de solicitudes concurrentes

$urls = array_fill(0, $num_threads, "http://localhost/withdraw_simulate.php");

$mh = curl_multi_init();
$curl_array = array();

foreach ($urls as $i => $url) {
    $curl_array[$i] = curl_init($url);
    curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_array[$i], CURLOPT_POST, true);
    curl_setopt($curl_array[$i], CURLOPT_POSTFIELDS, http_build_query([
        'account_number' => $account_number,
        'withdrawal_amount' => $withdrawal_amount,
        'num_threads' => 1
    ]));
    curl_multi_add_handle($mh, $curl_array[$i]);
}

$running = NULL;
do {
    curl_multi_exec($mh, $running);
    curl_multi_select($mh);
} while ($running > 0);

$responses = [];
foreach ($urls as $i => $url) {
    $responses[] = curl_multi_getcontent($curl_array[$i]);
    curl_multi_remove_handle($mh, $curl_array[$i]);
}

curl_multi_close($mh);

// Mostrar las respuestas
foreach ($responses as $response) {
    echo $response . PHP_EOL;
}
?>
