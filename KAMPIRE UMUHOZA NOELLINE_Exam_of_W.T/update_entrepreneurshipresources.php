<?php
include('db_connection.php');

// Check if resource_id is set
if(isset($_REQUEST['resource_id'])) {
    $resource_id = $_REQUEST['resource_id'];
    
    $stmt = $connection->prepare("SELECT * FROM entrepreneurship_resources WHERE resource_id=?");
    $stmt->bind_param("i", $resource_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
    } else {
        echo "Resource not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Entrepreneurship Resources Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Resources form -->
        <h2><u>Update Form of Entrepreneurship Resources</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
            <br><br>

            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Update the resource in the database
    $stmt = $connection->prepare("UPDATE entrepreneurship_resources SET title=?, description=? WHERE resource_id=?");
    $stmt->bind_param("ssi", $title, $description, $resource_id);
    if ($stmt->execute()) {
        echo "Resource updated successfully! <br><br>
             <a href='entrepreneurship_resources.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
