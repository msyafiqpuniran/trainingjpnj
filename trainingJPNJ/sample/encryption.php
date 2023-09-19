<?php
include('config.php'); // Sesuaikan path ke file config.php

$data = "Ini adalah data rahsia";

$encrypted = openssl_encrypt($data, "aes-256-cbc", $config['key'], 0, $config['iv']);
$decrypted = openssl_decrypt($encrypted, "aes-256-cbc", $config['key'], 0, $config['iv']);

echo "Data Enkripsi: " . $encrypted . "<br>";
echo "Data Dekripsi: " . $decrypted;
