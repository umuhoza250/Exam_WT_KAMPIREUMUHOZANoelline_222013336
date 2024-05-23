<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Workshop Schedule entity Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: yellow;
      background-color: green;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: orange;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: dimgray;
    }

    /* Active link */
    a:active {
      background-color: yellow;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
      background-color: yellow;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1250px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    header{
    background-color:pink;
    padding: 20px;
}

section{
    padding:28px;
    border-bottom: 1px solid #ddd;
}
footer{
    text-align: center;
    padding: 15px;
    background-color:pink;
}
  </style>
   <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="yellow">
  <form method="GET" class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/logo.jpeg" width="90" height="70" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">Attendees</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./attendee_payments.php">Attend-Payments</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./entrepreneurship_resources.php">Entre-Resources</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">Instructors</a></li>

    <li style="display: inline; margin-right: 10px;"><a href="./instructor_specializations.php">Specializations</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./payments.php">Payments</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">Workshops</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./workshop_resources.php">Resources</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./workshop_schedule.php">Schedule</a></li>

     <li style="display: inline; margin-right: 10px;"><a href="./workshop_topics.php"> Topics</a></li>
    
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Account</a>
         <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
  <center>
  <center><h1><u>Workshop Schedule Form</u></h1></center>

<form method="post" onsubmit="return confirmInsert();">
        <label for="schedule_id">Schedule ID:</label>
        <input type="number" id="schedule_id" name="schedule_id"><br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" id="workshop_id" name="workshop_id" required><br><br>

        <label for="date_time">Date & Time:</label>
        <input type="datetime-local" id="date_time" name="date_time" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>



    <?php
    include('db_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind the parameters
        $stmt = $connection->prepare("INSERT INTO workshop_schedule(schedule_id, workshop_id, date_time) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $schedule_id, $workshop_id, $date_time);
        // Set parameters and execute
        $schedule_id = $_POST['schedule_id'];
        $workshop_id = $_POST['workshop_id'];
        $date_time = $_POST['date_time'];
       
        if ($stmt->execute() == TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Information of Workshop Schedule</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <center><h2>Table of Workshop Schedule</h2></center>
    <table border="5">
        <tr>
            <th>Schedule ID</th>
            <th>Workshop ID</th>
            <th>Date & Time</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('db_connection.php');

        // Prepare SQL query to retrieve all workshop schedules
        $sql = "SELECT * FROM workshop_schedule";
        $result = $connection->query($sql);

        // Check if there are any workshop schedules
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $schedule_id = $row['schedule_id']; // Fetch the Schedule ID
                echo "<tr>
                    <td>" . $row['schedule_id'] . "</td>
                    <td>" . $row['workshop_id'] . "</td>
                    <td>" . $row['date_time'] . "</td>
                    <td><a style='padding:4px' href='delete_workshopschedule.php?schedule_id=$schedule_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_workshopschedule.php?schedule_id=$schedule_id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
  </body>
</section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy for 2024, Designer by: KAMPIRE UMUHOZA NOELLINE</h2></b>
  </center>
</footer>
  
</body>
</html>
