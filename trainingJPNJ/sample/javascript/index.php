<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hantar Data</title>
</head>

<body>
    <h2>Menghantar Data kepada PHP</h2>
    <input type="text" id="dataInput" placeholder="Masukkan data">
    <button onclick="hantarData()">Hantar</button>

    <div id="hasil"></div>




    <script>
        function hantarData() {
            var data = document.getElementById("dataInput").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "proses.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById("hasil").innerHTML = xhr.responseText;
                }
            };
            xhr.send("data=" + data);
        }
    </script>
</body>

</html>