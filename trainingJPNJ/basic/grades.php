<!DOCTYPE html>
<html>

<head>
    <title>Average Grades</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Average Grades</h1>

        <?php
        // Your PHP code to fetch and display average grades goes here
        // Assuming $avg_math, $avg_science, $avg_history are available
        include('db_config.php');

        $sql = "SELECT b.class_name, AVG(a.math_mark) AS avg_math, AVG(a.science_mark) AS avg_science, AVG(a.history_mark) AS avg_history FROM students a LEFT JOIN classes b ON a.class = b.class_id GROUP BY b.class_name";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            echo "<table id='detailTable' class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Average Math Grade</th>
                                    <th>Average Science Grade</th>
                                    <th>Average History Grade</th>
                                </tr>
                            </thead>
                            <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                                  <td>" . $row["class_name"] . "</td>
                                  <td>" . number_format($row["avg_math"], 2) . "%</td>
                                  <td>" . number_format($row["avg_science"], 2) . "%</td>
                                  <td>" . number_format($row["avg_history"], 2) . "%</td>
                              </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "No data available";
        }
        $conn->close();
        ?>

        <?php include('navMenu.php'); ?>

    </div>
</body>

</html>