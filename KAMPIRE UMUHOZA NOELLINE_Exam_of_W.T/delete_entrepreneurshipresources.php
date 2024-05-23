<?php
include('db_connection.php');

// Check if resource_id is set
if(isset($_REQUEST['resource_id'])) {
    $resource_id = $_REQUEST['resource_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM entrepreneurship_resources WHERE resource_id=?");
        $stmt->bind_param("i", $resource_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>
                 <a href='entrepreneurship_resources.php'>OK</a>";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Record</title>
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this record?");
                }
            </script>
        </head>
        <body>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="resource_id" value="<?php echo $resource_id; ?>">
                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "resource_id is not set.";
}

$connection->close();
?>
