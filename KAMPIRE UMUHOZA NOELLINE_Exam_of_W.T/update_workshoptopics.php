<?php
include('db_connection.php');

// Check if topic_id is set
if(isset($_REQUEST['topic_id'])) {
    $topic_id = $_REQUEST['topic_id'];
    
    $stmt = $connection->prepare("SELECT * FROM workshop_topics WHERE topic_id=?");
    $stmt->bind_param("i", $topic_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $workshop_id = $row['workshop_id'];
        $topic_name = $row['topic_name'];
    } else {
        echo "Topic not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Record in Workshop Topics Table</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Workshop Topics form -->
        <h2><u>Update Form of Workshop Topics</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">

            <label for="workshop_id">Workshop ID:</label>
            <input type="number" name="workshop_id" value="<?php echo isset($workshop_id) ? $workshop_id : ''; ?>">
            <br><br>

            <label for="topic_name">Topic Name:</label>
            <input type="text" name="topic_name" value="<?php echo isset($topic_name) ? $topic_name : ''; ?>">
            <br><br>

            <input type="hidden" name="topic_id" value="<?php echo isset($topic_id) ? $topic_id : ''; ?>">
            <input type="submit" name="up" value="Update">
            
        </form>
    </center>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $topic_name = $_POST['topic_name'];
    $topic_id = $_POST['topic_id'];
    
    // Update the workshop topic in the database
    $stmt = $connection->prepare("UPDATE workshop_topics SET workshop_id=?, topic_name=? WHERE topic_id=?");
    $stmt->bind_param("isi", $workshop_id, $topic_name, $topic_id);
    if ($stmt->execute()) {
        echo "Workshop topic updated successfully! <br><br>
             <a href='workshop_topics.php'>OK</a>";
        // Consider redirecting to a success page or displaying confirmation
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>
