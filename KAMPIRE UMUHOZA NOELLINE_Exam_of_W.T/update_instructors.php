<?php
include('db_connection.php');

// Check if instructor_id is set
if(isset($_REQUEST['instructor_id'])) {
    $instructor_id = $_REQUEST['instructor_id'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE instructor_id=?");
    $stmt->bind_param("i", $instructor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id'];
        $full_name = $row['full_name'];
    } else {
        echo "Instructor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Instructors Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Instructors form -->
        <h2><u>Update Form of Instructors</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
            <br><br>

            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" value="<?php echo isset($full_name) ? $full_name : ''; ?>">
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
    $full_name = $_POST['full_name'];
    
    // Update the instructor in the database
    $stmt = $connection->prepare("UPDATE instructors SET user_id=?, full_name=? WHERE instructor_id=?");
    $stmt->bind_param("isi", $user_id, $full_name, $instructor_id);
    if ($stmt->execute()) {
        echo "Instructor updated successfully! <br><br>
             <a href='instructors.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
