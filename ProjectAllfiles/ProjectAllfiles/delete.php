<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["files"])) {
        require_once("db_functions.php");

        $pendingUploadDirectory = "pending/";
        $selectedFiles = $_POST["files"];

        
        foreach ($selectedFiles as $fileId) {
            $filename = fetchFileInfoById($fileId)->fetch_assoc()["filename"];
            $fileLocation = $pendingUploadDirectory . $filename;
            
            if (file_exists($fileLocation) && unlink($fileLocation) && deleteFileInfoById($fileId)) {
                // Deletion was successful
                echo "<script>alert('File has been deleted successfully.')</script>";
                echo "<script>window.location.href = 'admin.php'</script>";

            } else {
                echo "<script>alert('Error deleting file.')</script>";
                echo "<script>window.location.href = 'admin.php'</script>";
                echo "File does not exist.";
            }
        }

    } else {
        header("Location: admin.php");
        exit;
    }
?>

