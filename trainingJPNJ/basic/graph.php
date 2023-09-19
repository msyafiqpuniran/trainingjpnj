<!DOCTYPE html>
<html>

<head>
    <title>Grade Averages Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h1>Grade Averages Graph</h1>

        <!-- Dropdown to select class -->
        <label for="classSelect">Select Class:</label>
        <select id="classSelect">
            <option value="">Show All Classes</option>
            <?php
            // Database connection
            include('db_config.php');

            // SQL query to retrieve class names
            $classSql = "SELECT DISTINCT class_name, class_id FROM classes";
            $classResult = $conn->query($classSql);

            if ($classResult->num_rows > 0) {
                while ($classRow = $classResult->fetch_assoc()) {
                    echo "<option value='" . $classRow["class_id"] . "'>" . $classRow["class_name"] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select>

        <!-- Canvas for the chart -->
        <div style="width: 80%; margin: 0 auto;">
            <canvas id="gradesChart"></canvas>
        </div>

        <?php include('navMenu.php'); ?>
    </div>

    <script>
        // Function to update the chart based on the selected class
        function updateChart(selectedClass) {
            // Database connection
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    var data = JSON.parse(this.responseText);


                    // Update the chart's data and labels
                    myChart.data.datasets[0].data = data.values;
                    myChart.data.labels = data.labels;
                    myChart.update();

                    // Show the chart
                    document.getElementById('gradesChart').style.display = 'block';
                }
            };

            // Send an AJAX request to fetch data for the selected class
            xhttp.open("GET", "fetch_data.php?class=" + selectedClass, true);
            xhttp.send();
        }

        // Data (initially empty)
        var initialData = [];
        var initialLabels = [];

        // Set the initial selectedClass to an empty string to show all classes by default
        var selectedClass = "";

        // Configuration
        var options = {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100 // Set the maximum value for the y-axis
                }
            },
            plugins: {
                legend: {
                    display: false, // Hide the legend
                }
            }
        };

        // Create the chart with initial data and labels
        var ctx = document.getElementById('gradesChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: initialLabels,
                datasets: [{
                    label: 'Average Grades',
                    backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                    borderWidth: 1,
                    data: initialData
                }]
            },
            options: options
        });

        // Immediately update the chart with data for all classes
        updateChart(selectedClass);

        // Listen for changes in the class dropdown
        var classSelect = document.getElementById('classSelect');
        classSelect.addEventListener('change', function() {
            selectedClass = classSelect.value;
            updateChart(selectedClass);
        });
    </script>
</body>

</html>