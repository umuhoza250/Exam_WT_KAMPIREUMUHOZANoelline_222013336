<?php
include('db_connection.php');

// Check if workshop_resource_id is set
if(isset($_REQUEST['workshop_resource_id'])) {
    $workshop_resource_id = $_REQUEST['workshop_resource_id'];
    
    $stmt = $connection->prepare("SELECT * FROM workshop_resources WHERE workshop_resource_id=?");
    $stmt->bind_param("i", $workshop_resource_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $workshop_id = $row['workshop_id'];
        $resource_id = $row['resource_id'];
    } else {
        echo "Workshop resource not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Workshop Resources Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Workshop Resources form -->
        <h2><u>Update Form of Workshop Resources</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="workshop_id">Workshop ID:</label>
            <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
            <br><br>

            <label for="resource_id">Resource ID:</label>
            <input type="number" name="resource_id" value="<?php echo isset($resource_id) ? $resource_id : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $resource_id = $_POST['resource_id'];
    
    // Update the workshop resource in the database
    $stmt = $connection->prepare("UPDATE workshop_resources SET workshop_id=?, resource_id=? WHERE workshop_resource_id=?");
    $stmt->bind_param("iii", $workshop_id, $resource_id, $workshop_resource_id);
    if ($stmt->execute()) {
        echo "Workshop resource updated successfully! <br><br>
             <a href='workshop_resources.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
