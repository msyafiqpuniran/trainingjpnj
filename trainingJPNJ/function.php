<?php

function encrypt($value)
{
    include('db_config.php'); // Sesuaikan path ke file config.php

    $encrypted = openssl_encrypt($value, "aes-256-cbc", $config['key'], 0, $config['iv']);
    return $encrypted;
}

function decrypt($value)
{
    include('db_config.php'); // Sesuaikan path ke file config.php

    $decrypt = openssl_decrypt($value, "aes-256-cbc", $config['key'], 0, $config['iv']);
    return $decrypt;
}
