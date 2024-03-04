<!DOCTYPE html>
<html>
<head>
    <title>View File</title>
</head>
<body>
    <?php
    require_once("db_functions.php");

    if (isset($_GET['id'])) {
        $fileId = $_GET['id'];
        $fileDetails = getDetails($fileId);

        if ($fileDetails) {
            echo '<h1>File Details</h1>';
            echo '<p><strong>Filename:</strong> ' . $fileDetails['filename'] . '</p>';
            echo '<p><strong>Title:</strong> ' . $fileDetails['title'] . '</p>';
            echo '<p><strong>Upload Date:</strong> ' . $fileDetails['create_datetime'] . '</p>';
            echo '<p><strong>File Type:</strong> ' . $fileDetails['file_type'] . '</p>';
            echo '<p><strong>Uploader:</strong> ' . $fileDetails['uploader'] . '</p>';

             // previous code
            // Display or provide download links based on file type
            // $fileType = $fileDetails['file_type'];
            // $filePath = 'your_file_directory/' . $fileDetails['filename']; 

            //modified one
            // For displaying the file in the browser
            echo '<p><a href="' . $filePath . '" target="_blank">View File</a></p>';

            // For downloading the file
            echo '<p><a href="' . $filePath . '" download>Download File</a></p>';


            if (strpos($fileType, 'image') !== false) {
                // Display images
                echo '<img src="' . $filePath . '" alt="' . $fileDetails['filename'] . '">';
            } elseif ($fileType == 'application/pdf') {
                // Display PDF files using an embedded viewer
                echo '<embed src="' . $filePath . '" type="application/pdf" width="100%" height="500px" />';
            } elseif (strpos($fileType, 'video') !== false) {
                // Display video files (
                echo '<video width="100%" controls><source src="' . $filePath . '" type="' . $fileType . '">Your browser does not support the video tag.</video>';
            } elseif (strpos($fileType, 'audio') !== false) {
                // Display audio files 
                echo '<audio controls><source src="' . $filePath . '" type="' . $fileType . '">Your browser does not support the audio element.</audio>';
            } else {
                // Provide a download link for other file types
                echo '<p><a href="' . $filePath . '" download>Download File</a></p>';
            }
        } else {
            echo 'File not found.';
        }
    } else {
        echo 'Invalid file ID.';
    }
    ?>
    <br><a href="viewfiles.php">Back to File List</a>
</body>
</html>
