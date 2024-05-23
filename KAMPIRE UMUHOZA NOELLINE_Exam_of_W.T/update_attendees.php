<?php
include('db_connection.php');

// Check if attendee_id is set
if(isset($_REQUEST['attendee_id'])) {
    $attendee_id = $_REQUEST['attendee_id'];
    
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE attendee_id=?");
    $stmt->bind_param("i", $attendee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $workshop_id = $row['workshop_id'];
    } else {
        echo "Attendee not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Attendees Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Attendees form -->
        <h2><u>Update Form of Attendees</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="workshop_id">Workshop ID:</label>
            <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
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
    $workshop_id = $_POST['workshop_id'];
    
    // Update the attendee in the database
    $stmt = $connection->prepare("UPDATE attendees SET user_id=?, workshop_id=? WHERE attendee_id=?");
    $stmt->bind_param("iii", $user_id, $workshop_id, $attendee_id);
    if ($stmt->execute()) {
        echo "Attendee updated successfully! <br><br>
             <a href='attendees.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
