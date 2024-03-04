<?php
session_start();

// Include database connection code
require_once("db_connection.php");

// Query to retrieve all user data
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Check if there are any users
if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>User Info Page</title>

        <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; 
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #9f87c5; 
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        a {
            color: black; 
            text-decoration: underline;
        }

        a:hover {
            text-decoration: underline; 
            color: peru;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff; 
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        </style>
    </head>
    <body>
        <header>
            <h1>User Info</h1>
            <a href="admin.php">Back to Admin Page</a>
        </header>
        <main>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Register Time</th>
                    <th>Action</th> 
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['username'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['create_datetime'];
                    echo '<td>';
                    echo '<a href="edit_user.php?id=' . $row['id'] . '">Edit</a>'; // Link to edit page
                    echo ' | ';
                    echo '<a href="delete_user.php?id=' . $row['id'] . '">Delete</a>'; // Link to delete page
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </table>
        </main>
    </body>
    </html>
    <?php
} else {
    echo "No users found.";
}

// Close the database connection
$conn->close();
?>
