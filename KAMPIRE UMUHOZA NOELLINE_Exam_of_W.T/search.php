<?php
include('db_connection.php');

// Check if a search term was provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Define the SQL queries to search across multiple tables
    $queries = [
        "attendees" => "SELECT attendee_id FROM attendees WHERE attendee_id LIKE '%$searchTerm%'",
        "attendee_payments" => "SELECT payment_id FROM attendee_payments WHERE payment_id LIKE '%$searchTerm%'",
        "entrepreneurship_resources" => "SELECT title FROM entrepreneurship_resources WHERE title LIKE '%$searchTerm%'",
        "instructors" => "SELECT full_name FROM instructors WHERE full_name LIKE '%$searchTerm%'",
        "instructor_specializations" => "SELECT specialization FROM instructor_specializations WHERE specialization LIKE '%$searchTerm%'",
        "payments" => "SELECT Amount FROM payments WHERE Amount LIKE '%$searchTerm%'",
        "workshops" => "SELECT workshop_id FROM workshops WHERE workshop_id LIKE '%$searchTerm%'",
        "workshop_resources" => "SELECT workshop_resource_id FROM workshop_resources WHERE workshop_resource_id LIKE '%$searchTerm%'",
        "workshop_schedule" => "SELECT schedule_id FROM workshop_schedule WHERE schedule_id LIKE '%$searchTerm%'",
        "workshop_topics" => "SELECT topic_name FROM workshop_topics WHERE topic_name LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
