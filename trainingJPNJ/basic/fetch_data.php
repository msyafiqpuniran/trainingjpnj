<?php
// Database connection
include('db_config.php');

// Get the selected class from the query parameter
if (isset($_GET["class"])) {
    $selectedClass = $_GET["class"];

    // SQL query to retrieve data for the selected class
    if (!empty($selectedClass)) {
        $sql = "SELECT AVG(math_mark) AS avg_math, AVG(science_mark) AS avg_science, AVG(history_mark) AS avg_history FROM students WHERE class = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $selectedClass);
    } else {
        // If no class is selected, retrieve data for all classes
        $sql = "SELECT AVG(math_mark) AS avg_math, AVG(science_mark) AS avg_science, AVG(history_mark) AS avg_history FROM students";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $avgMath = number_format($row["avg_math"], 2);
        $avgScience = number_format($row["avg_science"], 2);
        $avgHistory = number_format($row["avg_history"], 2);

        // Create an array with average grades and labels
        $data = array(
            "labels" => ["Math", "Science", "History"],
            "values" => [$avgMath, $avgScience, $avgHistory]
        );

        // Return data as JSON
        echo json_encode($data);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
