<?php
session_start();
require_once("db_connection.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $deleteSql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        header("Location: userinfo.php");
        exit();
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User ID not provided.";
}

$conn->close();
?>
