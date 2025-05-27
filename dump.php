<?php

// Database connection parameters
$host = '127.0.0.1';
$username = 'u963859540_siqurban';
$password = 'u963859540_siqurban';
$database = 'u963859540_siqurban';

// Create a new MySQLi connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Get all table names in the database
$tables = array();
$result = $mysqli->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Create SQL dump file
$filename = 'database_dump_' . date('Y-m-d_H-i-s') . '.sql';
$handle = fopen($filename, 'w');

// Dump table structures and data
foreach ($tables as $table) {
    fwrite($handle, "-- Table structure for table `$table` --\n\n");
    $result = $mysqli->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_row();
    fwrite($handle, $row[1] . ";\n\n");

    fwrite($handle, "-- Data for table `$table` --\n\n");
    $result = $mysqli->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $keys = array_map('addslashes', array_keys($row));
        $values = array_map('addslashes', array_values($row));
        fwrite($handle, "INSERT INTO `$table` (`" . implode('`,`', $keys) . "`) VALUES ('" . implode("','", $values) . "');\n");
    }
    fwrite($handle, "\n");
}

fclose($handle);

echo "Database dump saved to $filename";

// Close MySQLi connection
$mysqli->close();

?>
