<?php
include('db_connection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $payment_id = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM attendee_payments WHERE payment_id=?");
    $stmt->bind_param("i", $payment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $attendee_id = $row['attendee_id'];
        $amount_paid = $row['amount_paid'];
    } else {
        echo "Payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Attendee Payments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Attendee Payments form -->
        <h2><u>Update Form of Attendee Payments</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="attendee_id">Attendee ID:</label>
            <input type="number" name="attendee_id" value="<?php echo isset($attendee_id) ? $attendee_id : ''; ?>">
            <br><br>

            <label for="amount_paid">Amount Paid:</label>
            <input type="text" name="amount_paid" value="<?php echo isset($amount_paid) ? $amount_paid : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendee_id = $_POST['attendee_id'];
    $amount_paid = $_POST['amount_paid'];
    
    // Update the attendee payment in the database
    $stmt = $connection->prepare("UPDATE attendee_payments SET attendee_id=?, amount_paid=? WHERE payment_id=?");
    $stmt->bind_param("idi", $attendee_id, $amount_paid, $payment_id);
    if ($stmt->execute()) {
        echo "Attendee payment updated successfully! <br><br>
             <a href='attendee_payments.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
