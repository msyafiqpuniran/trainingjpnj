<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <style>
        /* Add CSS for basic table styling */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>

    <?php
    // Check if the user is authenticated
    session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: login.php"); // Redirect to the login page
        exit();
    }

    // User is authenticated, display protected content
    ?>
</head>

<body>
    <div class="container mt-5">
        <!-- Dashboard content -->
        <h1>Welcome, <?php echo $_SESSION["username"]; ?></h1>
        <p>This is the protected dashboard.</p>

        <h1>Student Detail Marks</h1>

        <table id="detailTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Math Mark</th>
                    <th>Science Mark</th>
                    <th>History Mark</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Your database connection code goes here
                include('db_config.php');
                include('function.php');

                $sql = "SELECT a.id, a.name, b.class_name, a.roll_number, a.math_mark, a.science_mark, a.history_mark FROM students a LEFT JOIN classes b ON a.class = b.class_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $encrypted = encrypt($row["id"]);
                        echo "<tr>
                                  <td>" . $row["roll_number"] . "</td>
                                  <td>" . $row["name"] . "</td>
                                  <td>" . $row["class_name"] . "</td>
                                  <td>" . number_format($row["math_mark"], 2) . "%</td>
                                  <td>" . number_format($row["science_mark"], 2) . "%</td>
                                  <td>" . number_format($row["history_mark"], 2) . "%</td>
                                  <td>
                                      <a href='edit.php?id=" . urlencode($encrypted) . "' class='btn btn-warning btn-sm'>Edit</a>
                                      <a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirmDelete()'>Delete</a>
                                  </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data available</td></tr>";
                }

                // Close your database connection
                $conn->close();
                ?>
            </tbody>
        </table>
        <?php include('navMenu.php'); ?>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>
</body>

</html>