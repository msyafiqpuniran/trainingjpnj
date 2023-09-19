<!DOCTYPE html>
<html>

<head>
    <title>Student Data</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Student Data</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Math</th>
            <th>Science</th>
            <th>History</th>
        </tr>

        <?php
        // Sample PHP array
        $students = array(
            array(
                'id' => 1,
                'name' => 'Alice',
                'class' => 'Class A',
                'marks' => array(
                    'Math' => 85,
                    'Science' => 92,
                    'History' => 78
                )
            ),
            array(
                'id' => 2,
                'name' => 'Bob',
                'class' => 'Class B',
                'marks' => array(
                    'Math' => 76,
                    'Science' => 88,
                    'History' => 72
                )
            ),
            array(
                'id' => 3,
                'name' => 'Charlie',
                'class' => 'Class A',
                'marks' => array(
                    'Math' => 90,
                    'Science' => 94,
                    'History' => 80
                )
            )
            // Add more student records as needed
        );

        // Loop through the student records and display them in the table
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td>" . $student['id'] . "</td>";
            echo "<td>" . $student['name'] . "</td>";
            echo "<td>" . $student['class'] . "</td>";
            echo "<td>" . $student['marks']['Math'] . "</td>";
            echo "<td>" . $student['marks']['Science'] . "</td>";
            echo "<td>" . $student['marks']['History'] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>

</html>