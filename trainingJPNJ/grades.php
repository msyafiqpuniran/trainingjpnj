<!DOCTYPE html>
<html>

<head>
    <title>Average Grades</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
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

    <!-- Include Bootstrap JS and jQuery (for some components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include DataTables JS and Bootstrap JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#detailTable').DataTable();
        });
    </script>
</body>

</html>