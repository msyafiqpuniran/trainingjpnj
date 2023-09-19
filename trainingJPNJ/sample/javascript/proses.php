<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST["data"];
    $mesej = "Data yang dihantar: " . $data;
    echo $mesej;
}
