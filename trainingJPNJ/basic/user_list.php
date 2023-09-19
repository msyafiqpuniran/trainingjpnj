<?php
// Database connection (use your own credentials)
include('db_config.php');

// Handle password reset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reset_user"])) {
    $userId = $_POST["user_id"];

    // Reset the user's password to the default value
    $defaultPassword = password_hash("123456", PASSWORD_DEFAULT);
    $resetPasswordQuery = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($resetPasswordQuery);
    $stmt->bind_param("si", $defaultPassword, $userId);

    if ($stmt->execute()) {
        // Password reset successful
        echo "<script>
            alert('Record successfully updated');
            window.location.href = 'user_list.php';
        </script>";
        // header("Location: user_list.php");
        exit();
    } else {
        echo "<script>
            alert('" . $stmt->error . "');
        </script>";
        // echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all users from the database
$sql = "SELECT id, username FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>User List</title>
</head>

<body>
    <div class="container mt-5">
        <h1>User List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="user_id" value="<?php echo $row["id"]; ?>">
                                <button type="submit" class="btn btn-danger" name="reset_user" onclick='return confirmReset()'>Reset Password</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php include('navMenu.php'); ?>
    </div>

    <script>
        function confirmReset() {
            return confirm("Are you sure you want to reset password for this record?");
        }
    </script>
</body>

</html>