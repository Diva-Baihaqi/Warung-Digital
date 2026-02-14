<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Default laragon

// Create connection without database
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sql = file_get_contents('database.sql');

// Execute multi query
if ($conn->multi_query($sql)) {
    echo "<h1>Setup Berhasil!</h1>";
    echo "<p>Database 'warung_digital' telah dibuat.</p>";
    echo "<p>Data dummy telah ditambahkan.</p>";
    echo "<br><a href='index.php'>Buka Website >></a>";
    
    // Clear results
    do {
        if ($res = $conn->store_result()) {
            $res->free();
        }
    } while ($conn->more_results() && $conn->next_result());
    
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?>
