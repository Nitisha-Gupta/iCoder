<?php

require_once("db_connection.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newUsername = $_POST['new_username'];
        $newEmail = $_POST['new_email'];

        $updateSql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssi", $newUsername, $newEmail, $userId);

        if ($stmt->execute()) {
            header("Location: userinfo.php");
            exit();
        } else {
            echo "Error updating user information: " . $stmt->error;
        }

        $stmt->close();
    }

    $selectSql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($selectSql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentUsername = $row['username'];
        $currentEmail = $row['email'];
    } else {
        echo "User not found.";
    }

    $stmt->close();
} else {
    echo "User ID not provided.";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="edit_user.css">

</head>
<body>
    <h1>Edit User Information</h1>
    <form method="POST" action="">
        <label for="new_username">New Username:</label>
        <input type="text" id="new_username" name="new_username" value="<?php echo $currentUsername; ?>" required><br>

        <label for="new_email">New Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $currentEmail; ?>" required><br>

        <!-- Add more input fields -->

        <input type="submit" value="Update">
    </form>
</body>
</html>
