<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = '127.0.0.1';
$username = 'u963859540_siqurban_mbrkh'; // ganti dengan benar
$password = 'u963859540_siqurban_mbrkh'; // ganti dengan benar
$database = 'u963859540_siqurban_mbrkh'; // ganti dengan benar

$mysqli = new mysqli($host, $username, $password, $database);
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename="backup_' . date('Y-m-d_H-i-s') . '.sql"');

$tables = [];
$result = $mysqli->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

foreach ($tables as $table) {
    echo "-- Table structure for table `$table` --\n\n";
    $result = $mysqli->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_row();
    echo $row[1] . ";\n\n";

    echo "-- Data for table `$table` --\n\n";
    $result = $mysqli->query("SELECT * FROM $table");
    while ($row = $result->fetch_assoc()) {
        $keys = array_map(fn($key) => "`" . str_replace("`", "``", $key) . "`", array_keys($row));
        $values = array_map(fn($val) => "'" . $mysqli->real_escape_string($val) . "'", array_values($row));
        echo "INSERT INTO `$table` (" . implode(",", $keys) . ") VALUES (" . implode(",", $values) . ");\n";
    }
    echo "\n";
}

$mysqli->close();
exit;
