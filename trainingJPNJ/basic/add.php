<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Add Student</h1>
        <form action="process.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="roll_number">Roll Number:</label>
                <input type="text" class="form-control" id="roll_number" name="roll_number" required>
            </div>

            <div class="form-group">
                <label for="class">Class:</label>
                <select class="form-control" id="class" name="class" required>
                    <option value="">Please Select</option> <!-- Default option -->
                    <?php
                    // Connect to your database and retrieve class names
                    include('db_config.php');

                    $sql = "SELECT * FROM classes";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["class_id"] . "'>" . $row["class_name"] . "</option>";
                        }
                    }

                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="math_mark">Math Mark:</label>
                <input type="number" class="form-control" id="math_mark" name="math_mark" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="science_mark">Science Mark:</label>
                <input type="number" class="form-control" id="science_mark" name="science_mark" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="history_mark">History Mark:</label>
                <input type="number" class="form-control" id="history_mark" name="history_mark" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <br>

        <a href="index.php">Home</a>
    </div>
</body>

</html>