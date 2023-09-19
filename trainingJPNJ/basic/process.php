<?php
include('db_config.php');

//info
// mysqli_real_escape_string() is used to escape and sanitize string inputs.
// floatval() is used to sanitize float inputs.
// Prepared statements and parameter binding are used to prevent SQL injection.

// Initialize variables with sanitized data
$name = mysqli_real_escape_string($conn, $_POST["name"]);
$roll_number = mysqli_real_escape_string($conn, $_POST["roll_number"]);
$class = mysqli_real_escape_string($conn, $_POST["class"]);
$math_mark = floatval($_POST["math_mark"]);
$science_mark = floatval($_POST["science_mark"]);
$history_mark = floatval($_POST["history_mark"]);


// Perform SQL insertion using prepared statement
$stmt = $conn->prepare("INSERT INTO students (name, roll_number, class, math_mark, science_mark, history_mark) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssddd", $name, $roll_number, $class, $math_mark, $science_mark, $history_mark);

//bind param meaning
// i - integer
// d - double
// s - string
// b - BLOB

if ($conn->query($sql) === TRUE) {
    // Display JavaScript alert and redirect back to index.php
    echo "<script>
        alert('Record successfully created');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Error creating record: '" . $sql .  "<br>" . $conn->error . "');
        window.location.href = document.referrer;
    </script>";
}

$stmt->close();
$conn->close();
