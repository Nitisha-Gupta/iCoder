<?php
if (!isset($_SESSION['userID'])) {
    header("Location: login.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - USER area</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            z-index: 2;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>Lets explore and learn with us.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>


    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <div class ="form">
            <label for="fileInput">Select a File:</label>
            <input type="file" name="fileInput" id="fileInput" required>
            
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="category">Category:</label>
            <textarea name="category" id="category" required></textarea>

            <input type="submit" name="submit" value="Upload File">
     </div>
    </form>
</body>
</html> 