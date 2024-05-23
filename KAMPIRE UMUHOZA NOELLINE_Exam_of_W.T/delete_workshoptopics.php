<?php
include('db_connection.php');

// Check if TopicID is set
if(isset($_REQUEST['TopicID'])) {
    $topicId = $_REQUEST['TopicID'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM workshop_topics WHERE topic_id=?");
        $stmt->bind_param("i", $topicId);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>
                 <a href='workshop_topics.php'>OK</a>";
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
                <input type="hidden" name="topicId" value="<?php echo $topicId; ?>">
                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "TopicID is not set.";
}

$connection->close();
?>
