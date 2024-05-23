<?php
include('db_connection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM attendee_payments WHERE payment_id=?");
        $stmt->bind_param("i", $payment_id);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.<br><br>
                 <a href='payments.php'>OK</a>";
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
                <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
                <input type="submit" value="Delete">
            </form>
        </body>
        </html>
        <?php
    }
} else {
    echo "payment_id is not set.";
}

$connection->close();
?>
