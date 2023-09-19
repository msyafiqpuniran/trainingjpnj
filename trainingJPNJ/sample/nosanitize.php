<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $komen = $_POST["komen"];
    // Paparkan komen yang dimasukkan pengguna
    echo "Komen Anda: " . $komen;
}
?>

<form method="post" action="">
    <textarea name="komen"></textarea>
    <button type="submit">Hantar</button>
</form>