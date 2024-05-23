<?php
include('db_connection.php');

// Check if specialization_id is set
if(isset($_REQUEST['specialization_id'])) {
    $specialization_id = $_REQUEST['specialization_id'];
    
    $stmt = $connection->prepare("SELECT * FROM instructor_specializations WHERE specialization_id=?");
    $stmt->bind_param("i", $specialization_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $instructor_id = $row['instructor_id'];
        $specialization = $row['specialization'];
    } else {
        echo "Specialization not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Instructor Specializations Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Instructor Specializations form -->
        <h2><u>Update Form of Instructor Specializations</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="instructor_id">Instructor ID:</label>
            <input type="number" name="instructor_id" value="<?php echo isset($instructor_id) ? $instructor_id : ''; ?>">
            <br><br>

            <label for="specialization">Specialization:</label>
            <input type="text" name="specialization" value="<?php echo isset($specialization) ? $specialization : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $instructor_id = $_POST['instructor_id'];
    $specialization = $_POST['specialization'];
    
    // Update the specialization in the database
    $stmt = $connection->prepare("UPDATE instructor_specializations SET instructor_id=?, specialization=? WHERE specialization_id=?");
    $stmt->bind_param("isi", $instructor_id, $specialization, $specialization_id);
    if ($stmt->execute()) {
        echo "Specialization updated successfully! <br><br>
             <a href='instructor_specializations.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
