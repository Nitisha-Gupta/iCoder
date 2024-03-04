<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="adminstyle.css"/>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table, th, td {
            border: 1px solid #ccc;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Uploaded Files</h1>
    <table>
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Filename</th>
                <th>Title</th>
                <th>Upload Date</th>
                <!-- <th>Category</th> -->
                <th>File Type</th>
                <th>Uploader</th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once("db_functions.php");

                $result = fetchF();
                if ($result->num_rows > 0) {
                    $serialNumber = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $serialNumber . '</td>';
                        echo '<td>' . $row["filename"] . '</td>';
                        echo '<td>' . $row["title"] . '</td>';
                        echo '<td>' . $row["create_datetime"] . '</td>';
                        // echo '<td>' . $row["category"] . '</td>';
                        echo '<td>' . $row["file_type"] . '</td>';
                        echo '<td>' . $row["uploader"] . '</td>';
                        echo '</tr>';
                        $serialNumber++;
                    }
                } else {
                    echo '<tr><td colspan="7">No files found.</td></tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>
