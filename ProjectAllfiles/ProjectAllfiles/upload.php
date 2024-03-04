<?php
session_start();

require_once("./db_functions.php");

if (isset($_POST["submit"])) {
    $pendingUploadDirectory = "./pending/";

    if (empty($_FILES["fileInput"]["name"])) {
        echo '<script>alert("Please choose a file to upload.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit;
    }

    $base_filename = basename($_FILES["fileInput"]["name"]);
    $pendingDirPathWithFilename = $pendingUploadDirectory . $base_filename;

    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);

    if ($fileInfo === false) {
        echo '<script>alert("File type detection not supported.");</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit;
    }

    $longFileType = finfo_file($fileInfo, $_FILES["fileInput"]["tmp_name"]);
    $fileType = explode("/", $longFileType)[1];
    finfo_close($fileInfo);

    $uploadDirectory = 'uploads/';
    $targetFile = $uploadDirectory . $base_filename;

    if (file_exists($targetFile)) {
        echo "<script>alert(`Sorry, the file '" . $base_filename . "' already exists`);</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    }

    $allowedFileTypes = array("jpg", "jpeg", "png", "pdf", "mp4", "mp3");
    if (!in_array($fileType, $allowedFileTypes)) {
        echo "This file type is not allowed.\n";
        return;
    }

    if (isset($_POST["category"])) {
        $category = $_POST["category"];
    } else {
        $category = "Uncategorized"; 
    }


    if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $pendingDirPathWithFilename)) {
        $filename = $_FILES["fileInput"]["name"];
        $tablename = "pending_files_for_approval";
        $filepath = $pendingUploadDirectory;
        $title = $_POST["title"];
        $create_datetime = date("Y-m-d H:i:s"); //current date and time
        $category = $_POST["category"];
        $file_type = $fileType;
        $uploader = $username;


        if (fileInfo($filename, $filepath, $title, $create_datetime, $category,$fileType, $uploader, $tablename)) {
            echo '<script>alert("The file ' . basename($_FILES["fileInput"]["name"]) . ' has been uploaded.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        } else {
            echo "<script>alert('Error saving file info to the database');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
