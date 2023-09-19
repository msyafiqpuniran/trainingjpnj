<a href="index.php" id="home">Home |</a>
<a href="add.php">Add Student |</a>
<a href="user_list.php">User List |</a>
<a href="grades.php">Average Grades |</a>
<a href="graph.php">Graph |</a>
<a href="logout.php" onclick="return confirmLogout()">Logout</a>

<script>
    // Get the current URL
    var currentUrl = window.location.href;

    // Get references to the menu items
    var homeLink = document.getElementById("home");

    // Compare the current URL with the href attributes and hide the matching menu item
    if (currentUrl.includes("index.php")) {
        homeLink.style.display = "none";
    }
</script>