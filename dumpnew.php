<?php
// Konfigurasi database
$host = "127.0.0.1";
$user = "u963859540_siqurban";
$pass = "u963859540_siqurban";
$db   = "u963859540_siqurban";

// Koneksi
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Nama file yang akan diunduh
$filename = "backup_{$db}_" . date("Ymd_His") . ".sql";

// Header agar langsung download
header("Content-Type: application/sql");
header("Content-Disposition: attachment; filename=\"$filename\"");

$output = "";

// Backup struktur dan data
$tables = [];
$res = $conn->query("SHOW TABLES");
while ($row = $res->fetch_array()) {
    $tables[] = $row[0];
}

foreach ($tables as $table) {
    // Struktur tabel
    $res = $conn->query("SHOW CREATE TABLE `$table`");
    $row = $res->fetch_assoc();
    $output .= "-- Struktur tabel `$table`\n";
    $output .= $row['Create Table'] . ";\n\n";

    // Data tabel
    $res = $conn->query("SELECT * FROM `$table`");
    while ($r = $res->fetch_assoc()) {
        $vals = array_map([$conn, 'real_escape_string'], array_values($r));
        $vals = array_map(fn($v) => "'" . $v . "'", $vals);
        $output .= "INSERT INTO `$table` VALUES (" . implode(", ", $vals) . ");\n";
    }
    $output .= "\n\n";
}

echo $output;
exit;
