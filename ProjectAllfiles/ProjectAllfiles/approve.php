<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["files"])) {
    require_once("db_functions.php");

    $selectedFiles = $_POST["files"];
    foreach ($selectedFiles as $fileId) {
        $result = fetchFileInfoById($fileId);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filename = $row["filename"];
                $fileId = $row["id"];
                $filepath = $row["filestoredpath"];
                $title = $row["title"];
                $create_datetime = $row["create_datetime"];
                $category = $row["category"];
                $file_type = $row["file_type"];
                $uploader = $row["uploader"];

                
                if (empty($title)) {
                    $title = "Default Title"; 
                }

                $sourceFilePath = $filepath . '/' . $filename;
                $uploadDirectory = "uploads/";
                $destinationFilePath = $uploadDirectory . $filename;

                echo "Source Path: $sourceFilePath<br>";
                echo "Destination Path: $destinationFilePath<br>";


                $uploadDirectory = "uploads/";
                $destinationFilePath = $uploadDirectory . $filename;

                if (file_exists($sourceFilePath)) {
                    if (rename($sourceFilePath, $destinationFilePath)) {
                        if (deleteFileInfoById($fileId) && fileInfo($filename, $filepath, $title,  $create_datetime, $category, $file_type, $uploader, "uploaded_files")) {
                            echo "<script>alert('File Approved: $filename')</script>";
                        } else {
                            echo "<script>alert('Error moving the file[1].')</script>";
                        }

                        echo "<script>window.location.href='admin.php'</script>";
                    } else {
                        error_log("Error moving the file[2]: " . error_get_last()['message']);
                        echo "<script>alert('Error moving the file[2].')</script>";
                        echo "<script>window.location.href='admin.php'</script>";
                    }
                } else {
                    echo "<script>alert('Source file does not exist: $sourceFilePath')</script>";
                }
            }
        }
    }
} else {
    header("Location: admin.php");
    exit;
}
?>
