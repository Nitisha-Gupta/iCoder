<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="adminstyle.css"/>
</head>
<body>
    <h1>File List</h1>
     <form action="approve.php" method="post" id="fileForm">
        <table>
            <tr>
                <th>Select</th>
                <th>Filename</th>
                <th>Title</th>
                <th>Upload Date</th>
                <!-- <th>Category</th> -->
                <th>File Type</th>
                <th>Uploader</th>
                <!-- <th></th> -->
            </tr>
            <?php
                require_once("db_functions.php");

                $result = pendingApp();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td><input type="checkbox" name="files[]" value="' . $row["id"] . '"></td>';
                        echo '<td>' . $row["filename"] . '</td>';
                        echo '<td>' . $row["title"] . '</td>';
                        echo '<td>' . $row["create_datetime"] . '</td>';
                        // echo '<td>' . $row["category"] . '</td>';
                        echo '<td>' . $row["file_type"] . '</td>';
                        echo '<td>' . $row["uploader"] . '</td>';
                        // echo '<td><a href="view.php?id=' . $row["id"] . '" target="_blank">View</a></td>';

                        echo '</tr>';
                    }
                    echo '</table>';
                    echo '<input type="submit" value="Approve Selected Files" style="cursor: pointer;"><br/><br/>';
                    echo '<button style="cursor: pointer;" type="button" onclick="deleteSelected()">Delete</button>';
                } else {
                    echo '</table>';
                    echo "No files found.";
                }
            ?>
    </form>
   <br><a href="userinfo.php?id=1">View User Info</a><br><br><br><br>
   <a href="index.php"> Home Page</a>

</body>
<script>
    function SelectionD() {
        if (confirm("Are you sure you want to delete the selected files?")) {
            document.getElementById("fileForm").action = "delete.php";
            document.getElementById("fileForm").submit();
        }
    }
</script>
</html>
