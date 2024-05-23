<?php
include('db_connection.php');

// Check if attendee_id is set
if(isset($_REQUEST['attendee_id'])) {
    $attendee_id = $_REQUEST['attendee_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM attendees WHERE attendee_id=?");
        $stmt->bind_param("i", $attendee_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>
                 <a href='attendees.php'>OK</a>";
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
                <input type="hidden" name="attendee_id" value="<?php echo $attendee_id; ?>">
                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "attendee_id is not set.";
}

$connection->close();
?>
