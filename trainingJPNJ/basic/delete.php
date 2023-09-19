<?php
include('db_config.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
<br /><br /><a href="detail_mark.php">Back to Detail Marks</a>