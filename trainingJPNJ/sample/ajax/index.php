<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contoh Ajax dengan PHP dari Pangkalan Data</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h2>Mengambil Data dari Pangkalan Data dengan Ajax</h2>
    <button id="muatData">Muat Data</button>

    <div id="hasil"></div>






    <script>
        $(document).ready(function() {
            $("#muatData").click(function() {
                $.ajax({
                    url: "ambil_data.php",
                    type: "GET",
                    success: function(response) {
                        $("#hasil").html(response);
                    },
                    error: function() {
                        $("#hasil").html("Ralat semasa memuat data.");
                    }
                });
            });
        });
    </script>
</body>

</html>