<!DOCTYPE html>
<html>

<head>
    <title>Edit Student</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Student Record</h1>

        <?php
        include('db_config.php');
        include('function.php');

        if (isset($_GET["id"])) {
            $id = decrypt($_GET["id"]);
            $sql = "SELECT * FROM students a LEFT JOIN classes b ON a.class = b.class_id WHERE a.id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $class = $row["class"];
                // Display a form with fields to edit student information
                echo "<form action='update.php' method='post'>
                <input type='hidden' name='id' value='" . $row["id"] . "'>
                <label for='name'>Name:</label>
                <input type='text' class='form-control' name='name' value='" . $row["name"] . "' required><br>
                <label for='roll_number'>Roll Number:</label>
                <input type='text' class='form-control' name='roll_number' value='" . $row["roll_number"] . "' readonly><br>
                <label for='class'>Class:</label>
                <select class='form-control' name='class' required>
                <option value=''>Please Select</option>";

                // Retrieve class names from the database
                $classQuery = "SELECT * FROM classes";
                $classResult = $conn->query($classQuery);

                if ($classResult->num_rows > 0) {
                    while ($classRow = $classResult->fetch_assoc()) {
                        $selected = ($classRow["class_id"] === $class) ? "selected" : "";
                        echo "<option value='" . $classRow["class_id"] . "' $selected>" . $classRow["class_name"] . "</option>";
                    }
                }

                echo "</select><br>
                <label for='math_mark'>Math Mark:</label>
                <input type='number' class='form-control' name='math_mark' step='0.01' value='" . $row["math_mark"] . "' required><br>
                <label for='science_mark'>Science Mark:</label>
                <input type='number' class='form-control' name='science_mark' step='0.01' value='" . $row["science_mark"] . "' required><br>
                <label for='history_mark'>History Mark:</label>
                <input type='number' class='form-control' name='history_mark' step='0.01' value='" . $row["history_mark"] . "' required><br>
                <input type='submit' class='btn btn-primary' value='Update'>
            </form>";
            } else {
                echo "Record not found.";
            }
        } else {
            echo "Invalid request.";
        }

        $conn->close();
        ?>
        <br />

        <a href="index.php">Home</a>
    </div>
</body>

</html>