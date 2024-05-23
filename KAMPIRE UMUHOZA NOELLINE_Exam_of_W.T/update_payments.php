<?php
include('db_connection.php');

// Check if PaymentID is set
if(isset($_REQUEST['PaymentID'])) {
    $PaymentID = $_REQUEST['PaymentID'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE PaymentID=?");
    $stmt->bind_param("i", $PaymentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $Amount = $row['Amount'];
        $PaymentDate = $row['PaymentDate'];
        $Status = $row['Status'];
    } else {
        echo "Payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Payments Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Payments form -->
        <h2><u>Update Form of Payments</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="Amount">Amount:</label>
            <input type="number" name="Amount" value="<?php echo isset($Amount) ? $Amount : ''; ?>">
            <br><br>

            <label for="PaymentDate">Payment Date:</label>
            <input type="datetime-local" name="PaymentDate" value="<?php echo isset($PaymentDate) ? $PaymentDate : ''; ?>">
            <br><br>

            <label for="Status">Status:</label>
            <input type="text" name="Status" value="<?php echo isset($Status) ? $Status : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['user_id'];
    $Amount = $_POST['Amount'];
    $PaymentDate = $_POST['PaymentDate'];
    $Status = $_POST['Status'];
    
    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payments SET user_id=?, Amount=?, PaymentDate=?, Status=? WHERE PaymentID=?");
    $stmt->bind_param("idbsi", $user_id, $Amount, $PaymentDate, $Status, $PaymentID);
    if ($stmt->execute()) {
        echo "Payment updated successfully! <br><br>
             <a href='payments.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
