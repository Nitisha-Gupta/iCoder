<?php
    require_once("./db_connection.php");


    function fileInfo($filename, $filepath, $title, $create_datetime, $category, $file_type, $uploader, $tablename) {
        
        global $conn;
    
        if (!$conn) {
            die("Database connection is not available.");
        }
    
        $file_type = pathinfo($filename, PATHINFO_EXTENSION);
    
        session_start();
        if (isset($_SESSION['username'])) {
            $uploader = $_SESSION['username'];
        } else {
            $uploader = 'Unknown';
        }
    
        $create_datetime = date("Y-m-d H:i:s");
    
        $sql = "INSERT INTO " . $tablename . " (filename, filestoredpath, title, create_datetime, category, file_type, uploader) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            die("Error in SQL statement: " . $conn->error);
        }
    
        $stmt->bind_param("ssssiss", $filename, $filepath, $title, $create_datetime, $category, $file_type, $uploader);
    
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: " . $stmt->error;
            exit;
        }
    }
        
         

        function getDetails($fileId) {
            global $conn; 
            $id = mysqli_real_escape_string($conn, $fileId);
            $query = "SELECT * FROM pending_files_for_approval WHERE id = '$id'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        }

    


    function pendingApp() {
        global $conn;
        $sql = "SELECT id, filename,filestoredpath, title, create_datetime, category, file_type, uploader FROM pending_files_for_approval";

        $result = $conn->query($sql);
        return $result;
    }

    function fetchF() {
        global $conn;
        $sql = "SELECT filename, title, create_datetime, category, file_type, uploader FROM uploaded_files";

        $result = $conn->query($sql);
        return $result;
    }


    function fetchFileInfoById($fileId) {
        global $conn;

        $sql = "SELECT id, filename, filestoredpath, category, create_datetime, uploader FROM pending_files_for_approval WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $fileId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }

    function deleteFileInfoById($fileId) {
        global $conn;
    
        $sql = "DELETE FROM pending_files_for_approval WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $fileId);
        $success = $stmt->execute();

        if ($success) {
            return true;
        } else {
            return false;
        }
    }    
?>