<?php
include('db_connection.php');

// Check if workshop_id is set
if(isset($_REQUEST['workshop_id'])) {
    $workshop_id = $_REQUEST['workshop_id'];
    
    $stmt = $connection->prepare("SELECT * FROM workshops WHERE workshop_id=?");
    $stmt->bind_param("i", $workshop_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $instructor_id = $row['instructor_id'];
    } else {
        echo "Workshop not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Workshops Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Workshops form -->
        <h2><u>Update Form of Workshops</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
            <br><br>

            <label for="instructor_id">Instructor ID:</label>
            <input type="number" name="instructor_id" value="<?php echo isset($instructor_id) ? $instructor_id : ''; ?>">
            <br><br>

            <input type="hidden" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
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
    $instructor_id = $_POST['instructor_id'];
    $workshop_id = $_POST['workshop_id'];
    
    // Update the workshop in the database
    $stmt = $connection->prepare("UPDATE workshops SET title=?, description=?, instructor_id=? WHERE workshop_id=?");
    $stmt->bind_param("ssii", $title, $description, $instructor_id, $workshop_id);
    if ($stmt->execute()) {
        echo "Workshop updated successfully! <br><br>
             <a href='workshops.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
