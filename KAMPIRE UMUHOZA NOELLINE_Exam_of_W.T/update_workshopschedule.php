<?php
include('db_connection.php');

// Check if schedule_id is set
if(isset($_REQUEST['schedule_id'])) {
    $schedule_id = $_REQUEST['schedule_id'];
    
    $stmt = $connection->prepare("SELECT * FROM workshop_schedule WHERE schedule_id=?");
    $stmt->bind_param("i", $schedule_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $workshop_id = $row['workshop_id'];
        $date_time = $row['date_time'];
    } else {
        echo "Schedule not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Workshop Schedule Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Workshop Schedule form -->
        <h2><u>Update Form of Workshop Schedule</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="workshop_id">Workshop ID:</label>
            <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
            <br><br>

            <label for="date_time">Date and Time:</label>
            <input type="datetime-local" name="date_time" value="<?php echo isset($date_time) ? $date_time : ''; ?>">
            <br><br>

            <input type="hidden" name="schedule_id" value="<?php echo isset($schedule_id) ? $schedule_id : ''; ?>">
            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $date_time = $_POST['date_time'];
    $schedule_id = $_POST['schedule_id'];
    
    // Update the workshop schedule in the database
    $stmt = $connection->prepare("UPDATE workshop_schedule SET workshop_id=?, date_time=? WHERE schedule_id=?");
    $stmt->bind_param("isi", $workshop_id, $date_time, $schedule_id);
    if ($stmt->execute()) {
        echo "Workshop schedule updated successfully! <br><br>
             <a href='workshop_schedule.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
