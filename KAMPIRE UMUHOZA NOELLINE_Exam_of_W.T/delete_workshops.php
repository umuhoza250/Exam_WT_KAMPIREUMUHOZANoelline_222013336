<?php
include('db_connection.php');

// Check if workshop_id is set
if(isset($_REQUEST['workshop_id'])) {
    $workshop_id = $_REQUEST['workshop_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM workshops WHERE workshop_id=?");
        $stmt->bind_param("i", $workshop_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>
                 <a href='workshops.php'>OK</a>";
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
                <input type="hidden" name="workshop_id" value="<?php echo $workshop_id; ?>">
                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "workshop_id is not set.";
}

$connection->close();
?>
