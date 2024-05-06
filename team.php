<?php
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '123';
$database = 'cloudfinalproj';

// Create a connection to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully<br>";

// Path to SQL script file
$sqlScriptPath = 'C:\xampp\htdocs\cloudfinalproj.sql';

// Check if the SQL script file exists
if (file_exists($sqlScriptPath)) {
    // Read SQL script content
    $sqlScript = file_get_contents($sqlScriptPath);

    // Execute SQL script
    if ($conn->multi_query($sqlScript)) {
        // Process and free the result sets
        do {
            // Store and free each result set
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());

        echo "SQL script executed successfully<br>";

        // Now fetch team data from the database
        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "Student_ID: " . $row["Student_ID"] . " | First_Name: " . $row["First_Name"] . " | CGPA: " . $row["CGPA"] . " | Age: " . $row["Age"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    } else {
        echo "Error executing SQL script: " . $conn->error;
    }
} else {
    echo "SQL script file not found";
}

// Close database connection
$conn->close();
?>
