<!DOCTYPE html>
<html>

<head>
    <title>Student Report</title>
</head>

<body>
    <h1>Student Report</h1>

    <nav>
        <ul>
            <li><a href="?action=group_by">Group By</a></li>
            <li><a href="?action=order_by">Order By</a></li>
            <li><a href="?action=limit_by">Limit By</a></li>
        </ul>
    </nav>

    <?php
    // Database connection code (replace with your actual database credentials)
    include('../db_config.php');

    // Check the "action" parameter to determine which query to execute
    if (isset($_GET["action"])) {
        $action = $_GET["action"];

        switch ($action) {
            case "group_by":
                // Query with GROUP BY and SUM for total students
                $sql = "SELECT c.class_name, COUNT(s.id) AS num_students, SUM(COUNT(s.id)) OVER () AS total_students FROM classes c LEFT JOIN students s ON c.class_id = s.class GROUP BY c.class_name;";
                $result = $conn->query($sql);

                // Display the report based on the query result
                echo "<h2>Grouped By Class (with Total Students)</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Class Name</th><th>Number of Students</th><th>Total Students</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["class_name"] . "</td>";
                    echo "<td>" . $row["num_students"] . "</td>";
                    echo "<td>" . $row["total_students"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                break;
            case "order_by":
                // Query with ORDER BY
                $sql = "SELECT c.class_name, COUNT(s.id) AS num_students FROM classes c LEFT JOIN students s ON c.class_id = s.class GROUP BY c.class_name ORDER BY c.class_name ASC;";
                $result = $conn->query($sql);

                // Display the report based on the query result
                echo "<h2>Ordered By Number of Students</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Class Name</th><th>Number of Students</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["class_name"] . "</td>";
                    echo "<td>" . $row["num_students"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                break;
            case "limit_by":
                // Query with LIMIT
                $sql = "SELECT c.class_name, COUNT(s.id) AS num_students FROM classes c LEFT JOIN students s ON c.class_id = s.class GROUP BY c.class_name LIMIT 2;";
                $result = $conn->query($sql);

                // Display the report based on the query result
                echo "<h2>Limited To Top 2 Classes</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Class Name</th><th>Number of Students</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["class_name"] . "</td>";
                    echo "<td>" . $row["num_students"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                break;
            default:
                // Default action or error handling
                echo "Invalid action.";
                break;
        }
    } else {
        // Default action or initial page load
        echo "Select an action from the navigation menu.";
    }

    // Close the database connection
    $conn->close();
    ?>

</body>

</html>