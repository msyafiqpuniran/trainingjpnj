<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //info
    // mysqli_real_escape_string() is used to escape and sanitize string inputs.
    // floatval() is used to sanitize float inputs.
    // Prepared statements and parameter binding are used to prevent SQL injection.

    // Initialize variables with sanitized data
    $id = intval($_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $class = mysqli_real_escape_string($conn, $_POST["class"]);
    $math_mark = floatval($_POST["math_mark"]);
    $science_mark = floatval($_POST["science_mark"]);
    $history_mark = floatval($_POST["history_mark"]);

    // Perform SQL update using prepared statement
    $stmt = $conn->prepare("UPDATE students SET name = ?, class = ?, math_mark = ?, science_mark = ?, history_mark = ? WHERE id = ?");
    $stmt->bind_param("ssdddi", $name, $class, $math_mark, $science_mark, $history_mark, $id);

    //bind param meaning
    // i - integer
    // d - double
    // s - string
    // b - BLOB

    if ($conn->query($sql) === TRUE) {
        // echo "Record updated successfully.";

        // Display JavaScript alert and redirect back to index.php
        echo "<script>
            alert('Record successfully updated');
            window.location.href = 'index.php';
        </script>";
    } else {
        // echo "Error updating record: " . $conn->error;

        echo "<script>
            alert('Error updating record: '" . $sql .  "<br>" . $conn->error . "');
            window.location.href = document.referrer;
        </script>";
    }
}

$stmt->close();
$conn->close();
?>

<br /><br /><a href="index.php">Home</a>