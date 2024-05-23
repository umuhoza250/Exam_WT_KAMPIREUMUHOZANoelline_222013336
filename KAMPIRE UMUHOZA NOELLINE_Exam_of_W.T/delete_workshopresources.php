<?php
include('db_connection.php');

// Check if workshop_resource_id is set
if(isset($_REQUEST['workshop_resource_id'])) {
    $workshop_resource_id = $_REQUEST['workshop_resource_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM workshop_resources WHERE workshop_resource_id=?");
        $stmt->bind_param("i", $workshop_resource_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>
                 <a href='workshop_resources.php'>OK</a>";
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
                <input type="hidden" name="workshop_resource_id" value="<?php echo $workshop_resource_id; ?>">
                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "workshop_resource_id is not set.";
}

$connection->close();
?>
